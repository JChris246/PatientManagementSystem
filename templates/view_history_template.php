<!doctype html>
<html lang="en">
    <head>
        <title>Patient Management System - View <?php echo ($type == "patient" ? "Patient" : "Family")?> History</title>
        <meta charset="utf-8">
		<meta name="description" content="ElectroHealth Management System - View <?php echo ($type == "patient" ? "Patient" : "Family")?> History">
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
                <h2 class="white balance">View <?php echo ($type == "patient" ? "Patient" : "Family")?> History</h2>
            </div>
            <?php require(TEMPLATE_DIR . "/sidebar_template.php"); // old habits ?>

            <div id="content2">
                <?php
                    if (count($history) < 1)
                        echo "<h1>No " . ($type == "patient" ? "Patient" : "Family") ." History to display</h1>";

                    $id_name = $type == "patient" ? "HistoryID" : "FamilyID";
                    for($i = 0; $i < count($history); $i++) {
                        echo '<div class="center_text text_color center pagebg">';
                            echo "<textarea readonly>" . $history[$i]["Issue"] . "</textarea><p></p>";
                            echo "<a href='updateHistory.php?id=". $history[$i]["NationalID"] ."&nid=". $history[$i][$id_name] . "&type=". $type ."'><button class='submit'>Edit</button></a> ";
                            echo "<a href='confirmDelete.php?delete=". $type ."&id=". $history[$i]["NationalID"] . "&nid=" . $history[$i][$id_name] ."'><button class='delete'>Delete</button></a>";
                        echo '</div>';
                    }
                ?>
                <p></p><a href='<?php echo "viewPatient.php?id=" . $id?>'><button class="submit">Back</button></a>
                <a href="?add=true&id=<?php echo $id;?>&index=<?php echo count($history);?>&type=<?php echo $type;?>"><button class="submit">Add</button></a><p></p>

                <?php 
                    //setup pagination here
                    if (isset($page)) {
                        if ($back)
                            echo "<a href='viewHistory.php?id=" . $id . "&page=". ($page - 1) . "&type=". $type ."'><button class='submit'>Back</button></a>";
                        for($i = 0, $j = $page - $left; $i < $left; $i++, $j++)
                            echo "<a href='viewHistory.php?id=" . $id . "&page=" . $j . "&type=". $type . "'><button class='submit'>". $j ."</button></a>";
                        echo "<button class='submit active'>". $page ."</button>";
                        for($i = 0, $j = $page + 1; $i < $right; $i++, $j++)
                            echo "<a href='viewHistory.php?id=" . $id . "&page=". $j . "&type=". $type . "'><button class='submit'>". $j ."</button></a>";
                        if ($forward)
                            echo "<a href='viewHistory.php?id=" . $id . "&page=". ($page + 1) . "&type=". $type . "'><button class='submit'>Forward</button></a>";
                    }
                ?>
            </div>
        </div>
    </body>
</html>
