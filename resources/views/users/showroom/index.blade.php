@extends('layouts.user')

@section('title', 'Hệ Thống Cửa Hàng')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css"
/>
<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"

/>
<link rel="stylesheet" href="{{ asset('css/showroom/showroom.css') }}">
@section('content')
<main>
  <div class="container" style="margin-top: 50px">
    <div class="row text-center">
      <div class="col-md-3">
        <div class="info-box">
          <h3>12+</h3>
          <i class="fas fa-store"></i>
          <p>Cửa Hàng</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="info-box">
          <h3>63+</h3>
          <i class="fas fa-map-marker-alt"></i>
          <p>Tỉnh Thành</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="info-box">
          <h3>3+</h3>
          <i class="fas fa-building"></i>
          <p>Văn Phòng</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="info-box">
          <h3>200+</h3>
          <i class="fas fa-users"></i>
          <p>Nhân Viên</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="filter-box">
          <select>
            <option>Chọn tỉnh thành</option>
          </select>
          <select>
            <option>Chọn quận/huyện</option>
          </select>
          <select>
            <option>Chọn phường/xã</option>
          </select>
        </div>
        <div class="store-list">
          <div class="store-item">
            <h5>RelaxViet Sài Gòn</h5>
            <p>
              267/5 Đ. Lê Thị Riêng, P, Quận 12, Hồ Chí Minh 700000, Việt
              Nam
            </p>
            <p><i class="fas fa-phone"></i> 1900 6750</p>
          </div>
        </div>
      </div>
      <div class="col-md-8 mt-3">
        <div class="map-container">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3545.7570182361487!2d106.65300124092758!3d10.873221197844686!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175294d0699d409%3A0x5032c53cebc51eea!2sRelax%20Viet-%20Outdoors%20%26%20Camping!5e1!3m2!1svi!2sus!4v1726764461647!5m2!1svi!2sus"
            width="850"
            height="850"
            style="border: 0"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
          ></iframe>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</main>
   
@endsection
