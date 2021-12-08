		<!--start overlay-->
		<div class="overlay toggle-btn-mobile"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<!--footer -->
		<div class="footer">
            <p class="mb-0">Pure Happilfe Admin @2020 | Developed By : <a href="https://www.facebook.com/codemoon2019" target="_blank">Code Moon</a>
		</div>
		<!-- end footer -->
	</div>
	<!-- end wrapper -->
	<!-- JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    @include('incs.footer_file')
</body>
</html>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
	$(document).ready(function(){
		getHeaderNotif();
	Pusher.logToConsole = true;

	var pusher = new Pusher('36c958f4bd0ed394e18b', {
		cluster: 'ap1'
	});

	var channel = pusher.subscribe('my-event');
		channel.bind('my-event', function(data) {
		getHeaderNotif();
		alertify.notify('New order arrive', 'success', 10, function(){  console.log('dismissed'); });
	});


	function getHeaderNotif(){
		$.ajax({
                            url: '/notification/notification-header-list',
                            type: "GET",
                            datatype: "html"
                        }).done(function(data){
                            $(".header-notifications-list").empty().html(data);
                        }).fail(function(jqXHR, ajaxOptions, thrownError){
                            // alert('No response from server');
                        });
                    }
	
})

</script>