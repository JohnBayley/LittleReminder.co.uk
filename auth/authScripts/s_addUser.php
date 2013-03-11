<?php
	/* Test for the security flag */
	secureCheck();
	/* Build an array of tags to swapout */
	$userEditTags = array(	'PHP_SELF'		=>$_SERVER['PHP_SELF']);

	return (createSubPage($userEditTags,$authTemplates.'t_addUserForm.php'));

?>

