
<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ 'Pure Happilife Admin' }}</title>
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png"/>
    @include('incs.header_file')
</head>

  <body>
    <div class="wrapper">
	 <div class="section-authentication">
	   <div class="container-fluid">
	    <div class="card mb-0">
	     <div class="card-body p-0">
		  <div class="row no-gutters">
			<div class="col-12 col-lg-5 col-xl-4 d-flex align-items-stretch">
			  <div class="card mb-0 shadow-none bg-transparent w-100 login-card rounded-0">
			     <div class="card-body p-md-5">
				  <img src="assets/images/logo-img.png" width="180" alt=""/>
					 <h4 class="mt-5"><strong>Welcome Back</strong></h4>
					 <p>Log in to your account using email & password</p>
					 <div class="form-group mt-4">
					   <label>Email Address</label>
					   <input type="text" class="form-control" placeholder="Enter your email address"/> 
					 </div>
					 <div class="form-group">
					   <label>Enter Password</label>
					   <input type="password" class="form-control" placeholder="Enter your password"/>
					 </div>
					 <div class="form-row">
					   <div class="form-group col">
					     <div class="custom-control custom-switch">
						  <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
						  <label class="custom-control-label" for="customSwitch1">Remember Me</label>
						</div>
					   </div>
					   <div class="form-group col text-right">
					     <a href="authentication-forgot-password.html"><i class='bx bxs-key mr-2'></i>Forget Password?</a>
					   </div>
					 </div>
					 <button type="button" class="btn btn-primary btn-block mt-3"><i class='bx bxs-lock mr-1'></i>Login</button>
					 <div class="text-center mt-4">
					   <p class="mb-0">Dont' have an account yet? <a href="authentication-register.html">Create an account</a></p>
					 </div>
				 </div>
			  </div>
			</div>
			<div class="col-12 col-lg-7 col-xl-8 d-flex align-items-stretch">
			  <div class="card mb-0 shadow-none bg-transparent w-100 rounded-0">
				  <div class="card-body p-md-5">
				    <div class="text-center"><img src="assets/images/login-images/auth-img-7.png" class="img-fluid" alt=""/></div>
					<h5 class="card-title">Why do we use it?</h5>
					<p class="card-text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.</p>
				  </div>
			  </div>
			 </div>
		    </div>
		    </div>
			<div class="card-footer bg-transparent px-md-5">
			 <div class="d-flex align-items-center justify-content-between flex-wrap">
			  <ul class="list-inline mb-0">
				  <li class="list-inline-item">Login With</li>
				  <li class="list-inline-item"><a href="javascript:void();"><i class='bx bxl-facebook mr-1'></i>Facebook</a></li>
				  <li class="list-inline-item"><a href="javascript:void();"><i class='bx bxl-twitter mr-1'></i>Twitter</a></li>
				  <li class="list-inline-item"><a href="javascript:void();"><i class='bx bxl-google mr-1'></i>Google</a></li>
			   </ul>
				 <p class="mb-0">Synadmin @2020 | Developed By : <a href="https://themeforest.net/user/codervent" target="_blank">Codervent</a>
				 </p>
				 <ul class="list-inline mb-0">
					<li class="list-inline-item"><a href="javascript:void();">Privacy Policy</a></li>
					<li class="list-inline-item"><a href="javascript:void();">Contact</a></li>
				 </ul>
			   </div>
			 </div>
		   </div>
		 </div>
	  </div>

      
    </div>
  
  </body>
</html>
