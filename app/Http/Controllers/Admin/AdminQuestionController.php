<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Question;
use App\Models\Answer;
use DB;
class AdminQuestionController extends Controller
{
    public function getPageQuestion(){
        return view('admin.pages.question');
    }

    public function getQuestion(){
        $lstQuestion = Question::all();
        foreach($lstQuestion as $question){
            $question->topic_id = $question->topic_question->topic_question_name;
            $question->level_id = $question->level->level_name;
        }
        return response()->json(['status'=>200,'lstQuestion'=>$lstQuestion]);
    }

    public function createQuestion(Request $request){
        $validator_question_content = Validator::make($request->all(),
            [
                'question_content'=>'required',
                'answer_content_1'=>'required',
                'answer_content_2'=>'required',
                'answer_content_3'=>'required',
                'answer_content_4'=>'required',
                'isTrue'=>'required',
            ],
            [
                'question_content.required' =>'Nội dung câu hỏi không được bỏ trống!',
                'answer_content_1.required' =>'Nội dung câu trả lời không được bỏ trống!',
                'answer_content_2.required' =>'Nội dung câu trả lời không được bỏ trống!',
                'answer_content_3.required' =>'Nội dung câu trả lời không được bỏ trống!',
                'answer_content_4.required' =>'Nội dung câu trả lời không được bỏ trống!',
                'isTrue.required' =>'Bạn chưa chọn đáp án đúng!',
            ]);

        if($validator_question_content->fails()){
            return response()->json(['status'=>400,'message'=>$validator_question_content->errors()->toArray()]);
        }else{
            DB::beginTransaction();
            try{
            $question = new Question();
            $question->question_content = $request->question_content;
            $question->topic_id = $request->topic_id;
            $question->level_id = $request->level_id;
            $question->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $question->save();
            for($i = 1 ; $i <= 4 ; $i++){
                    $data = $request->all();
                    $answer = New Answer();
                    $answer->answer_content = $data['answer_content_'.$i];
                    $answer->question_id = $question->id;
                    if($data['isTrue'] == $i){
                       $answer->isTrue = 1; 
                    }
                    $answer->created_at = Carbon::now('Asia/Ho_Chi_Minh');
                    $answer->save();  
            }
            DB::commit();
            return response()->json(['status'=>200,'Thêm câu hỏi thành công']);
            }catch(Exception $e){
                DB::rollBack();
                throw new Exception($e->getMessage());
            }
            
        }
       
    }

    public function editQuestion($id){
        $question = Question::Find($id);
        if(empty($question)){
            return response()->json(['status'=>400,'message'=>'Không tìm thấy thông tin câu hỏi!']);
        }else{
            
            return response()->json(['status'=>200,'question'=>$question,'answer'=>$question->answer]);
        }
    }

    public function updateQuestion(Request $request){

        $validator_question_content = Validator::make($request->all(),
            [
                'question_content'=>'required',
                'answer_content_1'=>'required',
                'answer_content_2'=>'required',
                'answer_content_3'=>'required',
                'answer_content_4'=>'required',
                'isTrue'=>'required',
            ],
            [
                'question_content.required' =>'Nội dung câu hỏi không được bỏ trống!',
                'answer_content_1.required' =>'Nội dung câu trả lời không được bỏ trống!',
                'answer_content_2.required' =>'Nội dung câu trả lời không được bỏ trống!',
                'answer_content_3.required' =>'Nội dung câu trả lời không được bỏ trống!',
                'answer_content_4.required' =>'Nội dung câu trả lời không được bỏ trống!',
                'isTrue.required' =>'Bạn chưa chọn đáp án đúng!',
            ]);
        if($validator_question_content->fails()){
            return response()->json(['status'=>400,'message'=>$validator_question_content->errors()->toArray()]);
        }else{

        $question = Question::Find($request->id);

            DB::beginTransaction();
            try{
            $question->question_content = $request->question_content;
            $question->topic_id = $request->topic_id;
            $question->level_id = $request->level_id;
            $question->update();
            for($i = 1 ; $i <= 4 ; $i++){
                $data = $request->all();
                if(empty($data['answer_content_'.$i])){
                    return response()->json(['status'=>400,'message'=>'Nội dung câu trả lời số '.$i.' không được bỏ trống!']);
                }else{
                    $answer = Answer::Find($data['answer_id_'.$i]);
                    $answer->answer_content = $data['answer_content_'.$i];
                    $answer->question_id = $question->id;
                    $answer->isTrue = 0;
                    if($data['isTrue'] == $i){
                       $answer->isTrue = 1;
                    }
                    $answer->update();
                        
                }
            }
            DB::commit();
            return response()->json(['status'=>200,'Cập nhật câu hỏi thành công']);
            }catch(Exception $e){
                DB::rollBack();
                throw new Exception($e->getMessage());
            }

        }


    }
}