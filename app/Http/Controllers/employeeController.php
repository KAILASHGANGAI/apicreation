<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee;
class employeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data = employee::all();
       return response()->json([
           "status"=>1,
           "message"=>"all the data of employee",
           "datas"=>$data
       ]);
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
        $request->validate([
            'name'=> "required",
            'email'=> "required | email|unique:employees",
            'address'=> "required",
            'gender'=> "required",
            'phone'=> "required",

        ]);

        $new = new employee;
        $new->name = $request->name;
        $new->email = $request->email;
        $new->address = $request->address;
        $new->gender = $request->gender;
        $new->phone = $request->phone;
        $new->save();
        return response()->json([
            'status'=>1,
            'message'=>"api created successfully"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = employee::find($id);
        if(!empty($data)){
        return response()->json([
            "status"=>1,
            "message"=>"all the data of employee",
            "datas"=>$data
        ]);
    }else{
        return response()->json([
            "status"=>1,
            "message"=>"no data found"
            
        ]);
    }
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
        if(employee::where('id',$id)->exists()){
            $data = employee::find($id);
            $data->name = !empty($request->name)? $request->name : $data->name;
            $data->email = !empty($request->email)? $request->email : $data->email;
            $data->address = !empty($request->address)? $request->address : $data->address;
            $data->gender = !empty($request->gender)? $request->gender : $data->gender;
            $data->phone = !empty($request->phone)? $request->phone : $data->phone;
            $data->save();
            return response()->json([
                "status"=>1,
                "message"=>"updated details if employee id ->"." ".$id,
                
            ]);
        }else{
            return response()->json([
                "status"=>1,
                "message"=>"ano employee to update"
                
            ]);
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = employee::find($id);
        if(!empty($data)){
            $data->delete();
            return response()->json([
                "status"=> 1,
                "message"=>"record deleted successfully"

            ]);
        }else{
            return response()->json([
                "status"=> 0,
                "message"=>"record not found"

            ]); 
        }

    }
}
