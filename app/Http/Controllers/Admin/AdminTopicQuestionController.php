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
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'topic_question_name.required' =>'Tên chủ đề không được bỏ trống!',
                'description.required' => 'Ghi chú không được bỏ trống!',
                'image.required' => 'Ảnh chủ đề câu hỏi bị thiếu!',
                'image.image' => 'Tệp phải là một ảnh!',
                'image.mimes' => 'Phần mở rộng của tệp phải là jpeg, png, hoặc jpg',
                'image.max' => 'Kích cỡ tệp quá giới hạn 2 MB!'
                
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

    public function editTopicQuestion($id){
        $tpq = TopicQuestion::find($id);
        if(empty($tpq)){
            return response()->json(['status'=>404,'message'=>'Không tìm thấy chủ đề câu hỏi!']);
        }else{
            return response()->json(['status'=>200,'tpq'=> $tpq]);
        }
        
    }

    public function updateTopicQuestion(Request $request){
        $validator = Validator::make($request->all(),
            [
                'topic_question_name'=>'required',
                'description'=>'required',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'topic_question_name.required' =>'Tên chủ đề không được bỏ trống!',
                'description.required' => 'Ghi chú không được bỏ trống!',
                'image.required' => 'Ảnh chủ đề câu hỏi bị thiếu!',
                'image.image' => 'Tệp phải là một ảnh!',
                'image.mimes' => 'Phần mở rộng của tệp phải là jpeg, png, hoặc jpg',
                'image.max' => 'Kích cỡ tệp quá giới hạn 2 MB!'
                
            ]);
            if($validator->fails()){
                return response()->json(['status'=>400,'message'=>$validator->errors()->toArray()]);
            }else{
                $data = $request->all();
                
                $tpq = TopicQuestion::find($data['id']);
                if(empty($tpq)){
                    return response()->json(['status'=>404,'message'=>'Không tìm thấy chủ đề câu hỏi!']);
                }else{
                    // dd($tpq);
                    $tpq->topic_question_name = $data['topic_question_name'];
                    $tpq->description = $data['description'];

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
                    
                    $tpq->update();
                }
                return response()->json(['status'=>200,'message'=> 'Cập nhật thông tin chủ đề thành công']);
            }
    }

    public function deleteTopicQuestion($id){
        $tpq = TopicQuestion::find($id);
        // dd($tpq);
        if(empty($tpq)){
            return response()->json(['status'=>400,'message'=>'Có lỗi xảy ra, vui lòng thử lại sau!']);
        }
        else{
            // dd($tpq);
            $tpq->delete();
            return response()->json(['status'=>200,'message'=>'Xóa chủ đề câu hỏi thành công!']);
        }
        
    }
}