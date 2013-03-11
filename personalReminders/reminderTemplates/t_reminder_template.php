<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>

	<meta name="keywords" content="Web design web applications SQL database design John R. Bayley" >
	<meta name="description" content="John R. Bayley" >
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" >
	<Meta http-equiv="Author" Content="J.R.Bayley" >
	<title>Little Reminder : Free reminders to your inbox</title>

	<link href="/reminder.ico" type="image/x-icon" rel="shortcut icon" >
    <link href="/auth/authCSS/authentication.css" type="text/css" rel="stylesheet" />
	<link href="/css/littlereminder.net.css" type="text/css" rel="stylesheet" >
	<link type="text/css" href="/js/css/smoothness/jquery-ui-1.8.9.css" rel="stylesheet" >
	<link type="text/css" href="/css/smoothbright/smoothbright.css" rel="stylesheet" />
	<link href="/css/jquery.gritter.css" type="text/css" rel="stylesheet" >
	<link href="/js/fancybox/jquery.fancybox-1.3.1.css" type="text/css" rel="stylesheet" >
	<link href="/css/jquery.ui.timepicker.css" type="text/css" rel="stylesheet" >
    <!--[if IE]><!-->
    <link rel="stylesheet" type="text/css" media="screen" href="/css/ie.css" />
    <!--<![endif]-->
	<script type="text/javascript" src="/js/jquery-1.4.4.min.js"></script>
	<script type="text/javascript" src="/js/jquery-ui-1.8.9.min.js"></script>
	<script type="text/javascript" src="/js/jquery.ui.touch-punch.min.js"></script>
	<script type="text/javascript" src="/js/jquery.ui.timepicker.js"></script>
	<script type="text/javascript" src="/js/jquery.gritter.min.js"></script>
	<script type="text/javascript" src="/js/jquery.tools.min.js"></script>
	<script type="text/javascript" src="/js/fancybox/jquery.fancybox-1.3.1.js"></script>
	<script type="text/javascript" src="//connect.facebook.net/en_US/all.js"></script>
	{java}

</head>

<body>

<!--header -->
<div id="header">
	<div id="headerLogo">
		<a href="/" title="Littlereminder.co.uk">Little Reminder</a>
	</div>
	<div id="reminderLinks">
		<a class="toolLink" href="/personalReminders/" title="Go to the monthly reminders view."><img src="/images/fam/calendar.png" alt="Home" /> Month View</a> |
		<a class="toolLink"  href="/personalReminders/yearview.php" title="Go to the yearly view of reminders."><img src="/images/fam/calendar_view_month.png" alt="year" /> Year View</a> |
		<a class="toolLink" href="/personalReminders/repeats.php" title="Go to the reminder manager to block edit reminders."><img src="/images/fam/calendar_add.png" alt="List" /> Manage</a> |
		<a class="toolLink" href="/personalReminders/reminderplan.php" title="View your reminders email plan."><img src="/images/fam/calendar_active.png" alt="Plan" /> Reminder Plan</a>	</div>
	<div id="breadCrumb">{breadCrumb}</div>
	<div id="calendarText"></div>
	<div id="headerLinks">
		<p>
		<a class="toolLink" href="/index.html" title="Return to the Little Reminder homepage."><img src="/images/fam/house.png" alt="Home" /> Home</a> |
		{username} |
		<a class="toolLink" href="/personalReminders/" title="Go to the monthly reminders view."><img src="/images/fam/calendar.png" alt="Cal" /> My Reminders</a> |
		<a class="toolLink" href="/contact.html" title="Contact us here at Little Reminders."><img src="/images/fam/email.png" alt="Contact" /> Contact</a> |
		<a class="toolLink" href="/sitemap.html" title="View the Little Reminder sitemap."><img src="/images/fam/map.png" alt="Home" /> Site Map</a>
		</p>
	</div>

</div>
<div id="wrapperBody"><!-- sets background to white and creates full length leftcol-->

	<div id="wrapperfooter"><!-- sets background to white and creates full length rightcol-->

		<div id="maincontent"><!-- begin main content area -->

			<div id="centercolumn"><!-- begin centercolumn -->
				{main}
			</div><!-- end centercolumn -->

		</div><!-- end main content area -->

	</div><!-- end wrapperFooter -->
</div><!-- end wrapperBody -->
<div id="footer"><!-- begin footer -->
	<p><a href="http://www.littlereminder.co.uk" title="Currently assigned as Little Reminder Development">www.littlereminder.co.uk</a>&nbsp;&nbsp;<a href="http://www.littlereminder.co.uk" title="Little Reminder Production Site">www.littlereminder.net</a> Little Reminder &copy;2007-2012 John R. Bayley <a href="http://www.jbayley.net" title="Jbayley group">www.jbayley.net</a></p>
</div><!-- end footer -->
<div id="fb-root"></div>
    <script type="text/javascript">
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '178974708785370',
          status     : true,
          cookie     : true,
          xfbml      : true,
          oauth      : true
        });

        FB.Event.subscribe('auth.login', function(response) {
          window.location.reload();
        });
      };

      (function(d){
         var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
         js = d.createElement('script'); js.id = id; js.async = true;
         js.src = "//connect.facebook.net/en_US/all.js";
         d.getElementsByTagName('head')[0].appendChild(js);
       }(document));
    </script>
</body>

</html>