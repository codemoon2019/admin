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
									<li class="breadcrumb-item active" aria-current="page">Order details</li>
								</ol>
							</nav>
						</div>
					</div>
                    
                    
                    <div class="card radius-10">
						<div class="card-header border-bottom-0">
							<div class="d-flex align-items-center">
								<div>
									<h5 class="font-weight-bold mb-0">Order Details #{{ $id }}</h5>
								</div>
								<div class="ml-auto">
									<h5 class="font-weight-bold mb-0">Total Price: ₱ {{ number_format($total_price) }}</h5>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table mb-0">
									<thead>
										<tr>
											<th>Photo</th>
											<th>Product Name</th>
											<th>Quantity</th>
											<th>Price</th>
											<th>Payment Method</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										@foreach($data as $data)
										<tr>
											<td>
												<div class="product-img bg-transparent border">
													<img src="{{ $data->product_info->product_image_url }}" width="35" alt="">
												</div>
											</td>
											<td>{{ $data->product_info->product_name }}</td>
											<td>{{ $data->quantity }}</td>
											<td>₱ {{ number_format($data->total_price) }}</td>
											<td>{{ $data->payment_method }}</td>
											<td>
												{{-- @if(auth()->user()->user_type == 1) 
												<select class="form-control order-select-status" id="{{ $data->id }}">
                                                    @if($data->status == 1)
														<option value="1">PENDING</option> 
													@endif
													@if($data->status == 2)
														<option value="2">PREPARING</option> 
													@endif
													@if($data->status == 3)
														<option value="3">DELIVERING</option> 
													@endif
													@if($data->status == 4)
														<option value="4">DELIVERED</option> 
													@endif
													@if($data->status == 5)
														<option value="5">CANCELLED</option>
													@endif
													<option value="1">PENDING</option> 
													<option value="2">PREPARING</option>
                                                    <option value="3">DELIVERING</option>
                                                    <option value="4">DELIVERED</option>
													<option value="5">CANCELLED</option>
												</select>
												@else--}}
													@if($data->status == 1)
														PENDING
													@endif
													@if($data->status == 2)
														PREPARING
													@endif
													@if($data->status == 3)
														DELIVERING
													@endif
													@if($data->status == 4)
														DELIVERED
													@endif
													@if($data->status == 5)
														CANCELLED
													@endif
												{{--@endif--}}
											</td>
										</tr>
                                        @endforeach
									</tbody>
								</table>
                                <hr>
							</div>

                            <div class="row">
                                    <div class="col-lg-6">
                                        Name: {{ $data->customer_info->first_name }} {{ $data->customer_info->last_name }}
                                    </div>
                                    <div class="col-lg-6">
                                        Order date: {{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y h:i:s a') }}
									</div>
							</div>
							<div class="row">
                                    <div class="col-lg-6">
										Delivery Driver: 
										@if($data->assigned_driver == 0 || $data->assigned_driver == -1)
											No driver Assigned
										@else
											{{ \App\Models\User::whereIn('id', [$data->assigned_driver])->get()->first()->first_name }} {{ \App\Models\User::whereIn('id', [$data->assigned_driver])->get()->first()->last_name }} ({{ \App\Models\User::whereIn('id', [$data->assigned_driver])->get()->first()->phone }})
										@endif
                                    </div>
                            </div>

                            <div class="row">
                                    <div class="col-lg-2">
                                        Address 1:
                                    </div>
									<div class="col-lg-10">
										{{ $data->customer_address->address }}
                                    </div>
                            </div>

							<div class="row">
                                    <div class="col-lg-2">
                                        Address 2:
                                    </div>
									<div class="col-lg-10">
										{{ $data->customer_address->address_complement }}
                                    </div>
                            </div>

							<div class="row">
                                    <div class="col-lg-2">
                                        City:
                                    </div>
									<div class="col-lg-10">
										{{ $data->customer_address->city }}
                                    </div>
                            </div>

							<div class="row">
                                    <div class="col-lg-2">
                                        State:
                                    </div>
									<div class="col-lg-10">
										{{ $data->customer_address->state }}
                                    </div>
                            </div>

							<div class="row">
                                    <div class="col-lg-2">
                                        Zip/Postal Code:
                                    </div>
									<div class="col-lg-10">
										{{ $data->customer_address->zip }}
                                    </div>
                            </div>

							<div class="row">
                                    <div class="col-lg-2">
                                        Country:
                                    </div>
									<div class="col-lg-10">
										{{ $data->customer_address->country }}
                                    </div>
                            </div>
							@if(auth()->user()->user_type == 1)
							<div class="row" style="margin-top:10px;">
                                    <div class="col-lg-6">
                                        <button class="btn btn-warning form-control" data-toggle="modal" data-target="#ExtraLargeModel">ASSIGN TO DRIVER</button>
                                    </div>
									<div class="col-lg-6">
										<select class="form-control order-select-status-all" id="{{ $data->id }}">
											<option value="">SELECT STATUS OF ALL ORDER ITEM</option>
											<option value="1">PENDING</option>
                                            <option value="2">PREPARING</option>
                                            <option value="3">DELIVERING</option>
                                            <option value="4">DELIVERED</option>
											<option value="5">CANCELLED</option>
                                        </select>
                                    </div>
							</div>
							@else
							<div class="row" style="margin-top:10px;">
                                    <div class="col-lg-6" style="margin-top:10px;">
                                        <button class="btn btn-warning form-control btn-cancelled" id="{{ $data->id }}">CANCELLED</button>
                                    </div>
									<div class="col-lg-6" style="margin-top:10px;">
										<button class="btn btn-success form-control btn-delivered" id="{{ $data->id }}">DELIVERED</button>
                                    </div>
							</div>

							@endif
							<div class="row" style="margin-top:10px;">
							@if(auth()->user()->user_type == 1)
							<div class="col-lg-12">
										@if($paymentImageLink != 'no-path')
											<a href="{{ config('app.pure_path_url').$paymentImageLink  }}" class="btn btn-success form-control" target="_blank">View Proof of payment</a>
										@endif
										<a href="/order/order-receipt/{{ $id }}" style="margin-top:10px;" class="btn btn-success form-control" target="_blank">View WayBill</a>
										</div>
							</div>
							@endif


									<!-- Modal -->
									<div class="modal" id="ExtraLargeModel" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="ExtraLargeModelLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="ExtraLargeModelLabel">Select a Driver to Deliver This Order</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">	<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<div class="row">
														<div class="col-lg-12">
															<label>Select a Driver:</label>
															<select class="form-control txt-select-driver">
																	<option value="">SELECT A DRIVER</option>
																@foreach($availableDriver as $driver)
																	<option value="{{ $driver->id }}">{{ $driver->first_name }} {{ $driver->last_name }}</option>
																@endforeach
															</select>
															<span class="error-message text-center"></span>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
												</div>
											</div>
										</div>
									</div>
									<!-- Modal -->							
							

						</div>
					</div>

				</div>
			</div>
			<!--end page-content-wrapper-->
		</div>
		<!--end page-wrapper-->

@include('incs.footer')

<script>
    $(document).on('change', '.order-select-status', function(){
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
		$.ajax({
			url:'/order/update-customer-order',
			method:'POST',
			data:{
				'status': this.value,
				'id': this.id
			},
			beforeSend:function(){
				Swal.fire({
					html: 'Updating order status ...',
					allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading()
                    },
                })
			},
			success:function(data){
				Swal.fire({
                    icon: 'success',
                    text: data.internalMessage,
                });
			}
		})
	});

	$(document).on('click', '.btn-cancelled', function(){
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
		$.ajax({
			url:'/order/update-all-customer-order',
			method:'POST',
			data:{
				'status': 5,
				'order_id': '{{ $id }}'
			},
			beforeSend:function(){
				Swal.fire({
					html: 'Updating order status ...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading()
                    },
                })
				location.reload()
			},
			success:function(data){
				Swal.fire({
                    icon: 'success',
                    text: data.internalMessage,
				});
				//location.reload()
			}
		})
	});

	$(document).on('click', '.btn-delivered', function(){
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
		$.ajax({
			url:'/order/update-all-customer-order',
			method:'POST',
			data:{
				'status': 4,
				'order_id': '{{ $id }}'
			},
			beforeSend:function(){
				Swal.fire({
					html: 'Updating order status ...',
					allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading()
                    },
                })
				location.reload()
			},
			success:function(data){
				Swal.fire({
                    icon: 'success',
                    text: data.internalMessage,
				});
				//location.reload()
			}
		})
	});

	$(document).on('change', '.txt-select-driver', function(){
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
		$.ajax({
			url:'/order/update-driver',
			method:'POST',
			data:{
				'id' : this.value,
				'order_id': '{{ $id }}'
			},
			beforeSend:function(){
				Swal.fire({
					html: 'Updating order delivery driver ...',
					allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading()
                    },
                })
			},
			success:function(data){
				location.reload();
				Swal.fire({
                        icon: 'success',
                        text: 'Assigned successfully!',
                })
			}
		});

	});
	
	$(document).on('change', '.order-select-status-all', function(){
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
		$.ajax({
			url:'/order/update-all-customer-order',
			method:'POST',
			data:{
				'status': this.value,
				'order_id': '{{ $id }}'
			},
			beforeSend:function(){
				Swal.fire({
					html: 'Updating order status ...',
					allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading()
                    },
                })
			},
			success:function(data){
				Swal.fire({
                    icon: 'success',
                    text: data.internalMessage,
				});
				location.reload()
			}
		})
	})
	
</script>