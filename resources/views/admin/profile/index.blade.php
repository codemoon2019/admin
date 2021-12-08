@include('incs.header')

@yield('section')
		<!--page-content-wrapper-->
        <div class="page-content-wrapper">
				<div class="page-content">
					<!--breadcrumb-->
					<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
						<div class="breadcrumb-title pr-3">My Profile</div>
						<div class="pl-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="javaScript:;"><i class='bx bx-user'></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Update your profile</li>
								</ol>
							</nav>
						</div>
					</div>
					<!--end breadcrumb-->
					<div class="card">
						<div class="card-header">Your profile information</div>
						<div class="card-body">
                            <div class="row text-center" style="margin-bottom:20px;">
                                    <div class="col-lg-3 offset-lg-4 profile-picture">
                                        <form action="/update-profile-picture" method="POST" enctype="multipart/form-data" id="update-profile-picture-form">
                                            <div class="text-center">
                                                <img src="{{ auth()->user()->profile_picture_url == '' ? 'http://ssl.gstatic.com/accounts/ui/avatar_2x.png' : config('app.url').auth()->user()->profile_picture_url }} " class="avatar img-circle img-thumbnail" alt="avatar" style="width:200px; height:200px;">
                                                <h6>Change your profile picture</h6>
                                                <input type="file" class="file-upload form-control" name="txtFileProfilePicture" id="txtFileProfilePicture">
                                            </div>
                                        </form>
                                    </div>
                            </div>
                            <form action="/update-user-profile" id="update-profile" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product-name">Firstname:</label>
                                            <input class="form-control validate-field" value="{{ auth()->user()->first_name }}" error-message="Last name is required" id="txtFirstname" name="txtFirstname" type="text" placeholder="Your first name">
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product-name">Lastname:</label>
                                            <input class="form-control validate-field" value="{{ auth()->user()->last_name }}" error-message="First name is required" id="txtLastname" name="txtLastname" type="text" placeholder="Your last name">
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                </div>   

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product-name">Email:</label>
                                            <input class="form-control validate-field" value="{{ auth()->user()->email }}" error-message="Email is required" id="txtEmail" name="txtEmail" type="text" placeholder="Your email">
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product-name">Phone number:</label>
                                            <input class="form-control validate-field" value="{{ auth()->user()->phone }}" error-message="Phone number is required" id="txtPhonenumber" name="txtPhonenumber" type="text" placeholder="Your phone number">
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                </div>   
                                <div><strong>Update your password</strong></div>

                                <div class="row" style="margin-top:10px;">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product-name">Current password:</label>
                                            <input class="form-control" id="txtPassword" name="txtCurrentPassword" type="password" placeholder="Current password">
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                </div>   
                                
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product-name">New password:</label>
                                            <input class="form-control" id="txtNewpassword" name="txtNewPassword" type="password" placeholder="New password">
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                </div>   
                                
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product-name">Retype new password:</label>
                                            <input class="form-control" id="txtRepassword" name="txtRetypePassword" type="password" placeholder="Re type your password">
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                </div>   
                             

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product-name">&nbsp</label>
                                            <button class="btn btn-success form-control btn-save-product">SAVE UPDATE(S)</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
						</div>
					</div>
				</div>
			</div>
			<!--end page-content-wrapper-->
		</div>
		<!--end page-wrapper-->
@include('incs.footer')
<script>

    $(document).ready(function() {        
        
        var submit = false;

        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".file-upload").on('change', function(){
            readURL(this);
        });


        $(document).on('change', '#txtFileProfilePicture', function(e){
            var formData = new FormData();
            var files = $('#txtFileProfilePicture')[0].files[0];
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('txtFileProfilePicture',files);

            $.ajax({
                url: '/upload-user-image',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success:function(data){
                    Swal.fire({
                        icon: 'success',
                        text: 'Profile picture updated successfully!',
                    })
                }
            });
        })

        $('#update-profile').on('submit', function(e){

            e.preventDefault();
            var form = $(this);
            var formData = new FormData(this);
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
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    beforeSend:function(){

                        Swal.fire({
                            html: 'Please wait while creating new product ...',
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
                            icon: data[0].success == true ? 'success' : 'warning',
                            text: data[0].message,
                        })

                    }
                });

                }else{

                return false;
                }
        });

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

    });

</script>