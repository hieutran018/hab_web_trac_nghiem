{{-- Add Modal --}}
<div class="modal fade" id="infoAccountAdmin" tabindex="-1" aria-labelledby="infoAccountAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoAccountAdminModalLabel">Thông tin chi tiết tài khoản Quản trị viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                          <img  alt="user-avatar" class="d-block rounded" height="100" width="100" id="info-avatar">
                        </div>
                        <hr class="my-0">
                        <div class="card-body">
                          <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="first-name" class="form-label">Họ:</label>
                              <span class="span-info" id="info-fName"></span>
                              
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="last-name" class="form-label">Tên:</label>
                              <span class="span-info" id="info-lName"></span>
                              
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="email" class="form-label">E-mail:</label>
                              <span class="span-info" id="info-email"></span>
                              
                            </div>
                            <div class="mb-3 col-md-6">
                              <label class="form-label" for="phoneNumber">Số điện thoại:</label>
                              <span class="span-info" id="info-phoneNumber" ></span>
                              
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="address" class="form-label">Địa chỉ:</label>
                              <span class="span-info" id="info-address"></span>
                              
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="date-of-birth" class="form-label">Ngày sinh:</label>
                              <span class="span-info" id="info-dateOfBirth"></span>
                            </div>
                            <div class="mb-3 col-md-6">
                            <label class="form-label" for="country">Vị trí:</label>
                            <span class="span-info" id="info-position"></span>
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
