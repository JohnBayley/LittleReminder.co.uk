<?php

/* Test for the security flag */
secureCheck();
	/*Load the user details for checking and display */
	$userDetails = & getAllUserDetails($_REQUEST['username']);
	//confirmation of e-mail in the database
	$eusername = md5($userDetails['username']);
	/* We have user details so build the email */

	
	$encUser = $userDetails['username'].$userDetails['email'];
	$encPass = md5($userDetails['username'].$userDetails['password']);
	$taglist = array(	'username'		=>$userDetails['username'],
						'realname'		=>$userDetails['realname'],
						'firstname'		=>$userDetails['firstname'],
						'surname'		=>$userDetails['surname'],
						'email'			=>$userDetails['email'],
						'confirmLink'	=>"http://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']."?user=".eregi_replace(" ","%20",$userDetails['username'])."&id=".$encUser."&di=".$encPass);

	$message = file_get_contents ($authTemplates."email/m_confirmMail.txt");
	/*Swapout the tags to create the email */
	foreach ($taglist as $tag => $data)
		{
		$message = eregi_replace('{'.$tag.'}', $data ,$message);
		}
	/* Build the email headers*/
		$headers = "From: ".$adminEmail . "\r\n";
		$headers .= "Content-type: text/html\r\n";

	/* Combine headers and message and send the email*/
	if (mail ( $userDetails['email'], $l['confirmEmailSubject'], $message, $headers))
		{
		$includeFile = file_get_contents ($authTemplates."loginTemplates/t_confirmationSent.php");
		$includeFileRight = file_get_contents ($authTemplates."loginTemplates/t_confirmationSentRight.php");
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
		$includeFileRight = file_get_contents ($authTemplates."loginTemplates/t_recoveryEmailFailed.php");
		}



	$userInsertTags = array(	'main'		=>$includeFile,
								'right'		=>$includeFileRight);
	return $userInsertTags;


?>

