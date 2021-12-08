@include('incs.header')

@yield('section')

<!--page-content-wrapper-->
<div class="page-content-wrapper">
				<div class="page-content">
					<!--breadcrumb-->
					<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
						<div class="breadcrumb-title pr-3">System Users</div>
						<div class="pl-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="javaScript:;"><i class='bx bx-home-alt'></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Drivers</li>
								</ol>
							</nav>
						</div>
					</div>
                    
                    
                    <div class="card radius-10">
						<div class="card-header border-bottom-0">
							<div class="d-flex align-items-center">
								<div>
									<h5 class="font-weight-bold mb-0">Delivery Driver</h5>
								</div>
								<div class="ml-auto">
									<button type="button" class="btn btn-white radius-10" data-toggle="modal" data-target="#ExtraLargeModel">Add Driver</button>

									<!-- Modal -->
									<div class="modal" id="ExtraLargeModel" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="ExtraLargeModelLabel" aria-hidden="true">
										<div class="modal-dialog modal-xl">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="ExtraLargeModelLabel">Register a Driver Account</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<div class="row">
														<div class="col-lg-6">
															<label>Firstname:</label>
															<input type="text" class="form-control validate-field" error-message="First name is required" id="txtFirstname">
															<span class="error-message text-center"></span>
														</div>
														<div class="col-lg-6">
															<label>Lastname:</label>
															<input type="text" class="form-control validate-field" error-message="Last name is required" id="txtLastname">
															<span class="error-message text-center"></span>
														</div>
													</div>
													<div class="row" style="margin-top:10px;">
														<div class="col-lg-6">
															<label>Email:</label>
															<input type="text" class="form-control validate-field" error-message="Email is required" id="txtEmail">
															<span class="error-message text-center"></span>
														</div>
														<div class="col-lg-6">
															<label>Phone number:</label>
															<input type="text" class="form-control validate-field" error-message="Phone number is required" id="txtPhone">
															<span class="error-message text-center"></span>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
													<button type="button" class="btn btn-primary btn-register-driver">Register</button>
												</div>
											</div>
										</div>
									</div>
									<!-- Modal -->

								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">

								<table class="table table-bordered table mb-0" id="driver-list">
										<thead>
											<th>ID</th>
											<th>Full Name</th>
											<th>Email</th>
											<th>Phone</th>
											<th>Action</th>
										</thead>				
								</table>

							</div>
						</div>
					</div>

					
				</div>
			</div>
			<!--end page-content-wrapper-->
		</div>
		<!--end page-wrapper-->

@include('incs.footer')
<script>

	$(document).ready(function () {

		var submit = false;

        $('#driver-list').DataTable({
            "processing": true,
			"serverSide": true,
			"width": '100%',
            "ajax":{
                     "url": "/system/driver-list",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{ csrf_token() }}"}
                   },
            "columns": [
				{ "data": "id" },
				{ "data": "name" },
				{ "data": "email" },
				{ "data": "phone" },
				{ "data": "action" },
            ]	 
		});
		
		$(document).on('click', '.btn-register-driver', function(){
			
			submit = true;

			var formData = new FormData();
			formData.append('firstname', $('#txtFirstname').val());
			formData.append('lastname', $('#txtLastname').val());
			formData.append('email', $('#txtEmail').val());
			formData.append('phone', $('#txtPhone').val());

			if(validateFields() == 0){
				$.ajaxSetup({
					headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
           		});
				$.ajax({
					url: '/system/register-driver',
					method: 'POST',
					data: formData,
					processData: false,
    				contentType: false,
					beforeSend:function(){
						Swal.fire({
							html: 'Please wait while creating new product ...',
							allowOutsideClick: false,
                    		showConfirmButton: false,
							willOpen: () => {
							Swal.showLoading()
							},
                    	});		
					},
					success:function(data){
						Swal.fire({
							icon: 'success',
							text: data.internalMessage,
                   	 	});
					}
				});
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
