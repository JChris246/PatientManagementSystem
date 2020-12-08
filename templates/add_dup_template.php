<!doctype html>
<html lang="en"> 
    <head>
        <title>ElectroHealth Management System - New Patient</title>
        <meta charset="utf-8">
		<meta name="description" content="ElectroHealth Management System - New Patient (duplicate)">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/colors.css">
        <link rel="stylesheet" href="css/buttons.css">
    </head>
    <body id="new" class="pagebg">
        <div class="center_text text_color">
            <div id="header">
                <div class="info">
                    
                </div>
            </div>
            <div id="content">
                <?php
                    if ($active) {
                        echo "<h1>That patient already exist in the database do you want to discharge them or simply view their record ?</h1>";
                        echo "<a href='discharge.php?id=". $id ."'><button class='panel'>Discharge Patient</button></a> <a href='viewPatient.php?id=" . $id . "'><button class='panel'>View Record</button></a>";
                    } else {
                        echo "<h1>That patient already exist in the database do you want to admit them to hospital or simply view their record ?</h1>";
                        echo "<a href='discharge.php?id=". $id ."'><button class='panel'>Admit Patient</button></a> <a href='viewPatient.php?id=" . $id . "'><button class='panel'>View Record</button></a>";
                    }
                ?>
            </div>
        </div>
    </body>
</html>