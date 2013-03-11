<link href="/css/repeats.css" type="text/css" rel="stylesheet" />
<script type='text/javascript' src='/personalReminders/reminderJs/reminderPlan.js'></script>
<script type='text/javascript'>

$(document).ready(function(){
var $scrollingDiv = $(".scrollPanel");
		$(window).scroll(function(){
		    if (slidePanels)
		        {
		        if($(window).scrollTop() > 59)
		            {
                    $scrollingDiv
                        .stop()
                        .animate({"marginTop": ($(window).scrollTop() - 70)  + "px"}, "slow" );
                    }
                else
                    {
                    $scrollingDiv
                        .stop()
                        .animate({"marginTop": "5px"}, "slow" );
                    }
                }
		});
	});

</script>
