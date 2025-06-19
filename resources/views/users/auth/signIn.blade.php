<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <title>Đăng nhập</title>
</head>

<body>

    <section class="vh-100"
        style="background: url('https://res.cloudinary.com/dbtqtvo9l/image/upload/v1727258278/form-banner-signin-bg_mkaasv.jpg') no-repeat; background-size: cover;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card border-0" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img class="w-100 h-100" style="object-fit: cover;"
                                    src="https://res.cloudinary.com/dbtqtvo9l/image/upload/v1727258277/form-banner-signIn_uwyg8v.jpg"
                                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="POST" action="/login">
                                        @csrf
                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Đăng Nhập</h5>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input value="{{ old('email') }}" name="email" type="email"
                                                id="form2Example17" class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example17">Email</label>
                                            @error('validate.email')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input value="{{ old('password') }}" name="password" type="password"
                                                id="form2Example27" class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example27">Mật khẩu</label>
                                            @error('validate.password')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            @error('validate.invalid')
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-dark btn-lg btn-block" type="submit">Đăng Nhập</button>
                                        </div>

                                        <a class="small text-muted" href="#!">Quên mật khẩu?</a>
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Chưa có tài khoản? <a
                                                href="/sign-up" style="color: #393f81;">Đăng ký</a></p>
                                        <a href="#!" class="small text-muted">Điều khoản sử dụng.</a>
                                        <a href="#!" class="small text-muted">Chính sách bảo mật</a>
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
