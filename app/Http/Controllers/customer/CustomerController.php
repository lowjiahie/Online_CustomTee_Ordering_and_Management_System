<?php

namespace App\Http\Controllers\Customer;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        $cus = Customer::where('email', $request->email)->first();

        if (!$cus || !Hash::check($request->password, $cus->password)) {
            throw ValidationException::withMessages([
                'password' => ['The provided credentials are incorrect.']
            ]);
        }

        $token = $cus->createToken('access_token')->plainTextToken;

        $response = [
            'cus' => $cus,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/|confirmed',
            'password_confirmation' => 'required',
        ]);

        $response = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response($response, 201);
    }

    public function logout(Request $request){
        // dd(auth()->guard("customer")->user());
        // $cus->currentAccessToken()->delete();

    }
}
