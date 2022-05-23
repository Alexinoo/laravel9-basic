<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Image;

class HomeSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = HomeSlider::find(1);

        return view('Frontend.Home-slider.index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        $model = HomeSlider::find($id);

        //LOGIC - Delete from destination and upload a new image
        if ($request->hasfile('image')) {

            $destination = public_path('upload/home_slide/' . $model->image);

            // Check if image exists in the destination folder
            if (File::exists($destination)) {

                // IF SO - DELETE
                File::delete($destination);
            }

            //PROCEED WITH THE UPLOAD

            $slider_image = $request->file('image');

            // get file extension - assign a unique name
            $img_name = time() . '.' . $slider_image->getClientOriginalExtension();

            // Use Image Intervention to resize and save in public directory
            $image_resize = Image::make($slider_image->getRealPath())->resize(636, 852)->save('upload/home_slide/' . $img_name, 80);

            HomeSlider::findOrFail($model->id)->update([
                'title' =>  $request->title,
                'short_description' =>  $request->short_description,
                'image' =>  $img_name,
                'video_url' =>  $request->video_url,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Home Slider Updated successfully',
                'alert-type' => 'info'
            );

            return redirect()->back()->with($notification);
        }else{

            HomeSlider::findOrFail($model->id)->update([
                'title' =>  $request->title,
                'short_description' =>  $request->short_description,
                'video_url' =>  $request->video_url,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Home Slider Updated without image successfully',
                'alert-type' => 'info'
            );

            return redirect()->back()->with($notification);
        }

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
