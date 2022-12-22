      <aside id="sidebar" class="sidebar">
         <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item"> <a class="nav-link " href="{{Route('get-page-dashboard')}}"> <i class="bi bi-grid"></i> <span>Trag chủ</span> </a></li>
            <li class="nav-item">
               <a class="nav-link collapsed" data-bs-target="#tables-nav-account" data-bs-toggle="collapse" href="#"> <i class="bi bi-menu-button-wide"></i><span>Tài khoản</span><i class="bi bi-chevron-down ms-auto"></i> </a>
               <ul id="tables-nav-account" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li> <a href="{{Route('page-account-admin')}}"> <i class="bi bi-circle"></i><span>Tài khoản quản trị viên</span> </a></li>
                  <li> <a href="{{Route('page-account-user')}}"> <i class="bi bi-circle"></i><span>Tài khoản người dùng</span> </a></li>

               </ul>
            </li>
            <li class="nav-item">
               <a class="nav-link collapsed" data-bs-target="#tables-nav-news" data-bs-toggle="collapse" href="#" aria-expanded="false"> <i class="bi bi-layout-text-window-reverse"></i><span>Quản lý bài viết</span><i class="bi bi-chevron-down ms-auto"></i> </a>
               <ul id="tables-nav-news" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
                  <li> <a href="{{Route('get-page-news-category')}}"> <i class="bi bi-circle"></i><span>Thể loại bài viết</span> </a></li>
                  <li> <a href="{{Route('get-page-news')}}"> <i class="bi bi-circle"></i><span>Bài viết</span> </a></li>
               </ul>
            </li>
            <li class="nav-item">
               <a class="nav-link collapsed" data-bs-target="#tables-nav-game" data-bs-toggle="collapse" href="#" aria-expanded="false"> <i class="bi bi-layout-text-window-reverse"></i><span>Quản lý trò chơi</span><i class="bi bi-chevron-down ms-auto"></i> </a>
               <ul id="tables-nav-game" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
                  <li> <a href="{{Route('get-page-topic-question')}}"> <i class="bi bi-circle"></i><span>Thể loại câu hỏi</span> </a></li>
                  <li> <a href="{{Route('get-page-level-question')}}"> <i class="bi bi-circle"></i><span>Độ khó</span> </a></li>
                  <li> <a href="{{Route('get-page-question')}}"> <i class="bi bi-circle"></i><span>Câu hỏi</span> </a></li>
               </ul>
            </li>
            
         </ul>
      </aside>