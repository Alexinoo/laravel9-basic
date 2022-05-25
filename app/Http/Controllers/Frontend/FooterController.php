<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $model =  Footer::find(1);
        return view('Admin.Footer.update', compact('model'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $id)
    {
        $data = array(

            'phone' => $request->phone,
            'short_description' => $request->short_description,
            'address' => $request->address,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'copyright' => $request->copyright,
        );
         Footer::findOrFail($id)->update($data);

        $notification = array(
            'message' => 'Footer content updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

}
