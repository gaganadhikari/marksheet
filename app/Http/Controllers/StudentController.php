<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function index(){
        $students = Student::query()
            ->select('id','name','address','dob','registration_no','guardian_name','guardian_no')
            ->where('deleted_at', NULL)
            ->get();
        return $students;
    }

    public function store(Request $request){
        try {
            $student = new Student();
            $student->name = $request->name;
            $student->dob = $request->dob;
            $student->address = $request->address;
            $student->registration_no = $request->registration_no;
            $student->guardian_name = $request->guardian_name;
            $student->guardian_no = $request->guardian_no;
            $student->save();
            return response()->json(['status'=>'success', 'message'=>'STUDENT_CREATED']);
        }catch (\Exception $e){
            return Response()->json(['status'=>'error','message'=>$e->getMessage()]);
        }
    }

    public function show($id){
        $student = Student::query()
            ->select('id','name','address','dob','registration_no','guardian_name','guardian_no')
            ->where('id','=',$id)
            ->where('deleted_at', NULL)
            ->first();
        return $student;
    }

    public function update(Request $request, $id){
        try {
            $student =  Student::findOrFail($id);
            $student->name = $request->name ?? $student->name;
            $student->dob = $request->dob ?? $student->dob;
            $student->address = $request->address ?? $student->address;
            $student->registration_no = $request->registration_no ?? $student->registration_no;
            $student->guardian_name = $request->guardian_name ?? $student->guardian_name;
            $student->guardian_no = $request->guardian_no ?? $student->guardian_no;

            if($student->save()) {
                return response()->json(['status' => 'success', 'message' => 'STUDENT_UPDATED']);
            }
        }catch (\Exception $e){
            return Response()->json(['status'=>'error','message'=>$e->getMessage()]);
        }
    }

    public function delete($id){
        try {
            $class =  Student::findOrFail($id);
            $class->deleted_at = date('Y-m-d H:i:s');

            if($class->save()) {
                return response()->json(['status' => 'success', 'message' => 'STUDENT_DELETED']);
            }
        }catch (\Exception $e){
            return Response()->json(['status'=>'error','message'=>$e->getMessage()]);
        }
    }
}
