{{-- Add Modal --}}
<div class="modal fade" id="createQuestion" tabindex="-1" aria-labelledby="createQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title" id="createQuestionModalLabel">Thêm câu hỏi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-4">
                    <span class="error-message" style="color: red;" id="error-add-isTrue" value=""></span>
                    <div class="card-body">
                      <form id="create-question" enctype="multipart/form-data">
                        @csrf
                        <br>
                        <div class="card-body">
                          <div class="row">   
                            <div class="mb col-md">
                              <label for="create-question-content" class="form-label">Nội dung câu hỏi:</label>
                              <textarea id="add-question-content" name="question_content" class="form-control" style="height: 100px"></textarea>
                              <span class="error-message" style="color: red;" id="error-add-question_content" value></span>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="create-question-topic" class="form-label">Chủ đề:</label>
                              <select class="form-select" name="topic_id" id="add-topic-id">
                              </select>
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="create-question-level" class="form-label">Độ khó:</label>
                              <select class="form-select" name="level_id" id="add-level-id">    
                              </select>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="mb col-md">
                              <div class="row">
                                <label for="add-answer-content-1" class= "form-label"> Câu trả lời 1:</label>
                                <div class="mb-6 col-md-10">
                                  <div class="mb-6 col-md">
                                    <input class="form-control" type="text" id="add-answer-content-1" name="answer_content_1">
                                    <span class="error-message" style="color: red;" id="error-add-answer_content_1" value=""></span>
                                  </div>
                                </div>
                                <div class="mb-6 col-md-2">
                                    <input class="form-check-input" value="1" name="isTrue" type="radio" id="gridRadios1">
                                    <label for="add-answer-content-3" class= "form-label">Đúng</label>
                                </div>
                              </div>
                              <br>
                              <div class="row">
                                <label for="add-answer-content-2" class= "form-label"> Câu trả lời 2:</label>
                                <div class="mb-6 col-md-10">
                                  <div class="mb-6 col-md">
                                    <input class="form-control" type="text" id="add-answer-content-2" name="answer_content_2">
                                    <span class="error-message" style="color: red;" id="error-add-answer_content_2" value=""></span>
                                  </div>
                                </div>
                                <div class="mb-6 col-md-2">
                                    <input class="form-check-input" value="2" name="isTrue" type="radio" id="gridRadios2">
                                    <label for="add-answer-content-3" class= "form-label">Đúng</label>
                                </div>
                              </div>
                              <br>
                              <div class="row">
                                <label for="add-answer-content-3" class= "form-label"> Câu trả lời 3:</label>
                                <div class="mb-6 col-md-10">
                                  <div class="mb-6 col-md">
                                    <input class="form-control" type="text" id="add-answer-content-3" name="answer_content_3">
                                    <span class="error-message" style="color: red;" id="error-add-answer_content_3" value=""></span>
                                  </div>
                                </div>
                                <div class="mb-6 col-md-2">
                                    <input class="form-check-input" value="3" name="isTrue" type="radio" id="gridRadios3">
                                    <label for="add-answer-content-3" class= "form-label">Đúng</label>
                                </div>
                              </div>
                              <br>
                              <div class="row">
                                <label for="add-answer-content-4" class= "form-label"> Câu trả lời 4:</label>
                                <div class="mb-6 col-md-10">
                                  <div class="mb-6 col-md">
                                    <input class="form-control" type="text" id="add-answer-content-4" name="answer_content_4">
                                    <span class="error-message" style="color: red;" id="error-add-answer_content_4" value=""></span>
                                  </div>
                                </div>
                                <div class="mb-6 col-md-2">
                                    <input class="form-check-input" value="4" name="isTrue" type="radio" id="gridRadios4">
                                    <label for="add-answer-content-3" class= "form-label">Đúng</label>
                                </div>
                              </div>
                            </div>
                            
                            
                          </div>
                          <br>
                          
                          <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Hoàn tất</button>
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