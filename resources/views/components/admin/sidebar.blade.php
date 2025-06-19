<!-- resources/views/components/admin/sidebar.blade.php -->
<div class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}" href="/admin/dashboard">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <!-- Quản lý sản phẩm -->
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/products*') ? 'active' : '' }}" href="/admin/products">
                    <span data-feather="box"></span>
                    Sản Phẩm
                </a>
            </li>
            <!-- Quản lý ngành hàng -->
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/categories*') ? 'active' : '' }}" href="/admin/categories">
                    <span data-feather="list"></span>
                    Ngành Hàng
                </a>
            </li>
            <!-- Quản lý đơn hàng -->
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/orders*') ? 'active' : '' }}" href="/admin/orders">
                    <span data-feather="shopping-cart"></span>
                    Đơn Hàng
                </a>
            </li>
            <!-- Quản lý người dùng -->
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}" href="/admin/users">
                    <span data-feather="users"></span>
                    Người Dùng
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}" href="/admin/contacts">
                    <span data-feather="users"></span>
                    Quản Lý Liên Hệ
                </a>
            </li>
            <!-- Quản lý mã giảm giá -->
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/discounts*') ? 'active' : '' }}" href="/admin/discounts">
                    <span data-feather="percent"></span>
                    Mã Giảm Giá
                </a>
            </li>
            <!-- Cài đặt hệ thống -->
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/settings') ? 'active' : '' }}" href="/admin/settings">
                    <span data-feather="settings"></span>
                    Cài Đặt
                </a>
            </li>
        </ul>
    </div>
</div>
