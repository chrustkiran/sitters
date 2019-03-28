<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Psy\Util\Str;

class SittersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function showHome(){
        if(!isset($_COOKIE['username'])){
            return redirect('login');
        }

        $images = DB::select("select * from images");
        $results_active = DB::select("select * from posts where active=?",[ true] );

        $data = array('images' => $images , 'posts'=>$results_active);
        return view('home')->with('data',$data);
    }

    public function expire($id){
        if(!isset($_COOKIE['username'])){
            return redirect('login');
        }

        DB::update("update posts set active=? where id=?",[0,$id]);
        return back();
    }

    public function filtering(Request $request){
        $search = $request->search;
        $images = DB::select("select * from images");


        if($request->search =="") {
            $results_active = DB::select("select * from posts where active=?", [true]);
            if ($request->filter == "with") {
                $results_active = DB::select("select * from posts where active=? and image=?", [true, true]);
            } elseif ($request->filter == "without") {
                $results_active = DB::select("select * from posts where active=? and image=?", [true, false]);
            }
        }
        elseif ($request->search != ""){
            if ($request->filter == "with") {
                $results_active = DB::select("select * from posts where (roles LIKE ? or location LIKE ? ) and active=? and image=? ", [$search.'%',$search.'%',true, true]);
            } elseif ($request->filter == "without") {
                $results_active = DB::select("select * from posts where (roles LIKE ? or location LIKE ? ) and active=? and image=?", [$search.'%', $search.'%', true, false]);
            }
            elseif ($request->filter ="both"){
                $results_active = DB::select("select * from posts where (roles LIKE ? or location LIKE ? ) and active=?", [$search.'%',$search.'%', true]);
            }
        }
        $data = array('images' => $images , 'posts'=>$results_active);
        $msg = view('post')->with('data',$data)->render();
        return response()->json(array('msg'=> $msg), 200);
    }



    public function deleteAd($id){
        if(!isset($_COOKIE['username'])){
            return redirect('login');
        }

        DB::delete("delete from posts where id=?",[$id]);
        DB::delete("delete from images where adv_id=?",[$id]);

        return back();

    }

    public function showAdvertise(){
        if(!isset($_COOKIE['username'])){
            return redirect('login');
        }

            $data_array = $this->fetchAd();

            $roles = DB::select("select * from roles");
            $postcodes = DB::select("select * from postcode");
            $images = DB::select("select * from images");

            $data = ['ad' => $data_array, 'roles' => $roles, 'postcodes' => $postcodes, 'images' => $images];

            return view('sitters.advertisement')->with('data', $data);

    }
    public function createAd(Request $request){
        if(!isset($_COOKIE['username'])){
            return redirect('login');
        }

        $isimage  = false;
        $this->validate($request, [
            'availability'=>'alphanum|required',
            'price'=>'numeric|required',
            'mobile'=>'numeric|required',
            'roles'=>'required',
            'postcode'=>'required',
        ]);

        $roles = $request->get('roles');
        $availability = $request->get('availability');

        $postcodes = DB::select("select * from postcode");
        $postcode_address = array();
        foreach ($postcodes as $postcode){
            $postcode_address[$postcode->postcode] = $postcode->name ;
        }

        $postcode = $request->get('postcode');
        $location = $postcode_address[$postcode];

        $price = $request->get('price');
        $username = Auth::user()->username;

        $mobile = $request->get('mobile');
        $created_at = Carbon::now()->toDateTimeString();
        $updated_at = $created_at;

        if($_FILES["images"]["tmp_name"][0]!=""){
            $isimage =true;

            DB::insert('insert into posts(username,mobile,location,availability,roles,price,active,image,created_at,updated_at) values (?,?,?,?,?,?,?,?,?,?)',[
                $username, $mobile, $location, $availability, $roles, $price, true, true, $created_at, $updated_at
            ]);
        }
        else{

            DB::insert('insert into posts(username,mobile,location,availability,roles,price,active,image,created_at,updated_at) values (?,?,?,?,?,?,?,?,?,?)',[
                $username, $mobile, $location, $availability, $roles, $price, true, false, $created_at, $updated_at
            ]);
        }

        $last_id_array = DB::select("SELECT * FROM posts ORDER BY ID DESC LIMIT 1");
        $last_id = $last_id_array[0]->id;

           if($isimage) {
               print_r($_FILES["images"]);
               $target_dir = base_path() . "\storage\images";
               $base_dir = "http://localhost/laravel/";
               $store_dir = $base_dir."storage/images";

               $num = 1;
               foreach ($_FILES["images"]["tmp_name"] as $image) {

                   $random_name = str_random(10);
                   $target_file = $target_dir . "\img" .$random_name .$num. ".png";
                   if (file_exists($target_file)) {
                       $target_file = str_random(10);
                   }
                   move_uploaded_file($image, $target_file);
                   DB::insert("insert into images(adv_id, images) value (?,?)", [$last_id, $store_dir."\img" .$random_name .$num. ".png"]);
                   $num = $num + 1;
               }
           }



       return back();
    }

    public function editAd(Request $request){

        if(!isset($_COOKIE['username'])){
            return redirect('login');
        }
        $isimage  = false;
        $this->validate($request, [
            'availability'=>'alphanum|required',
            'price'=>'numeric|required',
            'mobile'=>'numeric|required',
            'roles'=>'required',
            'postcode'=>'required',
        ]);

        $id = $request->get('id');
        $roles = $request->get('roles');
        $availability = $request->get('availability');


        $location = $request->get('postcode');


        $price = $request->get('price');
        $username = Auth::user()->username;

        $mobile = $request->get('mobile');
      //  $created_at = Carbon::now()->toDateTimeString();
        $updated_at = Carbon::now()->toDateTimeString();;

        if($_FILES["images"]["tmp_name"][0]!=""){
            $isimage =true;

            DB::update('update  posts set mobile=?, location =?, availability =?, roles = ?, price = ?, image = ?, updated_at = ? where id = ?',[
                 $mobile, $location, $availability, $roles, $price, true,  $updated_at, $id
            ]);
        }
        else{

            DB::update('update  posts set mobile=?, location =?, availability =?, roles = ?, price = ?, updated_at = ? where id = ?',[
                 $mobile, $location, $availability, $roles, $price,  $updated_at ,$id
            ]);
        }


        if($isimage) {
            DB::delete("delete from images where adv_id = ?",[$id]);
            print_r($_FILES["images"]);
            $target_dir = base_path() . "\storage\images";
            $base_dir = "http://localhost/laravel/";
            $store_dir = $base_dir."storage/images";

            $num = 1;
            foreach ($_FILES["images"]["tmp_name"] as $image) {

                $random_name = str_random(10);
                $target_file = $target_dir . "\img" .$random_name .$num. ".png";
                if (file_exists($target_file)) {
                    $target_file = str_random(10);
                }
                move_uploaded_file($image, $target_file);
                DB::insert("insert into images(adv_id, images) value (?,?)", [$id, $store_dir."\img" .$random_name .$num. ".png"]);
                $num = $num + 1;
            }
        }



        return back();
    }
    public function fetchAd(){
        if(!isset($_COOKIE['username'])){
            return redirect('login');
        }
        $results_active = DB::select("select * from posts where username=? and active=?",[Auth::user()->username, true] );

        $results_expired = DB::select("select * from posts where username=? and active=?",[Auth::user()->username, false]);

        $data_array = ['active'=>$results_active , 'expired'=>$results_expired];

        return $data_array;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
