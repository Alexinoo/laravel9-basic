<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Blog_category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Image;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Blog::latest()->get();
        return view('Admin.Blog.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blog_categories = Blog_category::latest()->get();
        return view('Admin.Blog.create' ,compact('blog_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //LOGIC - Delete from destination and upload a new image
        if ($request->hasfile('blog_image')) {

            //PROCEED WITH THE UPLOAD

            $image = $request->file('blog_image');

            // get file extension - assign a unique name
            $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            // Use Image Intervention to resize and save in public directory
            $image_resize = Image::make($image->getRealPath())->resize(430, 327)->save('upload/Blog_images/' . $img_name, 80);

            Blog::insert([
                'blog_category_id' =>  $request->blog_category_id,
                'blog_title' =>  $request->blog_title,
                'blog_tags' =>  $request->blog_tags,
                'blog_description' =>  $request->blog_description,
                'blog_image' =>  $img_name,
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Blog data Inserted successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('blog.index')->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Blog::findOrFail($id);

        $blogs = Blog::latest()->limit(5)->get();

        $blog_categories = Blog_category::latest()->get();

        return view('Frontend.Blog.blog_details', compact('model','blogs', 'blog_categories'));
    }

    public function viewCategoryBlogDetails($id)
    {
        $model = Blog::where('blog_category_id' ,$id)->orderBy('id','desc')->get();

        $blogs = Blog::latest()->limit(5)->get();

        $blog_categories = Blog_category::latest()->get();

        $category_name = Blog_category::findOrFail($id);

        return view('Frontend.Blog.category_blog_details', compact('model', 'blogs', 'blog_categories', 'category_name'));
    }


    public function HomeBlog()
    {

        $allBlogs = Blog::latest()->get();

        $blog_categories = Blog_category::latest()->get();

        return view('Frontend.Blog', compact('allBlogs', 'blog_categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Blog::findOrFail($id);
        
        $blog_categories = Blog_category::latest()->get();

        return view('Admin.Blog.edit', compact('model','blog_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = Blog::find($id);

        //LOGIC - Delete from destination and upload a new image
        if ($request->hasfile('blog_image')) {

            $destination = public_path('upload/Blog_images/' . $model->blog_image);

            // Check if image exists in the destination folder
            if (File::exists($destination)) {

                // IF SO - DELETE
                File::delete($destination);
            }


            //PROCEED WITH THE UPLOAD
            $image = $request->file('blog_image');

            // get file extension - assign a unique name
            $img_name = time() . '.' . $image->getClientOriginalExtension();

            // Use Image Intervention to resize and save in public directory
            $image_resize = Image::make($image->getRealPath())->resize(430, 327)->save('upload/Blog_images/' . $img_name, 80);

            Blog::findOrFail($model->id)->update([
                'blog_category_id' =>  $request->blog_category_id,
                'blog_title' =>  $request->blog_title,
                'blog_tags' =>  $request->blog_tags,
                'blog_description' =>  $request->blog_description,
                'blog_image' =>  $img_name,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Blog Updated successfully',
                'alert-type' => 'info'
            );

            return redirect()->route('blog.index')->with($notification);
        } else {

            Blog::findOrFail($model->id)->update([
                'blog_category_id' =>  $request->blog_category_id,
                'blog_title' =>  $request->blog_title,
                'blog_tags' =>  $request->blog_tags,
                'blog_description' =>  $request->blog_description,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Blog Updated without Image successfully',
                'alert-type' => 'info'
            );

            return redirect()->route('blog.index')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $model = Blog::find($id);

        if ($model) {

            $destination = 'upload/Blog_images/' . $model->image;

            // /Check if image exists in the destination folder
            if (File::exists($destination)) {
                // IF SO - DELETE
                File::delete($destination);
            }

            //Delete category itself
            $model->delete();

            $notification = array(
                'message' => 'Blog deleted successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Blog not found',
                'alert-type' => 'error'
            );
        }
    }
  
}
