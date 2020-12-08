<!doctype html>
<html lang="en">
    <head>
        <title>Patient Management System - View Patient Doctors</title>
        <meta charset="utf-8">
		<meta name="description" content="ElectroHealth Management System - View Patient Doctors">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/colors.css">
        <link rel="stylesheet" href="css/buttons.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/panels.css">
        <script type="text/javascript" src="js/interaction.js"></script>
    </head>
    <body id="page" class="pagebg heartBg">
        <div class="center_text text_color">
            <button class="toggle" id="toggleMenu">
                <div class="right" id="menu">
                    <div class="hamburger whitebg"></div>
                    <div class="hamburger whitebg"></div>
                    <div class="hamburger whitebg"></div>
                </div>
            </button>
            <div id="header">
                <h2 class="white balance">View Patient Doctors</h2>
            </div>
            <?php require(TEMPLATE_DIR . "/sidebar_template.php"); // old habits ?>

            <div id="content2">
                <div class="center_text text_color center pagebg">
                    <?php
                        if (count($doctors) < 1)
                            echo "<h1>Patient has no assigned medical personnel</h1>";
                        else {
                            echo "<table>";
                            echo "<tr><th>Role</th><th>First Name</th><th>Last Name</th><th></th></tr>";
                            for($i = 0; $i < count($doctors); $i++) {
                                echo "<tr><td>" . $doctors[$i]["Role"] . "</td><td>" . $doctors[$i]["FirstName"] . "</td><td>" . $doctors[$i]["LastName"] . "</td>";
                                echo "<td><a href='?delete=true&id=". $id ."&r=".$doctors[$i]['Role']."&f=".$doctors[$i]['FirstName']."&l=".$doctors[$i]['LastName']."'>Remove</a></td></tr>";
                            }
                            echo '</table>';
                        }
                    ?>
                    <p></p><a href='<?php echo "viewPatient.php?id=" . $id;?>'><button class="submit">Back</button></a> <a href="?add=true&id=<?php echo $id;?>"><button class="submit">Add</button></a>
                </div>
            </div>
        </div>
    </body>
</html>
