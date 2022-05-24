<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog_category;
use Illuminate\Http\Request;

class Blog_categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Blog_category::latest()->get();
        return view('Admin.Blog_category.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Blog_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' =>'required'
        ]);

        Blog_category::create([
            'category' => $request->category
        ]);

        $notification = array(
            'message' => 'Blog Category Added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('blog_categories.index')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Blog_category::findOrFail($id);
        return view('Admin.Blog_category.edit', compact('model'));
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
        $request->validate([
            'category' => 'required'
        ]);

        Blog_category::findOrFail($id)->update([
            'category' => $request->category
        ]);

        $notification = array(
            'message' => 'Blog Category Updated successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('blog_categories.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
       $model =  Blog_category::find($id);

       if($model){
            $model->delete();

            $notification = array(
                'message' => 'Blog Category Updated successfully',
                'alert-type' => 'info'
            );

            return redirect()->back()->with($notification);
       }else{

            $notification = array(
                'message' => 'No ID found',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
       }

       
    }
}
