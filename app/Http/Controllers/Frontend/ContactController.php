<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Frontend.contact');
    }
  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'phone' => $request->phone,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        );

        Contact::insert($data);

        $notification = array(
            'message' => 'Your Message Sent successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    // Show Messages
    public function readMessage()
    {
        $model = Contact::latest()->get();

        return view('Admin.Contact.index',compact('model'));
    }

    // Delete Messages
    public function deleteMessage($id)
    {
         Contact::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Message deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

  
}
