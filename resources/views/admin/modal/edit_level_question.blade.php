{{-- Add Modal --}}
<div class="modal fade" id="editLevelQuestion" tabindex="-1" aria-labelledby="editLevelQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLevelQuestionModalLabel">Thêm độ khó câu hỏi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-4">
                    <div class="card-body">
                      <form id="edit-level-question" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="card-body">
                            <input type="text" hidden name="id" id="edit-level-question-id">
                          <br>
                            <div class="mb-6 col-md">
                              <label for="create-level-name" class="form-label">Tên độ khó:</label>
                              <input class="form-control" type="text" id="edit-level-question-name" name="level_name">
                              <span class="error-message" style="color: red;" id="error-add-news_category_name" value></span>
                            </div>
                            <br>
                            <div class="mb-6 col-md">
                              <label for="description" class="form-label">Ghi chú:</label>
                              <input class="form-control" type="text" name="description" id="edit-level-description">
                              <span class="error-message" style="color: red;" id="error-add-description"></span>
                            </div>
                            <br>
                            <div class="mb-6 col-md">
                              <label for="create-amount" class="form-label">Số lượng câu hỏi:</label>
                              <input class="form-control" type="number" min="0" id="edit-level-amount" name="amount">
                              <span class="error-message" style="color: red;" id="error-add-news_category_name" value></span>
                            </div>
                            <br>
                            <div class="mb-6 col-md">
                              <label for="create-time-answer" class="form-label">Thời gian trả lời:</label>
                              <input class="form-control" type="number" min="0" id="edit-level-time-answer" name="time_answer">
                              <span class="error-message" style="color: red;" id="error-add-news_category_name" value></span>
                            </div>
                            <br>
                            <div class="mb-6 col-md">
                              <label for="create-point" class="form-label">Điểm mỗi câu:</label>
                              <input class="form-control" type="number" min="0" id="edit-level-point" name="point">
                              <span class="error-message" style="color: red;" id="error-add-news_category_name" value></span>
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