@include('incs.header')

@yield('section')
			<!--page-content-wrapper-->
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="row">
						<div class="col-12 col-lg-3">
							<div class="card radius-10">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<h6>Total Profit</h6>
											<h4 class="font-weight-bold mb-0">₱ {{ number_format($data[0]->totalSales) }}</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-3">
							<div class="card radius-10">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<h6>Overall Sales</h6>
											<h4 class="font-weight-bold mb-0">₱ {{ number_format($data[0]->totalOverallSales) }}</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-3">
							<div class="card radius-10">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<h6>Total Number of Orders</h6>
											<h4 class="font-weight-bold mb-0">{{ $data[0]->productOrders }}</h4>
										</div>
									</div>
								</div>
							</div>
                        </div>
                        <div class="col-12 col-lg-3">
							<div class="card radius-10">
								<div class="card-body">
									<div class="d-flex align-items-center">
										<div>
											<h6>Total Number of Customer Account</h6>
											<h4 class="font-weight-bold mb-0">{{ $data[0]->totalNumberOfUser }}</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end row-->
					<div class="card radius-10">
						<div class="card-header border-bottom-0">
							<div class="d-flex align-items-center">
								<div>
									<h5 class="font-weight-bold mb-0">Product Inventory</h5>
								</div>
								@if($productList != null)
								<div class="ml-auto">
									<button type="button" class="btn btn-white radius-10">View More</button>
								</div>
								@endif
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive" style="overflow:hidden;">
								@if($productList != null)
								<table class="table mb-0">
									<thead>
										<tr>
											<th>Photo</th>
											<th>Product Name</th>
											<th>Product id</th>
											<th>Price</th>
											<th>Stock</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										@foreach($productList as $product)
											<tr>
												<td>
													<div class="product-img bg-transparent border">
														<img src="{{ $product->product_image_url }}" width="35" height="35" alt="">
													</div>
												</td>
												<td><a href="/product/details/{{ $product->id }}">{{ $product->product_name }}</a></td>
												<td>{{ $product->id }}</td>
												<td>₱ {{ number_format($product->product_price) }}</td>
												<td>{{ $product->stocks }}</td>
												<td>
												@if($product->stocks == 0)
													<span class="btn btn-sm btn-dark radius-30">No stocks available</span>
												@elseif($product->stocks <= 100)
													<span class="btn btn-sm btn-danger radius-30">Very low</span>
												@elseif($product->stocks <= 500)
													<span class="btn btn-sm btn-warning radius-30">Low</span>
												@else($product->stocks <= 1000)
													<span class="btn btn-sm btn-success radius-30">Safe</span>
												@endif
												</td>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
								@else
								<div class="row">
									<div class="col-lg-12 text-center">
										No products yet!
									</div>
								</div>
								@endif
							</div>
						</div>
					</div>

					<div class="card radius-10">
						<div class="card-header border-bottom-0">
							<div class="d-flex align-items-center">
								<div>
									<h5 class="font-weight-bold mb-0">Recent Orders (Registered User)</h5>
								</div>
								@if($productOrder != null)
								<div class="ml-auto">
									<a href="/order/new" type="button" class="btn btn-white radius-10">View More</a>
								</div>
								@endif
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive" style="overflow:hidden;">
							@if($productOrder != null)
								<table class="table mb-0">
									<thead>
										<tr>
											<th>Order ID</th>
											<th>Customer Name</th>
											<th>Product Name</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
											@foreach($productOrder as $data)
												<tr>
													<td><a href="/order/order-details/{{ $data->order_id }}"> #{{ $data->order_id }}</td>
													<td>{{ $data->customer_info->first_name }} {{ $data->customer_info->last_name }}</td>
													
													@if(!empty($data->product_info->product_name))
														<td>{{ $data->product_info->product_name }}</td>
													@else
														<td>Undefined product</td>
													@endif
													
													<td><a href="/order/order-details/{{ $data->order_id }}" class="btn btn-sm btn-success radius-30">view Details</a>
													</td>
												</tr>
											@endforeach
									</tbody>
								</table>
							@else
								<div class="row">
									<div class="col-lg-12 text-center">
										No orders yet.
									</div>
								</div>
							@endif
							</div>
						</div>
                    </div>

					<div class="card radius-10">
						<div class="card-header border-bottom-0">
							<div class="d-flex align-items-center">
								<div>
									<h5 class="font-weight-bold mb-0">Recent Orders (Guest)</h5>
								</div>
								@if($productOrderGuest != null)
								<div class="ml-auto">
									<a href="/order/new" type="button" class="btn btn-white radius-10">View More</a>
								</div>
								@endif
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive" style="overflow:hidden;">
							@if($productOrderGuest != null)
								<table class="table mb-0">
									<thead>
										<tr>
											<th>Order ID</th>
											<th>Customer Name</th>
											<th>Product Name</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
											@foreach($productOrderGuest as $data)
												<tr>
													<td><a href="/order/guest-order-details/{{ $data->order_id }}"> #{{ $data->order_id }}</td>
													<td>{{ $data->guest_info->first_name }} {{ $data->guest_info->last_name }}</td>
													
													@if(!empty($data->product_info->product_name))
														<td>{{ $data->product_info->product_name }}</td>
													@else
														<td>Undefined product</td>
													@endif
													
													<td><a href="/order/order-details/{{ $data->order_id }}" class="btn btn-sm btn-success radius-30">view Details</a>
													</td>
												</tr>
											@endforeach
									</tbody>
								</table>
							</div>
							@else
								<div class="row">
									<div class="col-lg-12 text-center">
										No orders yet.
									</div>
								</div>
							@endif
						</div>
                    </div>

				</div>
			</div>
			<!--end page-content-wrapper-->
@include('incs.footer')