<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    //
    public function average($id){
        $marks = Mark::query()
            ->selectRaw('avg(nepali) as avg_nepali, avg(english) as avg_english, avg(maths) as avg_maths, avg(science) as avg_science, avg(ehp) as avg_ehp')
            ->where('class_id', '=', $id)
            ->get();
        return $marks;
    }

    public function store(Request $request){
        try {
            $mark = new Mark();
            $mark->student_id = $request->student;
            $mark->class_id = $request->class;
            $mark->nepali = $request->nepali;
            $mark->english = $request->english;
            $mark->maths = $request->maths;
            $mark->science = $request->science;
            $mark->eph = $request->eph;
            $mark->save();
            return response()->json(['status'=>'success', 'message'=>'MARKS_CREATED']);
        }catch (\Exception $e){
            return Response()->json(['status'=>'error','message'=>$e->getMessage()]);
        }
    }

    public function update(Request $request, $id){
        try {
            $mark =  Mark::findOrFail($id);
            $mark->student_id = $request->student ?? $mark->student_id;
            $mark->class_id = $request->class ?? $mark->class_id;
            $mark->nepali = $request->nepali ?? $mark->nepali;
            $mark->english = $request->english ?? $mark->english;
            $mark->maths = $request->maths ?? $mark->maths;
            $mark->science = $request->science ?? $mark->science;
            $mark->eph = $request->eph ?? $mark->eph;

            if($mark->save()) {
                return response()->json(['status' => 'success', 'message' => 'MARKS_UPDATED']);
            }
        }catch (\Exception $e){
            return Response()->json(['status'=>'error','message'=>$e->getMessage()]);
        }
    }

}
