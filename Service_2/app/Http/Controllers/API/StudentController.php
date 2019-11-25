<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class StudentController extends Controller
{
    /**
     * Login the specified resource .
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        $student= Student::where('email', '=', request('email'))->firstOrFail();
        if(empty( $student)){
            return response()->json(['status' => 'error','message' => 'student not found'],401);
        }elseif(Hash::check(request('password'), $student->password)){
            return response()->json(['status' => 'success','data' => $student],200);
        }else{
            return response()->json(['data' => $student,'pass'=>request('password'),'past'=>$student->password]);
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
        $student= Student::find($id);
        if(empty( $student)){
            return response()->json(['status' => 'error','message' => 'student not found'],404);
        }else{
            return response()->json(['status' => 'success','data' => $student],200);
        }
    }

    
}