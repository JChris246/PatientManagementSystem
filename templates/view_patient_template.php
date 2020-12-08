<!doctype html>
<html lang="en">
    <head>
        <title>Patient Management System - View Patient</title>
        <meta charset="utf-8">
		<meta name="description" content="ElectroHealth Management System - View Patient">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/colors.css">
        <link rel="stylesheet" href="css/buttons.css">
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
                <h1 class=blue>View Patient</h1>
            </div>
            <?php require(TEMPLATE_DIR . "/sidebar_template.php"); // old habits ?>
            <div id="content2">
                <?php
                    foreach ($patient as $key => $val) {
                        if ($key == "Active") {
                            echo "<span class='tag'>Currently in hospital</span>";
                            echo "<input value='" . ($val ? "Yes" : "No") . "' readonly><br/>";
                            continue;
                        }
                        if ($key == "DOB")
                            echo "<span class='tag'>". $key ." mm/dd/yyyy: </span>";
                        else echo "<span class='tag'>". $key .": </span>";
                        if ($key == "DOB")
                            echo "<input type='date' value='" . $val . "' readonly><br/>";
                        else if ($key == "Investigations" || $key == "TreatmentPlan" || $key == "Symptoms" || $key == "PresentingProblems" || $key == "Address")
                            echo "<textarea readonly>" . $val . "</textarea><br/>";
                        else echo "<input value='" . $val . "' readonly><br/>";
                    }
                ?>
                <div class="patientActions">
                    <a href='<?php echo "viewNotes.php?id=" . $patient["NationalID"];?>'><button class="submit">View Notes</button></a>
                    <a href='<?php echo "viewPatientDoctors.php?id=" . $patient["NationalID"];?>'><button class="submit">View Doctors</button></a>
                    <a href='<?php echo "viewHistory.php?type=patient&id=" . $patient["NationalID"];?>'><button class="submit">View Patient History</button></a>
                    <a href='<?php echo "viewHistory.php?type=family&id=" . $patient["NationalID"];?>'><button class="submit">View Family History</button></a>
                    <?php 
                        echo "<a href='" . ($patient["Active"] ? "discharge" : "admit") . ".php?id=" . $patient["NationalID"] . "'>";
                        echo "<button class='submit'>" . ($patient["Active"] ? "Discharge" : "Admit") . "</button></a>";
                    ?>
                </div>

                <p></p><a href="dashboard.php"><button class="submit">Back</button></a> <a href='<?php echo "updatePatient.php?id=" . $patient["NationalID"]; ?>'><button class="submit">Edit</button></a> <a href='<?php echo "deletePatient.php?id=" . $patient['NationalID'];?>'><button class="delete">Delete</button></a>
            </div>
        </div>
    </body>
</html>
