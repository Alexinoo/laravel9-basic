<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function profile()
    {
        $id = Auth::user()->id;

        $user = User::find($id);

        return view('Admin.Profile.index',compact('user'));
    }

    public function EditProfile($id)
    {
        $user = User::find($id);

        return view('Admin.profile.edit', compact('user'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => ['required']
        ],[
            'username.required' => 'Username cannot be blank'
        ]);
        $user = User::find(Auth::user()->id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;

        //LOGIC - Delete from destination and upload a new image

        if ($request->hasfile('profile_image')) {

            $destination = 'upload/admin_images/' . $user->profile_image;

            // /Check if image exists in the destination folder
            if (File::exists($destination)) {

                // IF SO - DELETE
                File::delete($destination);
            }

            //PROCEED WITH THE UPLOAD
            $file = $request->file('profile_image');
            // get file extension
            $filename = time() . '.' . $file->getClientOriginalExtension();
            //Use move() to upload the file in the uploads folder
            //Takes 2 parameters - ( location , filename )
            $file->move('upload/admin_images/', $filename);
            //Save the filename in the db
            $user->profile_image = $filename;
        }

        $user->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);
    }



    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
