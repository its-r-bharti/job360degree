<?php

namespace App\Http\Controllers;
// use right  path of the validator for remove error in the fuction call in under validator 
// use Dotenv\Validator;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function registration() {
        return view('component.account.registration');

    }

    public function processRegistration(Request $request){
        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'email' =>'required|email|unique:users,email',
            'password' => 'required|min:5|same:confirm_password',
            'confirm_password' =>'required',
        ]);

        if($validator->passes()){
            $user = new User();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            // $user->name = $request->name;
            $user->save();

            session()->flash('success','you have registered successfully');

            return response()->json([
                'status'=> true,
                'errors'=> []
            ]);
        }else{
            return response()->json([
                'status'=> false,
                'errors'=> $validator->errors()
            
            ]);
        }
    }

    public function login() {
        return view('component.account.login');

    }


    public function authenticate(Request $request){
        $Validator = Validator::make($request ->all(),[
            'email'=>'required',
            'password' => 'required'
        ]);

        if($Validator->passes()){
                if (Auth::attempt(['email' => $request->email, 'password'=>$request->password])){
                        return redirect()->route('account.profile');
                }else{
                    return redirect()->route('account.login') ->with('error','Either Email/Password is incorrect');

                }
        }else{
            return redirect()->route('account.login')
            ->withErrors($Validator)
            ->withInput($request->only('email'));

        }
    }

    public function profile(){
       
        return view('component.account.profile');
    }
    


}
