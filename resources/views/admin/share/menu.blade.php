<div class="nav-container primary-menu">
    <div class="mobile-topbar-header">
        <div>
            <img src="/assets_admin/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Rukada</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <nav class="navbar navbar-expand-xl w-100">
        <ul class="navbar-nav justify-content-start flex-grow-1 gap-1">
            {{-- <li class="nav-item dropdown">
                <a href="javascript:;" class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                    data-bs-toggle="dropdown">
                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
                <ul class="dropdown-menu">
                    <li> <a class="dropdown-item" href="index.html"><i class="bx bx-right-arrow-alt"></i>Default</a>
                    </li>
                    <li> <a class="dropdown-item" href="index2.html"><i class="bx bx-right-arrow-alt"></i>Alternate</a>
                    </li>
                    <li> <a class="dropdown-item" href="index3.html"><i class="bx bx-right-arrow-alt"></i>Graphical</a>
                    </li>
                </ul>
            </li> --}}
            <li class="nav-item dropdown">
                <a href="/admin/khu-vuc/vue" class="nav-link dropdown-toggle dropdown-toggle-nocaret">
                    <div class="parent-icon"><i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div class="menu-title">Khu Vực</div>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="/admin/ban/vue" class="nav-link dropdown-toggle dropdown-toggle-nocaret">
                    <div class="parent-icon"><i class="fa-solid fa-dragon"></i>
                    </div>
                    <div class="menu-title">Bàn</div>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="/admin/danh-muc/vue" class="nav-link dropdown-toggle dropdown-toggle-nocaret">
                    <div class="parent-icon"><i class="fa-regular fa-rectangle-list"></i>
                    </div>
                    <div class="menu-title">Danh Mục</div>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="/admin/mon-an/vue" class="nav-link dropdown-toggle dropdown-toggle-nocaret">
                    <div class="parent-icon"><i class="fa-solid fa-bowl-food"></i>
                    </div>
                    <div class="menu-title">Món Ăn</div>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="/admin/loai-khach-hang" class="nav-link dropdown-toggle dropdown-toggle-nocaret">
                    <div class="parent-icon"><i class="fa-brands fa-intercom"></i>
                    </div>
                    <div class="menu-title">Loại Khách Hàng</div>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="/admin/khach-hang" class="nav-link dropdown-toggle dropdown-toggle-nocaret">
                    <div class="parent-icon"><i class="fa-solid fa-person-military-pointing"></i>
                    </div>
                    <div class="menu-title">Khách Hàng</div>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="/admin/nha-cung-cap/index" class="nav-link dropdown-toggle dropdown-toggle-nocaret">
                    <div class="parent-icon"><i class="fa-solid fa-truck-field-un"></i>
                    </div>
                    <div class="menu-title">Nhà Cung Cấp</div>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="/admin/ban-hang" class="nav-link dropdown-toggle dropdown-toggle-nocaret">
                    <div class="parent-icon"><i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <div class="menu-title">Bán Hàng</div>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="/admin/nhap-hang" class="nav-link dropdown-toggle dropdown-toggle-nocaret">
                    <div class="parent-icon"><i class="fa-solid fa-vault"></i>
                    </div>
                    <div class="menu-title">Nhập Hàng</div>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="/admin/tai-khoan/index" class="nav-link dropdown-toggle dropdown-toggle-nocaret">
                    <div class="parent-icon"><i class="fa-solid fa-user"></i></i>
                    </div>
                    <div class="menu-title">Tài Khoản</div>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                    data-bs-toggle="dropdown">
                    <div class="parent-icon"><i class="fa-solid fa-bars"></i>
                    </div>
                    <div class="menu-title">Menu</div>
                </a>
                <ul class="dropdown-menu">
                    <li> <a class="dropdown-item" href="/admin/bep"><i class="fa-solid fa-fire-burner"></i>Menu Bếp</a>
                    </li>
                    <li> <a class="dropdown-item" href="/admin/tiep-thuc"><i class="fa-solid fa-cart-flatbed-suitcase"></i></i>Menu Tiếp Thục</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                    data-bs-toggle="dropdown">
                    <div class="parent-icon"><i class="fa-solid fa-chart-simple"></i>
                    </div>
                    <div class="menu-title">Thống Kê</div>
                </a>
                <ul class="dropdown-menu">
                    <li> <a class="dropdown-item" href="/admin/thong-ke/ban-hang"><i class="fa-solid fa-fire-burner"></i>Thống Kê Bán Hàng</a>
                    </li>
                    <li> <a class="dropdown-item" href="/admin/thong-ke/mon-an"><i class="fa-solid fa-cart-flatbed-suitcase"></i>Thống Kê Món Ăn Bán</a>
                    </li>
                    <li> <a class="dropdown-item" href="/admin/thong-ke/chart-mon-an"><i class="fa-solid fa-diagram-project"></i>Chart Món Ăn Bán</a>
                    </li>
                    <li> <a class="dropdown-item" href="/admin/thong-ke/chart"><i class="fa-solid fa-cart-flatbed-suitcase"></i></i>Chart</a>
                        <li> <a class="dropdown-item" href="/admin/thong-ke/chart-js"><i class="fa-solid fa-cart-flatbed-suitcase"></i></i>Chart JS</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/admin/quyen">
                    <div class="parent-icon">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div class="menu-title">Phân Quyền</div>
                </a>
            </li>
        </ul>
    </nav>
</div>
