<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Request;
class requestCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           $user = User::find(1);
           
        $request=Request::create(['requestnumber'=>123132,
        'department'=>'computer','location'=>'zakho','problem_description'=>'sdfdsfdsfdsf',
        'priority'=>'sdfdsfd','completed_by'=>'zeyad
        Sharo','user_id'=>1,'Remarks'=>'sdfdsfdsf','date_completed'=>Carbon::today()->toDateString()]);
        // $user->requests()->save($request);
        return view("home");
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