<!DOCTYPE html>
<html lang="en">
<head>
    <title>CarSeekers - Register</title>
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
    <style>
        .input100{
            height: 40px !important;
            font-size: 14px !important;
        }
    </style>
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="col-md-8 bg-white p-4">
            <form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <span class="text-center login100-form-title p-b-32">
						Account Register
					</span>
                <div class="col-md-12">
                    <div class="row">
                        @foreach ($errors->all() as $error)
                            <div class="col-md-6 ml-auto mr-auto">
                                <div class="text-center alert alert-danger text-danger form-control">{{ $error }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Name
                    </span></br>
                    <input class="input100 border{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name" placeholder="Name">
                    <span class="focus-input100"></span>
                </div>
                <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Email
                    </span></br>
                    <input class="input100 border" type="email" name="email" placeholder="Email">
                    <span class="focus-input100"></span>
                </div>
                <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
						Avatar
					</span></br>
                    <input class="{{ $errors->has('avatar') ? ' is-invalid' : '' }}" type="file" name="avatar" placeholder="Avatar">
                </div>
                <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
						Govt. Issued ID
					</span></br>
                    <input class="{{ $errors->has('govt_issued_id') ? ' is-invalid' : '' }}" type="file" name="govt_issued_id" placeholder="Govt. Issued ID">
                </div>
                <div class="col-md-3 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Contact
                    </span></br>
                    <input class="input100 border{{ $errors->has('contact') ? ' is-invalid' : '' }}" type="text" name="contact" placeholder="Contact">
                    <span class="focus-input100"></span>
                </div>
                <div class="col-md-9 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Address
                    </span></br>
                    <input class="input100 border{{ $errors->has('address') ? ' is-invalid' : '' }}" type="text" name="address" placeholder="Address">
                    <span class="focus-input100"></span>
                </div>
                <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Gender
                    </span></br>
                    <select name="gender" id="" class="input100 border">
                        <option value="Male" selected>Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Role
                    </span></br>
                    <select name="role" id="role" class="input100 border" required>
                        <option value="Customer" selected>Customer</option>
                        <option value="Renter">Renter</option>
                    </select>
                </div>
                <div class="col-md-12 mb-2" id="paypal_account">
                    <span class="txt1 p-b-11 text-info">
                        PayPal Account (Business account)
                    </span></br>
                    <input class="input100 border{{ $errors->has('paypal_account') ? ' is-invalid' : '' }}" type="text" name="paypal_account" placeholder="PayPal Account (Business account)">
                    <span class="focus-input100"></span>
                </div>
                <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Password
                    </span></br>
                    <input class="input100 border{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" placeholder="Password">
                    <span class="focus-input100"></span>
                </div>
                <div class="col-md-6 mb-2">
                    <span class="txt1 p-b-11 text-info">
                        Confirm Password
                    </span></br>
                    <input class="input100 border{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password_confirmation" placeholder="Confirm Password">
                    <span class="focus-input100"></span>
                </div>

                {{-- <div class="flex-sb-m w-full p-b-48">
                 </div>--}}

                <div class="container-login100-form-btn m-3">
                    <button class="login100-form-btn" type="submit">
                        Register
                    </button>
                    <div class="ml-auto mt-3">
                        or,
                        <a href="{{ route('login') }}">
                            Login now!
                        </a>
                    </div>
                </div>


                {{--<div class="row">
						<span class="txt1 p-b-11 text-info">
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

                    <span class="txt1 p-b-11 text-info">
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
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit">
                            Register
                        </button>
                        <div class="ml-auto mt-3">
                            or,
                            <a href="{{ route('login') }}">
                                Login now!
                            </a>
                        </div>
                    </div>
                </div>--}}

            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>

<script>
    $('#paypal_account').hide();
    $('#role').on('change', function () {
        if ($('#role').val() === 'Renter'){
            $('#paypal_account').show();
        }else{
            $('#paypal_account').hide();
        }
    })
</script>
{{--<!--===============================================================================================-->
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
<script src="{{asset('templates/authentication/js/main.js')}}"></script>--}}

</body>
</html>
