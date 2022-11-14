<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TopicQuestion;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Image;

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
                $data = $request->all();

                $tpq = new TopicQuestion();
                $tpq->topic_question_name = $data['topic_question_name'];
                $tpq->description = $data['description'];
                $tpq->created_at = Carbon::now('Asia/Ho_Chi_Minh');
                $tpq->updated_at = null;
                $tpq->status = 1;
                $tpq->save();
                // dd($request->hasFile('image'));
                if($request->hasFile('image')){
                    $fileExtentsion = $request->file('image')->getClientOriginalExtension();
                    $fileName = time().'.'.$fileExtentsion;
                    $request->file('image')->storeAs('topic_question/', $fileName);
                    $file = Image::make(storage_path('app/public/topic_question/'. $fileName));
                    $file->resize(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $file->save(storage_path('app/public/topic_question/'. $fileName));
                    $tpq->image = $fileName;
                }
                $tpq->updated_at = null;
                $tpq->save();
                return response()->json(['status'=>200,'message'=>'Thêm chủ đề câu hỏi thành công!']);

            }
    }
}