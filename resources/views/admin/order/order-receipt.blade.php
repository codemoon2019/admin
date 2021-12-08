


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
									<li class="breadcrumb-item active" aria-current="page">Invoice</li>
								</ol>
							</nav>
						</div>
					</div>
					<!--end breadcrumb-->
					<div class="card">
						<div class="card-body">
							<div id="invoice">
								<div class="toolbar hidden-print">
									<div class="text-right">
										<button type="button" class="btn btn-dark btn-print"><i class="fa fa-print"></i> Print</button>
									</div>
									<hr/>
								</div>
								<div class="invoice overflow-auto" id="invoice-body">
									<div style="min-width: 600px">
										<header>
											<div class="row">
												<div class="col">
													<a href="javaScript:;">
														<img src="{{ config('app.app_url') }}/images/logo.png" width="180" alt="" />
													</a>
												</div>
												<div class="col company-details">
													<h2 class="name">
												
												Pure Happilife PH

											</h2>
													<div>Bario San Roque, Tala Caloocan City, Metro Manila PH</div>
													<div>(+639) 23 447 6552</div>
													<div>info@purehappilife.ph</div>
												</div>
											</div>
										</header>
										<main>
											<div class="row contacts">
												<div class="col invoice-to">
                                                    @foreach($data as $dataq)
                                                    @endforeach
													<div class="text-gray-light">INVOICE TO:</div>
													<h2 class="to">{{ $dataq->customer_info->first_name }} {{ $dataq->customer_info->last_name }}</h2>
													<div class="address">{{ $dataq->customer_address->address }}</div>
													<div class="email">{{ $dataq->customer_info->email }}
													</div>
												</div>
												<div class="col invoice-details">
													<h1 class="invoice-id"># {{ $id }}</h1>
													<div class="date">Invoice date: {{ \Carbon\Carbon::parse($dataq->created_at)->format('d/m/Y h:i:s a') }}</div>
												</div>
											</div>
											<table>
												<thead>
													<tr>
														<th>#</th>
														<th class="text-left">Product Name</th>
														<th class="text-right">Product Price</th>
														<th class="text-right">Quantity</th>
														<th class="text-right">Total</th>
													</tr>
												</thead>
												<tbody>
                                                @foreach($data as $data)
													<tr>
														<td class="no">{{ $data->pid }}</td>
														<td class="text-left">
															<h3>{{ $data->product_info->product_name }}</td>
														<td class="unit">₱ {{ number_format($data->product_info->product_retail_price) }}</td>
														<td class="qty">{{ $data->quantity }}</td>
														<td class="total">₱ {{ number_format($data->total_price)  }}</td>
                                                    </tr>
                                                @endforeach
												</tbody>
												<tfoot>
													<tr>
														<td colspan="2"></td>
														<td colspan="2">SUBTOTAL</td>
														<td>₱ {{ number_format($total_price) }}</td>
													</tr>
													<tr>
														<td colspan="2"></td>
														<td colspan="2">TAX</td>
														<td>0</td>
													</tr>
													<tr>
														<td colspan="2"></td>
														<td colspan="2">GRAND TOTAL</td>
														<td>₱ {{ number_format($total_price) }}</td>
													</tr>
												</tfoot>
											</table>
											<div class="thanks">Thank you!</div>
										</main>
										<footer>Invoice was created on a computer and is valid without the signature and <br>seal.</footer>
										

									</div>
									<!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                                    <div></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--end page-content-wrapper-->


			@include('incs.footer')
<script>
    $('.btn-print').on('click', function(){

        var divContents = $("#invoice-body").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>DIV Contents</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
    })
</script>