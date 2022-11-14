<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TopicQuestion;

class AdminTopicQuestionController extends Controller
{
    public function getPageTopicQuestion(){
        return view('admin.pages.topic_questions');
    }

    public function getToipicQuestion(){
        $lstTopicQuestion = TopicQuestion::all();
        return response()->json(['lstTopicQuestion'=>$lstTopicQuestion,'status'=>200]);
    }

    public function createTopicQuestion(Request $request){
        $validator = Validator::make($request->all(),
            [
                'topic_question_name'=>'required',
                'description'=>'required',
                // 'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'topic_question_name.required' =>'Tên chủ đề không được bỏ trống!',
                'description.required' => 'Ghi chú không được bỏ trống!',
                
            ]);

            if($validator->fails()){
                return response()->json(['status'=>400,'message'=>$validator->errors()->toArray()]);
            }else{
                
            }
    }
}