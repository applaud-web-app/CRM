<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Government School Management" />
	<meta property="og:title" content="Government School Management" />
	<meta property="og:description" content="Government School Management" />
	<meta property="og:image" content="social-image.png" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- PAGE TITLE HERE -->
	<title>Government School Management</title>
	
	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="{{asset('assets/images/favicon.png')}}" />
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="vh-100">
<div class="page-wraper">

<!-- Content -->
<div class="browse-job login-style3">
    <!-- Coming Soon -->
    <div class="bg-img-fix overflow-hidden" style="background-image:url({{asset('assets/images/login-bg.jpg')}}); height: 100vh;">
        <div class="row gx-0">
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12 vh-100 bg-white ">
                <div id="mCSB_1" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" style="max-height: 653px;" tabindex="0">
                    <div id="mCSB_1_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
                        <div class="login-form style-2">
                            <div class="card-body">
                                <div class="logo-header text-center mb-3">
                                    <a href="{{route('dashboard')}}" class="logo"><img src="{{asset('assets/images/logo.jpg')}}" alt="" class="img-fluid" style="width: 180px;"></a>
                                </div>
                                <form class="" action="{{route('login')}}" method="POST" id="login-form">
                                    @csrf
                                    <div class="text-center mb-3">
                                        <h3 class="form-title mb-1">Login</h3>
                                        <p>Enter your username and your password. </p>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-12 mb-3">
                                            <div class="form-group ">
                                                <label for="username">User Name</label>
                                                <input type="text" name="username" id="username" class="form-control" placeholder="User Name" >
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12 mb-3">
                                            <div class="form-group ">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" id="password"  class="form-control" placeholder="Type Password" >
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-6 mb-3">
                                            <div class="form-check  ">
                                                <input type="checkbox" class="form-check-input" id="check1" value="true" name="remember">
                                                <label class="form-check-label" for="check1">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-6 mb-3">
                                            <div class="text-end">
                                                <a href="{{route('forgetPassword')}}" class="float-end">Forget Password ?</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block" id="login">Login</button> 
                                </form>
                            </div>
                                <div class="card-footer">
                                    <div class=" bottom-footer text-center">
                                    {{-- <p>Copyright © Designed &amp; Developed by <a href="https://applaudwebmedia.com/" target="_blank">Applaud Web Media</a> {{date('y')}}</p> --}}
                                </div>
                            </div>	   
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Blog Page Contant -->
</div>
<!-- Content END-->
</div>
    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('assets/vendor/global/global.min.js')}}"></script>
    <script src="{{asset('assets/js/custom.min.js')}}"></script>
    <script src="{{asset('assets/js/deznav-init.js')}}"></script>
	<script src="{{asset('assets/js/styleSwitcher.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $("#login-form").validate({
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true
                },
            },
            messages: {
                username: "Username is required",
                password: "Password is required",
            },
            errorElement: 'div',
            highlight: function(element, errorClass) {
                $(element).css({ border: '1px solid #f00' });
            },
            unhighlight: function(element, errorClass) {
                $(element).css({ border: '1px solid #c1c1c1' });
            },
            submitHandler: function(form,event) {
                event.preventDefault();
                $("#login").attr('disabled','disabled').text('Verifying...');
                document.login-form.submit();
            }
        });
    </script>
     @include('message')
</body>

</html>