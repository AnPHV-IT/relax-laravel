@extends('layouts.user')

@section('title', 'Danh Sách Sản Phẩm')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/products/products.css') }}">
@section('content')
    <div class="container mt-4">
        <h4 class="mb-4">Danh Sách Sản Phẩm</h4>

        <div class="seach mb-3">
            <input type="text" id="search" class="form-control" placeholder="Tìm kiếm sản phẩm...">
        </div>

        <div class="row" id="product-list">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">Giá: {{ number_format($product->price, 2) }} VNĐ</p>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.getElementById('search').addEventListener('input', function() {
            let searchTerm = this.value.toLowerCase();
            let products = document.querySelectorAll('#product-list .col-md-4');

            products.forEach(function(product) {
                let productName = product.querySelector('.card-title').textContent.toLowerCase();
                if (productName.includes(searchTerm)) {
                    product.style.display = '';
                } else {
                    product.style.display = 'none';
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

@endsection
