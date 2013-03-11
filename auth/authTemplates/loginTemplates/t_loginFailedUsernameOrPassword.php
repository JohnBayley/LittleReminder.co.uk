<?php

if (checkAccountExistsButNotLocalisedFB($_REQUEST['logname']) ==0)
    {
    print ('

                <div id="info">
                <h1>Login Failed</h1>
                <h3>Bad Username or Password</h3>
                <p>A valid username and password is required to use this system.</p>
                <p><a href="javascript:retryLogin()">Try again</a></p>
                <p>Forgotten your password? <a href="/auth/recover.php" title="Click here to recover a lost password">Recover it here.</a></p>
                <p>Forgotten your usename? Use your email address instead.</p>
            </div>



            ');


    }
else
    {
    print ('

            <div id="info">
                <h1>Login Failed : Facebook Account</h1>
                <h2>You have a facebook account</h2>
                <p>As you have only used facebook before there is no local password for you to use.</p>
                <p>You can set a reminder password using the automated password reset / recovery by <a href="javascript:recoveryMail()">clicking here</a></p>
                <p>Or you can <a href="javascript:retryLogin()">return and use the facebook login instead</a></p>
            </div>
            <form method="post" action="/auth/recover.php" enctype="multipart/form-data" id="userForm">
                    <input type="hidden" id="email" name="email" value="'.$_REQUEST['logname'].'" size="30" maxlength="45" />
            </form>

    ');
    }

?>
            <form method="post" action="" enctype="multipart/form-data" id="retryLogin">
                <input type="hidden" name="retry" value="1" />
            </form>
            <script type="text/javascript">
            function retryLogin(){document.getElementById("retryLogin").submit();}
            function recoveryMail(){document.getElementById("userForm").submit();}
            </script>

