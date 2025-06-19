@extends('layouts.user')

@section('title', $product->name)
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ asset('css/products/products.css') }}">

@section('content')
    <main class="cd__main">
        <form method="POST" action="/cart/add">
            @csrf
            <div class="container my-5">
                <div class="row">
                    <div class="col-md-5">
                        <div class="main-img">
                            <img id="preview-main" class="img-fluid" src="{{ $product->image }}" alt="ProductS">
                            <div style="border-bottom: 2px solid #dc3545"></div>
                            <div style="border-top: 1px solid #dc3545" class="row my-3 previews">
                                @foreach ($product->colors as $color)
                                    <div style="width: 82px; height: 82px; border: 1px solid #dc3545; padding: 6px;"
                                        class="col-md-3 previews-item" data-image="{{ $color->imageUrl }}"
                                        data-id="{{ $color->id }}">
                                        <img style="object-fit: cover" class="w-100 h-100" src="{{ $color->imageUrl }}"
                                            alt="image/{{ $color->name }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="main-description px-2">
                            <div class="category text-bold">
                                Danh mục: {{ $product->category }}
                            </div>
                            <div class="product-title text-bold my-3">
                                {{ $product->name }}
                            </div>

                            <div class="row my-3 previews">
                                <div>
                                    <span class="fw-bold">Màu sắc</span>
                                </div>
                                <div class="d-flex align-items-center my-2" id="color-options">
                                    @foreach ($product->colors as $color)
                                        <button type="button" style="padding: 10px;"
                                            class="d-flex align-items-center mx-2 color-button"
                                            data-image="{{ $color->imageUrl }}" data-id="{{ $color->id }}">
                                            <div style="width: 30px; height: 30px;" class="mx-2">
                                                <img style="width: 100%; height: 100%; object-fit: cover;"
                                                    src="{{ $color->imageUrl }}" alt="image/{{ $color->name }}">
                                            </div>
                                            <span>{{ $color->name }}</span>
                                        </button>
                                    @endforeach
                                </div>
                                @error('validate.colorId')
                                    <div class="invalid-feedback d-block">
                                        Vui lòng chọn màu sản phẩm
                                    </div>
                                @enderror
                            </div>

                            <div class="row my-3 previews">
                                <div>
                                    <span class="fw-bold">Phân Loại</span>
                                </div>

                                <div class="my-2" id="type-options">
                                    @foreach ($categories as $type)
                                        <button type="button" style="padding: 10px;" class="mx-2 type-button"
                                            data-id="{{ $type->id }}">
                                            {{ $type->name }}
                                        </button>
                                    @endforeach
                                </div>

                                @error('validate.categoryId')
                                    <div class="invalid-feedback d-block">
                                        Vui lòng chọn phân loại sản phẩm
                                    </div>
                                @enderror
                            </div>

                            <div style="font-size: 18px" class="price-area d-flex">
                                Giá:
                                <p class="new-price text-bold mx-2">{{ number_format($product->price, 0, ',', '.') }} đ</p>
                            </div>

                            <div class="buttons d-flex my-2">
                                <div class="block">
                                    <a href="#" class="shadow btn custom-btn ">Danh sách yêu thích</a>
                                </div>
                                <div class="block">
                                    <button type="submit" class="shadow btn custom-btn" id="add-to-cart">Thêm vào giỏ
                                        hàng</button>
                                </div>

                                <div class="block quantity">
                                    <input type="number" class="form-control" id="cart_quantity" value="1"
                                        min="1" max="{{ $product->quantity }}" placeholder="Số lượng"
                                        name="amount">
                                </div>
                            </div>

                            <input type="hidden" id="selected_color_id" name="colorId">
                            <input type="hidden" id="selected_type_id" name="categoryId">
                        </div>

                        <div class="row questions bg-light p-3 my-2">
                            <div class="col-md-1 icon">
                                <i class="fa-brands fa-rocketchat questions-icon"></i>
                            </div>
                            <div class="col-md-11 text">
                                Bạn có thắc mắc về sản phẩm của chúng tôi tại RELEX? Vui lòng liên hệ với đại diện của chúng
                                tôi
                                qua trò chuyện trực tiếp hoặc email.
                            </div>
                        </div>

                        <div class="delivery my-4">
                            <p class="font-weight-bold mb-0">
                                <span>
                                    <i class="fa-solid fa-truck"></i>
                                </span>
                                <b>Giao hàng trong vòng 3 ngày kể từ ngày mua</b>
                            </p>
                            <p class="text-secondary">Đặt hàng ngay để nhận được sản phẩm này giao hàng</p>
                        </div>
                        <div class="delivery-options my-4">
                            <p class="font-weight-bold mb-0">
                                <span>
                                    <i class="fa-solid fa-filter"></i>
                                </span>
                                <b>Tùy chọn giao hàng</b>
                            </p>
                            <p class="text-secondary">Xem các tùy chọn giao hàng tại đây</p>
                        </div>
                    </div>
                </div>

                <div class="product-details my-4">
                    <p style="padding: 14px; background: rgba(0,0,0,.06); margin: 10px 0;"
                        class="details-title text-color">
                        Chi
                        tiết sản phẩm</p>
                    <div class="description">
                        @foreach (explode("\n", $product->description) as $paragraph)
                            <p>{{ e($paragraph) }}</p>
                        @endforeach
                    </div>
                </div>
            </div>

            <input type="text" hidden name="productId" value="{{ $product->id }}">
        </form>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"
        integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const colorItems = document.querySelectorAll('.color-button');
            const previews = document.querySelectorAll('.previews-item')
            const previewImage = document.getElementById('preview-main');
            const defaultImage = previewImage.src;
            const selectedColorIdInput = document.getElementById('selected_color_id');
            const selectedTypeIdInput = document.getElementById('selected_type_id');

            let activeImageSrc = defaultImage;

            previews.forEach((item) => {
                item.addEventListener('mouseover', function() {
                    const newImageSrc = this.dataset.image;
                    previewImage.src = newImageSrc;
                });

                item.addEventListener('mouseout', function() {
                    previewImage.src = activeImageSrc;
                });

            })

            colorItems.forEach(item => {
                item.addEventListener('mouseover', function() {
                    const newImageSrc = this.dataset.image;
                    previewImage.src = newImageSrc;
                });

                item.addEventListener('mouseout', function() {
                    previewImage.src = activeImageSrc;
                });

                item.addEventListener('click', function() {
                    const newImageSrc = this.dataset.image;
                    previewImage.src = newImageSrc;

                    activeImageSrc = newImageSrc;

                    colorItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');

                    selectedColorIdInput.value = this.dataset.id;
                });
            });

            const typeButtons = document.querySelectorAll('.type-button');

            typeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    typeButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    selectedTypeIdInput.value = this.dataset.id;
                });
            });
        });
    </script>

@endsection
