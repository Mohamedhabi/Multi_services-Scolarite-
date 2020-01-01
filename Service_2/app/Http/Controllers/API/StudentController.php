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
     
     * 
     * 
     * Login the student .
     * 
     * @bodyParam email string required The email of the admin. Example:Habi1@esi.dz.com
     * @bodyParam password string required The password name of the admin. Example: dalzkjlk
    *  @response{
     * "status": "success",
     * "data":{"id": 1,"first_name": "Mohamed","last_name": "Habi","adress": "Setif","birth_place": "Setif","birth_day": "1999-12-11","level": "1CS","email": "Habi1@esi.dz"}
     * }
     * @response 401{"message": "Wrong email or password"}    
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        $student= Student::where('email', '=', request('email'))->first();;
        if(!$student){
            return response()->json(['message' => 'Student not found'], 404);
        }
        elseif(Hash::check(request('password'), $student->password)){
            return response()->json(['status' => 'success','data' => $student],200);
        }else{
            return response()->json(['message' => 'Wrong email or password'], 401);
        }
        
       
    }

    /**
     * Display the specified student.
     * @response{
     * "status": "success",
     * "data":{"id": 1,"first_name": "Mohamed","last_name": "Habi","adress": "Setif","birth_place": "Setif","birth_day": "1999-12-11","level": "1CS","email": "Habi1@esi.dz"}
     * }
     * @response 404 {"status": "error","message": "student not found"}   
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
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