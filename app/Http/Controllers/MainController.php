<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mews\Captcha\Facades\Captcha;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    public function guest_home(){

        return view('guest_home');
    }

    public function register(){
        $roles = Role::all();
        return view('register')->with('roles',$roles);
    }

    public function verifyCode(Request $request){
        $code = $request->get("code");
        $username = $request->get("username");

        $code_db = DB::select("select remember_token from users where username=? limit 1",[$username]);


        if($code_db[0]->remember_token == $code){
            DB::insert('update users set verified=? where remember_token=? and username=?',[true, $code, $username]);
            return redirect("/login");
        }
        else{
            return back()->with('error','Wrong code');
        }

    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_src()]);

    }

    public function verifyEmail($username){

        return view('verify_email')->with('username',$username);
    }
    public function createCaptcha()
    {
        return view('captchacreate');
    }



    public function createUser(Request $request){
        $this->validate($request,[
            'name'=> 'required|alpha|unique:users,username',
            'email'=>'required|email|unique:users,email',
            'password'=>'min:6|same:repassword',
            'captcha' => 'required|captcha']);

        $name = $request->get('name');
        $email = $request->get('email');

        $password = Hash::make($request->get('password'));

        $remember_token = str_random(5);

        session(['remember_token'=>$remember_token]);

        DB::insert('insert into users( username,email, password,remember_token) values (?,?,?,?)',[$name,$email,$password,$remember_token]);

        Mail::send('mail', ['user'=>"Verification Code"], function ($message) {
            $message->subject("Sitters Account Verification");
            $message->from(env('MAIL_FROM','sittersverify@gmail.com'), 'Sitters Verification');

            $message->to('christkiran.15@cse.mrt.ac.lk');
        });



        return redirect('/verifyEmail/'.$name);
        //return $this->verifyEmail($name);
    }

    public function logout(Request $request){
        Auth::logout();
        setcookie('username',"",time()+(86400+30),'/');
        return redirect('/login');
    }

    public function checklogin(Request $request){
        $this->validate($request, [
            'username' => 'required|',
            'password' => 'required|alphaNum|min:3'
        ]);

        $user_array = array(
            'username' => $request->get('username'),
            'password' => $request->get('password')
        );

        if(Auth::attempt($user_array)){
            if(Auth::user()->verified == true) {
                    setcookie('username',$request->get('username'),time()+(86400*30),'/');

                    return redirect('main/sitters/home');
            }
            else{
                return redirect('/verifyEmail/'.Auth::user()->username);
            }
        }
        else{
            return back()->with('error', "Wrong Username or Password");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
