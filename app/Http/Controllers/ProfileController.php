<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\profile;
use App\Models\User;

use Illuminate\Support\Facades\Session;
class ProfileController extends Controller
{
    //

    function profile()
    {
        if (Session::has('user')) {
            $userId = Session::get('user')['id'];
            return view('profile', [
                'Address' => Profile::where('user_id', $userId)->first(),
                'user' => User::where('id', $userId)->first(),
            ]);
        } else {
            return redirect('login');
        }
    }

    public function update(Request $request)
    {
        $userId = Session::get('user')['id'];

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'profile' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules
            'state' => 'required',
            'zipcode' => 'required',
        ]);

        $user = User::findOrFail($userId);
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        $profile = profile::where('user_id', $userId)->first();
        $profile->update([
            'contact' => $validatedData['contact'],
            'address' => $validatedData['address'],
            'zipcode' => $validatedData['zipcode'],
            'state' => $validatedData['state'],
        ]);
        if ($request->hasFile('profile')) {
            $imagePath = $request->file('profile');
            $newFileName =
                'custom_name.' . $imagePath->getClientOriginalExtension(); // Customize the new filename here

            $imagePath->storeAs('public/images', $newFileName);

            //->storeAs('public/images'); // Adjust the storage path
            $profile->profile = 'images/' . $newFileName;
            $profile->save();
        }
        return redirect('/profile');
    }
}
