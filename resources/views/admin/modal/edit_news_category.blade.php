{{-- Add Modal --}}
<div class="modal fade" id="editNewsCategory" tabindex="-1" aria-labelledby="editNewsCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editNewsCategoryModalLabel">Cập nhật thể loại bài viết</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <span class="error-message" style="color: red;" id="error-add-error-password"></span>
                <div class="card mb-4">
                    
                    <div class="card-body">
                      <form id="edit-news-category" method="POST">
                        @csrf
                        <hr class="my-0">
                        <div class="card-body">
                            {{-- <input type="hidden" id="edit-id" name="id"> --}}
                            <input type="hidden" id="edit-news-category-id" name="id">
                            <div class="mb-6 col-md">
                              <label for="edit-category-name" class="form-label">Tên thể loại:</label>
                              <input class="form-control" type="text" id="edit-category-name" name="news_category_name">
                              <span class="error-message" style="color: red;" id="error-edit-news_category_name" value></span>
                            </div>
                            <div class="mb-6 col-md">
                              <label for="edit-category-name" class="form-label">Ghi chú:</label>
                              <input class="form-control" type="text" name="description" id="edit-description">
                              <span class="error-message" style="color: red;" id="error-edit-description"></span>
                            </div>
                            <div class="mb-6 col-md">
                              <label for="edit-status" class="form-label">Trạng thái:</label>
                              <select name="status" id="edit-status" class="select2 form-select">
                              <option value="1">Hiện</option>
                              <option value="0">Ẩn</option>
                            </select>
                            </div>
                          <div class="mt-2">
                            <button type="submit" id="submit-edit-news-category" class="btn btn-primary me-2">Hoàn tất</button>
                            <span data-bs-dismiss="modal" aria-label="Close" class="btn btn-outline-secondary">Hủy</span>
                          </div>
                        </div>
                        <div class="card">
                    
                    </div>
                      </form>
                          
                    </div>
                </div>
            </div>
        </div>
    </div>
              
</div>

<script>
var loadFile = function(event){
  var crAvatar = document.getElementById('create-avatar');
  crAvatar.src = URL.createObjectURL(event.target.files[0]);
}
</script>