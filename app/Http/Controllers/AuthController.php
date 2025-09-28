<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\User\CreateUserRequest;

class AuthController extends Controller
{
    use ApiResponseTrait ;
     
    protected $userService = null ;

    public function __construct()
    {
        $this->userService = new UserService;
    }
    public function registration(){
        return view('auth.registration');
    }
    public function login(){
        return view('auth.login');
    }
    public function registrationPost(Request $request){
        $data = $request->only(['name', 'email', 'password']);
        $data['password'] = bcrypt($data['password']);
        $result = User::query()->create($data);
        return $this->sendResponse(appStatic()::SUCCESS, 'Successfully Registration .',$data);
    }
    public function loginPost(Request $request){
       $data = $request->only(['email','password']);
       $request->validate([
            'email' => 'required|email',
            'password'=>'required|min:3',
       ],[
            'email.required' => 'Email is required ',
            'email.email' => 'Please enter a valid email adress',
            'password.required' => 'Password is required',
            'password.min' => 'At least 3 character are needed',
       ]);

       $result = Auth::attempt($data);
       if($result){
        return $this->sendResponse(appStatic()::SUCCESS,'Sucessfully login',['success']);
       }
      return $this->sendResponse(appStatic()::SUCCESS,'Invalid email or password',[]);
    }

    public function logout(){
        session()->flush();
        Auth::logout();
        return redirect(route('login'));
    }

}
