@extends('layouts.admin')

@section('content')
    <div style="
        min-height: calc(100vh - 112px);
    " class="p-4">
        <div class="d-flex justify-content-center my-2 p-2 bg-dark text-white">
            <h4>Quản lý sản phẩm</h4>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th scope="col">ID</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr style="
                            line-height: 38px;
                    " class="text-center">
                        <th scope="row">{{ $product->id }}</th>
                        <td
                            style="
                                max-width: 600px; 
                                white-space: nowrap; 
                                overflow: hidden; 
                                text-overflow: ellipsis;
                        ">
                            {{ $product->name }}</td>
                        <td>
                            <span>{{ $product->category }}</span><br>
                        </td>
                        <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>

                        <td class="d-flex justify-content-center">
                            <a href="/admin/products/{{ $product->id }}/edit" class="btn btn-warning">Sửa</a>
                            <form method="POST" action="/admin/products/{{ $product->id }}/destroy">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="mx-2 btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>



        <div class="d-flex justify-content-end my-2">
            <a href="/admin/products/create" class="btn btn-primary">
                Thêm sản phẩm
            </a>
        </div>

    </div>
@endsection
