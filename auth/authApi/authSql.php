<?php
if (isset($logname)){
	/*Security function SQL */
	/* Testing of passed user details to log the user in */
	$loginUserSql = "	SELECT *
						FROM users
						WHERE username= LOWER('".$logname."') OR email = LOWER('".$logname."') ";

	/* Update the failed login count */
	$updateFailedCountSql = "	UPDATE users
								SET failedlogins = failedlogins + 1
								WHERE username = LOWER('".$logname."') ";


	/* Disable the account */
	$disableUserAccountSql = "	UPDATE users
								SET active = 0 WHERE username = LOWER('".$logname."') ";

	/* Reset the failed login count */
	if (isset($row))
		{
		$resetFailedCountSql = "	UPDATE users
									SET failedlogins = 0,
									lastLogin = NOW()
									WHERE username = LOWER('".$row['username']."') ";
		}
	/* Recovery Check email exists */
	$existsEmailCheckSql = " 	SELECT COUNT(*) AS emailCount
								FROM users
								WHERE email = LOWER('".$logname."') OR username = LOWER('".$logname."') ";
	$existsUsernameCheckSql = " 	SELECT COUNT(*) AS userCount
								FROM users
								WHERE username = '".$logname."'  ";
	$recoverUserSql = "	SELECT *
						FROM users
						WHERE email = LOWER('".$logname."') OR username = LOWER('".$logname."') ";
}
if (isset($fbUsername)) {
$fbUserCheckNotLocalisedSql = " 	SELECT COUNT(*) AS userCount
								FROM users
								WHERE username = LOWER('".$fbUsername."') OR email = LOWER('".$fbUsername."')
								AND password = MD5('facebook') ";
}
if (isset($fbUsername) || isset($fbEmail)){
    	$fbUserCheckSql = " 	SELECT COUNT(*) AS userCount
								FROM users
								WHERE username = LOWER('".$fbUsername."') OR email = LOWER('".$fbEmail."') ";

}

if (isset($jbepw))
	{
	$recoveryTestSql = "	SELECT COUNT(*)
							FROM users
							WHERE username = LOWER('".$username."')
							AND password = '".$jbepw."'";

	$recoverySql= "	SELECT *
					FROM users
					WHERE username = LOWER('".$username."')
					AND password = '".$jbepw."'";

	}
if (isset($username)){
	/* get the key user details */
	$getUserDetailsSql = "	SELECT *
							FROM users
							WHERE username= LOWER('".$username."') ";

	/* Check for unique username */
	$uniqueUsernameCheckSql = " 	SELECT COUNT(username) AS usernameCount
									FROM users
									WHERE username = LOWER('".$username."') ";


    $updateUserConfirmationSql = "		UPDATE users
                                        SET econfirmed = '1'
                                        WHERE username = LOWER('".$username."')
                                        LIMIT 1";


	if (isset($password) && isset($email) && isset($realname))
		{
		$insertUserSql = "INSERT INTO users (	username,
												firstname,
												surname,
												password,
												email,
												enabled,
												econfirmed,
												realname,
												created_date

											)

									VALUES	(	LOWER('".$username."'),
												'".$firstname."',
												'".$surname."',
												'".$password."',
												LOWER('".$email."'),
												1,
												1,
												'".$realname."',
												now()
												)";
		}
}
if (isset($newPassword)){
/* Update the password */

	$updateUserPasswordSql = "	UPDATE users
								SET password='".$newPassword."',
								failedlogins = 0,
								enabled=1,
								econfirmed=1,
								lastLogin = NOW()
								WHERE username = LOWER('".$username."')
								AND password = '".$oldPassword."'
								LIMIT 1";
}
if (isset($email)){

	/* Check for unique email */
	$uniqueEmailCheckSql = " 	SELECT COUNT(email) AS emailCount
								FROM users
								WHERE email = LOWER('".$email."') ";


	if (isset($username)){
		/* Update the email */
		$updateUserEmailSql = "		UPDATE users
									SET email='".$email."',
									econfirmed = '0'
									WHERE username = LOWER('".$username."')
									LIMIT 1";
							}
	if (isset($username)){
		/* Check for unique email */
		$uniqueUserEmailCheckSql = " 	SELECT COUNT(email) AS emailCount
									FROM users
									WHERE email = LOWER('".$email."')
									AND username != LOWER('".$username."') ";
							}
}


if (isset($realname)){
	/* Update the realname */
	$updateUserRealnameSql = "		UPDATE users
								SET realname='".$realname."'
								WHERE username = LOWER('".$username."')
								LIMIT 1";

}
if (isset($org) && isset($username))
	{
	$getUsersSql = "	SELECT *
						FROM users
						WHERE username NOT IN ('root','admin',LOWER('".$username."'))";

	}
?>