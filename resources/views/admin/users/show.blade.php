@extends('layouts.admin')

@section('title', 'Chi tiết người dùng')

@section('content')
    <h2>Thông tin chi tiết người dùng</h2>
    <table class="table">
        <tr>
            <th>ID</th>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>Tên</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <!-- Thêm các trường thông tin khác nếu cần -->
    </table>

    <a href="{{ route('users.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
@endsection
