@include('incs.header')

@yield('section')
<div class="page-content-wrapper">
				<div class="page-content">
                    <div class="wrapper">
                        <div class="card shadow-none bg-transparent">
                            <img src="{{ config('app.url') }}assets/images/errors-images/coming-soon-2.png" class="img-fluid" alt="" />
                            <div class="card-body text-center">
                                <h1 class="display-4 mt-5">This page is Under the construction!</h1>
                                <p>We work to build it for you to provide an outstanding experience on our customer.</p>
                            </div>
                        </div>
                    </div>
                </div>
</div>
@include('incs.footer')