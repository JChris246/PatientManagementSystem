<!doctype html>
<html lang="en"> 
    <head>
        <title>ElectroHealth Management System - Add User</title>
        <meta charset="utf-8">
		<meta name="description" content="ElectroHealth Management System - Add User">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="css/colors.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/buttons.css">
        <link rel="stylesheet" href="css/panels.css">
        <script type="text/javascript" src="js/validators.js"></script>
    </head>
    <body id="add">
        <div class="center_text text_color center pagebg">
            <div id="header">
                <h1 class="blue">ElectroHealth Management System</h1>
            </div>
            <span class="red" id="error"><?php if (isset($error)) echo $error;?></span>
            <div id="content3">
                <form id="addUserForm" action="addUser.php" name="createForm" method="post">
                    <div class="inputs">
                        <input type="text" name="Role" placeholder="Role..." value='<?php if (isset($user["Role"])) echo $user["Role"];?>'><br/>
                        <input type="text" name="FirstName" placeholder="First Name..." value='<?php if (isset($user["FirstName"])) echo $user["FirstName"];?>'><br/>
                        <input type="text" name="LastName" placeholder="Last Name..." value='<?php if (isset($user["LastName"])) echo $user["LastName"];?>'><br/>
                        <input type="password" name="Pass" placeholder="password..."><br/>
                        <input type="password" name="confirmPass" placeholder="confirm password..."><br/>
                        <input type="hidden" name="add" value="">
                    </div>
                    <button class="submit" id="create">Create User</button><p></p>
                </form>
                <noscript><i class="blue">Site performs better with javascript enabled</i></noscript>
                <!--<a href="#">Forgot Password</a><p></p>-->
            </div>
        </div>
    </body>
</html>