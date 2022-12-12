<?php

namespace App\Http\Controllers\Customer;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PaypalAccount;
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

    public function logout(Request $request)
    {
        // dd(auth()->guard("customer")->user());
        // $cus->currentAccessToken()->delete();

    }

    public function getAuthCusProfile(Request $request)
    {
        $cusID = $request->cus_id;

        $response = Customer::find($cusID)->first();

        return response($response, 201);
    }

    public function editAuthCusProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30',
            'address' => 'required|max:120',
            'phone_num' => ['required', 'regex:/^(\+?6?01)[02-46-9]-*[0-9]{7}$|^(\+?6?01)[1]-*[0-9]{8}$/'],
        ]);

        $cus = Customer::find($request->cus_id)->first();

        $cus->name = $request->name;
        $cus->address = $request->address;
        $cus->phone_num = $request->phone_num;
        $response = $cus->update();

        return response($response, 201);
    }

    public function getAuthPaypalProfile(Request $request)
    {
        $cusID = $request->cus_id;

        $response = PaypalAccount::where('cus_id',$cusID)->get();

        return response($response, 201);
    }


    public function editAuthPaypalProfile(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'paypal_email' => 'required|email',
        ]);

        $paypalAcc = PaypalAccount::where('cus_id',$request->cus_id)->get();

        $response ="";
        if(!$paypalAcc){
            $paypalAcc->first_name =$request->first_name;
            $paypalAcc->last_name =$request->last_name;
            $paypalAcc->paypal_email =$request->paypal_email;
            $response = $paypalAcc->update();
        }else{
            $response = PaypalAccount::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'paypal_email' => $request->paypal_email,
            ]);
        }

        return response($response, 201);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'password_confirmation' => 'required',
        ]);

        $cus = Customer::find($request->cusID)->first();

        if (!Hash::check($request->old_password, $cus->password)) {
            throw ValidationException::withMessages([
                'old_password' => ['The old password is incorrect.']
            ]);
        }

        if ($request->new_password != $request->password_confirmation) {
            throw ValidationException::withMessages([
                'new_password' => ['The new password does not match with confirm password.']
            ]);
        }

        $cus->password = Hash::make($request->new_password);
        $response = $cus->update();

        return response($response, 201);
    }
}
