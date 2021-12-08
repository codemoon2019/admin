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
									<li class="breadcrumb-item active" aria-current="page">Users</li>
								</ol>
							</nav>
						</div>
					</div>
                    
                    
                    <div class="card radius-10">
						<div class="card-header border-bottom-0">
							<div class="d-flex align-items-center">
								<div>
									<h5 class="font-weight-bold mb-0">System Users</h5>
								</div>
								<div class="ml-auto">
									
									<button class="btn btn-success" id="view-admin-list">View admin list</button>

									<button class="btn btn-success" id="view-user-list" style="display:none;">View user list</button>

								</div>
							</div>
						</div>

						<div class="card-body" id="user-list">
								<div class="table-responsive">
								<table class="table table-bordered table mb-0" id="system-user">
										<thead>
											<th>ID</th>
											<th>Name</th>
											<th>User Type</th>
										</thead>				
								</table>
							</div>
						</div>

						<div class="card-body" id="admin-list" style="display:none;">
								<div class="row" style="margin-bottom:10px;">
									<div class="col-lg-12 text-right">
									<button class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">Add new admin</button>
									</div>
								</div>
								<div class="table-responsive">
								<table class="table table-bordered table mb-0" id="system-admin" style="width:100%;">
										<thead>
											<th>ID</th>
											<th>Name</th>
											<th>User Type</th>
										</thead>				
								</table>
							</div>
						</div>
					</div>

					<!-- Modal -->
					<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Register a new Admin User</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
													<div class="row">
														<div class="col-lg-12">
															<label>Firstname:</label>
															<input type="text" class="form-control validate-field" error-message="First name is required" id="txtFirstname">
															<span class="error-message text-center"></span>
														</div>
														<div class="col-lg-12">
															<label>Lastname:</label>
															<input type="text" class="form-control validate-field" error-message="Last name is required" id="txtLastname">
															<span class="error-message text-center"></span>
														</div>
													</div>
													<div class="row" style="margin-top:10px;">
														<div class="col-lg-12">
															<label>Email:</label>
															<input type="text" class="form-control validate-field" error-message="Email is required" id="txtEmail">
															<span class="error-message text-center"></span>
														</div>
														<div class="col-lg-12">
															<label>Phone number:</label>
															<input type="text" class="form-control validate-field" error-message="Phone number is required" id="txtPhone">
															<span class="error-message text-center"></span>
														</div>
													</div>
												</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary btn-register-admin">Register New Admin</button>
						</div>
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

        $('#system-user').DataTable({
            "processing": true,
			"serverSide": true,
			"width": '100%',
            "ajax":{
                     "url": "/system/system-user-list",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{ csrf_token() }}"}
                   },
            "columns": [
				{ "data": "id" },
				{ "data": "name" },
				{ "data": "user_type" },
            ]	 
		});


		$('#system-admin').DataTable({
            "processing": true,
			"serverSide": true,
			"width": '100%',
            "ajax":{
                     "url": "/system/system-user-list",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{ csrf_token() }}"}
                   },
            "columns": [
				{ "data": "id" },
				{ "data": "name" },
				{ "data": "user_type" },
            ]	 
		});
		
		$(document).on('click', '#view-admin-list', function(){
			$('#admin-list').show("fast");
			$('#user-list').hide("fast");
			$('#view-admin-list').hide('fast');
			$('#view-user-list').show('fast');
		})

		
		$(document).on('click', '#view-user-list', function(){
			$('#admin-list').hide("fast");
			$('#user-list').show("fast");
			$('#view-admin-list').show('fast');
			$('#view-user-list').hide('fast');
		})

		$(document).on('click', '.btn-register-admin', function(){
			
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
					url: '/system/register-admin',
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
					},
					error:function(){
						Swal.fire({
							icon: 'error',
							text: 'email or phone number was already used.',
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