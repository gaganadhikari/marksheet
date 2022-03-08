<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    //
    public function index(){
        $classes = ClassRoom::query()
        ->select('id','name')
            ->where('deleted_at', NULL)
            ->get();
        return $classes;
    }

    public function store(Request $request){
        try {
            $class = new ClassRoom();
            $class->name = $request->name;
            $class->save();
            return response()->json(['status'=>'success', 'message'=>'CLASS_CREATED']);
        }catch (\Exception $e){
            return Response()->json(['status'=>'error','message'=>$e->getMessage()]);
        }
    }

    public function show($id){
        $class = ClassRoom::query()
            ->select('id','name')
            ->where('id','=', $id)
            ->where('deleted_at', NULL)
            ->get();
        return $class;
    }

    public function update(Request $request, $id){
        try {
            $class =  ClassRoom::findOrFail($id);
            $class->name = $request->name;

            if($class->save()) {
                return response()->json(['status' => 'success', 'message' => 'CLASS_UPDATED']);
            }
        }catch (\Exception $e){
            return Response()->json(['status'=>'error','message'=>$e->getMessage()]);
        }
    }

    public function delete($id){
        try {
            $class =  ClassRoom::findOrFail($id);
            $class->deleted_at = date('Y-m-d H:i:s');

            if($class->save()) {
                return response()->json(['status' => 'success', 'message' => 'CLASS_DELETED']);
            }
        }catch (\Exception $e){
            return Response()->json(['status'=>'error','message'=>$e->getMessage()]);
        }
    }
}
