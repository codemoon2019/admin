@include('incs.header')

@yield('section')
	<!--page-content-wrapper-->
    <div class="page-content-wrapper">
				<div class="page-content">
					<!--breadcrumb-->
					<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
						<div class="breadcrumb-title pr-3">Order</div>
						<div class="pl-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="javaScript:;"><i class='bx bx-home-alt'></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">New</li>
								</ol>
							</nav>
						</div>
					</div>
	
                    @if(auth()->user()->user_type != 2)
                    <div class="card radius-10">
						<div class="card-header border-bottom-0">
							<div class="d-flex align-items-center">
								<div>
									<h5 class="font-weight-bold mb-0">New Order</h5>
								</div>
								<div class="ml-auto">
									<select class="form-control" id="txtFilterByUserType">
										<option value="All">ALL ORDERS</option>
										<option value="User">REGISTERED USER ORDERS</option>
										<option value="Guest">GUEST ORDERS</option>
									</select>
								</div>
							</div>
						</div>
						
						<div class="card-body" id="user-order-table">
							<div class="row">
								<div class="col-lg-12">
									<p>You can update multiple items product order status by selecting each user order select box.</p>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">
									<select class="form-control" id="txtUserProductStatus">
										<option value="">SELECT PRODUCT STATUS</option>
										<option value="1">PENDING</option>
										<option value="2">PREPARING</option>
										<option value="3">DELIVERING</option>
										<option value="4">DELIVERED</option>
										<option value="5">CANCELLED</option>
									</select>
								</div>
								<div class="col-lg-2">
									<button class="btn btn-success form-control" id="update-user-order">UPDATE</button>
								</div>
							</div>
							<div class="table-responsive"style="margin-top:50px;">
								<table class="table table-bordered table mb-0" id="user-order">
										<thead>
											<th>ID</th>
											<th>Order id</th>
											<th>Customer name</th>
											<th>Customer type</th>
											<th>Total item Orders</th>
											<th>Total Price</th>
											<th>Order date</th>
											<th>Payment Method	</th>
											<th>Payment Status</th>
											<th>Order Status</th>
										</thead>				
								</table>
							</div>
						</div>

						<div class="card-body" id="guest-order-table">
							<div class="row">
								<div class="col-lg-12">
									<p>You can update multiple items product order status by selecting each guest order select box.</p>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3">
									<select class="form-control" id="txtGuestProductStatus">
										<option value="">SELECT PRODUCT STATUS</option>
										<option value="1">PENDING</option>
										<option value="2">PREPARING</option>
										<option value="3">DELIVERING</option>
										<option value="4">DELIVERED</option>
										<option value="5">CANCELLED</option>
									</select>
								</div>
								<div class="col-lg-2">
									<button class="btn btn-success form-control" id="update-guest-order" data-tooltip="sample">UPDATE</button>
								</div>
							</div>
							<div class="table-responsive"style="margin-top:50px;">
								<table class="table table-bordered table mb-0" id="guest-order">
										<thead>
											<th>ID</th>	
											<th>Order id</th>
											<th>Customer name</th>
											<th>Customer type</th>
											<th>Total item Orders</th>
											<th>Total Price</th>
											<th>Order date</th>
											<th>Payment Method	</th>
											<th>Payment Status</th>
											<th>Order Status</th>
										</thead>				
								</table>
							</div>
						</div>
					@else

					<div class="card radius-10">
						<div class="card-header border-bottom-0">
							<div class="d-flex align-items-center">
								<div>
									<h5 class="font-weight-bold mb-0">New Order</h5>
								</div>
							</div>
						</div>
						
						<div class="card-body" id="user-order-table">
							<div class="row">
								<div class="col-lg-12">
									<p>You can update multiple items product order status by selecting each user order select box.</p>
								</div>
							</div>
							<div class="table-responsive"style="margin-top:50px;">
								<table class="table table-bordered table mb-0" id="user-order">
										<thead>
											<th>ID</th>
											<th>Order id</th>
											<th>Customer name</th>
											<th>Customer type</th>
											<th>Total item Orders</th>
											<th>Total Price</th>
											<th>Order date</th>
											<th>Payment Method	</th>
											<th>Payment Status</th>
											<th>Order Status</th>
										</thead>				
								</table>
							</div>
						</div>

					@endif
					</div>

					
				</div>
			</div>
			<!--end page-content-wrapper-->
		</div>
		<!--end page-wrapper-->

@include('incs.footer')
<link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />
<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
<script>
    $(document).ready(function () {

		$('#txtFilterByUserType').on('change', function(){

			if(this.value == 'User'){
				$('#user-order-table').show("fast");
				$('#guest-order-table').hide("slow");
			}
			if(this.value == 'Guest'){
				$('#guest-order-table').show("fast");
				$('#user-order-table').hide("slow");
			}
			if(this.value == 'All'){
				$('#guest-order-table').show("fast");
				$('#user-order-table').show("fast");
			}
			
		})

        var userOrder = $('#user-order').DataTable({
            "processing": true,
			"serverSide": true,
			"width": '100%',
            "ajax":{
                     "url": "/order/new-order-list-user",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{ csrf_token() }}"}
                   },
            "columns": [
				{ "data": "id" },
				{ "data": "order_id" },
				{ "data": "customer_name" },
				{ "data": "customer_type" },
				{ "data": "total_item_orders" },
				{ "data": "total_price" },
				{ "data": "created_at" },
				{ "data": "payment_method" },
				{ "data": "payment_status" },
				{ "data": "order_status" }
            ],
			'columnDefs': [
				{
					'targets': 0,
					'checkboxes': {
					'selectRow': true
					}
				}
			],	 
			'select': {
				'style': 'multi'
			},
			'order': [[6, 'desc']]
		});

		var guestOrder =  $('#guest-order').DataTable({
            "processing": true,
			"serverSide": true,
			"width": '100%',
            "ajax":{
                     "url": "/order/new-order-list-guest",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{ csrf_token() }}"}
                   },
            "columns": [
				{ "data": "id" },
				{ "data": "order_id" },
				{ "data": "customer_name" },
				{ "data": "customer_type" },
				{ "data": "total_item_orders" },
				{ "data": "total_price" },
				{ "data": "created_at" },
				{ "data": "payment_method" },
				{ "data": "payment_status" },
				{ "data": "order_status" }
            ],
			'columnDefs': [
				{
					'targets': 0,
					'checkboxes': {
					'selectRow': true
					}
				}
			],	 
			'select': {
				'style': 'multi'
			},
			'order': [[6, 'desc']]
				 
		});

		$('#update-user-order').on('click', function(){
			
			var rows_selected = userOrder.column(0).checkboxes.selected();
			var orderEmptyArray = [];
			
			$.each(rows_selected, function(index, rowId){
			
				orderEmptyArray.push(rowId)

			});

			if(orderEmptyArray.length == 0){

				Swal.fire({
                    icon: 'warning',
                    text: 'Please select a product order.',
                })

			}else{
				$.ajaxSetup({
					headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
            	});
				$.ajax({
					url: "/order/update-multiple-order-status",
					method: "POST",
					data:{
						orderArray: orderEmptyArray,
						status: $('#txtUserProductStatus').val()
					},
					beforeSend: function(){

						Swal.fire({
							html: 'Please wait while updating the selected product order ...',
							allowOutsideClick: false,
							showConfirmButton: false,
							willOpen: function willOpen() {
							Swal.showLoading();
							}
						});

					},
					success: function(){
						userOrder.ajax.reload();
						Swal.fire({
							icon: 'success',
							text: 'Product orders updated successfully!',
						})

					}
				})

			}

		})


		$('#update-guest-order').on('click', function(){
			
			var rows_selected = guestOrder.column(0).checkboxes.selected();
			var orderEmptyArray = [];
			
			$.each(rows_selected, function(index, rowId){
			
				orderEmptyArray.push(rowId)

			});

			if(orderEmptyArray.length == 0){

				Swal.fire({
                    icon: 'warning',
                    text: 'Please select a product order.',
                })

			}else{
				$.ajaxSetup({
					headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
            	});
				$.ajax({
					url: "/order/update-multiple-order-status",
					method: "POST",
					data:{
						orderArray: orderEmptyArray,
						status: $('#txtGuestProductStatus').val()
					},
					beforeSend: function(){

						Swal.fire({
							html: 'Please wait while updating the selected product order ...',
							allowOutsideClick: false,
							showConfirmButton: false,
							willOpen: function willOpen() {
							Swal.showLoading();
							}
						});

					},
					success: function(){
						guestOrder.ajax.reload();
						Swal.fire({
							icon: 'success',
							text: 'Product orders updated successfully!',
						})

					}
				})

			}

		})


    });
</script>