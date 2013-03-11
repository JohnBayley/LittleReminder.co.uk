<?php	
/* Test for the security flag */
secureCheck();

//Get transfered data
$username = $_REQUEST['user'];
$encUser = $_REQUEST['id'];
$encPass = $_REQUEST['di'];



/*Load the user details for checking and display */
$userDetails = & getAllUserDetails($_REQUEST['user']);
/* Build security details */
$refUser = $userDetails['eusername'].$userDetails['eemail'];
$refPass = md5($userDetails['eusername'].$userDetails['epassword']);


/* Check we got the correct data back*/



if (($encUser == $refUser) && ($encPass == $refPass))
	{
	//Confirm unique username
	
	$result = updateUserConfirmation($userDetails['username'],$userDetails['eusername']);
	$message = $authTemplates."loginTemplates/t_confirmationComplete.php";
	$rightCol = $authTemplates."loginTemplates/t_confirmationCompleteRight.php";
	}
else
	{
	/* Confirmation failed to to bad details */
	$message = $authTemplates."loginTemplates/t_confirmationAborted.php";
	$rightCol = $authTemplates."loginTemplates/t_confirmationAbortedRight.php";
	}
/*Build array */
$taglist = array(	'username'		=>$userDetails['username'],
					'firstname'		=>$userDetails['firstname'],
					'surname'		=>$userDetails['surname'],
					'realname'		=>$userDetails['realname'],
					'email'			=>$userDetails['email']);
/*Load the appropriate message*/
$includeFile = file_get_contents ($message);
/*Swapout the tags */
foreach ($taglist as $tag => $data)
	{
	$includeFile = eregi_replace('{'.$tag.'}', $data ,$includeFile);
	}
/*Print results */


$returnData = array(	'main'		=>$includeFile,
						'rightColumn' =>$rightCol);
/*Load the appropriate message*/
return $returnData;
?>