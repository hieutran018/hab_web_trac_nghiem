      <aside id="sidebar" class="sidebar">
         <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item"> <a class="nav-link " href="index.html"> <i class="bi bi-grid"></i> <span>Dashboard</span> </a></li>
            <li class="nav-item">
               <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#"> <i class="bi bi-menu-button-wide"></i><span>Tài khoản</span><i class="bi bi-chevron-down ms-auto"></i> </a>
               <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li> <a href="{{Route('page-account-admin')}}"> <i class="bi bi-circle"></i><span>Tài khoản quản trị viên</span> </a></li>
                  <li> <a href="{{Route('page-account-user')}}"> <i class="bi bi-circle"></i><span>Tài khoản người dùng</span> </a></li>

               </ul>
            </li>
         </ul>
      </aside>