@extends('layouts.user') <!-- Sử dụng layout của bạn nếu cần -->

@section('title', 'Liên Hệ')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

@section('content')
<div class="container">
    <h2 class="mt-4">Liên hệ</h2>
    <div class="contact-info">
        <h4>CÔNG TY TNHH THƯ GIÃN VIỆT</h4>
        <p>
            <strong>Địa chỉ</strong> : 30 Thới An 15, Phường Thới An, Quận 12, TP.HCM
        </p>
        <p><strong>Điện thoại</strong> : 0938 513 828 - 0919 011 300</p>
        <p>
            <strong>Giờ làm việc</strong> : Thứ 2 đến thứ 7 : 8:00 AM – 6:00 PM
        </p>
    </div>
    <form action="/contact" method="POST"> <!-- Thay đổi action nếu cần -->
        @csrf
        <div class="form-group">
            <label for="name">Họ tên (*)</label>
            <input type="text" id="name" name="name" class="form-control" required />
        </div>
        <div class="form-group">
            <label for="company">Đơn vị</label>
            <input type="text" id="company" name="company" class="form-control" />
        </div>
        <div class="form-group">
            <label for="address">Địa chỉ</label>
            <input type="text" id="address" name="address" class="form-control" />
        </div>
        <div class="form-group">
            <label for="phone">Điện thoại (*)</label>
            <input type="text" id="phone" name="phone" class="form-control" required />
        </div>
        <div class="form-group">
            <label for="email">Email (*)</label>
            <input type="email" id="email" name="email" class="form-control" required />
        </div>
        <div class="form-group">
            <label for="message">Lời nhắn (*)</label>
            <textarea id="message" name="message" class="form-control" rows="4" required></textarea>
        </div>
        <div class="btn-group mt-3">
            <button type="submit" class="btn btn-primary ">Gửi liên hệ</button>
            <button type="reset" class="btn btn-secondary ms-2">Soạn lại</button>
        </div>
        
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</div>
@endsection
