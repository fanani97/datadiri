<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['status' => 'success', 'data' => User::all()]);
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
        $this->validate($request, [
          'name' => 'required',
          'alamat' => 'required',
          'telepon' => 'required|unique:users'          
        ]);
 
        if (User::create($request->all())) {
          return response()->json(['status' => 'success', 'message' => 'Data has been created' ],201);
        } else {
          return response()->json(['status' => 'error', 'message' => 'Internal Server Error' ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
          return response()->json(['status' => 'success', 'data'=> $user]);
        }
 
        return response()->json(['status' => 'error', 'message' => 'Data not found'],404);
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
        $this->validate($request, [
          'name' => 'required',
          'alamat' => 'required',
          'telepon' => 'required|unique:users,telepon,'.$id
        ]);
 
        $user = User::find($id);
        if ($user) {
          $user->update($request->all());
          return response()->json(['status' => 'success', 'message' => 'Data has been updated']);
        }
 
        return response()->json(['status' => 'error', 'message' => 'Cannot updating data'],400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
      $user = User::find($id);
      if ($user) {
        $user->delete();
        return response()->json(['stats' => 'success', 'message' => 'Data has been deleted']);
      }
 
      return response()->json(['status' => 'error', 'message' => 'Cannot deleting data'],400);
    }
}
