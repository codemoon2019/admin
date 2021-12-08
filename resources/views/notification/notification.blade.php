    @include('incs.header')

    @yield('section')

    <!--page-content-wrapper-->
    <div class="page-content-wrapper">
				<div class="page-content">
					<div class="">
						<div class="">
							<div class="container py-2">
                                <h2 class="font-weight-light text-center text-muted py-3">Notification Center</h2>
                                
                                <div id="notif-list">
                                </div>

                                <!--<a href="#">
							
								<div class="row">
									<div class="col-auto text-center flex-column d-none d-sm-flex">
										<div class="row h-50">
											<div class="col border-right">&nbsp;</div>
											<div class="col">&nbsp;</div>
										</div>
										<h5 class="m-2">
                                            <span class="badge badge-pill bg-success">&nbsp;</span>
                                        </h5>
										<div class="row h-50">
											<div class="col border-right">&nbsp;</div>
											<div class="col">&nbsp;</div>
										</div>
									</div>
									<div class="col py-2">
										<div class="card border-success shadow">
											<div class="card-body">
												<div class="float-right text-success">Tue, Jan 10th 2019 8:30 AM</div>
												<h4 class="card-title text-success">Day 2 Sessions</h4>
												<p class="card-text">Sign-up for the lessons and speakers that coincide with your course syllabus. Meet and greet with instructors.</p>
											</div>
										</div>
									</div>
								</div>
								
                                </a>-->
                                
                             
							
								<!--/row-->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--end page-content-wrapper-->

            @include('incs.footer')
            <script>

                    getData(1);

                    $(window).on('hashchange', function() {
                        if (window.location.hash) {
                            var page = window.location.hash.replace('#', '');
                            if (page == Number.NaN || page <= 0) {
                                return false;
                            }else{
                                getData(page);
                            }
                        }
                    });

                    $(document).on('click', '.pagination a', function(event){
                        event.preventDefault(); 
                        $('li').removeClass('active');
                        $(this).parent('li').addClass('active');

                        var myurl = $(this).attr('href');
                        var page=$(this).attr('href').split('page=')[1];

                        getData(page);
                    });

                  function getData(page){
                        $.ajax({
                            url: '/notification/notification-list?page=' + page,
                            type: "GET",
                            datatype: "html"
                        }).done(function(data){
                            $("#notif-list").empty().html(data);
                        }).fail(function(jqXHR, ajaxOptions, thrownError){
                            // alert('No response from server');
                        });
                    }

            </script>