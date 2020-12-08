<!doctype html>
<html lang="en"> 
    <head>
        <title>ElectroHealth Management System - Delete Patient</title>
        <meta charset="utf-8">
		<meta name="description" content="ElectroHealth Management System - Delete Patient">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/colors.css">
        <link rel="stylesheet" href="css/buttons.css">
    </head>
    <body id="new" class="pagebg">
        <div class="center_text text_color">
            <div id="header"></div>
            <div id="content">
                <?php
                    echo "<h1>Are you sure you want to delete ALL info on this patient?</h1>";
                    echo "<a href='viewPatient.php?id=". $id ."'><button class='panel'>No</button></a> <a href='deletePatient.php?confirm=yes&id=" . $id . "'><button class='panel'>Yes</button></a>";
                ?>
            </div>
        </div>
    </body>
</html>