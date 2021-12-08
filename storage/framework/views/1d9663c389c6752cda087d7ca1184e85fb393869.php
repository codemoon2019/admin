
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
	<!-- wrapper -->
	<div class="wrapper">
		<div class="section-authentication" style="margin-top:60px;">
			<div class="container-fluid">
				<div class="card mb-0">
					<div class="card-body p-0">
						<div class="row no-gutters">
							<div class="col-12 col-lg-5 col-xl-4 d-flex align-items-stretch">
								<div class="card mb-0 shadow-none bg-transparent w-100 login-card rounded-0">
									<div class="card-body p-md-5">
										<img src="images/logo.png" width="180" alt="" />
										<h4 class="mt-5"><strong>Setup your account!</strong></h4>
                                        <p>Register by entering the informations below</p>
                                        <form action="/api/register" id="register-form" method="POST">
										<div class="form-group mt-4">
											<label>Email Address</label>
											<input type="text" class="form-control validate-field" error-message="Email is required" name="email" placeholder="example@user.com" />
                                            <span class="error-message text-center"></span>
                                        </div>
                                        <div class="form-group mt-4">
											<label>Phone Number</label>
											<input type="text" class="form-control validate-field" error-message="Phone is required" name="phone" placeholder="09XXXXXXXXX" />
                                            <span class="error-message text-center"></span>
                                        </div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label>First Name</label>
												<input type="text" class="form-control validate-field" error-message="Firstname is required" name="first_name" placeholder="Jhon" />
                                                <span class="error-message text-center"></span>
                                            </div>
											<div class="form-group col-md-6">
												<label>Last Name</label>
												<input type="text" class="form-control validate-field" error-message="Lastname is required" name="last_name" placeholder="Deo" />
                                                <span class="error-message text-center"></span>
                                            </div>
										</div>
										<div class="form-group">
											<label>Password</label>
											<div class="input-group" id="show_hide_password">
												<input class="form-control border-right-0 validate-field" error-message="Password is required" name="password" type="password" placeholder="Type your password">
												<div class="input-group-append">	<a href="javaScript:;" class="input-group-text bg-transparent border-left-0"><i class='bx bx-hide'></i></a>
												</div>
                                            </div>
                                            <span class="error-message text-center"></span>
                                        </div>

                                        <div class="form-group">
                                            <label>Retype Password</label>
											<div class="input-group" id="show_hide_password">
												<input class="form-control border-right-0 validate-field" error-message="Retype your password is required" name="c_password" type="password" placeholder="Retype your password">
												<div class="input-group-append"><a href="javaScript:;" class="input-group-text bg-transparent border-left-0"><i class='bx bx-hide'></i></a>
												</div>
                                            </div>
                                            <span class="error-message text-center"></span>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary btn-block mt-4"><i class='bx bxs-lock mr-1'></i>Register</button>
                                        </form>
									</div>
								</div>
							</div>
							<div class="col-12 col-lg-7 col-xl-8 d-flex align-items-stretch">
								<div class="card mb-0 shadow-none bg-transparent w-100 rounded-0">
									<div class="card-body p-md-5">
									</div>
									<img src="images/login-images/auth-img-7.png" class="img-fluid" alt="" />
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer bg-transparent px-md-5">
						<div class="d-flex align-items-center justify-content-center flex-wrap">
                        <p class="mb-0">Pure Happilife Admin @2020  | Developed By : <a href="https://www.facebook.com/codemoon2019" target="_blank">Code Moon</a>
							</p>
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
	<!-- JavaScript -->

	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
</body>


<!-- Mirrored from codervent.com/synadmin/demo/authentication-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 20 Oct 2020 15:38:45 GMT -->
</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="<?php echo e(config('app.url')); ?>js/jquery.min.js"></script>

<script>

$(document).ready(function(){

    var submit = false;

    $('#register-form').submit(function(event){
        event.preventDefault();
        submit = true;
        var form = $(this);
        var formData = new FormData(this);
        formData.append('user_type', 1);
        var url = form.attr('action');
        if(validateFields() == 0){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: url,
                data: formData, // serializes the form's elements.\
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){

                    Swal.fire({
                        html: 'Please wait while registering your account ...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                          Swal.showLoading()
                        },
                    })

                },
                success:function(data)
                {


                    Swal.fire({
                        icon: 'success',
                        text: 'Registerd successfully!',
                    })
                    window.location = '/login';

                }
              });
        }else{
            return false;
        }
    })
    
    $(document).on('keyup change', '.validate-field', function(){
        if(submit != false){
            validateFields();
        }
    })


    function validateFields(){

        for(var i = 0, countError = 0, inputFieldsCount = $('.validate-field').length; i < inputFieldsCount; i++){
            
            var errorMessage = document.getElementsByClassName("validate-field")[i].getAttribute("error-message");
            if(document.getElementsByClassName("validate-field")[i].value == ""){
                countError += 1;
                document.getElementsByClassName("validate-field")[i].style.border = "1px solid red";
                document.getElementsByClassName("error-message")[i].textContent = errorMessage;
            }else{
                document.getElementsByClassName("validate-field")[i].style.border = "1px solid #e3e3e3";
                document.getElementsByClassName("error-message")[i].textContent = "";
            }
            
        }

        return countError;

    }

})

</script><?php /**PATH C:\Users\Home\Desktop\My Projects\purehappilifeadmin\resources\views/auth/register.blade.php ENDPATH**/ ?>