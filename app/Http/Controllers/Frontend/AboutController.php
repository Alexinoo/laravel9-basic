<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Image;

class AboutController extends Controller
{
    public function about()
    {
        $model = About::find(1);

        return view('Frontend.about-page', compact('model'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = About::find(1);

        return view('Frontend.About.update', compact('model'));
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
        $model = About::find($id);

        //LOGIC - Delete from destination and upload a new image
        if ($request->hasfile('about_image')) {

            $destination = public_path('upload/home_about/' . $model->about_image);

            // Check if image exists in the destination folder
            if (File::exists($destination)) {

                // IF SO - DELETE
                File::delete($destination);
            }

            //PROCEED WITH THE UPLOAD

            $slider_image = $request->file('about_image');

            // get file extension - assign a unique name
            $img_name = time() . '.' . $slider_image->getClientOriginalExtension();

            // Use Image Intervention to resize and save in public directory
            $image_resize = Image::make($slider_image->getRealPath())->resize(523, 605)->save('upload/home_about/' . $img_name, 80);

            About::findOrFail($model->id)->update([
                'title' =>  $request->title,
                'short_title' =>  $request->short_title,
                'short_description' =>  $request->short_description,
                'long_description' =>  $request->long_description,
                'about_image' =>  $img_name,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'About Page Updated successfully',
                'alert-type' => 'info'
            );

            return redirect()->back()->with($notification);
        } else {

            About::findOrFail($model->id)->update([
                'title' =>  $request->title,
                'short_title' =>  $request->short_title,
                'short_description' =>  $request->short_description,
                'long_description' =>  $request->long_description,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'About Page Updated without image successfully',
                'alert-type' => 'info'
            );

            return redirect()->back()->with($notification);
        }
    }

    
}
