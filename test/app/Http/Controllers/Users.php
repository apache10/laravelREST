<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Http\Resources\User as UserResource;

class Users extends Controller
{
    /**
     * list all the user
     * @return array 
     */
    function list(){
        return response()->json(User::paginate(10),200);
    }
    
    /**
     * just one user 
     * @param $id
     * @return json object
     */
    function show($id){
        $user = User::find($id);
        if(is_null($user)){
            return response()->json(null,404);
        }
        $response = new UserResource(User::findOrFail($id),200);
        return response()->json($response,200);
    }

    /**
     * store new user
     */
    function store(Request $request){
        //validation
        $valid = Validator::make($request->all(), [
            'name'=> 'required|max:10',
            'detail'=> 'required|max:20',
            'num'=> 'required|max:5'
        ]);
        if($valid->fails()){
            return response()->json(['error'=>$valid->errors()],401);
        }
        $user = User::create($request->all());
        return response()->json($user,201);
    }

    /**
     * update the value of old user 
     */
    function update(Request $request, User $user){
        $valid = Validator::make($request->all(), [
            'name'=> 'max:10',
            'num'=> 'max:5'
        ]);
        if($valid->fails()){
            return response()->json(['error'=>$valid->errors()],401);
        }
        $user->update($request->all());
        return response()->json($user,200);
    }

    /**
     * delete the user from database
     */
    function delete(Request $request, User $user){
        $user->delete();
        return response()->json(null,204);
    }

    
}
