<!doctype html>
<html lang="en"> 
    <head>
        <title>ElectroHealth Management System - Add Patient Doctor</title>
        <meta charset="utf-8">
		<meta name="description" content="ElectroHealth Management System - Add Patient Doctor">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="css/colors.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/buttons.css">
        <link rel="stylesheet" href="css/panels.css">
        <script type="text/javascript" src="js/validators.js"></script>
        <script type="text/javascript" src="js/interaction.js"></script>
    </head>
    <body id="addDoctor" class="heartBg">
        <div class="center_text text_color center pagebg">
            <button class="toggle" id="toggleMenu">
                <div class="" id="menu">
                    <div class="hamburger bluebg"></div>
                    <div class="hamburger bluebg"></div>
                    <div class="hamburger bluebg"></div>
                </div>
            </button>
            <div id="header">
                <h1 class="blue">Add Doctor to Patient</h1>
            </div>
            <span class="red" id="error"><?php if (isset($error)) echo $error;?></span>
            <div id="content3">
                <?php require(TEMPLATE_DIR . "/sidebar_template.php"); // old habits ?>
                <form id="addDoctorForm" action="viewPatientDoctors.php" name="addDoctorForm" method="post">
                    <div class="inputs">
                        <input type="text" name="Role" placeholder="Role..." value='<?php if (isset($doctor["Role"])) echo $doctor["Role"];?>'><br/>
                        <input type="text" name="FirstName" placeholder="First Name..." value='<?php if (isset($doctor["FirstName"])) echo $doctor["FirstName"];?>'><br/>
                        <input type="text" name="LastName" placeholder="Last Name..." value='<?php if (isset($doctor["LastName"])) echo $doctor["LastName"];?>'><br/>
                        <input type="hidden" name="id" value='<?php echo $id; ?>'>
                        <input type="hidden" name="addDoctor" value="">
                    </div>
                    <button class="submit" id="AddDoctorBtn">Add Doctor</button><p></p>
                </form>
                <a href="viewPatientDoctors.php?id=<?php echo $id;?>"><button class="submit">Cancel</button></a>
                <noscript><i class="blue">Site performs better with javascript enabled</i></noscript>
                <!--<a href="#">Forgot Password</a><p></p>-->
            </div>
        </div>
    </body>
</html>