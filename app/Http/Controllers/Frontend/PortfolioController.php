<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Image;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Portfolio::latest()->get();
        return view('Admin.Portfolio.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Portfolio.create');
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
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'portfolio_image' => 'required',
        ],[
            'name.required' => 'Name Cannot be blank',
            'title.required' => 'Title Cannot be blank',
            'description.required' => 'Description Cannot be blank',
            'portfolio_image.required' => 'No image uploaded',
        ]);
        //LOGIC - Delete from destination and upload a new image
        if ($request->hasfile('portfolio_image')) {

            //PROCEED WITH THE UPLOAD

            $image = $request->file('portfolio_image');

            // get file extension - assign a unique name
            $img_name = time() . '.' . $image->getClientOriginalExtension();

            // Use Image Intervention to resize and save in public directory
            $image_resize = Image::make($image->getRealPath())->resize(1020, 519)->save('upload/Portfolio_images/' . $img_name, 80);

            Portfolio::insert([
                'name' =>  $request->name,
                'title' =>  $request->title,
                'description' =>  $request->description,
                'image' =>  $img_name,
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Portfolio Inserted successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('portfolio.index')->with($notification);
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
        $model = Portfolio::find($id);

        return view('Admin.Portfolio.edit',compact('model'));
        
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
        $model = Portfolio::find($id);

        //LOGIC - Delete from destination and upload a new image
        if ($request->hasfile('portfolio_image')) {

            $destination = public_path('upload/Portfolio_images/' . $model->image);

            // Check if image exists in the destination folder
            if (File::exists($destination)) {

                // IF SO - DELETE
                File::delete($destination);
            }


            //PROCEED WITH THE UPLOAD
            $image = $request->file('portfolio_image');

            // get file extension - assign a unique name
            $img_name = time() . '.' . $image->getClientOriginalExtension();

            // Use Image Intervention to resize and save in public directory
            $image_resize = Image::make($image->getRealPath())->resize(1020, 519)->save('upload/Portfolio_images/' . $img_name, 80);

            Portfolio::findOrFail($model->id)->update([
                'name' =>  $request->name,
                'title' =>  $request->title,
                'description' =>  $request->description,
                'image' =>  $img_name,
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Portfolio Updated successfully',
                'alert-type' => 'info'
            );

            return redirect()->route('portfolio.index')->with($notification);
        } else {

            Portfolio::findOrFail($model->id)->update([
                'name' =>  $request->name,
                'title' =>  $request->title,
                'description' =>  $request->description,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Portfolio Updated without Image successfully',
                'alert-type' => 'info'
            );

            return redirect()->route('portfolio.index')->with($notification);
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
        $portfolio = Portfolio::find($id);

        if ($portfolio) {

            $destination = 'upload/Portfolio_images/' . $portfolio->image;

            // /Check if image exists in the destination folder
            if (File::exists($destination)) {
                // IF SO - DELETE
                File::delete($destination);
            }

            //Delete category itself
            $portfolio->delete();

            $notification = array(
                'message' => 'Portfolio deleted successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Images not found',
                'alert-type' => 'error'
            );
        }
    }
}
