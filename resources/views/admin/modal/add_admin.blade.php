{{-- Add Modal --}}
<div class="modal fade" id="addAdmin" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddStudentModalLabel">Thêm tài khoản quản trị viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="card mb-4">
                    
                    <div class="card-body">
                      <form id="formCreateAccount" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                          <img src="{{URL('admin/assets/img/app/no_avatar.png')}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                          <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                              <span class="d-none d-sm-block">Tải hình ảnh lên</span>
                              <i class="bx bx-upload d-block d-sm-none"></i>
                              <input name="add-avatar" type="file" id="upload" class="account-file-input" hidden="">
                            </label>
                            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                              <i class="bx bx-reset d-block d-sm-none"></i>
                              <span class="d-none d-sm-block">Đặt lại biểu mẫu</span>
                            </button>

                            <p class="text-muted mb-0">Cho phép định dạng file PNG, JPEG.</p>
                          </div>
                        </div>
                        
                        <hr class="my-0">
                        <div class="card-body">
                      
                          <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="first-name" class="form-label">Họ:</label>
                              <input class="form-control" type="text" id="add-first-name" name="first_name" placeholder="Họ..." autofocus="">
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="last-name" class="form-label">Tên:</label>
                              <input class="form-control" type="text" name="last_name" id="add-last-name" placeholder="Tên...">
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="email" class="form-label">E-mail</label>
                              <input class="form-control" type="text" id="add-email" name="email" placeholder="Địa chỉ email...">
                            </div>
                            <div class="mb-3 col-md-6">
                              <label class="form-label" for="phoneNumber">Số điện thoại</label>
                              <input type="text" id="add-phone-number" name="phone_number" class="form-control" placeholder="Số điện thoại...">
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="address" class="form-label">Địa chỉ:</label>
                              <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="date-of-birth" class="form-label">Ngày sinh:</label>
                              <input type="date" class="form-control" id="add-date-of-birth" name="date-of-birth">
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="password" class="form-label">Mật khẩu:</label>
                              <input type="password" class="form-control" id="add-password" name="password" placeholder="Mật khẩu...">
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="confirm-password" class="form-label">Xác nhận mật khẩu:</label>
                              <input type="password" class="form-control" id="add-confirm-password" name="confirm_password" placeholder="Xác nhận mật khẩu...">
                            </div>
                          </div>
                          <div class="mt-2">
                            <button type="submit" id="submit-create-account-admin" class="btn btn-primary me-2">Hoàn tất</button>
                            <button type="reset" class="btn btn-outline-secondary">Hủy</button>
                          </div>
                        </div>
                        
                      </form>
                          
                    </div>
                </div>
            </div>
        </div>
    </div>
              
</div>
