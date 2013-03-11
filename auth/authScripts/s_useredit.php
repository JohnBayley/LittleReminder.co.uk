<?php
	/* Test for the security flag */
	secureCheck();
	$alert = '';
	/*Load the user details for checking and display */
	$userDetails = & getAllUserDetails($_SESSION['username']);
	$username = $userDetails['username'];
	/* Is there a pssword to update */
	if (isset ($_REQUEST['oldpassword']) && ($_REQUEST['oldpassword'] != ""))
		{
	//Encrypt all passwords 
		$epassword = md5($_REQUEST['oldpassword']);
		$newpassword1 = md5($_REQUEST['newpassword1']);
		$newpassword2 = md5($_REQUEST['newpassword2']);
		/* Test for current password */
		if (($userDetails['password']== $epassword))
			{
		
			/*Update if there is a password */
			if(($newpassword1 == $newpassword2) && $newpassword1 !="")
				{
				//Update the database with the new password
				$updateResult = updateUserPassword($username,$newpassword1,$epassword);
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
					
				}
			}
		else
			{
			$alert = gritterMessage($l['passChangeTitle'],$l['passChangeFail']);
			}
		}
	if (isset ($_REQUEST['realname']) && $_REQUEST['realname'] != "" && $_REQUEST['realname'] != $userDetails['realname'])
		{
			$updateResult = updateUserRealname($userDetails['username'],$_REQUEST['realname']);
			if ($updateResult == 1)
				{
				/* Give a confirmation message for realname change */
				$alert = gritterMessage($l['realnameChangeTitle'],$l['realnameChangeGood']);
				}
			else
				{
				/* Give a failure message for realname change */
				$alert = gritterMessage($l['realnameChangeTitle'],$l['realnameChangeBad']);
				}	
			
			}				
	if (isset ($_REQUEST['email']) && $_REQUEST['email'] != "" && $_REQUEST['email'] != $userDetails['email'])
		{
		if(checkUniqueEmail($userDetails['username'],$_REQUEST['email']))
			{
			$updateResult = updateUserEmail($userDetails['username'],$_REQUEST['email']);
				if ($updateResult == 1)
					{
					/* Give a confirmation message for email change */
					$alert = gritterMessage($l['emailChangeTitle'],$l['emailChangeGood']);


					//confirmation of e-mail in the database
					$eusername = md5($userDetails['username']);
					/* We have user details so build the email */
				
					
					$encUser = $userDetails['eusername'].md5($_REQUEST['email']);
					$encPass = md5($userDetails['eusername'].$userDetails['epassword']);
					$taglist = array(	'username'		=>$userDetails['username'],
										'firstname'		=>$userDetails['firstname'],
										'surname'		=>$userDetails['surname'],
										'jobTitle'		=>$userDetails['jobTitle'],
										'email'			=>$_REQUEST['email'],
										'confirmLink'	=>"http://".$_SERVER['SERVER_NAME']."/auth/useradd.php?user=".eregi_replace(" ","%20",$userDetails['username'])."&id=".$encUser."&di=".$encPass);
				
	$message = file_get_contents ($authTemplates."/email/m_confirmMail.txt");
					/*Swapout the tags to create the email */
					foreach ($taglist as $tag => $data)
						{
						$message = eregi_replace('{'.$tag.'}', $data ,$message);
						}
					/* Build the email headers*/
					$headers = 'From: '.$adminEmail . '';
				
	/* Combine headers and message and send the email*/
					if (mail ( $_REQUEST['email'], $l['confirmEmailSubject'], $message, $headers))
						{
						$includeFile = file_get_contents ($authTemplates."/loginTemplates/t_updateConfirmationSent.php");
						/*Swapout the tags in the results */	
						foreach ($taglist as $tag => $data)
							{
							$includeFile = eregi_replace('{'.$tag.'}', $data ,$includeFile);
							}
						}
					else
						{
						/* Mail problems */
						
						$includeFile = file_get_contents ($authTemplates.'loginTemplates/t_recoveryEmailFailed.php');
						}
						return $includeFile;
					}
				else
					{
					/* Give a failure message for email change */
					$alert = gritterMessage($l['emailChangeTitle'],$l['emailChangeBad']);
					}	
			}
		}

	/*Re read user to pick up changes */
	$userDetails = & getAllUserDetails($_SESSION['username']);

	/* Build an array of tags to swapout */
	$userEditTags = array(	'PHP_SELF'		=>$_SERVER['PHP_SELF'],
						'username'		=>$userDetails['username'],
						'realname'		=>$userDetails['realname'],
						'alert'			=>$alert,
						'email'			=>$userDetails['email']);

	return (createSubPage($userEditTags,$authTemplates.'t_useredit.php'));

?>

