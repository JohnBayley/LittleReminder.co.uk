<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
	<meta name="keywords" content="Web design web applications SQL database design John R. Bayley" />
	<meta name="description" content="John R. Bayley" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="content-language" content="en" />
	<title>Little Reminder : Free reminders to your inbox</title>

	<link href="/reminder.ico" type="image/x-icon" rel="shortcut icon" />
	<link type="text/css" href="/css/smoothbright/smoothbright.css" rel="stylesheet" />
	<link href="/auth/authCSS/authentication.css" type="text/css" rel="stylesheet" />
	<link href="/css/littlereminder.net.css" type="text/css" rel="stylesheet" />

	<link href="/css/jquery.gritter.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/js/jquery.gritter.min.js"></script>
	<script type="text/javascript" src="/js/jquery.tools.min.js"></script>
	 <script src="//connect.facebook.net/en_US/all.js"></script>

	{java}

</head>
<body>
<!--header -->
<div id="header">
	<div id="headerLogo">
		<a href="/" title="Littlereminder.net">Little Reminder</a>
	</div>
	<div id="breadCrumb">{breadCrumb}</div>

	<div id="calendarText"></div>
	<div id="headerLinks">
		<p>
		<a href="/index.html"><img src="/images/fam/house.png" alt="Home" /> Home</a> |
		{username}
		<a href="/personalReminders/"><img src="/images/fam/calendar.png" alt="Cal" /> My Reminders</a> |
		<a href="/contact.html"><img src="/images/fam/email.png" alt="Contact" /> Contact</a> |
		<a href="/sitemap.html"><img src="/images/fam/map.png" alt="Home" /> Site Map</a>
		</p>
	</div>

</div>
<!-- navigation -->
<div  id="menu">

</div>

<div id="wrapperBody"><!-- sets background to white and creates full length leftcol-->

	<div id="wrapperfooter"><!-- sets background to white and creates full length rightcol-->

		<div id="maincontent"><!-- begin main content area -->
			<div id="rightcolumn" class="ui-corner-all"><!-- begin rightcolumn -->
				{rightColumn}
			</div><!-- end righttcolumn -->

			<div id="centercolumn"><!-- begin centercolumn -->
				{main}
			</div><!-- end centercolumn -->

		</div><!-- end main content area -->

	</div><!-- end wrapperFooter -->
</div><!-- end wrapperBody -->
<div id="footer"><!-- begin footer -->
    <p>littlereminder.co.uk (C)2017-2012 John R. Bayley www.jbayley.com</p>
</div><!-- end footer -->
<div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '178974708785370',
          status     : true,
          cookie     : true,
          xfbml      : true,
          oauth      : true
        });

        FB.Event.subscribe('auth.login', function(response) {
            document.getElementById("loginHolder").innerHTML = "<div id='fbMessage' class='ui-corner-all'><h1><br>Logging in with your facebook account</h1>\n<br \><br \><h3>Please wait while facebook confirms your details</h3></div>";
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