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
									<button type="button" class="btn btn-white radius-10">View More</button>
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
											<th>Customer</th>
											<th>Product id</th>
											<th>Price</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<div class="product-img bg-transparent border">
													<img src="assets/images/icons/shoes.png" width="35" alt="">
												</div>
											</td>
											<td>Nike Sports NK</td>
											<td>Mitchell Daniel</td>
											<td>#9668521</td>
											<td>$99.85</td>
											<td><a href="javaScript:;" class="btn btn-sm btn-success radius-30">Delivered</a>
											</td>
										</tr>
										<tr>
											<td>
												<div class="product-img bg-transparent border">
													<img src="assets/images/icons/smartphone.png" width="35" alt="">
												</div>
											</td>
											<td>Redmi Airdts</td>
											<td>Craig Clayton</td>
											<td>#8627523</td>
											<td>$59.35</td>
											<td><a href="javaScript:;" class="btn btn-sm btn-success radius-30">Delivered</a>
											</td>
										</tr>
										<tr>
											<td>
												<div class="product-img bg-transparent border">
													<img src="assets/images/icons/mouse.png" width="35" alt="">
												</div>
											</td>
											<td>Magic Mouse 2</td>
											<td>Julia Burke</td>
											<td>#6875954</td>
											<td>$42.68</td>
											<td><a href="javaScript:;" class="btn btn-sm btn-success radius-30">Delivered</a>
											</td>
										</tr>
										<tr>
											<td>
												<div class="product-img bg-transparent border">
													<img src="assets/images/icons/tshirt.png" width="35" alt="">
												</div>
											</td>
											<td>Coton-T-Shirt</td>
											<td>Clark Natela</td>
											<td>#4587892</td>
											<td>$32.78</td>
											<td><a href="javaScript:;" class="btn btn-sm btn-success radius-30">Delivered</a>
											</td>
										</tr>
										<tr>
											<td>
												<div class="product-img bg-transparent border">
													<img src="assets/images/icons/headphones.png" width="35" alt="">
												</div>
											</td>
											<td>Headphones 7</td>
											<td>Robin Mandela</td>
											<td>#5587426</td>
											<td>$29.52</td>
											<td><a href="javaScript:;" class="btn btn-sm btn-success radius-30">Delivered</a>
											</td>
										</tr>
									</tbody>
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
