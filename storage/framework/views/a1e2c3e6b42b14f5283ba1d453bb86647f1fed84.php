<?php echo $__env->make('incs.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldContent('section'); ?>
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
											<h4 class="font-weight-bold mb-0">₱ <?php echo e(number_format($data[0]->totalSales)); ?></h4>
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
											<h4 class="font-weight-bold mb-0">₱ <?php echo e(number_format($data[0]->totalOverallSales)); ?></h4>
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
											<h4 class="font-weight-bold mb-0"><?php echo e($data[0]->productOrders); ?></h4>
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
											<h4 class="font-weight-bold mb-0"><?php echo e($data[0]->totalNumberOfUser); ?></h4>
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
								<?php if($productList != null): ?>
								<div class="ml-auto">
									<button type="button" class="btn btn-white radius-10">View More</button>
								</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive" style="overflow:hidden;">
								<?php if($productList != null): ?>
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
										<?php $__currentLoopData = $productList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td>
													<div class="product-img bg-transparent border">
														<img src="<?php echo e($product->product_image_url); ?>" width="35" height="35" alt="">
													</div>
												</td>
												<td><a href="/product/details/<?php echo e($product->id); ?>"><?php echo e($product->product_name); ?></a></td>
												<td><?php echo e($product->id); ?></td>
												<td>₱ <?php echo e(number_format($product->product_price)); ?></td>
												<td><?php echo e($product->stocks); ?></td>
												<td>
												<?php if($product->stocks == 0): ?>
													<span class="btn btn-sm btn-dark radius-30">No stocks available</span>
												<?php elseif($product->stocks <= 100): ?>
													<span class="btn btn-sm btn-danger radius-30">Very low</span>
												<?php elseif($product->stocks <= 500): ?>
													<span class="btn btn-sm btn-warning radius-30">Low</span>
												<?php else: ?>
													<span class="btn btn-sm btn-success radius-30">Safe</span>
												<?php endif; ?>
												</td>
												</td>
											</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</tbody>
								</table>
								<?php else: ?>
								<div class="row">
									<div class="col-lg-12 text-center">
										No products yet!
									</div>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>

					<div class="card radius-10">
						<div class="card-header border-bottom-0">
							<div class="d-flex align-items-center">
								<div>
									<h5 class="font-weight-bold mb-0">Recent Orders (Registered User)</h5>
								</div>
								<?php if($productOrder != null): ?>
								<div class="ml-auto">
									<a href="/order/new" type="button" class="btn btn-white radius-10">View More</a>
								</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive" style="overflow:hidden;">
							<?php if($productOrder != null): ?>
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
											<?php $__currentLoopData = $productOrder; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<tr>
													<td><a href="/order/order-details/<?php echo e($data->order_id); ?>"> #<?php echo e($data->order_id); ?></td>
													<td><?php echo e($data->customer_info->first_name); ?> <?php echo e($data->customer_info->last_name); ?></td>
													
													<?php if(!empty($data->product_info->product_name)): ?>
														<td><?php echo e($data->product_info->product_name); ?></td>
													<?php else: ?>
														<td>Undefined product</td>
													<?php endif; ?>
													
													<td><a href="/order/order-details/<?php echo e($data->order_id); ?>" class="btn btn-sm btn-success radius-30">view Details</a>
													</td>
												</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</tbody>
								</table>
							<?php else: ?>
								<div class="row">
									<div class="col-lg-12 text-center">
										No orders yet.
									</div>
								</div>
							<?php endif; ?>
							</div>
						</div>
                    </div>

					<div class="card radius-10">
						<div class="card-header border-bottom-0">
							<div class="d-flex align-items-center">
								<div>
									<h5 class="font-weight-bold mb-0">Recent Orders (Guest)</h5>
								</div>
								<?php if($productOrderGuest != null): ?>
								<div class="ml-auto">
									<a href="/order/new" type="button" class="btn btn-white radius-10">View More</a>
								</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive" style="overflow:hidden;">
							<?php if($productOrderGuest != null): ?>
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
											<?php $__currentLoopData = $productOrderGuest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<tr>
													<td><a href="/order/guest-order-details/<?php echo e($data->order_id); ?>"> #<?php echo e($data->order_id); ?></td>
													<td><?php echo e($data->guest_info->first_name); ?> <?php echo e($data->guest_info->last_name); ?></td>
													
													<?php if(!empty($data->product_info->product_name)): ?>
														<td><?php echo e($data->product_info->product_name); ?></td>
													<?php else: ?>
														<td>Undefined product</td>
													<?php endif; ?>
													
													<td><a href="/order/order-details/<?php echo e($data->order_id); ?>" class="btn btn-sm btn-success radius-30">view Details</a>
													</td>
												</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</tbody>
								</table>
							</div>
							<?php else: ?>
								<div class="row">
									<div class="col-lg-12 text-center">
										No orders yet.
									</div>
								</div>
							<?php endif; ?>
						</div>
                    </div>

				</div>
			</div>
			<!--end page-content-wrapper-->
<?php echo $__env->make('incs.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Home\Desktop\My Projects\purehappilifeadmin\resources\views/admin/index.blade.php ENDPATH**/ ?>