<?php
function createPage($array,$template)	{
	/********************************************************************************************/
	/* createPage : create a page and output to browser 										*/
	/********************************************************************************************/
	/* array: 		an array of the tags that are to be replaced in the template 				*/
	/* template: 	a html template file that is the basis for the page. Contains 				*/
	/*				tags in curly braces that are to be swapped with the values in the array 	*/
	/* John R. Bayley john@jbayley.net															*/
	/********************************************************************************************/

	$page = createSubPage($array,$template);
	print ($page);

	}
function createSubPage($array,$template) {
	/********************************************************************************************/
	/* createPage : create a page and return the contents to the calling function				*/
	/********************************************************************************************/
	/* array: 		an array of the tags that are to be replaced in the template 				*/
	/* template: 	a html template file that is the basis for the page. Contains 				*/
	/*				tags in curly braces that are to be swapped with the values in the array 	*/
	/*																							*/
	/* Contains several default tags that are commonly used in the page components				*/
	/*																							*/
	/* John R. Bayley john@jbayley.net															*/
	/********************************************************************************************/

	include 'reminderCommon.php';
	/*Set a defalt template */
	if  ((! isset ($template)) || ($template == ""))
		{
		$template = $authTemplates."default_template.php";
		}

	/* Set a default menu template if necessary */
	if (! isset($array['menu']))
	
		{
	
		$array['menu'] = $authTemplates . 'menuTemplates/t_defaultMenu.php';
	
		}


	/* Set a defaul naviagation template if necessary */
	if (! isset($array['navigation']))
	
		{
			$defaultNav = include($authScripts.'s_authNavigation.php');
	
		$array['navigation'] =  $defaultNav;
	
		}

	/* Set a default javaj tag if necessary */
	if (! isset($array['java']))
	
		{
	
		$array['java'] = '';
	
		}
	/* Set a default pageTitle tag if necessary */
	if (! isset($array['pageTitle']))
	
		{
	
		$array['pageTitle'] = $l['defaultPageTitle'];
	
		}

	if (! isset($array['logo']))
	
		{
	
		$array['logo'] = $l['defaultLogo'];
	
		}
	if (! isset($array['pageTagline']))
	
		{
	
		$array['pageTagline'] = $l['defaultTagline'];
	
		}
	if (! isset($array['breadcrumb']))
	
		{
	
		$array['breadcrumb'] = $l['defaultBreadcrumb'];
	
		}
	if (! isset($array['userImage']))
	
		{
			if (isset($_SESSION['userImage']))
				{
				$array['userImage'] = $_SESSION['userImage'];
				}
			else
				{
	
			$array['userImage'] = $l['defaultUserImage'];
	
			}
			}
	/* Build a page based on the html template and the swapout tags */
	/* Add some default tags */
	if (isset($_SESSION['realname']) && $_SESSION['realname'] != '')
		{
		$defaultUsernameTag = '<a class="toolLink" href="/auth/useredit.php" title="Edit details for '.$_SESSION['realname'].'">'.$_SESSION['realname'].'</a>&nbsp;&nbsp;<a class="toolLink" href="/logoff.php" title="Click here to log off">[Logoff<img src="/images/fam/key_delete.png" alt="logoff '.$_SESSION['realname'].'" height="10px"/>]</a>';
		$defaultLogoffTag = '&nbsp;&nbsp;<a class="toolLink" href="/logoff.php" title="Click here to log off">Log off</a>';
		}
	elseif (isset($_SESSION['username']) && $_SESSION['username'] != '')
		{
		$defaultUsernameTag = '<a class="toolLink" href="/auth/useredit.php" title="Edit details for '.$_SESSION['username'].'">'.$_SESSION['username'].'</a>&nbsp;&nbsp;<a class="toolLink" href="/logoff.php" title="Click here to log off">[Logoff<img src="/images/fam/key_delete.png" alt="logoff '.$_SESSION['username'].'" height="10px"/>]</a>';
		$defaultLogoffTag = '&nbsp;&nbsp;<a class="toolLink" href="/logoff.php" title="Click here to log off">Log off</a>';
		}
	else
		{
		$defaultUsernameTag = 'Not Logged in';
		$defaultLogoffTag = '';
		}
	$defaultTags = array(	'username' => $defaultUsernameTag,
							'logoff' => $defaultLogoffTag);
	/*Read template*/
	$swapTags = array_merge($defaultTags,$array);
	$page = file_get_contents($template);
	if ($page == '')
		{
		$page = '<H1>Template Error</H1>Unable to load template '.$template.'.';
		}
	/*Swap the tags in the template for the active values*/
	foreach ($swapTags as $tag => $data)
		{
		$data = (file_exists($data)) ? parse($data) :	$data;
		$page = eregi_replace('{'.$tag.'}', $data ,$page);
		}
	/*Ouput the results*/
	return $page;
	}

/* Parse the file that is passed as a parameter and return the contents of the file*/
function parse($file)
	{
	/* Buffer the output */
	ob_start();
	/* import the file */
	include($file);
	/* Read the contents of the file from the default buffer into our buffer*/
	$buffer = ob_get_contents();
	/*Purge the default buffer*/
	ob_end_clean();
	/*Return the file contents*/
	return $buffer;
	}


/* Test for the security flag in subscripts */
function secureCheck()
	{

	/* Test for secure flag */

	if (! defined('AUTHdbSEC'))

		{
		/* Bailout if flag is not set */
		die ("Security initialisation failed");
		}
	}
function login()
	{
	authenticate(null);
	}

function loginAdmin()
	{
	authenticate('ADMIN');
	}

function authenticate($access) {
	/* Session login */
	/* Handles the login from the seesion or initial login page*/

//uses the PHP SDK.  Download from https://github.com/facebook/php-sdk
include 'reminderCommon.php';

try {
define('YOUR_APP_ID', '178974708785370');
require 'facebook.php';
$facebook = new Facebook(array( 'appId'  => YOUR_APP_ID,
                                'secret' => 'bce7a6006d1cdb49e6602e4a657762c1',
                        ));

$userId = $facebook->getUser();

$userInfo = $facebook->api('/' + $userId);
}

catch (Exception $e) {}



if (isset($userInfo['username']) && $userInfo['username'] != '' && isset($userInfo['email']) )
    {
    $fbUserExists = checkAccountExistsFB($userInfo['username'],$userInfo['email']);
    if ($fbUserExists == 0)
        {
         $fbUsername = createFBAccount($userInfo['username'],$userInfo['first_name'],$userInfo['last_name'],$userInfo['name'],$userInfo['email']);
        }
    $userid = getUserId($userInfo['username']);
    $lastlogin = getUserLastLogin($userInfo['username']);
    $_SESSION['userid']=$userid;
    $_SESSION['username']=$userInfo['username'];
    $_SESSION['realname']=$userInfo['name'];
    $_SESSION['password']=md5('facebook');
    $_SESSION['lastlogin']=$lastlogin;
    }
else
    {
	$now = date('Y-m-d H:i:s');
	//session_start();
	//Look for previous session or new login request
	if ((isset($_SESSION['username']) && $_SESSION['username'] != "") || (isset ($_REQUEST['logname'])) && !isset($_POST['retry']))
		{
			//If this is logon info then this overrides session
			if (isset ($_REQUEST['logname']))
				{
				$logname = strtolower (mysql_real_escape_string($_REQUEST['logname']));
				$logpassword = md5(mysql_real_escape_string($_REQUEST['logpassword']));
				}
			else
				{
				/* No logon info so handle as a session */
				$logname = $_SESSION['username'];
				$logpassword = $_SESSION['password'];
				}
   			//Build logon query - all user data
   			include 'authSql.php';
			    $result = mysql_query($loginUserSql) or die("Could not successfully run query ($loginUserSql) from DB: " . mysql_error());

			$row = mysql_fetch_assoc($result);
 			include 'authSql.php';
			//Test for valid  password if no data then logon failed.
			//print ($_REQUEST['logpassword']."==".$logpassword ."==". $row['password']);
			if (mysql_num_rows ($result ) >=1 && ($logpassword == $row['password']) || ($faceBook != "" && $faceBook == $row['email']))
				{
				//Username and password were valid.
				$lastlogin = $row['lastlogin'];
				$lastlogin = substr($lastlogin, 8, 2).":".substr($lastlogin, 10, 2)." ".substr($lastlogin, 6, 2)."-".substr($lastlogin, 4, 2)."-".substr($lastlogin, 0, 4);
				if (isset ($_REQUEST['logname']))
					//Login so reset the session time
					{$session = $now;}
				else
					//Existing session so test for timeout
					{$session = $row['lastlogin'];}
				if ($now - $session> $authSessionTimeout)
					{
					//Timed out so report and bail
					$replaceTags = array(	'rightColumn' => $authTemplates.'loginTemplates/t_sessionTimedOutRight.php',
											'main' => $authTemplates.'loginTemplates/t_sessionTimedOut.php');
					createPage($replaceTags,NULL);

					unset ($_SESSION['username']);
					exit;
					}
				//At this point username, password and session are good
				//Reset the failedlogins and session time
				$resetResult = mysql_query($resetFailedCountSql) or die("Could not successfully run query ($resetFailedCountSql) from DB: " . mysql_error());

				//Check status enabled

				if (isset($row['enabled']))
					{
					if(($row['enabled'] == 0) &&($row['username'] != 'admin'))
						{
						//no, account is disabled
						$replaceTags = array(	'rightColumn' => $authTemplates.'loginTemplates/t_accountDisabledRight.php',
												'main' => $authTemplates.'loginTemplates/t_accountDisabled.php');
						createPage($replaceTags,NULL);
						exit;
						}
					if(($row['econfirmed'] == 0) &&($row['username'] != 'admin'))

						{
						$replaceTags = array(	'rightColumn' => $authTemplates.'loginTemplates/t_accountNotConfirmedRight.php',
												'main' => $authTemplates.'loginTemplates/t_accountNotConfirmed.php');
						createPage($replaceTags,NULL);
						exit;
						}
					/* If a specific authcode was sent, check if the user has it */
					if (isset($access))
						{
						/*TODO add access test */
						}

					}
				//All is ok login the user, update the session
				$_SESSION['userid']=$row['userid'];
				$_SESSION['username']=$row['username'];
				$_SESSION['realname']=$row['realname'];
				$_SESSION['password']=$row['password'];
				$_SESSION['lastlogin']=$lastlogin;
				$_SESSION['userImage']=$row['image'];

				}
			else
				{
				//Here if logon failed
					$result = mysql_query($updateFailedCountSql) or die("Could not successfully run query ($updateFailedCountSql) from DB: " . mysql_error());
					//Read results to see if account is disabled
					if ($row['failedLoginCount'] > $auth_failcount)
						{
						//Yes, disable account
						$result = mysql_query($disableUserAccountSql) or die("Could not successfully run query ($disableUserAccountSql) from DB: " . mysql_error());
						}
					//Set failed flag, report and bailout
					$replaceTags = array(	'breadcrumb' => $l['loginBreadcrumb'],
											'java' => '',
											'rightColumn' => $authTemplates . 'loginTemplates/t_loginFailedUsernameOrPasswordRight.php',
											'main' => $authTemplates.'loginTemplates/t_loginFailedUsernameOrPassword.php');
					createPage($replaceTags,NULL);
					exit;
				}
		}
	else
		{
		$breadcrumb = 'Login'>
		//No session found so popup a logon screen instead
		//Generate a template based on the login tags and login template
		$replaceTags = array(	'breadcrumb' => $l['loginBreadcrumb'],
								'java' => $authTemplates . 'j_loginForm.php',
								'rightColumn' => $authTemplates . 't_loginFormRight.php',
								'main' => $authTemplates . 't_loginForm.php');
		createPage($replaceTags,NULL);
		exit;
		}
    }

}

function replaceTags($output = '',$tags = array())
	{
	foreach ($tags as $tag => $data)
		{
		$output = eregi_replace('{'.$tag.'}', $data, $output);
		}
	return $output;
	}

function createMinimalPage($array,$template)
	{
	include 'reminderCommon.php';
	/*Set a defalt template */
	if  ((! isset ($template)) || ($template == ""))
		{
		$template = $authTemplates."defaultTemplate.php";
		}

	/* Build a page based on the html template and the swapout tags */
	/* Add some default tags */
	if (isset($_SESSION['username']) && $_SESSION['username'] != '')
		{
		$defaultUsernameTag = $_SESSION['username'].'&nbsp;&nbsp;<a class="toolLink" href="/logoff.php" title="Click here to log off">[Logoff<img src="/images/fam/key_delete.png" alt="logoff" height="10px"/>]</a>';
		$defaultLogoffTag = '&nbsp;&nbsp;<a class="toolLink" href="/logoff.php" title="Click here to log off">Log off</a>';
		}
	else
		{
		$defaultUsernameTag = 'Not Logged in';
		$defaultLogoffTag = '';
		}
	$defaultTags = array(	'username' => $defaultUsernameTag,
							'logoff' => $defaultLogoffTag);
	/*Read template*/
	$swapTags = array_merge($defaultTags,$array);
	$page = file_get_contents($template);
	if ($page == '')
		{
		$page = '<H1>Template Error</H1>$usernameload template $template';
		}
	/*Swap the tags in the template for the active values*/
	foreach ($swapTags as $tag => $data)
		{
		$data = (file_exists($data)) ? parse($data) :	$data;
		$page = eregi_replace('{'.$tag.'}', $data ,$page);
		}
	/*Ouput the results*/
	return $page;
	}

?>
