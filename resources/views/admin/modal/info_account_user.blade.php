{{-- Add Modal --}}
<div class="modal fade" id="infoAccountUser" tabindex="-1" aria-labelledby="infoAccountUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoAccountUserModalLabel">Thông tin chi tiết tài khoản người dùng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                          <img  alt="user-avatar" class="d-block rounded" height="100" width="100" id="info-avatar-user">
                        </div>
                        <hr class="my-0">
                        <div class="card-body">
                          <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="first-name" class="form-label">Tên người dùng:</label>
                              <span class="span-info" id="info-display-name-user"></span>
                            </div>
                            
                            <div class="mb-3 col-md-6">
                              <label for="email" class="form-label">E-mail:</label>
                              <span class="span-info" id="info-email-user"></span>
                              
                            </div>
                            <div class="mb-3 col-md-6">
                              <label class="form-label" for="phoneNumber">Số điện thoại:</label>
                              <span class="span-info" id="info-phoneNumber-user" ></span>
                              
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="address" class="form-label">Địa chỉ:</label>
                              <span class="span-info" id="info-address-user"></span>
                              
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="date-of-birth" class="form-label">Ngày sinh:</label>
                              <span class="span-info" id="info-dateOfBirth-user"></span>
                            </div>
                            

                          </div>
                          <div class="mt-2">
                            
                            <span data-bs-dismiss="modal" aria-label="Close" class="btn btn-outline-secondary">Đóng</span>
                          </div>
                        </div>
                        
                      </form>
                          
                    </div>
                </div>
            </div>
        </div>
    </div>
              
</div>
