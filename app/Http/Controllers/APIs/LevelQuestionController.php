<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Level;

class LevelQuestionController extends Controller
{
    public function getLevelQuestion(){
        $lv = Level::all();
        
        return response()->json($lv,200);
    }

    public function getLevelById(Request $request){
        $id = $request->id_level;

        $lv = Level::Find($id);
        // $tp->image = asset('storage/topic_question/'.$tp->image);
        return response()->json($lv,200);
    }
}