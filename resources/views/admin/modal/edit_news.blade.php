{{-- edit Modal --}}
<div class="modal fade" id="editNews" tabindex="-1" aria-labelledby="editNewsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="edit-news" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <div class="col-10">
                    <h5 class="modal-title" id="editNewsModalLabel">Cập nhật thể loại bài viết</h5>
                </div>
                <div class="col-1">
                    <select name="status" id="edit-news-status" class="form-select">
                        <option value="0">Ẩn</option>
                        <option value="1">Hiện</option>
                    </select>
                </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    
                    
                    <div class="card-body">
                        <input class="form-control" hidden id="id-news" name="id">
                        <div class="mb-3 col-md">
                              <label for="edit-title" class="form-label">Tiêu đề:</label>
                              <input class="form-control" type="text" id="edit-title" name="title">
                              <span class="error-message" style="color: red;" id="error-edit-title" value></span>
                        </div>
                        <div class="mb-3 col-md">
                              <label for="edit-for-category" class="form-label">Chủ đề:</label>
                              <select name="news_category_id" id="edit-for-category" class="select2 form-select">     
                              </select>
                        </div>
                        <div class="mb-3 col-md">
                              <label for="content" class="form-label">Nội dung chính:</label>
                              <textarea id="edit-news-content" class="form-control" name="news_content" rows="10" style="width: 100%;height: 100%;resize: none;" ></textarea>
                              <span class="error-message" style="color: red;" id="error-edit-news_content" value></span>
                        </div>
                        
                        <div class="mb-3 col-md">
                              <label for="image-news" class="form-label">Nội dung chính:</label>
                              <input onchange="loadFileEditNews(event)" class="form-control" type="file" id="edit-image-news" name="image">
                              <span class="error-message" style="color: red;" id="error-edit-image" value></span>
                        </div>
                        
                        <div class="mb-3 col-md">
                              <img class="info-avatar d-block rounded" height="720" width="1080" id="preview-image-edit-news" src="{{URL('admin/assets/img/no_avatar.png')}}" alt="image-topic-question">
                        </div>
                        
                    </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Hoàn tất</button>
                            <span data-bs-dismiss="modal" aria-label="Close" class="btn btn-outline-secondary">Hủy</span>
                        </div>
                    </form>
                </div>  
            </div>
        </div>
    </div>    
</div><script>
var loadFileEditNews = function(event){
  var crAvatar = document.getElementById('preview-image-edit-news');
  crAvatar.src = URL.createObjectURL(event.target.files[0]);
}
</script>