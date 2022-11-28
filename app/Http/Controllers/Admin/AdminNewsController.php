<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Image;
use Auth;

class AdminNewsController extends Controller
{
    public function getPageNews(){
        return view('admin.pages.news');
    }

    public function getNews(){
        $lstNews = News::all();
        foreach($lstNews as $news){
            $news->user_id = $news->user->first_name.' '.$news->user->last_name;
            $news->news_category_id = $news->newscategory->news_category_name;
            $news->image = asset('storage/news/'.$news->image);
        }
        return response()->json(['status'=>200,'lstNews'=>$lstNews]);
    }

    public function createNews(Request $request){
        $validator = Validator::make($request->all(),
            [
                'title'=>'required',
                'news_content'=>'required',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'title.required' =>'Tên chủ đề bài viết không được bỏ trống!',
                'news_content.required' => 'Ghi chú không được bỏ trống!',
                'image.required' => 'Ảnh tin tức bị thiếu!',
                'image.image' => 'Tệp phải là một ảnh!',
                'image.mimes' => 'Phần mở rộng của tệp phải là jpeg, png, hoặc jpg',
                'image.max' => 'Kích cỡ tệp quá giới hạn 2 MB!'
            ]);
        $data = $request->all();
        $news = new News();
        $news->title = $data['title'];
        $news->user_id = Auth::user()->id;
        $news->news_category_id = $data['news_category_id'];
        $news->news_content = $data['content'];
        $news->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $news->status = 1;
        if($request->hasFile('image')){
            $fileExtentsion = $request->file('image')->getClientOriginalExtension();
            $fileName = time().'.'.$fileExtentsion;
            $request->file('image')->storeAs('news/', $fileName);
            $file = Image::make(storage_path('app/public/news/'. $fileName));
            $file->resize(1080, 720, function ($constraint) {
                $constraint->aspectRatio();
            });
            $file->save(storage_path('app/public/news/'. $fileName));
            $news->image = $fileName;
            $news->save();
            return response()->json(['status'=>200,'message'=>'Thêm bài viết thành công!']);
        }
        else{
            return response()->json(['status'=>400,'message'=>'Có lỗi xảy ra, vui lòn thử lại sau!']);
        }

    }

    public function getNewsDetail($id){
        $news = News::Find($id);
        if(empty($news)){
            return response()->json(['status'=>400,'message'=>'Không tìm thấy thông tin bài viết!']);
        }else{
            $news->image = asset('storage/news/'.$news->image);
            $news->user_id = $news->user->first_name.' '.$news->user->last_name;
            $news->news_category_id = $news->newscategory->news_category_name;
            $news->created_at = Carbon::parse($news->created_at)->format('d/m/Y');
            return response()->json(['status'=>200,'news'=> $news]);
        }
    }

    public function editNews($id){
        $news = News::Find($id);
        if(empty($news)){
            return response()->json(['status'=>400,'message'=>'Không tìm thấy thông tin bài viết!']);
        }else{
            $news->image = asset('storage/news/'.$news->image);
            return response()->json(['status'=>200,'news'=> $news]);
        }
    }

    public function updateNews(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(),
            [
                'id'=>'required',
                'title'=>'required',
                'news_content'=>'required',
                'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'id.required'=>'Không tồn tại bài viết!',
                'title.required' =>'Tên chủ đề bài viết không được bỏ trống!',
                'news_content.required' => 'Nội dung không được bỏ trống!',
                'image.image' => 'Tệp phải là một ảnh!',
                'image.mimes' => 'Phần mở rộng của tệp phải là jpeg, png, hoặc jpg',
                'image.max' => 'Kích cỡ tệp quá giới hạn 2 MB!'
            ]);
            if($validator->fails()){
                return response()->json(['status'=>400,'message'=>$validator->errors()->toArray()]);
            }else{
            $data= $request->all();
            $news = News::find($data['id']);
            if(empty($news)){
                return response()->json(['status'=>400,'message'=>'Không tìm thấy thông tin bài viết!']);
            }else{
                $news->title = $data['title'];
                $news->news_category_id = $data['news_category_id'];
                $news->news_content = $data['news_content'];
                $news->status = $data['status'];


                if($request->hasFile('image')){
                    $fileExtentsion = $request->file('image')->getClientOriginalExtension();
                    $fileName = time().'.'.$fileExtentsion;
                    $request->file('image')->storeAs('news/', $fileName);
                    $file = Image::make(storage_path('app/public/news/'. $fileName));
                    $file->resize(1080, 720, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $file->save(storage_path('app/public/news/'. $fileName));
                    $news->image = $fileName;
                    
                }
                $news->update();
                return response()->json(['status'=>200,'message'=>'Thêm bài viết thành công!']);
            }
        }
    }

    public function deleteNews($id){
        $news = News::find($id);
        if(empty($news)){
            return response()->json(['status'=>400,'message'=>'Không tìm thấy thông tin bài viết!']);
        }else{
            $news->delete();
            return response()->json(['status'=>200,'message'=>'Xóa bài viết thành công!']);
        }
    }
}