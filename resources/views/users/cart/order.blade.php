@extends('layouts.user')

@section('title', 'Đơn hàng của bạn')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="{{ asset('css/cart/cart.css') }}">
@section('content')

    <form method="POST" action="/orders" class="h-100 h-custom" style="background-color: #d2c9ff;">
        @csrf
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col">
                                    <div class="p-5">
                                        <div class="d-flex justify-content-between align-items-center mb-5">
                                            <h1 class="fw-bold mb-0">Đã Đặt Hàng</h1>
                                            <h6 class="mb-0 text-muted">{{ $orders->count() }} sản phẩm</h6>
                                        </div>
                                        <hr class="my-4">

                                        @foreach ($orders as $order)
                                            <div class="row mb-4 d-flex justify-content-between align-items-center">
                                                <div class="col-md-2 col-lg-2 col-xl-2">
                                                    <img src="{{ $order->color->imageUrl }}" class="img-fluid rounded-3"
                                                        alt="Cotton T-shirt">
                                                </div>
                                                <div class="col-md-3 col-lg-3 col-xl-3">
                                                    <h6 class="text-muted"
                                                        style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 2; max-height: 3em;">
                                                        {{ $order->product->name }}
                                                    </h6>
                                                    <h6 class="mb-0">Loại: {{ $order->category->name }}</h6>
                                                    <h6 class="mb-0">Màu: {{ $order->color->name }}</h6>
                                                </div>
                                                <div class="col-md-2 col-lg-2 col-xl-2 d-flex">
                                                    <h6 class="mb-0 total-price">
                                                        Số lượng: {{ $order->amount }}
                                                    </h6>
                                                </div>
                                                <div class="col-md-2 col-lg-2 col-xl-2 d-flex">
                                                    <h6 class="mb-0 total-price">
                                                        Tổng Giá:
                                                        {{ number_format($order->amount * $order->product->price, 0, ',', '.') }}
                                                        đ
                                                    </h6>
                                                </div>
                                                <div class="col-md-2 col-lg-2 col-xl-2 d-flex">
                                                    <h6 style="color: {{ $order->status === 'WAITING' ? 'blue' : ($order->status === 'CONFIRMED' ? 'green' : 'red') }};"
                                                        class="mb-0 total-price">
                                                        {{ $order->status === 'WAITING' ? 'Đang Duyệt' : ($order->status === 'CONFIRMED' ? 'Đang Giao' : 'Đã Hủy') }}
                                                    </h6>
                                                </div>
                                            </div>
                                            <hr class="my-4">
                                        @endforeach

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
