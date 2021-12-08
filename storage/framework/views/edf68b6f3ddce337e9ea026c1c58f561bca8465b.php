<?php echo $__env->make('incs.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldContent('section'); ?>

<!--page-content-wrapper-->
<div class="page-content-wrapper">
				<div class="page-content">
					<!--breadcrumb-->
					<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
						<div class="breadcrumb-title pr-3">System</div>
						<div class="pl-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="javaScript:;"><i class='bx bx-home-alt'></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Website Blogs</li>
								</ol>
							</nav>
						</div>
					</div>
                    
                    
                    <div class="card radius-10">
						<div class="card-header border-bottom-0">
							<div class="d-flex align-items-center">
								<div>
									<h5 class="font-weight-bold mb-0">Website blogs</h5>
								</div>

								<div class="ml-auto">
									<button type="button" class="btn btn-white radius-10" data-toggle="modal" data-target="#ExtraLargeModel">View More</button>
								</div>

									<!-- Modal -->
									<div class="modal" id="ExtraLargeModel" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="ExtraLargeModelLabel" aria-hidden="true">
										<div class="modal-dialog modal-xl">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="ExtraLargeModelLabel">Create a new Blog</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form action="/system/create-website-blog" id="create-blog" method="POST" enctype="multipart/form-data">
													<div class="row">
														<div class="col-lg-12">
															<label>Subject:</label>
															<input type="text" class="form-control validate-field" error-message="First name is required" name="txtSubject" id="txtSubject">
															<span class="error-message text-center"></span>
														</div>
														<div class="col-lg-12">
															<label>Primary Image:</label>
															<input type="file" class="form-control validate-field" error-message="Last name is required" name="txtFile" id="txtFile">
															<span class="error-message text-center"></span>
														</div>
													</div>

													<div class="row">
														<div class="col-lg-12">
															<label>Subject:</label>
															<textarea class="form-control ckeditor" id="txtBlogDescription" name="txtBlogDescription" placeholder="Message" rows="10" cols="10"></textarea>
														</div>
													</div>
											
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
													<button type="submit" class="btn btn-primary btn-create-blog">Create</button>
												</div>
												</form>
											</div>
										</div>
									</div>
									<!-- Modal -->

							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered table mb-0" id="blog-list">
										<thead>
											<th>ID</th>
											<th>Subject</th>
											<th>Description</th>
											<th>Status</th>
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
<?php echo $__env->make('incs.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
$(document).ready(function(){

	let ckEditor = CKEDITOR;
	var blogDescription = ckEditor.instances['txtBlogDescription'];

	$('#create-blog').submit(function(event){
			event.preventDefault();
			submit = true;
			var form = $(this);
			var formData = new FormData(this);
			formData.append('txtDescription', blogDescription.getData());
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

                    $('#create-blog')[0].reset();
                    blogDescription.setData('');
                    Swal.fire({
                        icon: 'success',
                        text: data.internalMessage,
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
	
	$(document).ready(function () {
        $('#blog-list').DataTable({
            "processing": true,
			"serverSide": true,
			"width": '100%',
            "ajax":{
                     "url": "/system/website-blog-list",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "<?php echo e(csrf_token()); ?>"}
                   },
            "columns": [
				{ "data": "id" },
				{ "data": "subject" },
				{ "data": "description" },
				{ "data": "status" },
				{ "data": "action" },
            ]	 
        });
    });
	
	$(document).on('click', '.btn-update-blog', function(){
	
		$.ajaxSetup({
					headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
           		});
				$.ajax({
					url: '/system/update-website-blog',
					method: 'POST',
					data: {
						status: $(this).attr("data-value"),
						id: $(this).attr("id")
					},
					beforeSend:function(){
						Swal.fire({
							html: 'Please wait while publishing the blog ...',
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
							text: 'Blog updated successfully!',
                   	 	});
					}
				});
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
</script><?php /**PATH C:\Users\Home\Desktop\My Projects\purehappilifeadmin\resources\views/admin/website-blogs.blade.php ENDPATH**/ ?>