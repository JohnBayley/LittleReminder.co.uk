<link href="/css/repeats.css" type="text/css" rel="stylesheet" />
<script type='text/javascript' src='/personalReminders/reminderJs/repeat.js'></script>
<script type='text/javascript'>


$(document).ready(function() {
	$(".rmEdit").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'autoScale'		:	true,
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	true,
		'onComplete'	:	function(){initFancyBoxEdit();}
	});
	$(".infoTool").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'autoScale'		:	true,
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	true
	});
	
	$(".toolLink").tooltip({position:"bottom center",effect:"fade",tipClass:"tooltipu"});
	$(".toolLinke").tooltip({position:"bottom center",effect:"fade",tipClass:"tooltipe",offset:[0,-70]});

	});



</script>
