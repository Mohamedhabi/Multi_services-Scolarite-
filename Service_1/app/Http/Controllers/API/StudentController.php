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
     * Create a new StudentController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /**
         *         'first_name', 'last_name', 'password','adress','email','','birth_place','birth_day'

         */
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
            'status' => 'success',
            'data' => Student::all()
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
        $student= Student::find($id);
        if(empty( $student)){
            return response()->json(['status' => 'error','message' => 'student not found'],404);
        }else{
            return response()->json(['status' => 'success','data' => $student],200);
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
