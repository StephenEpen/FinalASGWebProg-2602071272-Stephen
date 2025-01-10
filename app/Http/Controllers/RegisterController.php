<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:Male,Female'],
            'hobbies' => [
                'required',
                'string',
                'regex:/^(?:[^,]+,){2}[^,]+$/',
            ],
            'instagram' => [
                'required',
                'url',
                'regex:/^https?:\/\/www\.instagram\.com\/.+$/',
            ],
            'mobile' => [
                'required',
                'digits_between:10,15',
            ],
            'age' => [
                'required',
                'integer',
                'min:18',
            ],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'price' => ['required', 'integer', 'min:100000', 'max:125000'],
        ], [
            'hobbies.regex' => 'The hobbies field must contain at least 3 hobbies separated by commas.',
            'instagram.regex' => 'The Instagram URL must start with "http://www.instagram.com/".',
        ]);
    }

    public function handleRegister(Request $request)
    {
        $data = $request->all();

        $this->validator($data)->validate();

        Session::put('registration_data', $data);

        return redirect()->route('paymentPage');
    }

    public function completeRegistration(Request $request)
    {
        $data = Session::get('registration_data');

        if (!$data) {
            return redirect()->route('register')->withErrors('Session expired. Please register again.');
        }

        User::create([
            'name' => $data['name'],
            'gender' => $data['gender'],
            'hobbies' => $data['hobbies'],
            'instagram' => $data['instagram'],
            'mobile' => $data['mobile'],
            'age' => $data['age'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'price' => $data['price'],
            'wallet_balance' => $data['wallet_balance'] + 100,
            'profile_picture' => 'https://firebasestorage.googleapis.com/v0/b/vinie-44385.appspot.com/o/%E2%80%94Pngtree%E2%80%94default%20avatar_5408430.png?alt=media&token=580f3ac1-4a50-4327-89c4-bc7667d841de'
        ]);

        Session::forget('registration_data');

        return redirect()->route('loginPage')->with('success', 'Registration complete! Please log in.');
    }
}
