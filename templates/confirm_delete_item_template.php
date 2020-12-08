<!doctype html>
<html lang="en"> 
    <head>
        <title>ElectroHealth Management System - Delete <?php (isset($item) ? $item : "item")?></title>
        <meta charset="utf-8">
		<meta name="description" content="ElectroHealth Management System - Delete <?php (isset($item) ? $item : "item")?>">
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
                    echo "<h1>Are you sure you want to delete" . (isset($item) ? $item : "item") ." ? </h1>";
                    echo "<a href='". $back ."'><button class='panel'>No</button></a> <a href='". $forward ."'><button class='panel'>Yes</button></a>";
                ?>
            </div>
        </div>
    </body>
</html>