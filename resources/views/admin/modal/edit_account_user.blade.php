{{-- Add Modal --}}
<div class="modal fade" id="editAccountUser" tabindex="-1" aria-labelledby="editAccountUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAccountUserModalLabel">Cập nhật tài khoản người dùng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <span class="error-message" style="color: red;" id="error-add-error-password"></span>
                <div class="card mb-4">
                    
                    <div class="card-body">
                      <form id="edit-account-user" method="POST" enctype="multipart/form-data">
                        {{-- @method('PUT') --}}
                        @csrf
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                          <img src="" alt="user-avatar" class="info-avatar d-block rounded" height="50" width="50" id="edit-avatar-user">
                          <div class="button-wrapper">
                            <label for="edit-upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                              <span class="d-none d-sm-block">Tải hình ảnh lên</span>
                              <i class="bx bx-upload d-block d-sm-none"></i>
                              <input onchange="loadFileEdit(event)" name="avatar" type="file" id="edit-upload" class="account-file-input" hidden="">
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
                            <input type="hidden" id="edit-id-user" name="id">
                          <div class="row">
                            <div class="row">
                              <div class="mb-3 col-md-6">
                                <label for="first-name" class="form-label">Tên người dùng:</label>
                                <input class="form-control" type="text" id="edit-display-name-user" name="display_name">
                                <span class="error-message" style="color: red;" id="error-edit-display_name" value></span>
                              </div>
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="email" class="form-label">E-mail</label>
                              <input class="form-control" type="text" id="edit-email-user" name="email">
                              <span class="error-message" style="color: red;" id="error-edit-email"></span>
                            </div>
                            <div class="mb-3 col-md-6">
                              <label class="form-label" for="phoneNumber">Số điện thoại</label>
                              <input type="text" id="edit-phoneNumber-user" name="phone_number" class="form-control">
                              <span class="error-message" style="color: red;" id="error-edit-phone_number"></span>
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="address" class="form-label">Địa chỉ:</label>
                              <input type="text" class="form-control" id="edit-address-user" name="address">
                              <span class="error-message" style="color: red;" id="error-edit-address"></span>
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="date-of-birth" class="form-label">Ngày sinh:</label>
                              <input type="date" class="form-control" id="edit-dateOfBirth-user" name="date_of_birth">
                              <span class="error-message" style="color: red;" id="error-edit-date-of-birth"></span>
                            </div>
                            <div class="mb-3 col-md-6">
                            <label class="form-label" for="edit-status">Trạng thái</label>
                            <select name="status" id="edit-status" class="select2 form-select">
                              <option value="1">Hoạt động</option>
                              <option value="0">Bị khóa</option>
                            </select>
                            </div>
                            @if(Auth::user()->isAdmin == 1)
                            <div class="row">
                              <div class="mb-3 col-md-6">
                                <span id="btn-change-password-user" class="btn btn-outline-danger btn-sm">Tùy chọn mật khẩu</span>
                              </div>
                            </div>
                            @endif
                          </div>
                          <div class="mt-2">
                            <button type="submit" id="submit-update-account-admin" class="btn btn-primary me-2">Hoàn tất</button>
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
var loadFileEdit = function(event){
  var edAvatar = document.getElementById('edit-avatar-user');
  edAvatar.src = URL.createObjectURL(event.target.files[0]);
}
</script>