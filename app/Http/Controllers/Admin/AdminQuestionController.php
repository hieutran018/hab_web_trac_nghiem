<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminQuestionController extends Controller
{
    public function getPageQuestion(){
        return view('admin.pages.question');
    }

    public function createQuestion(Request $request){
        $validator = Validator::make($request->all(),
            [
                'question_content'=>'required',
            ],
            [
                'question_content.required' =>'Nội dung câu hỏi không được bỏ trống!',
            ]);

        if($validator->fails()){
            return response()->json(['status'=>400,'message'=>$validator->errors()->toArray()]);
        }else{
            $data = $request->all();
            dd($data);
        }
    }
}