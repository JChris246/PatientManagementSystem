<!doctype html>
<html lang="en"> 
    <head>
        <title>ElectroHealth Management System - Login</title>
        <meta charset="utf-8">
		<meta name="description" content="ElectroHealth Management System - Login">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="css/colors.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/buttons.css">
        <link rel="stylesheet" href="css/panels.css">
        <script type="text/javascript" src="js/validators.js"></script>
        <script type="text/javascript" src="js/interaction.js"></script>
    </head>
    <body id="index">
        <div class="center_text text_color center pagebg">
            <div id="header">
                <h1 class="blue">ElectroHealth Management System</h1>
            </div>
            <span class="red" id="error"><?php echo $error; //will print nothing if no error?></span>
            <div id="content3">
                <form id="login" action="validate.php" name="loginForm" method="post">
                    <div class="inputs">
                        <input type="text" name="username" placeholder="Username..." value='<?php if (isset($user)) echo $user;?>'><br/>
                        <input type="password" name="pass" placeholder="password..."><br/> 
                        <input type="checkbox" name="togglePass" class="checkbox" id="togglePass">Show Password<br/>
                        <input type="hidden" name="index" value="">
                    </div>
                    <button class="submit" id="signin">Sign In</button><p></p>
                </form>
                <noscript><i class="blue">Site performs better with javascript enabled</i></noscript>
                <!--<a href="#">Forgot Password</a><p></p>-->
            </div>
        </div>

        <div class="text_color center pagebg">
            <div id="header">
                <h1 class="blue center_text">Is this your first time here?</h1>
            </div>
            <div id="">
                <h2>Below are links to the recommended browsers to use while accessing the system.</h2>
                <ul>
                    <li><a href="https://www.mozilla.org/en-US/firefox/new">Firefox</a></li>
                    <li><a href="https://www.google.com/chrome">Chrome</a></li>
                    <li><a href="https://support.apple.com/downloads/safari">Safari</a></li>
                </ul><p></p>

                <h2>General Login Instructions</h2>
                <div>Your username is Your role at the hospital (e.g. NO, RN, HO) + Your First Name + Your Last Name<br>
                    For example: RN Chris King<p></p>
                    Please use the password given to you by supervisor.
                </div>
            </div>
        </div>
    </body>
</html>