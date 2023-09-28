<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
class UserController extends Controller
{
    //
    function login(Request $req)
    {
        $user = User::where(['email' => $req->email])->first();
        if (!$user || Hash::check($req->password, $user->password)) {
            return 'Username or Password is not matched';
        } else {
            $req->session()->put('user', $user);
            return redirect('/');
        }
    }

    function register(Request $req)
    {
        $userCheck = User::where(['email' => $req->email])->first();
        if (empty($userCheck->email)) {
            $validatedData = $req->validate([
                'name' => 'required',
                'email' => 'required',
                'password' =>
                    'required|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/',
            ]);

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            Mail::to($validatedData['email'])->send(
                new WelcomeEmail($validatedData['name'])
            );

            return 'Email sent successfully';
        } else {
            return 'email exist';
        }

        return 'registered';
    }
}
