{{-- Add Modal --}}
<div class="modal fade" id="createNews" tabindex="-1" aria-labelledby="createNewsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createNewsModalLabel">Cập nhật thể loại bài viết</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <span class="error-message" style="color: red;" id="error-add-error-password"></span>
                <div class="card">
                    <form id="create-news" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="mb-3 col-md">
                              <label for="create-title" class="form-label">Tiêu đề:</label>
                              <input class="form-control" type="text" id="create-title" name="title">
                              <span class="error-message" style="color: red;" id="error-add-title" value></span>
                        </div>
                        <div class="mb-3 col-md">
                              <label for="create-for-category" class="form-label">Chủ đề:</label>
                              <select name="news_category_id" id="create-for-category" class="select2 form-select">     
                              </select>
                              <span class="error-message" style="color: red;" id="error-add-first_name" value></span>
                        </div>
                        <div class="mb-3 col-md">
                              <label for="content" class="form-label">Nội dung chính:</label>
                              <textarea class="form-control" name="content" rows="10" style="width: 100%;height: 100%;resize: none;" ></textarea>
                              <span class="error-message" style="color: red;" id="error-add-content" value></span>
                        </div>
                        
                        <div class="mb-3 col-md">
                              <label for="image-news" class="form-label">Nội dung chính:</label>
                              <input onchange="loadFileNews(event)" class="form-control" type="file" id="create-image-news" name="image">
                              <span class="error-message" style="color: red;" id="error-add-image" value></span>
                        </div>
                        <div class="mb-3 col-md">
                              <img class="info-avatar d-block rounded" height="720" width="1080" id="preview-image-create-news" src="{{URL('admin/assets/img/no_avatar.png')}}" alt="image-topic-question">
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
var loadFileNews = function(event){
  var crAvatar = document.getElementById('preview-image-create-news');
  crAvatar.src = URL.createObjectURL(event.target.files[0]);
}
</script>