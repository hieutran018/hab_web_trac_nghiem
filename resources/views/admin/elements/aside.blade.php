      <!-- Menu -->

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="" class="app-brand-link">
            <span class="app-brand-logo demo">
              <img src="{{URL('admin/assets/img/logo/ic_logo_hab.png')}}" alt="" width="40">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Sneat</span>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
          <!-- Dashboard -->
          <li class="menu-item active">
            <a href="index.html" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Trang chủ</div>
            </a>
          </li>

          <!-- Layouts -->
          <li class="menu-item">
            <a href="" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-layout"></i>
              <div data-i18n="Layouts">Tài khoản</div>
            </a>

            <ul class="menu-sub">
              <li class="menu-item">
                <a href="{{Route('page-account-admin')}}" class="menu-link">
                  <div data-i18n="Without menu">Tài khoản quản trị</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="layouts-without-navbar.html" class="menu-link">
                  <div data-i18n="Without navbar">Tài khoản người dùng</div>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </aside>
      <!-- / Menu -->