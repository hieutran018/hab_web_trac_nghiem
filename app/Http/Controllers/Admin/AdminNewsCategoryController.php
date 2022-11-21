<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsCategories;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class AdminNewsCategoryController extends Controller
{
    public function getPageNewsCategories(){
        return view('admin.pages.news_categories');
    }
    public function getNewsCategory(){
        $newsCategory = NewsCategories::Get();
        return response()->json(['status'=>200,'newsCategory'=>$newsCategory]);
    }

    public function createNewsCatetogy(Request $request){
        $validator = Validator::make($request->all(),
            [
                'news_category_name'=>'required',
                'description'=>'required',
                
            ],
            [
                'news_category_name.required' =>'Tên chủ đề bài viết không được bỏ trống!',
                'description.required' => 'Ghi chú không được bỏ trống!',
            ]);

        if($validator->fails()){
            return response()->json(['status'=>400,'message'=>$validator->errors()->toArray()]);
        }else{    
            $data = $request->all();
            $newsCategory = new NewsCategories();
            $newsCategory->news_category_name = $data['news_category_name'];
            $newsCategory->description = $data['description'];
            $newsCategory->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $newsCategory->updated_at = null;
            $newsCategory->status = 1;
            $newsCategory->save();
            return response()->json(['status'=>200,'messages'=>'Thêm thể loại bài viết thành công!']);
        }
    }

    public function editNewsCategory($id){
        $newsCategory = NewsCategories::WHERE('id',$id)->first();
        if(empty($newsCategory)){
            return response()->json(['status'=>404,'messages'=>'Không tìm thấy thể loại bài viết!']);
        }
        else{
            return response()->json(['status'=>200,'newsCategory'=>$newsCategory]);
        }
    }

    public function updateNewsCategory(Request $request){

        $validator = Validator::make($request->all(),
            [
                'news_category_name'=>'required',
                'description'=>'required',
                
            ],
            [
                'news_category_name.required' =>'Tên chủ đề bài viết không được bỏ trống!',
                'description.required' => 'Ghi chú không được bỏ trống!',
            ]);

        if($validator->fails()){
            return response()->json(['status'=>400,'message'=>$validator->errors()->toArray()]);
        }else{ 
            $data = $request->all();
            $newsCategory = NewsCategories::WHERE('id',$data['id'])->first();
            if(empty($newsCategory)){
                return response()->json(['status'=>404,'messages'=>'Không tìm thấy thể loại bài viết!']);
            }
            else{
                $newsCategory->news_category_name = $data['news_category_name'];
                $newsCategory->description = $data['description'];
                if($data['status'] == 1){
                    $newsCategory->status =1;
                }elseif($data['status'] == 0){
                    $newsCategory->status = 0;
                }
                $newsCategory->update();
                return response()->json(['status'=>200,'messages'=>'Cập nhật chủ đề bài viết thành công!']);
            }
        }
    }

    public function deleteNewsCategory($id){
        $newsCategory = NewsCategories::find($id);
        if(empty($newsCategory)){
            return response()->json(['status'=>400,'message'=>'Có lỗi xảy ra, vui lòng thử lại sau!']);
        }else{
            $newsCategory->delete();
            return response()->json(['status'=>200,'message'=>'Xóa chủ đề bài viết thành công!']);
        }
    }
}