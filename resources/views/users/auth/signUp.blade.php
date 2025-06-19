<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <title>Đăng Ký</title>
</head>

<body>

    <section class="vh-100"
        style="background: url('https://res.cloudinary.com/dbtqtvo9l/image/upload/v1727258313/form-banner-signup-bg_cuz6mt.jpg') no-repeat; background-size: cover;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card border-0" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img class="w-100 h-100" style="object-fit: cover;"
                                    src="https://res.cloudinary.com/dbtqtvo9l/image/upload/v1727258313/form-banner-signup_slzqp7.jpg"
                                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="POST" action="/v3/user">
                                        @csrf
                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Đăng Ký</h5>

                                        <div data-mdb-input-init class="form-outline mb-4">

                                            <label class="form-label" for="name">Ho Và Tên</label>
                                            <input value="{{ old('name') }}" name="name" type="text"
                                                id="name" class="form-control form-control-lg" />
                                            @error('validate.name')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">

                                            <label class="form-label" for="address">Địa Chỉ</label>
                                            <input value="{{ old('address') }}" name="address" type="text"
                                                id="address" class="form-control form-control-lg" />
                                            @error('validate.address')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="email">Email</label>
                                            <input value="{{ old('email') }}" name="email" type="email"
                                                id="email" class="form-control form-control-lg" />
                                            @error('validate.email')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            @error('existingEmail')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="password">Mật khẩu</label>
                                            <input value="{{ old('password') }}" name="password" type="password"
                                                id="password" class="form-control form-control-lg" />
                                            @error('validate.password')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-dark btn-lg btn-block" type="submit">Đăng ký</button>
                                        </div>

                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Đã có tài khoản? <a
                                                href="/sign-in" style="color: #393f81;">Đăng Nhập</a></p>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
