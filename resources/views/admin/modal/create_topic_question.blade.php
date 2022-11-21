{{-- Add Modal --}}
<div class="modal fade" id="createTopicQuestion" tabindex="-1" aria-labelledby="createTopicQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTopicQuestionModalLabel">Thêm chủ đề câu hỏi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-4">
                    <div class="card-body">
                      <form id="create-topic-question" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="card-body">
                          <br>
                            <div class="mb-6 col-md">
                              <label for="first-name" class="form-label">Tên chủ đề:</label>
                              <input class="form-control" type="text" id="create-topic-question-name" name="topic_question_name">
                              <span class="error-message" style="color: red;" id="error-add-topic_question_name" value></span>
                            </div>
                            <br>
                            <div class="mb-6 col-md">
                              <label for="last-name" class="form-label">Ghi chú:</label>
                              <input class="form-control" type="text" name="description" id="create-topic-description">
                              <span class="error-message" style="color: red;" id="error-add-description"></span>
                            </div>
                            <br>
                            <div class="mb-6 col-md">
                              <label for="last-name" class="form-label">Ảnh minh họa:</label>
                              <input onchange="loadFileCreateTopic(event)" class="form-control" type="file" name="image" id="create-topic-image">
                              <span class="error-message" style="color: red;" id="error-add-image"></span>
                            </div>
                            <br>
                            <div class="mb-6 col-md">
                              <img class="info-avatar d-block rounded" height="100" width="100" id="preview-image-create-topic" src="{{URL('admin/assets/img/no_avatar.png')}}" alt="image-topic-question">
                            </div>
                            <br>
                          <div class="mt-2">
                            <button type="submit" id="submit-create-topic-question" class="btn btn-primary me-2">Hoàn tất</button>
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
var loadFileCreateTopic = function(event){
  var crTopicQuestion = document.getElementById('preview-image-create-topic');
  crTopicQuestion.src = URL.createObjectURL(event.target.files[0]);
}
</script>