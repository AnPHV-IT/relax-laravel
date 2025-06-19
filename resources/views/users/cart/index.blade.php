@extends('layouts.user')

@section('title', 'Giỏ hàng của bạn')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="{{ asset('css/cart/cart.css') }}">
@section('content')
    @foreach ($carts as $cart)
        <form method="POST" action="/carts/{{ $cart->id }}/destroy" class="d-none">
            @csrf
            @method('DELETE')
            <button id="removeCart-{{ $cart->id }}" type="submit" class="d-none"></button>
        </form>
    @endforeach

    <form method="POST" action="/orders" class="h-100 h-custom" style="background-color: #d2c9ff;">
        @csrf
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-lg-8">
                                    <div class="p-5">
                                        <div class="d-flex justify-content-between align-items-center mb-5">
                                            <h1 class="fw-bold mb-0">Giỏ hàng</h1>
                                            <h6 class="mb-0 text-muted">{{ $carts->count() }} sản phẩm</h6>
                                        </div>
                                        <hr class="my-4">

                                        @foreach ($carts as $index => $cart)
                                            <div class="row mb-4 d-flex justify-content-between align-items-center">
                                                <div class="col-md-2 col-lg-2 col-xl-2">
                                                    <img src="{{ $cart->color->imageUrl }}" class="img-fluid rounded-3"
                                                        alt="Cotton T-shirt">
                                                </div>
                                                <div class="col-md-3 col-lg-3 col-xl-3">
                                                    <h6 style="
                                                            white-space: nowrap;          
                                                            overflow: hidden;            
                                                            text-overflow: ellipsis; 
                                                        "
                                                        class="text-muted">{{ $cart->product->name }}</h6>
                                                    <h6 class="mb-0">Loại: {{ $cart->category->name }}</h6>
                                                    <h6 class="mb-0">Màu: {{ $cart->color->name }}</h6>
                                                </div>
                                                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                    <button data-mdb-button-init data-mdb-ripple-init
                                                        class="btn btn-link px-2" onclick="updateQuantity(this, -1)">
                                                        <i class="fas fa-minus"></i>
                                                    </button>

                                                    <input id="form1" min="1"
                                                        name="carts[{{ $index }}][amount]"
                                                        value="{{ $cart->amount }}" type="number"
                                                        max="{{ $cart->product->quantity }}"
                                                        class="form-control form-control-sm"
                                                        data-price="{{ $cart->product->price }}"
                                                        data-product-id="{{ $cart->product->id }}"
                                                        data-color-id="{{ $cart->color->id }}"
                                                        data-category-id="{{ $cart->categoryId }}"
                                                        oninput="updateTotal(this)" />


                                                    <input type="hidden" name="carts[{{ $index }}][productId]"
                                                        value="{{ $cart->product->id }}">

                                                    <input type="hidden" name="carts[{{ $index }}][colorId]"
                                                        value="{{ $cart->color->id }}">

                                                    <input type="hidden" name="carts[{{ $index }}][categoryId]"
                                                        value="{{ $cart->category->id }}">



                                                    <button data-mdb-button-init data-mdb-ripple-init
                                                        class="btn btn-link px-2" onclick="updateQuantity(this, 1)">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                    <h6 class="mb-0 total-price"
                                                        data-total-price="{{ $cart->amount * $cart->product->price }}">
                                                        {{ number_format($cart->product->price, 0, ',', '.') }}
                                                        đ
                                                    </h6>
                                                </div>
                                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                    <a href="#!" class="text-muted"><i class="fas fa-times"></i></a>
                                                </div>

                                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                    <label for="removeCart-{{ $cart->id }}"
                                                        class="btn btn-danger">Xóa</label>
                                                </div>
                                            </div>

                                            <hr class="my-4">
                                        @endforeach


                                    </div>
                                </div>

                                <div class="col-lg-4 bg-body-tertiary">
                                    <div class="p-5">
                                        <h3 class="fw-bold mb-5 mt-2 pt-1">Tổng</h3>
                                        <hr class="my-4">
                                        @foreach ($carts as $cart)
                                            <div class="d-flex align-items-center justify-content-between mb-4">
                                                <div>
                                                    <h6
                                                        style="
                                                white-space: nowrap;          
                                                overflow: hidden;            
                                                text-overflow: ellipsis;
                                                width: 200px;
                                            ">
                                                        {{ $cart->product->name }}
                                                    </h6>
                                                    <p
                                                        style="
                                                    padding: 0;
                                                    margin: 0;
                                                ">
                                                        Loại: {{ $cart->category->name }}</p>
                                                    <p>Màu: {{ $cart->color->name }}</p>
                                                    <p
                                                        id="cart-{{ $cart->product->id }}-{{ $cart->color->id }}-{{ $cart->categoryId }}">
                                                        Số lượng: {{ $cart->amount }}</p>
                                                </div>

                                                <h5
                                                    id="price-{{ $cart->product->id }}-{{ $cart->color->id }}-{{ $cart->categoryId }}">
                                                    {{ number_format($cart->amount * $cart->product->price, 0, ',', '.') }}
                                                    đ</h5>
                                            </div>

                                            <hr class="my-4">
                                        @endforeach
                                        <div class="d-flex justify-content-between mb-5">
                                            <h5>Tổng giỏ hàng</h5>
                                            <h5 id="cart-total">
                                                {{ number_format($carts->sum(fn($cart) => $cart->amount * $cart->product->price), 0, ',', '.') }}
                                                đ</h5>
                                        </div>

                                        <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                            class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">Đặt
                                            hàng</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function updateQuantity(button, change) {
            const input = button.parentNode.querySelector('input[type=number]');
            let quantity = parseInt(input.value);
            const price = parseFloat(input.dataset.price);



            quantity += change;
            if (quantity < 1) quantity = 1;
            input.value = quantity;

            updateTotal(input);
        }

        function updateTotal(input) {
            const price = parseFloat(input.dataset.price);
            const quantity = parseInt(input.value);
            const totalPrice = price * quantity;

            const totalPriceElement = input.closest('.row').querySelector('.total-price');
            totalPriceElement.dataset.totalPrice = totalPrice;


            const productId = input.dataset.productId;
            const colorId = input.dataset.colorId;
            const categoryId = input.dataset.categoryId;

            document.getElementById(`cart-${productId}-${colorId}-${categoryId}`)
                .innerText = `Số lượng: ${quantity}`;

            document.getElementById(`price-${productId}-${colorId}-${categoryId}`)
                .innerText = `${numberWithCommas(totalPrice)}`;

            updateCartTotal();
        }

        function updateCartTotal() {
            const totalElements = document.querySelectorAll('.total-price');
            let grandTotal = 0;

            totalElements.forEach(element => {
                const price = parseFloat(element.dataset.totalPrice);
                grandTotal += price;
            });


            document.getElementById('cart-total').innerText = numberWithCommas(grandTotal.toFixed(0)) + ' đ';
        }

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    </script>
@endsection
