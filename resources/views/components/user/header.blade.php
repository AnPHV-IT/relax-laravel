<header>
    <nav class="navbar navbar-expand-lg bg-white fixed-top">
      <div class="container-fluid">
        <!-- Navbar Brand -->
        <a class="navbar-brand" href="{{ route('home') }}">
          <img
           src="{{ asset('images/components/logo_relaxviet.png') }}"
            alt="RelaxViet"
            class="logo"
            width="100"
            height="50"
          />
        </a>

        <!-- Toggler Button -->
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarContent"
          aria-controls="navbarContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div
          class="collapse navbar-collapse text-start w-100 mt-3"
          id="navbarContent"
        >
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <form
                class="search-form d-flex"
                action="search.php"
                method="GET"
              >
                <input
                  class="form-control search-input"
                  type="search"
                  name="q"
                  placeholder="Tìm kiếm sản phẩm, thương hiệu và danh mục"
                  aria-label="Search"
                />
                <button class="btn search-btn" type="submit">
                  <i class="bi bi-search"></i>
                </button>
              </form>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home') }}">Trang Chủ</a>
            </li>

            <li>
              <a class="nav-link" href="{{ route('products.index') }}">Sản Phẩm</a>
            </li>
              
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('showroom') }}">Hệ thống cửa hàng</a>
          </li>
          
            <li class="nav-item">
              <a class="nav-link" href="{{ route('blog.index') }}">Tạp chí</a>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Hỗ trợ
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="/contact">Liên Hệ</a>
                </li>
              </ul>
            </li>
          </ul>

          <!-- Login Button (Desktop View) -->
          <ul class="navbar-nav ms-auto d-none d-lg-flex">
            <li class="nav-item">
              <a href="{{ route('cart.index') }}" class="nav-link">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                      <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                  </svg>
                  <span class="badge bg-danger">{{ count(session('cart', [])) }}</span>
              </a>
          </li>
            <li class="nav-item ms-3 me-5">
                <a class="nav-link" aria-label="Login" href="{{ route('login') }}">Đăng Nhập</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>