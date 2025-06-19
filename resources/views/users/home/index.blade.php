@extends('layouts.app')

@section('title', 'Trang Chủ')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{ asset('css/home/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/home/card.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
@section('content')
    <main>
        <section class="section-products">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="header">
                            <h3>Sản Phẩm Nổi Bật</h3>
                            <h2>Sản Phẩm Phổ Biến</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if ($products && $products->isNotEmpty())

                        @foreach ($products as $product)
                            <div style="background: rgba(0, 0, 0, 0.05);" class="col-md-6 col-lg-4 col-xl-3">
                                <div id="product" class="single-product">
                                    <div style="
                                    --data-image: url('{{ $product->image }}');
                                  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
                                
                                "
                                        class="part-1">
                                        @if ($product->created_at->isToday())
                                            <span class="new">new</span>
                                        @endif
                                        <ul>
                                            <li>
                                                <a href="/products/{{ $product->id }}"><i
                                                        class="fas fa-shopping-cart"></i></a>
                                            </li>
                                            <li>
                                                <button onclick="handleOpenModal()">
                                                    <a><i class="fas fa-expand"></i></a>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="part-2">
                                        <h3 class="product-title">{{ $product->name }}</h3>
                                        <h4 style="color: red; class="product-price">
                                            {{ number_format($product->price, 0, ',', '.') }} đ</h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>

        <!----------------------------------------------------------------- Giao Hàng -->
        <div class="container-ship">
            <div class="container mt-5">
                <div class="row">
                    <div class="container_shipper col-md-3">
                        <div class="feature-box">
                            <i class="fas fa-shipping-fast"></i>
                            <h5>Giao hàng hỏa tốc</h5>
                            <p>Từ 2-4h sau khi đặt hàng thành công</p>
                        </div>
                    </div>
                    <div class="container_shipper col-md-3">
                        <div class="feature-box">
                            <i class="fas fa-hand-holding-heart"></i>
                            <h5>Dịch vụ CSKH</h5>
                            <p>Tận tình, chương trình hậu mãi chu đáo</p>
                        </div>
                    </div>
                    <div class="container_shipper col-md-3">
                        <div class="feature-box">
                            <i class="fas fa-exchange-alt"></i>
                            <h5>Đổi trả hàng lỗi</h5>
                            <p>Miễn phí trong vòng 07 ngày do lỗi nhà sản xuất</p>
                        </div>
                    </div>
                    <div class="container_shipper col-md-3">
                        <div class="feature-box">
                            <i class="fas fa-certificate"></i>
                            <h5>Sản phẩm chính hãng</h5>
                            <p>Thương hiệu chính hãng, độc quyền</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($products && $products->isNotEmpty())
            <div id="modal">
                <div class="content">
                    <div style="--data-image: url({{ $product->image }})">
                        <button onclick="handleCloseModal()">
                            <i class="bi bi-x-square-fill"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endif


    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        function handleOpenModal() {
            document.getElementById('modal').style.display = "block";
        }

        function handleCloseModal() {
            document.getElementById('modal').style.display = "none";
        }
    </script>
@endsection
