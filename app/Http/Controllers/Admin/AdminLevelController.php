<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Level;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AdminLevelController extends Controller
{
    public function getPageLevelQuestion(){
        return view('admin.pages.level_question');
    }

    public function getLevelQuestion(){
        $lv = Level::all();
        return response()->json(['status'=>200,'lv'=>$lv]);
    }

    public function createLevelQuestion(Request $request){
        $validator = Validator::make($request->all(),
            [
                'level_name'=>'required',
                'description'=>'required',
                'amount'=>'required|numeric|gt:0',
                'time_answer'=>'required|numeric|gt:0',
                'point'=>'required|numeric|gt:0',
                // 'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'level_name.required' =>'Tên độ khó không được bỏ trống!',
                'description.required' => 'Ghi chú không được bỏ trống!',
                'amount.required' => 'Số lượng câu hỏi không được bỏ trống',
                'amount.numeric'=>'Số lượng câu hỏi bắt buộc phải là số',
                'amount.gt'=>'Số lượng câu hỏi phải lớn hơn hoặc bằng 0',
                'time_answer.required' => 'Thời gian trả lời không được bỏ trống',
                'time_answer.numeric'=>'Thời gian trả lời bắt buộc phải là số',
                'time_answer.gt'=>'Thời gian trả lời phải lớn hơn hoặc bằng 0',
                'point.required' => 'Điểm không được bỏ trống',
                'point.numeric'=>'TĐiểm bắt buộc phải là số',
                'point.gt'=>'Điểm phải lớn hơn hoặc bằng 0',
            ]);

            if($validator->fails()){
                return response()->json(['status'=>400,'message'=>$validator->errors()->toArray()]);
            }else{
                $data =$request->all();
                $lv = new Level();
                $lv->level_name = $data['level_name'];
                $lv->description = $data['description'];
                $lv->amount_question = $data['amount'];
                $lv->time_answer = $data['time_answer'];
                $lv->point= $data['point'];
                $lv->created_at = Carbon::now('Asia/Ho_Chi_Minh');
                $lv->status = 1;
                $lv->save();
                return response()->json(['status'=>200,'message'=>'Thêm độ khó thành công!']);
            }
    }


    public function editLevelQuestion($id){
        $lv = Level::find($id);
        if(empty($lv)){
            return response()->json(['status'=>400,'message'=>'Không tìm thấy thông tin độ khó này!']);
        }else{
            return response()->json(['status'=>200,'lv'=>$lv]);
        }
    }
}