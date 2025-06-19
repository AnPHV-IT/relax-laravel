<!-- resources/views/components/sederbar.blade.php -->
<section class="section_slider container mt-4">
    <div class="row-sliderbar row">
        <!-- Slider -->
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/users/banner-cam-trai-relaxviet (1).jpg') }}" class="d-block w-100" alt="Banner Relaxviet 1" />
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/users/banner-cam-trai-relaxviet (6).png') }}" class="d-block w-100" alt="Banner Relaxviet 2" />
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/users/banner-cam-trai-relaxviet (1).png') }}" class="d-block w-100" alt="Banner Relaxviet 3" />
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <!-- Side Banners -->
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="mb-2">
                <a href="#">
                    <img src="{{ asset('images/users/banner-cam-trai-relaxviet (5).png') }}" class="img-fluid" alt="Banner 1" />
                </a>
            </div>
            <div>
                <a href="#">
                    <img src="{{ asset('images/users/banner-cam-trai-relaxviet (7).png') }}" class="img-fluid" alt="Banner 2" />
                </a>
            </div>
        </div>
    </div>
</section>
