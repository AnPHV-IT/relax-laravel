@extends('layouts.admin')

@section('content')
    <div style="
        min-height: calc(100vh - 112px);
    " class="p-4">
        <div class="d-flex justify-content-center my-2 p-2 bg-dark text-white">
            <h4>Quản lý Đơn hàng</h4>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th scope="col">ID</th>
                    <th scope="col">Tên Khách hàng</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usersWithOrders as $user)
                    @foreach ($user->orders as $order)
                        <tr style="
                    line-height: 38px;
            " class="text-center">
                            <th scope="row">{{ $user->id }}</th>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td
                                style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 1;">
                                {{ $order->product->name }}</td>
                            <td>{{ $order->amount }}</td>
                            <td>{{ number_format($order->amount * $order->product->price, 0, ',', '.') }} đ</td>
                            <td>

                                @if ($order->status === 'CONFIRMED' || $order->status === 'CANCELED')
                                    <span
                                        style="
                                        color: {{ $order->status === 'CONFIRMED' ? 'green' : 'red' }}
                                    ">{{ $order->status === 'CONFIRMED' ? 'Đã duyệt' : 'Đã Hủy' }}</span>
                                @else
                                    <div class="d-flex">
                                        <form method="POST" action="/admin/orders/{{ $order->id }}/confirm">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="mx-2 btn text-white" style="background: green">
                                                Duyệt đơn
                                            </button>
                                        </form>
                                        <form method="POST" action="/admin/orders/{{ $order->id }}/cancel">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn text-white" style="background: red">
                                                Hủy đơn
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
