<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends BaseController
{
     public function register(Request $request)
    {
        $validator=Validator::make($request->all(),[
        	'name'=>'required',
        	'email'=>'required|email',
        	'password'=>'required',
        	'c_password'=>'required|same:password',
        ]);

        if ($validator->fails()) {
        	return $this->sendErorr('Validate Error',$validator->errors());
        }

        $input=$request->all();
        $input['password']= Hash::make($input['password']);
        $user =User::create($input);
        $success['token']=$user->createToken('haneen')->accessToken;
        $success['name']=$user->name;
        return $this->sendResponse($success, 'User registered successfully');


    }


         public function login(Request $request)
        {

    	if (Auth::attempt(['email'=>$request->email, 'password'=>$request->password] )) {
    		$user=Auth::user();
    		$success['token']=$user->createToken('haneen')->accessToken;
            $success['name']=$user->name;
            return $this->sendResponse($success, 'User login successfully');
    	}
    	else
    	{
    		return $this->sendErorr('Unauthorised',['error', 'Unauthorised']);
    	} 
    }
}
