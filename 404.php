 <!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta name="keywords" content="Web design web applications SQL database design John R. Bayley" />
	<meta name="description" content="John R. Bayley" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="en" />
	<title>Little Reminder : Not Found</title>

	<link href="/reminder.ico" type="image/x-icon" rel="shortcut icon" />
	<link type="text/css" href="/css/smoothbright/smoothbright.css" rel="stylesheet" />
	<link href="/auth/authCSS/authentication.css" type="text/css" rel="stylesheet" />
	<link href="/css/littlereminder.net.css" type="text/css" rel="stylesheet" />

	<link href="/css/jquery.gritter.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/js/jquery.gritter.min.js"></script>
	<script type="text/javascript" src="/js/jquery.tools.min.js"></script>
    <style type="text/css">
        li {
            margin: 10px 5px 5px 35px;
        }

        p.title{
            color: #ac0505;
            font-weight:bold;
            margin: 20px 5px 0px 0px;
        }
    </style>

</head>
<body>
<!--header -->
<div id="header">
	<div id="headerLogo">
		<a href="/" title="Littlereminder.net">Little Reminder</a>
	</div>
	<div id="breadCrumb"><a href='/'>Home</a> :: Not found</div>

	<div id="calendarText"></div>
	<div id="headerLinks">
		<p>
		<a href="/index.html"><img src="/images/fam/house.png" alt="Home" /> Home</a> |
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
                <div id="sidebar" class="ui-corner-all">
                <h3>Page Not Found</h3>
                </div>
            </div><!-- end righttcolumn -->

    	<div id="centercolumnText" class="ui-corner-all"><!-- begin centercolumn -->

			<br/>
			<h1>Error 404</h1>
			<hr />
			<h2>File not found[

				<?php print ($_ENV["SCRIPT_URL"]); ?>	
			]</h2>
			<br/>

			<h2> Error 404 - File not found</h2>

			<h3>The file 
			<?php print ($_ENV["SCRIPT_URL"]); ?>	
			could not be found on this server </h3>
			<br /><br />
			<h4>Try the <a href="/sitemap.html">Site Map</a> to help locate what you need </h4>
			<br /><br /><br /><br /><br />
			</div><!-- end centercolumn -->

		</div><!-- end main content area -->

	</div><!-- end wrapperFooter -->
</div><!-- end wrapperBody -->
<div id="footer"><!-- begin footer -->
    <p>LittleReminder.co.uk LittleReminder.net &copy;2007-2012 John R. Bayley www.jbayley.com</p>
</div><!-- end footer -->
</body>
</html>