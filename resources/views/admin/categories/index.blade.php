@extends('layouts.admin')

@section('title', 'Danh sách Ngành Hàng')

@section('content')
<div class="container">
    <h2>Danh sách Ngành Hàng</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif




    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Ngành Hàng</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <div class="d-flex ">
                            <a href="/admin/categories/{{ $category->id }}/edit" class="btn btn-warning">Sửa</a>
                            <form class="mx-2" method="POST" action="/admin/categories/{{ $category->id }}/destroy">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger">Xoá</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach

            
        </tbody>
    </table>
    <a href="/admin/categories/create" class="btn btn-primary my-2">Tạo Danh Mục sản phẩm</a>
</div>
@endsection
