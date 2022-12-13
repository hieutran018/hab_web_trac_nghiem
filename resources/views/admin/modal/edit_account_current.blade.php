{{-- Add Modal --}}
<div class="modal fade" id="editAccountCurrent" tabindex="-1" aria-labelledby="editAccountCurrentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAccountCurrentModalLabel">Cập nhật tài khoản quản trị viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-4"> 
                    <div class="card-body">
                      <form id="current-account-admin" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                          <img src="" alt="user-avatar" class="info-avatar d-block rounded" height="70" width="70" id="current-avatar">
                          <div class="button-wrapper">
                            <label for="current-upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                              <span class="d-none d-sm-block">Tải hình ảnh lên</span>
                              <i class="bx bx-upload d-block d-sm-none"></i>
                              <input onchange="loadFileCurrent(event)" name="avatar" type="file" id="currtent-upload" class="account-file-input" hidden="">
                            </label>
                            <button type="reset" class="btn btn-outline-secondary account-image-reset mb-4">
                              <i class="bx bx-reset d-block d-sm-none"></i>
                              <span class="d-none d-sm-block">Đặt lại biểu mẫu</span>
                            </button>
                            <p class="text-muted mb-0">Cho phép định dạng file PNG, JPEG.</p>
                          </div>
                        </div>
                        
                        <br>
                        <div class="card-body">
                            <div class="row">
                              <div class="mb-3 col-md-6">
                                <label for="first-name" class="form-label">ID:</label>
                                <span id="current-id" name="id"></span>
                              </div>
                            </div>
                          <div class="row">
                            <div class="row">
                              <div class="mb-3 col-md-6">
                                <label for="current-display-name" class="form-label">Tên người dùng:</label>
                                <input class="form-control" type="text" id="current-display-name" name="display_name">
                                <span class="error-message" style="color: red;" id="error-current-display_name" value></span>
                              </div>
                            </div>
                            <div class="mb-3 col-md-6">
                              <label class="form-label" for="current-email">Email</label>
                              <input type="text" id="current-email" name="email" class="form-control">
                              <span class="error-message" style="color: red;" id="error-current-email"></span>
                            </div>
                            <div class="mb-3 col-md-6">
                              <label class="form-label" for="phoneNumber">Số điện thoại</label>
                              <input type="text" id="current-phoneNumber" name="phone_number" class="form-control">
                              <span class="error-message" style="color: red;" id="error-current-phone_number"></span>
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="address" class="form-label">Địa chỉ:</label>
                              <input type="text" class="form-control" id="current-address" name="address">
                              <span class="error-message" style="color: red;" id="error-current-address"></span>
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="date-of-birth" class="form-label">Ngày sinh:</label>
                              <input type="date" class="form-control" id="current-dateOfBirth" name="date_of_birth">
                              <span class="error-message" style="color: red;" id="error-current-date-of-birth"></span>
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
<script>
var loadFileCurrent = function(event){
  var edAvatar = document.getElementById('current-avatar');
  edAvatar.src = URL.createObjectURL(event.target.files[0]);
}
</script>