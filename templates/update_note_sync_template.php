<!doctype html>
<html lang="en"> 
    <head>
        <title>ElectroHealth Management System - Edit Note</title>
        <meta charset="utf-8">
		<meta name="description" content="ElectroHealth Management System - Edit Note (sync)">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/colors.css">
        <link rel="stylesheet" href="css/buttons.css">
    </head>
    <body class="pagebg">
        <div class="center_text text_color">
            <div id="header"></div>
            <div id="content">
                <h1>This particular note was updated while you were editing. Do you want to view and edit the changes?</h1>
                <a href="viewNotes.php?id=<?php echo $id;?>"><button class="panel">No</button></a> <a href="updatePatient.php?id=<?php echo $id;?>&nid=<?php echo $nid;?>"><button class="panel">Yes</button></a>
            </div>
        </div>
    </body>
</html>         