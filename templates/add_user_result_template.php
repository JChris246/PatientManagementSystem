<!doctype html>
<html lang="en"> 
    <head>
        <title>ElectroHealth Management System - New User</title>
        <meta charset="utf-8">
		<meta name="description" content="ElectroHealth Management System - New User">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/colors.css">
        <link rel="stylesheet" href="css/buttons.css">
    </head>
    <body id="new" class="pagebg heartBg">
        <div class="center_text text_color">
            <div id="header"></div>
            <div id="content">
                <?php
                    if (isset($error))
                        echo $error;
                    else echo "<h1>User added Successfully</h1>";
                ?>
            </div>
        </div>
    </body>
</html>