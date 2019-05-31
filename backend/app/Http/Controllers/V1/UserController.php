<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct(){

    }

    public function register(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:30'
        ]);

        if (User::where('email', $request->get('email'))->count() === 0){
            $user = new User;
            $user->username = $request->get('username');
            $user->email = $request->get('email');
            $user->password = password_hash($request->get('password') . env('APP_KEY', 'my-secret-key'), PASSWORD_DEFAULT);
            $user->remember_token = base64_encode(str_random(40));
            if ($user->save()) return $this->_response('success', $user->makeVisible('remember_token'));
        } else return $this->_response('user_exists');

        return $this->_error();
    }

    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->get('email'))->first();

        if ($user != null && password_verify($request->get('password') . env('APP_KEY', 'my-secret-key'), $user->password)){
            $user->remember_token = base64_encode(str_random(40));
            $user->save();
            return $this->_response('success', $user->makeVisible('remember_token'));
        }

        return $this->_response('incorrect');
    }

    public function check(Request $request){
        if ($request->header('Authorization')){
            $key = explode(' ', $request->header('Authorization'));
            $user = User::where('remember_token', $key[1])->first();
            if($user != null){
                $request->request->add(['user_id' => $user->id]);
                return $this->_response('success', $user);
            }
        }
        return $this->_response('unauthorized');
    }
}
