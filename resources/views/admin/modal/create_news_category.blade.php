{{-- Add Modal --}}
<div class="modal fade" id="createNewsCategory" tabindex="-1" aria-labelledby="createNewsCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createNewsCategoryModalLabel">Thêm thể loại bài viết</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-4">
                    
                    <div class="card-body">
                      <form id="create-news-category" method="POST">
                        @csrf
                        <hr class="my-0">
                        <div class="card-body">
                            {{-- <input type="hidden" id="edit-id" name="id"> --}}
                          
                            <div class="mb-6 col-md">
                              <label for="first-name" class="form-label">Tên thể loại:</label>
                              <input class="form-control" type="text" id="create-category-name" name="news_category_name">
                              <span class="error-message" style="color: red;" id="error-add-news_category_name" value></span>
                            </div>
                            <div class="mb-6 col-md">
                              <label for="last-name" class="form-label">Ghi chú:</label>
                              <input class="form-control" type="text" name="description" id="create-description">
                              <span class="error-message" style="color: red;" id="error-add-description"></span>
                            </div>
                          <div class="mt-2">
                            <button type="submit" id="submit-create-news-category" class="btn btn-primary me-2">Hoàn tất</button>
                            <span data-bs-dismiss="modal" aria-label="Close" class="btn btn-outline-secondary">Hủy</span>
                          </div>
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