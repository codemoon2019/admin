<?php echo $__env->make('incs.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldContent('section'); ?>

		<!--page-content-wrapper-->
        <div class="page-content-wrapper">
				<div class="page-content">
				
					<!--breadcrumb-->
					<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
						<div class="breadcrumb-title pr-3">Products</div>
						<div class="pl-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="javaScript:;"><i class='bx bx-home-alt'></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Inventory</li>
								</ol>
							</nav>
						</div>
					</div>
                    
                    
                    <div class="card radius-10">
						<div class="card-header border-bottom-0">
							<div class="d-flex align-items-center">
								<div>
									<h5 class="font-weight-bold mb-0">Product Inventory</h5>
								</div>
								<div class="ml-auto">
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered table mb-0" id="product-list">
										<thead>
											<th>ID</th>
											<th>Product Name</th>
											<th>Product Image</th>
											<th>Product Price</th>
											<th>Product Stock</th>
											<th>Product Status</th>
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
   $(document).ready(function () {
        $('#product-list').DataTable({
            "processing": true,
			"serverSide": true,
			"width": '100%',
            "ajax":{
                     "url": "/product/product-list",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "<?php echo e(csrf_token()); ?>"}
                   },
            "columns": [
				{ "data": "id" },
				{ "data": "product_name" },
				{ "data": "product_image" },
				{ "data": "product_price" },
				{ "data": "product_stock" },
				{ "data": "product_status" },
				{ "data": "status" },
				{ "data": "action" },
            ]	 
        });

		$(document).on('click', '.btn-edit', function(){
			window.location = "/product/retrieve-single-product-info/"+this.id;
		})

		$(document).on('click', '.btn-delete', function(){
			$.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
			$.ajax({
				url:'/product/delete-product',
				method:'POST',
				data:{
					id:this.id
				},
				success:function(data){
					location.reload();
				}
			});

		})

    });
</script><?php /**PATH C:\Users\Home\Desktop\My Projects\purehappilifeadmin\resources\views/admin/product/inventory.blade.php ENDPATH**/ ?>