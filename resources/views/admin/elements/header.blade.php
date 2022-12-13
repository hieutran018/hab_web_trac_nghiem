      <header id="header" class="header fixed-top d-flex align-items-center">
         <div class="d-flex align-items-center justify-content-between"> 
            <a href="index.html" class="logo d-flex align-items-center"> <img src="{{URL('admin/assets/img/ic_logo_hab.png')}}" alt=""> 
               <span class="d-none d-lg-block">HAB</span> 
            </a> 
            <i class="bi bi-list toggle-sidebar-btn"></i>
         </div>
         
         <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
              
               <li class="nav-item dropdown pe-3">
                  <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown"> <img src="@if(Auth::user()->avatar != null) {{URL('storage/account/')}}/{{Auth::user()->id}}/avatar/{{Auth::user()->avatar}}" @else {{URL('admin/assets/img/no_avatar.png')}}" @endif alt="Profile" class="rounded-circle"> <span class="d-none d-md-block dropdown-toggle ps-2">{{Auth::user()->display_name}}</span> </a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                     <li class="dropdown-header">
                        <h6>{{Auth::user()->display_name}}</h6>
                        <span>@if(Auth::user()->isAdmin == 1 &&Auth::user()->isSubAdmin == 0) 
                           Quản trị viên 
                           @elseif(Auth::user()->isAdmin == 0 &&Auth::user()->isSubAdmin == 1)  Cộng tác viên @endif</span>
                     </li>
                     <li>
                        <hr class="dropdown-divider">
                     </li>
                     <li> <button id="btn-edit-account-current" class="dropdown-item d-flex align-items-center"> <i class="bi bi-person"></i> <span>Thông tin tài khoản</span> </button></li>
                     <li>
                        <hr class="dropdown-divider">
                     </li>
                     <li> <button class="dropdown-item d-flex align-items-center" id="btn-change-password-account-current"> <i class="bi bi-gear"></i> <span>Đổi mật khẩu</span> </button></li>
                     <li>
                        <hr class="dropdown-divider">
                     </li>
                     
                     <li>
                        <hr class="dropdown-divider">
                     </li>
                     <li> <a class="dropdown-item d-flex align-items-center" href="{{Route('logout-admin')}}"> <i class="bi bi-box-arrow-right"></i> <span>Sign Out</span> </a></li>
                  </ul>
               </li>
            </ul>
         </nav>
      </header>
      @include('admin.modal.edit_account_current')
      @include('admin.modal.change_password_account_current')