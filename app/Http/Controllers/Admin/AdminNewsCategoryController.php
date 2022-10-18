<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsCategories;
use Carbon\Carbon;

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