<script type='text/javascript' src='authJS/useredit.js'></script>
<script type='text/javascript'>

	$(document).ready(function() {
		$('.password').keyup(function(event) {
			passwordChanged();
		}).keydown(function(event) {
		  if (event.which == 13) {
			event.preventDefault();
		  }
		});

		$('#email').keyup(function(event) {
		   emailChanged();
		   $('#email').removeClass('errorField');
		}).keydown(function(event) {
		  if (event.which == 13) {
			event.preventDefault();
		  }
		});

		$(".imgtip").tooltip({position: "top center"});
	});


</script>
