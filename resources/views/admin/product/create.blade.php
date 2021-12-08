@include('incs.header')

@yield('section')
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
									<li class="breadcrumb-item active" aria-current="page">Create new product</li>
								</ol>
							</nav>
						</div>
					</div>
					<!--end breadcrumb-->
					<div class="card">
						<div class="card-header">Create new products</div>
						<div class="card-body">
                            <form action="/product/send-create-product" id="create-product" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product-name">Product Name:</label>
                                            <input class="form-control validate-field" error-message="Product name is required" id="txtProductName" name="txtProductName" type="text" placeholder="Product Name">
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product-name">Product Status:</label>
                                            <select class="single-select validate-field" error-message="Product status is required" id="txtProductStatus" name="txtProductStatus">
                                                <option value="">SELECT</option>
                                                <option value="1">Publish</option>
                                                <option value="0">Unpublish</option>
                                            </select>
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="product-name">Product Description:</label>
                                            <textarea class="form-control ckeditor" id="txtProductDescription" name="txtProductDescription" placeholder="Message" rows="10" cols="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product-name">Product Selling Price:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">	<span class="input-group-text">₱</span>
                                                </div>
                                                <input type="text" class="form-control  validate-field" id="txtProductOriginalPrice" name="txtProductOriginalPrice" error-message="Product original price is required" aria-label="Amount (to the nearest dollar)">
                                                <div class="input-group-append">	<span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="product-name">Product Original Price:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">	<span class="input-group-text">₱</span>
                                                </div>
                                                <input type="text" class="form-control" id="txtProductRetailPrice" name="txtProductRetailPrice" aria-label="Amount (to the nearest dollar)">
                                                <div class="input-group-append">	<span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="product-name">Product Stock:</label>
                                                <input type="text" class="form-control validate-field" error-message="Please specify the stock of this product" id="txtProductStock" name="txtProductStock" error-message="Please specify the stock of this product" aria-label="Amount (to the nearest dollar)">
                                                <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="product-name">Primary Product Image:</label>
                                            <input class="form-control" id="txtProductPrimaryImage" name="txtProductPrimaryImage" error-message="Product image is required" type="file" placeholder="Product Name">
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="product-name">Lorikeet Image:</label>
                                            <input class="form-control" id="txtLorikeet" name="txtLorikeet" type="file" placeholder="Product Name">
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="product-name">Gift Points:</label>
                                            <input class="form-control" id="txtGiftPoints" name="txtGiftPoints" type="text" placeholder="Gift Points">
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product-name">Addtional Product Image:</label>
                                            <input class="form-control" type="file" id="txtProductAdditionalImage" name="txtProductAdditionalImage[]" multiple>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product-name">&nbsp</label>
                                            <button class="btn btn-success form-control btn-save-product">SAVE NEW PRODUCT</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
						</div>
					</div>
				</div>
			</div>
			<!--end page-content-wrapper-->
		</div>
		<!--end page-wrapper-->
@include('incs.footer')
<script src="{{ config('app.cdn') . '/js/product/create-product.js' . '?v=' . config('app.version') }}"></script>