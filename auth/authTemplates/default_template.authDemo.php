<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
	<meta name="keywords" content="Web design web applications SQL database design John R. Bayley" />
	<meta name="description" content="John R. Bayley" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta http-equiv="content-language" content="en" />
	<title>{pageTitle}</title>

	<link href="/auth.ico" type="image/x-icon" rel="shortcut icon" />
	<link type="text/css" href="/css/smoothbright/smoothbright.css" rel="stylesheet" />
	<link href="/css/defaultStyle.css" type="text/css" rel="stylesheet" />
	<link href="/auth/authCSS/authentication.css" type="text/css" rel="stylesheet" />
	<link href="/css/jquery.gritter.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/js/jquery.gritter.min.js"></script>
	<script type="text/javascript" src="/js/jquery.tools.min.js"></script>
	{java}


</head>

<body>
<div id="header">
	<div id="logo">{logo}</div>
	<div id="tagline">{pageTagline}</div>

</div>
<div id="menu">
		{menu}<div id="breadcrumb" class="ui-corner-all">{breadcrumb}</div>
</div>


<div id="wrapperBody"><!-- sets background to white and creates full length leftcol-->

	<div id="wrapperfooter"><!-- sets background to white and creates full length rightcol-->

		<div id="maincontent"><!-- begin main content area -->

			<div id="leftcolumn" class="ui-corner-all"><!-- begin leftcolumn -->
				{navigation}
			</div><!-- end leftcolumn -->

			<div id="rightcolumnAuth" class="ui-corner-all"><!-- begin rightcolumn -->
				{rightColumn}
			</div><!-- end righttcolumn -->

			<div id="centercolumn"><!-- begin centercolumn -->
				{main}
			</div><!-- end centercolumn -->

		</div><!-- end main content area -->

	</div><!-- end wrapperFooter -->
</div><!-- end wrapperBody -->
<div id="footer"><!-- begin footer -->
    <p>webBSA (C)2011 John R. Bayley www.jbayley.com</p>
</div><!-- end footer -->	

</body>
</html>