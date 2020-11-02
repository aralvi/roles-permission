<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $profile = Auth::user();
        return response()->json(['profile'=>$profile]);
    }


    public function update_profile(Request $request)
    {
        $profile = User::find(Auth::id());

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $profile->id],
        ]);

        $profile->name = $request->name;

        $profile->email = $request->email;
        $profile->save();

        return response()->json(['success'=> 'Profile updated successfully!']);
    }


    public function update_avatar(Request $request)
    {
        $profile = User::find(Auth::id());
        $old_avatar = $profile->avatar;

        $this->validate($request, [
            'avatar' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        //storing new avatar image
        if ($request->hasFile('avatar')) {

            $image = $request->file('avatar');
            $image_original_name = $image->getClientOriginalName();
            $image_changed_name = str_replace(' ', '-', $image_original_name);
            $image_original_ext = $image->getClientOriginalExtension();
            $image_destination_name = time() . '_' . $image_changed_name;
            $image_destination_folder = "/uploads/images/user/avatars/";
            $image_destination_path = $image->move(public_path($image_destination_folder), $image_destination_name);
        }

        $profile->avatar = $image_destination_name;
        $profile->save();

        if (!empty($old_avatar)) {
            unlink(public_path("/uploads/images/user/avatars/$old_avatar"));
        }
        return response()->json(['success'=> 'Profile image updated successfully!']);
    }


    public function password()
    {
        $password = Auth::user();
        return response()->json(['password'=>$password]);
    }


    public function update_password(Request $request)
    {

        $password = User::find(Auth::id());

        $this->validate($request, [
            'old_password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed', 'different:old_password'],
        ]);
        if (Hash::check($request->old_password, $password->password)) {

            $password->password = Hash::make($request->new_password);
            $password->save();

            return response()->json(['success'=> 'Password updated successfully!']);
        } else {
            return response()->json(['error'=> 'Old Password does not match!']);
        }
    }
}
