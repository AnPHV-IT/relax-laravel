@extends('layouts.admin')

@section('title', 'Danh sách Ngành Hàng')

@section('content')
<div class="container">
    <form method="POST" action="/admin/categories/create">
        @csrf
        <h2>Tạo Danh Mục Sản Phẩm</h2>

        <div class="form-group">
            <label class="fw-bold my-2" for="name">Tên Danh Mục</label>
            <input name="name" type="text" class="form-control" id="name" placeholder="Tên Danh Mục">
        </div>

        <button type="submit" class="btn btn-primary my-2">Lưu</button>
    </form>
</div>
@endsection
