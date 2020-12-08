<!doctype html>
<html lang="en">
    <head>
        <title>Patient Management System - Advanced Search</title>
        <meta charset="utf-8">
		<meta name="description" content="ElectroHealth Management System - View All Patients - Advanced Search">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/colors.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/buttons.css">
        <link rel="stylesheet" href="css/panels.css">
        <script type="text/javascript" src="js/validators.js"></script>
        <script type="text/javascript" src="js/interaction.js"></script>
    </head>
    <body class="heartBg">
        <div class="center_text text_color pagebg center">
            <button class="toggle" id="toggleMenu">
                <div class="right" id="menu">
                    <div class="hamburger bluebg"></div>
                    <div class="hamburger bluebg"></div>
                    <div class="hamburger bluebg"></div>
                </div>
            </button>
            <div id="header">
                <h2 class="blue">Advanced Search</h2>
            </div>
            <?php require(TEMPLATE_DIR . "/sidebar_template.php"); // old habits ?>

            <div id="content2">
                <form method="post" action="viewPatients.php">
                    <input placeholder="National ID..." name="NationalID" value=""><br/>
                    <input placeholder="First Name..." name="FirstName" value=""><br/>
                    <input placeholder="Last Name..." name="LastName" value=""><br/>
                    <input placeholder="Other Names..." name="OtherNames" value=""><br/>
                    <input placeholder="Hospital ID" name="HospitalRegNo" value=""><br/>
                    <select name="Sex">
                        <option value="any">Any</option>
                        <option value="female">Female</option>
                        <option value="male">Male</option>
                    </select><br/>
                    <input placeholder="Address..." name="Address" value=""><br/>
                    <input value="" name="DOB" type="date"><p></p>
                    <input name="advanced" type="hidden">
                    <button class="submit">Search</button> 
                </form>
                <a href="dashboard.php"><button class="submit">Cancel</button></a>
            </div>
        </div>
    </body>
</html>
