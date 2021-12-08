@include('incs.header')

@yield('section')
		<!--page-content-wrapper-->
        <div class="page-content-wrapper">
				<div class="page-content">
					<!--breadcrumb-->
					<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
						<div class="breadcrumb-title pr-3">{{ $retrieveData[0]->product_name }}</div>
						<div class="pl-3">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="javaScript:;"><i class='bx bx-home-alt'></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Update</li>
								</ol>
							</nav>
						</div>
					</div>
					<!--end breadcrumb-->
					<div class="card">
						<div class="card-header">Update Product Information</div>
						<div class="card-body">
                            <form action="/product/update-product" id="update-product" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product-name">Product Name:</label>
                                            <input class="form-control validate-field" value="{{ $retrieveData[0]->product_name }}" error-message="Product name is required" id="txtProductName" name="txtProductName" type="text" placeholder="Product Name">
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product-name">Product Status:</label>
                                            <select class="single-select validate-field" error-message="Product status is required" id="txtProductStatus" name="txtProductStatus">
                                                @if($retrieveData[0]->product_status == 1)
                                                    <option value="1"> Publish </option>
                                                @else
                                                    <option value="0"> Unpublish </option>
                                                @endif
                                                <option value="">SELECT</option>
                                                <option value="1">Publish</option>
                                                <option value="0">Unpublish</option>
                                            </select>
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                </div>
                                <input type="text" id="txtId" name="txtId" value="{{ $id }}" style="display:none;">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="product-name">Product Description:</label>
                                            <textarea class="form-control ckeditor" id="txtProductDescription" name="txtProductDescription" placeholder="Message" rows="10" cols="10">
                                            {!! $retrieveData[0]->product_description !!}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product-name">Product Original Price:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">	<span class="input-group-text">₱</span>
                                                </div>
                                                <input type="text" class="form-control  validate-field" value="{{ $retrieveData[0]->product_price }}" id="txtProductOriginalPrice" name="txtProductOriginalPrice" error-message="Product original price is required" aria-label="Amount (to the nearest dollar)">
                                                <div class="input-group-append">	<span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="product-name">Product Retail Price:</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">	<span class="input-group-text">₱</span>
                                                </div>
                                                <input type="text" class="form-control" id="txtProductRetailPrice" value="{{ $retrieveData[0]->product_retail_price }}" name="txtProductRetailPrice" aria-label="Amount (to the nearest dollar)">
                                                <div class="input-group-append">	<span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="product-name">Product Stock:</label>
                                                <input type="text" class="form-control validate-field" value="{{ $retrieveData[0]->stocks }}" id="txtProductStock" name="txtProductStock" error-message="Please specify the stock of this product" aria-label="Amount (to the nearest dollar)">
                                                <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="product-name">Choose to change Primary Product Image:</label>
                                            <input class="form-control" id="txtProductPrimaryImage" name="txtProductPrimaryImage" error-message="Product image is required" type="file" placeholder="Product Name">
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="product-name">Choose to change Lorikeet Image:</label>
                                            <input class="form-control" id="txtLorikeet" name="txtLorikeet" type="file" placeholder="Product Name">
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="product-name">Gift Points:</label>
                                            <input class="form-control" id="txtGiftPoints" value="{{ $retrieveData[0]->gift_points }}" name="txtGiftPoints" type="text" placeholder="Gift Points">
                                            <span class="error-message text-center"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    @foreach($retrieveData[0]->product_images as $productImages)
                                        <div class="col-lg-2 text-center" id="product-image-{{ $productImages->id }}">
                                            <image src="{{ $productImages->product_image_url }} " class="img-thumbnail" style="width:100%; height:200px;">
                                            <button type="button" class="btn btn-danger form-control btn-delete-product-image" id="{{ $productImages->id }}" style="margin-top:10px; margin-bottom:10px;">REMOVE THIS IMAGE</button>
                                        </div>
                                    @endforeach
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
                                            <button class="btn btn-success form-control btn-save-product">SAVE THE PRODUCT UPDATE</button>
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
<script>

    $(document).ready(function(){

        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });

        let ckEditor = CKEDITOR;
        var productDescription = ckEditor.instances['txtProductDescription'];

        $(document).on('click', '.btn-delete-product-image', function(){
            $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                url:'/product/delete-product-image',
                method:'POST',
                data:{
                    id:this.id
                },
                success:function(data){
                    Swal.fire({
                        icon: 'success',
                        text: 'Remove successfully!',
                    })
                }
            });

            $('#product-image-'+this.id).fadeOut("slow");

        });

        $('#update-product').submit(function(event){

        event.preventDefault();

        submit = true;
        var form = $(this);
        var formData = new FormData(this);
        formData.append('description', productDescription.getData());
        
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
                data: formData, // serializes the form's elements.\
                cache:false,
                contentType: false,
                processData: false,
                beforeSend:function(){

                    Swal.fire({
                        html: 'Please wait while updating this product ...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                          Swal.showLoading()
                        },
                    })

                },
                success:function(data)
                {

                    Swal.fire({
                        icon: 'success',
                        text: data.internalMessage,
                    })

                }
              });
        }else{
            return false;
        }
        })
            
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