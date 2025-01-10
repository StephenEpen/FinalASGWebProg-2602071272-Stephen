<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        $data = Session::get('registration_data');

        if (!$data) {
            return redirect()->route('register')->withErrors('Session expired. Please register again.');
        }

        $request->validate([
            'balance' => ['required', 'integer', 'min:' . $data['price']],
        ]);

        $price = $data['price'];
        $balance = $request->input('balance');
        $remainingBalance = $balance - $price;

        $data['wallet_balance'] = $remainingBalance;
        Session::put('registration_data', $data);

        return redirect()->route('register.complete');
    }
}
