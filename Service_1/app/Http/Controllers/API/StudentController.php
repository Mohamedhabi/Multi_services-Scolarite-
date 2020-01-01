<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

/**
 * @group Student management
 *
 * APIs for managing Student
 */
class StudentController extends Controller
{

    /**
     * Create a new StudentController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the students.
     * @authenticated
     *
     * @bodyParam token string required The token of the admin. Example:lmkfmelzkf
     * @response {
     *  "status": "success",
     *  "data": [
     *    {
     *     "id": 1,
     *     "first_name": "Mohamed",
     *     "last_name": "Habi",
     *     "adress": "Setif",
     *     "birth_place": "Setif",
     *     "birth_day": "1999-12-11",
     *     "level": "1CS",
     *     "email": "Habi1@esi.dz"
     *    }
     *  ]
     * }
     * @response 401 {
     *  "message": "Unauthenticated"
     * }
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Student::all()
        ]);
    }

     /**
     * Store a newly created student in storage.
     * @authenticated
     * @bodyParam token string required The token of the admin. Example:lmkfmelzkf
     * @bodyParam firt_name string required The firt name of the student. Example: Mohamed
     * @bodyParam last_name string required The last name of the student. Example: Habi
     * @bodyParam level string required The level of the student. Example: 1cs
     * @bodyParam birth_place string required The birth place of the student. Example: Setif
     * @bodyParam birth_day date required The birth day of the student. Example: 1999-12-11
     * @bodyParam adress string required The adress of the student. Example: Setif
     *
     * @response {
     *  "status": "success"
     * }
     * 
     * @response 500 {
     *  "status": "error",
     *  "message": { "birth_day": ["The birth day field is required."]}
     * }
     *  
     * @response 401 {
     *  "message": "Unauthenticated"
     * }
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $max_year=date('Y') -16;
        $validation =Validator::make($request->all(),[
            'first_name'=>"required|max:40|min:2",
            'last_name'=>"required|max:40|min:2",
            'adress'=>"required|min:3",
            'birth_place'=>"required|min:3",
            'birth_day'=>'required|before:'. $max_year . '-01-01',
            'level'=>"required",
            ]);
        if($validation->fails()){
            return response()->json([
                'status' => 'error',
                'message' => $validation->errors()
            ],500);
        }
        $student=new Student();
        $student->first_name =request('first_name');
        $student->level=request('level');
        $student->birth_place=request('birth_place');
        $student->birth_day=request('birth_day');
        $student->last_name=request('last_name');
        $student->adress=request('adress');
        $student->password=Hash::make(request('last_name'));
        $student->save();
        $student->email=request('last_name').($student->id)."@esi.dz";
        $student->save();

        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * Display the specified student.

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

    /**
     * Remove the specified student from storage.
     *
     * @response {
     * "status": "success",
     * "message": "student deleted"
     * }
     * @authenticated
     * @bodyParam token string required The token of the admin. Example:lmkfmelzkf
     * @response 404{ "status": "error", "message": "student not found" }
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student= Student::find($id);
        if(empty( $student)){
            return response()->json(['status' => 'error','message' => 'student not found'],404);
        }elseif($student->delete()){
            
            return response()->json(['status' => 'success','message' => 'student deleted'],200);

        }else{
            return response()->json(['status' => 'error','message' => 'Database server error'],500);
        }
    }
}
