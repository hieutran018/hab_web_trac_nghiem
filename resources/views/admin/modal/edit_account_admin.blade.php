{{-- Add Modal --}}
<div class="modal fade" id="editAccountAdmin" tabindex="-1" aria-labelledby="editAccountAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAccountAdminModalLabel">Thêm tài khoản quản trị viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <span class="error-message" style="color: red;" id="error-add-error-password"></span>
                <div class="card mb-4">
                    
                    <div class="card-body">
                      <form id="edit-account-admin" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                          <img src="" alt="user-avatar" class="info-avatar d-block rounded" height="100" width="100" id="edit-avatar">
                          <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                              <span class="d-none d-sm-block">Tải hình ảnh lên</span>
                              <i class="bx bx-upload d-block d-sm-none"></i>
                              <input name="avatar" type="file" id="upload" class="account-file-input" hidden="">
                            </label>
                            <button type="reset" class="btn btn-outline-secondary account-image-reset mb-4">
                              <i class="bx bx-reset d-block d-sm-none"></i>
                              <span class="d-none d-sm-block">Đặt lại biểu mẫu</span>
                            </button>
                            <p class="text-muted mb-0">Cho phép định dạng file PNG, JPEG.</p>
                          </div>
                        </div>
                        
                        <hr class="my-0">
                        <div class="card-body">
                            <input type="hidden" id="edit-id" name="id">
                          <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="first-name" class="form-label">Họ:</label>
                              <input class="form-control" type="text" id="edit-fName" name="first_name">
                              <span class="error-message" style="color: red;" id="error-add-first_name"></span>
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="last-name" class="form-label">Tên:</label>
                              <input class="form-control" type="text" name="last_name" id="edit-lName">
                              <span class="error-message" style="color: red;" id="error-add-last_name"></span>
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="email" class="form-label">E-mail</label>
                              <input class="form-control" type="text" id="edit-email" name="email">
                              <span class="error-message" style="color: red;" id="error-add-email"></span>
                            </div>
                            <div class="mb-3 col-md-6">
                              <label class="form-label" for="phoneNumber">Số điện thoại</label>
                              <input type="text" id="edit-phoneNumber" name="phone_number" class="form-control">
                              <span class="error-message" style="color: red;" id="error-add-phone_number"></span>
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="address" class="form-label">Địa chỉ:</label>
                              <input type="text" class="form-control" id="edit-address" name="address">
                              <span class="error-message" style="color: red;" id="error-add-address"></span>
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="date-of-birth" class="form-label">Ngày sinh:</label>
                              <input type="date" class="form-control" id="edit-dateOfBirth" name="date_of_birth">
                              <span class="error-message" style="color: red;" id="error-add-date-of-birth"></span>
                            </div>
                            <div class="mb-3 col-md-6">
                            <label class="form-label" for="country">Vị trí</label>
                            <select name="position" id="edit-position" class="select2 form-select">
                              <option value="1">Quản trị viên</option>
                              <option value="2">Cộng tác viên</option>
                            </select>
                          </div>
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