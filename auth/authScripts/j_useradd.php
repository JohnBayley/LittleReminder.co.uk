<script type='text/javascript' src='authJS/useradd.js'></script>
<script type='text/javascript'>

	$(document).ready(function() {
		$('.username').keyup(function(event) {
			usernameChanged();
		}).keydown(function(event) {
		  if (event.which == 13) {
			event.preventDefault();
		  }  
		});	
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
		$('.firstname').keyup(function(event) {
			firstnameChanged();
		}).keydown(function(event) {
		  if (event.which == 13) {
			event.preventDefault();
		  }  
		});
		$('.surname').keyup(function(event) {
			surnameChanged();
		}).keydown(function(event) {
		  if (event.which == 13) {
			event.preventDefault();
		  }  
		});		
		$('.realname').keyup(function(event) {
			realnameChanged();
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
		
		$(".imgtip").tooltip();
	});	
	

</script>
