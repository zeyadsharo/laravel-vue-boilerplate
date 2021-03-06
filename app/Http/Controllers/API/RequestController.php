<?php

namespace App\Http\Controllers\API;
 use App\Http\Controllers\Controller;
// namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
// use App\Requests;
use App\Http\Resources\UserResource;
use App\Http\Resources\RequestResource;
use Illuminate\Database\Eloquent\Model;

// use AuthenticatesUsers;
class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $id=Auth::id();
       return RequestResource::collection(User::find($id)->requests);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //    $requestrt= new Requests([
    //     'requestnumber'=> $request->requestnumber,
    //     'department'=> $request->department,
    //     'location'=>$request->location,
    //     'problem_description'=>$request->problem_description,
    //     'priority'=>$request->priority,
    //     ]);
   
    //     $user=User::find(Auth::id());
    //  return $user->requests()->save($requestrt);
     
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
?>