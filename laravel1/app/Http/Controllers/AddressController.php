<?php

namespace App\Http\Controllers;



use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\Address;
use Psy\Readline\Hoa\_Protocol;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $emailValidator=$this->validateEmail();
        $addressValidator=$this->validateAddress();

        if ($emailValidator->fails() || $addressValidator->fails()){
            return response()->json(['message'=>'Failed',
                'email'=>$emailValidator->messages(),
                'address'=>$addressValidator->messages()], status: 400);
        }
        $user = User::where('email', $request->get('email'))->firstOrFail();
        if ($user->address){
            return response()->json(['messages'=>'User has Address Already','data'=>null],status: 400);
        }
        $address = new Address($addressValidator->validate());
        if ($user->address()->save($address)){
            return response()->json(['message'=>'Address saved', 'data'=>$address],status: 200);
        }
        return response()->json(['message'=>'Failed','data'=>null],status: 400);
    }


    public function show(Address $address)
    {
        return response()->json(['message'=>'','data'=>$address],200);
    }
    public function show_user(Address $address)
    {
        return response()->json(['message'=>'','data'=>$address->user],200);
    }


    public function validateEmail()
    {
        return Validator::make(request()->all(),[
            'email' => 'required|string|email|max:255',
        ]);
    }
    public function validateAddress()
    {
        return Validator::make(request()->all(),[
            'country' => 'required|string|min:1|max:7',
            'zipcode' => 'required|string|min:5|max:6',
        ]);
    }
}

