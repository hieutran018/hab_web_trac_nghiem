{{-- Add Modal --}}
<div class="modal fade" id="editTopicQuestion" tabindex="-1" aria-labelledby="editTopicQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTopicQuestionModalLabel">Thêm chủ đề câu hỏi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-4">
                    <div class="card-body">
                      <form id="edit-topic-question" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="card-body">
                            <input name="id" id="edit-topic-question-id" type="text" hidden>
                          <br>
                            <div class="mb-6 col-md">
                              <label for="first-name" class="form-label">Tên chủ đề:</label>
                              <input class="form-control" type="text" id="edit-topic-question-name" name="topic_question_name">
                              <span class="error-message" style="color: red;" id="error-edit-topic_question_name" value></span>
                            </div>
                            <br>
                            <div class="mb-6 col-md">
                              <label for="last-name" class="form-label">Ghi chú:</label>
                              <input class="form-control" type="text" name="description" id="edit-topic-description">
                              <span class="error-message" style="color: red;" id="error-edit-description"></span>
                            </div>
                            <br>
                            <div class="mb-6 col-md">
                              <label for="last-name" class="form-label">Ảnh minh họa:</label>
                              <input onchange="loadFile(event)" class="form-control" type="file" name="image" id="edit-topic-image">
                              <span class="error-message" style="color: red;" id="error-edit-image"></span>
                            </div>
                            <br>
                            <div class="mb-6 col-md">
                              <img class="info-avatar d-block rounded" height="100" width="100" id="preview-image-edit" src="{{URL('admin/assets/img/no_avatar.png')}}" alt="image-topic-question">
                            </div>
                            <br>
                          <div class="mt-2">
                            <button type="submit" id="submit-edit-topic-question" class="btn btn-primary me-2">Hoàn tất</button>
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
  var crAvatar = document.getElementById('preview-image-edit');
  crAvatar.src = URL.createObjectURL(event.target.files[0]);
}
</script>