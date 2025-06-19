<!-- resources/views/components/admin/header.blade.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/admin/dashboard">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar"
            aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <!-- Thêm các mục menu nếu cần -->
                <li class="nav-item">
                    <a class="nav-link" href="/home">Xem Trang Web</a>
                </li>
                <!-- Dropdown cho tài khoản người dùng -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="adminUserDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name ?? 'Admin' }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminUserDropdown">
                        <li><a class="dropdown-item" href="/admin/settings">Cài Đặt</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <!-- Form đăng xuất -->
                            <a class="dropdown-item" href="/logout"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                Đăng Xuất
                            </a>
                            <form id="logout-form" action="/logout" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
