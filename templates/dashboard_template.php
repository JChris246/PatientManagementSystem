<!doctype html>
<html lang="en">
    <head>
        <title>Patient Management System - DashBoard</title>
        <meta charset="utf-8">
		<meta name="description" content="ElectroHealth Management System - Dashboard">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/buttons.css">
        <link rel="stylesheet" href="css/colors.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/panels.css">
        <script type="text/javascript" src="js/interaction.js"></script>
    </head>
    <body class="heartBg">
        <div class="center_text text_color center pagebg">
            <button class="toggle" id="toggleMenu">
                <div class="right" id="menu">
                    <div class="hamburger bluebg"></div>
                    <div class="hamburger bluebg"></div>
                    <div class="hamburger bluebg"></div>
                </div>
            </button>
            <div id="header">
                <span><?php if (isset($message)) echo $message; ?></span>
                <h1 class="blue">Dashboard</h2>
            </div>
            <?php require(TEMPLATE_DIR . "/sidebar_template.php"); // old habits ?>

            <div id="content2">
                <div id="first_panel" class="dashrow">
                    <a href="viewPatients.php?my=true"><button class="panel">View My Patients</button></a>
                    <a href="viewPatients.php"><button class="panel">View Patients</button></a>
                    <a href="newPatient.php"><button class="panel">Add Patient</button></a>
                </div>
                <div id="bottom_panel" class="dashrow">
                    <a href="#"><button class="panel">Create Report</button></a>
                    <a href="discharge.php"><button class="panel">Create Discharge Form</button></a>
                    <a href="admit.php"><button class="panel">Admit Patient</button></a>
                </div>
            </div>
        </div>
    </body>
</html>
