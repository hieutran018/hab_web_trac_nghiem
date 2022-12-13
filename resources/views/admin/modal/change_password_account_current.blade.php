{{-- Add Modal --}}
<div class="modal fade" id="changePasswordAccountCurrent" tabindex="-1" aria-labelledby="changePasswordAccountCurrentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordAccountCurrentModalLabel">Tùy chọn mật khẩu người dùng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-4">
                    <div class="card-body">
                      <form id="form-change-password-account-current" method="POST" enctype="multipart/form-data">
                        @csrf
                        <span class="error-message" style="color: red;" id="error-password-not-match"></span>
                        <div class="card-body">
                            <br>
                            <div class="mb-6 col-md">
                              <label for="change-password" class="form-label">Mật khẩu cũ:</label>
                              <input class="form-control" type="password" id="change-old-password-acount-current" name="old_password">
                              <span class="error-message" style="color: red;" id="error-change-password-current-old_password" value></span>
                            </div>
                          <br>
                            <div class="mb-6 col-md">
                              <label for="change-password" class="form-label">Mật khẩu mới:</label>
                              <input class="form-control" type="password" id="change-password-acount-current" name="password">
                              <span class="error-message" style="color: red;" id="error-change-password-current-password" value></span>
                            </div>
                            <br>
                            <div class="mb-6 col-md">
                              <label for="change-confirm-password-acount-current" class="form-label">Xác nhận mật khẩu mới:</label>
                              <input class="form-control" type="password" name="confirm_password" id="change-confirm-password-acount-current">
                              <span class="error-message" style="color: red;" id="error-change-password-current-confirm_password"></span>
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
