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
                    
                    <div class="card-body">
                      <form id="create-account-admin" enctype="multipart/form-data">
                        @csrf
                        <br>
                        <div class="card-body">
                          <div class="row">   
                            <div class="mb col-md">
                              <label for="create-question-content" class="form-label">Nội dung câu hỏi:</label>
                              <textarea class="form-control" style="height: 100px"></textarea>
                              <span class="error-message" style="color: red;" id="error-question-content" value></span>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="create-question-topic" class="form-label">Chủ đề:</label>
                              <select class="form-select" aria-label="Default select example">
                                    <option selected="">Chọn chủ đề</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                 </select>
                              <span class="error-message" style="color: red;" id="error-add-last_name"></span>
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="create-question-level" class="form-label">Độ khó:</label>
                              <select class="form-select" aria-label="Default select example">
                                    <option selected="">Chọn độ khó</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                 </select>
                              <span class="error-message" style="color: red;" id="error-add-last_name"></span>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="col"><button id="add-form-field" type="button" class="btn btn-info"><i class='bx bx-message-alt-add'></i></button></div>
                          </div>
                          <br>
                          <div id="add-answer">
                            <div class="mb-6 col-md">
                              <div class="row">
                                <label for="create-level-name" class= "form-label"> Câu trả lời 1:</label>
                                <div class="mb-6 col-md-10">
                                  <div class="mb-6 col-md">
                                    <input class="form-control" type="text" id="create-answer-1" name="question_content_1">
                                    <span class="error-message" style="color: red;" id="error-add-news_category_name" value=""></span>
                                  </div>
                                </div>
                                <div class="mb-6 col-md-2">
                                    <input class="form-check-input" type="checkbox" id="gridCheck1">
                                </div>
                              </div>
                            </div>
                            
                          </div>
                          
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