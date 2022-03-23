<head>
   
    <title>@yield('title')</title>
   
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="DashboardKit is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords" content="DashboardKit, Dashboard Kit, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Free Bootstrap Admin Template">
    <meta name="author" content="DashboardKit ">


    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('admin/images/favicon.svg')}}" type="image/x-icon">

    <!-- Bootstrap CSS -->
   <!--  <link href="{{asset('admin/css/plugins/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --> 
    
    <!-- font css -->
    <link rel="stylesheet" href="{{asset('admin/fonts/feather.css')}}">
    <link rel="stylesheet" href="{{asset('admin/fonts/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('admin/fonts/material.css')}}">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}" id="main-style-link">

</head>

<!-- [ auth-signup ] start -->
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
<div class="auth-wrapper">
	<div class="auth-content">
		<div class="card">
			<div class="row align-items-center text-center">
				<div class="col-md-12">
					<div class="card-body">
						<img src="{{asset('admin/images/logo-dark.svg')}}" alt="" class="img-fluid mb-4">
						<h4 class="mb-3 f-w-400">Sign In</h4>
                <!-- Form Start -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
						

						<div class="input-group mb-3">
							<span class="input-group-text"><i data-feather="mail"></i></span>
							<input type="email" name="email" id="email" class="form-control" :value="old('email')" placeholder="Email address" required autofocus>
						</div>

						<div class="input-group mb-4">
							<span class="input-group-text"><i data-feather="lock"></i></span>
							<input type="password" class="form-control" id="password" name="password" placeholder="Password" required autocomplete="current-password">
						</div>

						<div class="form-group text-left mt-2">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
								<label class="form-check-label" for="flexCheckChecked">
                                {{ __('Remember me') }}
								</label>
							</div>
						</div>
                        <div class="flex items-center justify-end mt-4">
                          

                            <input class="btn btn-primary btn-block mb-4" type="submit" value="{{ __('Log in') }}">
                            @if (Route::has('password.request'))
                               <br> <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>
						
                        </form>
						<p class="mb-2">Already have an account? <a href="auth-signin.html" class="f-w-400">Signin</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ auth-signup ] end -->



<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->

 <!-- Required Js -->
 <script src="{{asset('admin/js/vendor-all.min.js')}}"></script>
<script src="{{asset('admin/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{asset('admin/js/plugins/feather.min.js')}}"></script>
<script src="{{asset('admin/js/pcoded.min.js')}}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script> -->
<!-- <script src="assets/js/plugins/clipboard.min.js"></script> -->
<!-- <script src="assets/js/uikit.min.js"></script> -->

<!-- Apex Chart -->
<script src="{{asset('admin/js/plugins/apexcharts.min.js')}}"></script>
<!-- <script>
$("body").append('<div class="fixed-button active"><a href="https://gumroad.com/dashboardkit" target="_blank" class="btn btn-md btn-success"><i class="material-icons-two-tone text-white">shopping_cart</i> Upgrade To Pro</a> </div>');
</script> -->

<!-- custom-chart js -->
<script src="{{asset('admin/js/pages/dashboard-sale.js')}}"></script>