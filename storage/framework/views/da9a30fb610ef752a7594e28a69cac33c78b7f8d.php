
<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e('Pure Happilife Admin'); ?></title>
    
    <link rel="icon" href="images/icon.png" type="image/png"/>
    <link href="css/pace.min.css" rel="stylesheet"/>
    <script src="js/pace.min.js"></script>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="<?php echo e(config('app.url')); ?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo e(config('app.url')); ?>css/icons.css" />
    <link rel="stylesheet" href="<?php echo e(config('app.url')); ?>css/app.css" />
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

</head>

  <body>
    <div class="wrapper">
	 <div class="section-authentication" style="margin-top:60px;">
	   <div class="container-fluid"> 
	    <div class="card mb-0">
	     <div class="card-body p-0">
		  <div class="row no-gutters">
			<div class="col-12 col-lg-5 col-xl-4 d-flex align-items-stretch">
			  <div class="card mb-0 shadow-none bg-transparent w-100 login-card rounded-0">
			     <div class="card-body p-md-5">
				  <img src="images/logo.png" width="180" alt=""/>
					 <h4 class="mt-5"><strong>Welcome Back</strong></h4>
                     <p>Log in to your account using email & password</p>
                     <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="form-group mt-4">
                        <label>Email Address</label>
                        <input type="text" class="form-control validate-field" error-message="Please input your email" id="txtEmail" name="email"  placeholder="Enter your email address"/> 
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error-message text-center"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group">
                        <label>Enter Password</label>
                        <input type="password" class="form-control validate-field" error-message="Please input your password" name="password" id="txtPassword" placeholder="Enter your password"/>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="error-message text-center"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-row">
                        <div class="form-group col">
                            <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                            <label class="custom-control-label" for="customSwitch1">Remember Me</label>
                            </div>
                        </div>  
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3 btn-login"><i class='bx bxs-lock mr-1'></i>Login</button>
                    </form>
				 </div>
			  </div>
			</div>
			<div class="col-12 col-lg-7 col-xl-8 d-flex align-items-stretch">
			  <div class="card mb-0 shadow-none bg-transparent w-100 rounded-0">
				  <div class="card-body p-md-5">
				    <div class="text-center"><img src="images/login-images/auth-img-7.png" class="img-fluid" alt=""/></div>
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
				 
			    </ul>
				 <p class="mb-0">Pure Happilife Admin @2020  | Developed By : <a href="https://www.facebook.com/codemoon2019" target="_blank">Code Moon</a>
				 </p>
				 <ul class="list-inline mb-0">
				</ul>
			   </div>
			 </div>
		   </div>
		 </div>
	  </div>

      
    </div>
  
  </body>
</html>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php /**PATH C:\Users\Home\Desktop\My Projects\purehappilifeadmin\resources\views/auth/login.blade.php ENDPATH**/ ?>