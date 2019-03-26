<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showHome(){
        $images = DB::select("select * from images");
        $results_active = DB::select("select * from posts where active=?",[ true] );

        $data = array('images' => $images , 'posts'=>$results_active);
        return view('guest_home')->with('data',$data);
    }
    public function showProfile()
    {
       return view('customers.profile');
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

    public function index()
    {
        //
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
