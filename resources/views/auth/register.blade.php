<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>

    <link rel="stylesheet" href="{{ asset('template/dist/assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('template/dist/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('template/dist/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('template/dist/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/dist/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/dist/assets/css/style.css') }}">
</head>

<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">

                        <div class="brand-logo text-center">
                            <img src="{{ asset('img/logo.png') }}" alt="logo">
                        </div>

                        <h4>New here?</h4>
                        <h6 class="font-weight-light">Signing up is easy.</h6>
                        {{-- Success Message --}}
                        @if (session('success'))
                            <div class="alert alert-success text-center">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Error Message --}}
                        @if (session('error'))
                            <div class="alert alert-danger text-center">
                                {{ session('error') }}
                            </div>
                        @endif

                        {{-- Validation Errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="pt-3" method="POST" action="{{ route('register.process') }}">
                            @csrf

                            <div class="form-group">
                                <input type="text" name="name"
                                    class="form-control form-control-lg"
                                    placeholder="Nama" required>
                            </div>

                            <div class="form-group">
                                <input type="text" name="username"
                                    class="form-control form-control-lg"
                                    placeholder="Username" required>
                            </div>

                            <div class="form-group">
                                <input type="email" name="email"
                                    class="form-control form-control-lg"
                                    placeholder="Email" required>
                            </div>

                            <div class="form-group">
                                <input type="password" name="password"
                                    class="form-control form-control-lg"
                                    placeholder="Password" required>
                            </div>

                            <div class="mt-3 d-grid gap-2">
                                <button type="submit"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                    REGISTER
                                </button>
                            </div>

                            <div class="text-center mt-4 font-weight-light">
                                Already have an account?
                                <a href="{{ route('login') }}" class="text-primary">Login</a>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('template/dist/assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('template/dist/assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('template/dist/assets/js/template.js') }}"></script>
<script src="{{ asset('template/dist/assets/js/settings.js') }}"></script>
<script src="{{ asset('template/dist/assets/js/todolist.js') }}"></script>
</body>
</html>
