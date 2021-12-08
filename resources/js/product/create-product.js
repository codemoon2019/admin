
$(document).ready(function(){

    let ckEditor = CKEDITOR;
    var submit = false;
    var productDescription = ckEditor.instances['txtProductDescription'];
        
    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });

    $('#create-product').submit(function(event){
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
                    if(data.success == true){
                        
                        $('#create-product')[0].reset();
                        productDescription.setData('');
                        Swal.fire({
                            icon: 'success',
                            text: data.internalMessage,
                        })
                        window.location = '/product/inventory';
                        
                    }else{

                        Swal.fire({
                            icon: 'error',
                            text: data.internalMessage,
                        })

                    }
                  

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


});

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