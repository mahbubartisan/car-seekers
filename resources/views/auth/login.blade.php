<!DOCTYPE html>
<html lang="en">
<head>
    <title>CarSeekers - Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('templates/authentication/images/icons/favicon.ico')}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('templates/authentication/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('templates/authentication/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('templates/authentication/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('templates/authentication/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('templates/authentication/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('templates/authentication/vendor/animsition/css/animsition.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('templates/authentication/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('templates/authentication/vendor/daterangepicker/daterangepicker.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('templates/authentication/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('templates/authentication/css/main.css')}}">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
            <form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('login') }}">
                @csrf

                <span class="text-center login100-form-title p-b-32">
						Account Login
					</span>

                @foreach ($errors->all() as $error)
                    <div class="text-center alert alert-danger text-danger form-control">{{ $error }}</div>
                @endforeach

                <div class="row">
						<span class="txt1 p-b-11">
						Email
					</span>
                    <div class="wrap-input100 validate-input m-b-36" data-validate = "Email is required">
                        <input class="input100{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email">
                        <span class="focus-input100"></span>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
                        @endif

                    </div>

                    <span class="txt1 p-b-11">
						Password
					</span>

                    <div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
							<span class="btn-show-pass">
                                <i class="fa fa-eye" onclick="myFunction()"></i>
                            </span>

                        <script>
                            function myFunction() {
                                var x = document.getElementById("password");
                                if (x.type === "password") {
                                    x.type = "text";
                                } else {
                                    x.type = "password";
                                }
                            }
                        </script>

                        <input class="input100" id="password" type="password" name="password">
                        <span class="focus-input100"></span>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
                        @endif

                    </div>

                    <div class="flex-sb-m w-full p-b-48">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="label-checkbox100" for="ckb1">
                                Remember me
                            </label>
                        </div>

                        <div>
                            <a href="password/reset" class="txt3">
                                Forgot Password?
                            </a>
                        </div>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit">
                            Login
                        </button>
                        <div class="ml-auto mt-3">
                            or,
                            <a href="{{ route('register') }}">
                                Register now!
                            </a>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="{{asset('templates/authentication/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('templates/authentication/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('templates/authentication/bootstrap/js/popper.js')}}"></script>
<script src="{{asset('templates/authentication/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('templates/authentication/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('templates/authentication/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('templates/authentication/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('templates/authentication/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('templates/authentication/js/main.js')}}"></script>

</body>
</html>
