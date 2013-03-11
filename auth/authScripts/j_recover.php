<script type='text/javascript' src='authJS/recover.js'></script>
<script type='text/javascript'>

	$(document).ready(function() {
		try {
				document.getElementById('email').focus();
			}
		catch(err){}
		$('.password').keyup(function(event) {
			passwordChanged();
		}).keydown(function(event) {
		  if (event.which == 13) {
			event.preventDefault();
		  }  
		});
		
		
		$('.passwordConf').keyup(function(event) {
			passwordChanged();
		}).keydown(function(event) {
		  if (event.which == 13) {
			event.preventDefault();
		  }  
		});
		
		$(".imgtip").tooltip();
	});


</script>
