@extends('layouts.admin')

@section('title', 'Danh sách Ngành Hàng')

@section('content')
<div class="container">
    <form method="POST" action="/admin/categories/{{  $category->id }}/edit">
        @csrf
        @method("PATCH")
        <h2>Sửa Danh Mục Sản Phẩm</h2>

        <div class="form-group">
            <label class="fw-bold my-2" for="name">Tên Danh Mục</label>
            <input value="{{ $category->id }}" name="id" type="hidden">
            <input value="{{ $category->name }}" name="name" class="form-control" id="name" placeholder="Tên Danh Mục">
        </div>

        <button type="submit" class="btn btn-primary my-2">Lưu</button>
    </form>
</div>
@endsection
