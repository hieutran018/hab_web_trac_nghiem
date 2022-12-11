{{-- Add Modal --}}
<div class="modal fade" id="createLevelQuestion" tabindex="-1" aria-labelledby="createLevelQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLevelQuestionModalLabel">Thêm độ khó câu hỏi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-4">
                    <div class="card-body">
                      <form id="create-level-question" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="card-body">
                          <br>
                            <div class="mb-6 col-md">
                              <label for="create-level-name" class="form-label">Tên độ khó:</label>
                              <input class="form-control" type="text" id="create-level-name" name="level_name">
                              <span class="error-message" style="color: red;" id="error-add-level_name" value></span>
                            </div>
                            <br>
                            <div class="mb-6 col-md">
                              <label for="description" class="form-label">Ghi chú:</label>
                              <input class="form-control" type="text" name="description" id="create-level-description">
                              <span class="error-message" style="color: red;" id="error-add-description"></span>
                            </div>
                            <br>
                            <div class="mb-6 col-md">
                              <label for="create-amount" class="form-label">Số lượng câu hỏi:</label>
                              <input class="form-control" type="number" min="0" id="create-amount" name="amount">
                              <span class="error-message" style="color: red;" id="error-add-amount" value></span>
                            </div>
                            <br>
                            <div class="mb-6 col-md">
                              <label for="create-time-answer" class="form-label">Thời gian trả lời:</label>
                              <input class="form-control" type="number" min="0" id="create-time-answer" name="time_answer">
                              <span class="error-message" style="color: red;" id="error-add-time_answer" value></span>
                            </div>
                            <br>
                            <div class="mb-6 col-md">
                              <label for="create-point" class="form-label">Điểm mỗi câu:</label>
                              <input class="form-control" type="number" min="0" id="create-point" name="point">
                              <span class="error-message" style="color: red;" id="error-add-point" value></span>
                            </div>
                            <br>
                          <div class="mt-2">
                            <button type="submit" id="submit-create-level-question" class="btn btn-primary me-2">Hoàn tất</button>
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
  var crAvatar = document.getElementById('preview-image');
  crAvatar.src = URL.createObjectURL(event.target.files[0]);
}
</script>