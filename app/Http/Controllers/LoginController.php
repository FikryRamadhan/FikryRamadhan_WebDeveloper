<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\MyClass\Response;
use App\MyClass\Validations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        return view('login.login');
    }

    public function authenticate(Request $request) {
        Validations::loginValidate($request);
        
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();
        
        if(Hash::check($credentials['password'], $user->password)){
            Auth::loginUsingId($user->id);

            return Response::success();
        } else {
            return Response::error('error','Username atau password salah');
        }
    }

    public function register(){
        return view('register.index');
    }

    public function daftar(Request $request){
        Validations::registerValidate($request);
        DB::beginTransaction();

        try {
            $user = User::storeUser($request->all());
            $password = $request->password;
            $user->setPassword($password);
            DB::commit();

            return Response::success();
        } catch (Exception $e) {
            DB::rollback();

            return Response::error($e);
        }
    }

    public function logout(){
        try {
			auth()->logout();
		} catch (\Exception $e) {}

		return redirect()->route('login');
    }
}
