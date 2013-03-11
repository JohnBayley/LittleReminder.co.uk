<?php

/* Test for the security flag */
secureCheck();


/* Test to see if the user has recovery details */
if (isset ($_REQUEST['jbepw']))
	{
	//Recovery details sent confirm the validity
	$test = md5($_REQUEST['user']);
	//Test the send and recieved username
	if ( $test == $_REQUEST['eu'])
		{
		//Test password
		$result = recoverDetailsCheck($_REQUEST['user'],$_REQUEST['jbepw']);
		if ($result ==0)
			{
			//Username ok but password is bad
			$right = file_get_contents ( $authTemplates.'loginTemplates/t_recoveryFailedRight.php');
			$message = createMinimalPage($taglist,$authTemplates.'loginTemplates/t_recoveryFailed.php');
			$return = array(	'main'		=>$message,
								'right'		=>$right);
			return $return;
			}
		else
			{
			//Recover the user details and log in
			$userDetails = recoverDetails($_REQUEST['user'],$_REQUEST['jbepw']);
			session_start();
			$_SESSION['username'] = $userDetails['username'];
			$_SESSION['password'] = $userDetails['password'];
			$_SESSION['enabled'] = $userDetailsw['enabled'];
			//Display confirmation
			$taglist = array(	'PHP_SELF'		=>$_SERVER['PHP_SELF'],
								'username'		=>$_REQUEST['user']);

			$right = file_get_contents ( $authTemplates.'loginTemplates/t_recoveryChangePasswordRight.php');
			$message = createMinimalPage($taglist,$authTemplates.'loginTemplates/t_recoveryChangePassword.php');
			$return = array(	'main'		=>$message,
								'right'		=>$right);
			return $return;
			}
		}
	else
		{
		//Recovery failed alert user
		$message = file_get_contents ( $authTemplates.'loginTemplates/t_recoveryFailed.php');
		$right = file_get_contents ( $authTemplates.'loginTemplates/t_recoveryFailedRight.php');
		$return = array(	'main'		=>$message,
							'right'		=>$right);
		return $return;
		}
	}
elseif ((isset ($_REQUEST['email'])&& $_REQUEST['email'] != '')||(isset ($_REQUEST['username'])&&!isset ($_REQUEST['chpw'])&& $_REQUEST['username'] != ''))
	{
	$result = 0;
    if (isset ($_REQUEST['email']))
        {
	    //Recovery request test for e-mail in the database
	    $logname = $_REQUEST['email'];
	    include $authApi.'authSql.php';
	    $result = mysql_result(mysql_query($existsEmailCheckSql),0,0);
	    }
    if (isset ($_REQUEST['username']))
        {
	    //Recovery request test for e-mail in the database
	    $logname = $_REQUEST['username'];
	    include $authApi.'authSql.php';
	    $result = mysql_result(mysql_query($existsUsernameCheckSql),0,0);
	    }

	if ( $result > 0)
		{
		//e-mail exists so compose a mail with the recovery link in it
		$result = mysql_query($recoverUserSql) or die("Could not successfully run query ($recoverUserSql) from DB: " . mysql_error());

		$recoveruser = mysql_fetch_assoc($result);

		$taglist = array(	'username'		=>$_['username'],
							'realname'		=>$recoveruser['realname'],
							'email'			=>$recoveruser['email'],
							'username'		=>$recoveruser['username'],
							'recoverLink'	=>'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'].'?user='.$recoveruser['username'].'&jbepw='.$recoveruser['password'].'&eu='.md5($recoveruser['username']));

		$message = file_get_contents ($authTemplates.'email/m_recoveryMail.html');

		foreach ($taglist as $tag => $data)
			{
			$message = eregi_replace('{'.$tag.'}', $data ,$message);
			}
		$headers = "Date: ".date('r')."\n";
		$headers .= "Return-Path: ".$adminEmail."\n";
		$headers .= "From: ".$adminEmail."\n";
		$headers .= "Message-ID: <".md5(uniqid(time()))."@littlereminder.co.uk>\n";
		$headers .= "X-Priority: 3\n";
		$headers .= "MIME-Version: 1.0\n";
		$headers .= "Content-Transfer-Encoding: 8bit\n";
		$headers .= 'Content-Type: text/html; charset="iso-8859-1"'."\n";
		if (mail ( $recoveruser['email'], $l['recoverySubject'], $message, $headers))
			{
			$taglist = array(	'email'		=>$recoveruser['email']);
			$message = createMinimalPage ($taglist,$authTemplates.'loginTemplates/t_recoveryEmailSent.php');
			$right = file_get_contents ($authTemplates.'loginTemplates/t_recoveryEmailSentRight.php');
			$return = array(	'main'		=>$message,
								'right'		=>$right);
			return $return;
			}

		else
			/* The email did not exist */
			{
			$taglist = array(	'email'		=>$recoveruser['email']);
			$message = createMinimalPage ($taglist,$authTemplates.'loginTemplates/t_recoveryEmailFailed.php');
			$right = file_get_contents ($authTemplates.'loginTemplates/t_recoveryEmailFailedRight.php');
			$return = array(	'main'		=>$message,
								'right'		=>$right);
			return $return;
			}

		}
	else
		{
		/* No matching email so return fail message */
			$taglist = array(	'email'		=>$_REQUEST['email']);
			$message = createMinimalPage ($taglist,$authTemplates.'loginTemplates/t_recoveryAborted.php');
			$right = file_get_contents ($authTemplates.'loginTemplates/t_recoveryAbortedRight.php');
			$return = array(	'main'		=>$message,
								'right'		=>$right);
			return $return;
			}
	}
elseif (isset ($_REQUEST['chpw']))
	{
	$userDetails = getAllUserDetails($_REQUEST['username']);

	$newpassword1 = md5($_REQUEST['newpassword1']);
		$updateResult = updateUserPassword($userDetails['username'],$newpassword1,$userDetails['password']);
	/* Display results */
	if ($updateResult == 1)
		{
		/* Give a confirmation message for password change */
		$alert = gritterMessage($l['passChangeTitle'],$l['passChangeGood']);
		$_SESSION['password']=$newpassword1;
		}
	else
		{
		/* Give a failure message for password change */
		$alert = gritterMessage($l['passChangeTitle'],$l['passChangeBad']);
		}
	$taglist = array(	'alert'			=>$alert,
						'username'		=>$userDetails['username']);
	$message = createMinimalPage ($taglist,$authTemplates.'loginTemplates/t_recoveryCompleted.php');
	$right = file_get_contents ($authTemplates.'loginTemplates/t_recoveryCompletedRight.php');
	$return = array(	'main'		=>$message,
						'right'		=>$right);
	$_SESSION['password']= md5($_REQUEST['newpassword1']);
	$_SESSION['username']= $userDetails['username'];
	return $return;
	}

else

	{
	$message = file_get_contents ($authTemplates.'loginTemplates/t_recoverForm.php');
	$right = file_get_contents ($authTemplates.'loginTemplates/t_recoverFormRight.php');
	$return = array(	'main'		=>$message,
						'right'		=>$right);
	return $return;

	}
mysql_close($dbh);




?>

