<!doctype html>
<html lang="en">
    <head>
        <title>Patient Management System - View Patient Notes</title>
        <meta charset="utf-8">
		<meta name="description" content="ElectroHealth Management System - View Patient Notes">
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
                <h1 class="white balance">View Patient Notes</h1>
            </div>
            <?php require(TEMPLATE_DIR . "/sidebar_template.php"); // old habits ?>

            <div id="content2">
                <?php
                    if (count($notes) < 1)
                        echo "<h1>No Patient Notes to display</h1>";
                    for($i = 0; $i < count($notes); $i++) {
                        echo '<div class="center_text text_color center pagebg">';
                            echo "<span class='green'>Entry time: " . $notes[$i]["EntryTime"] ." by " . $notes[$i]["Author"] . "</span><br/>";
                            echo "<span class='green'>Last edit: " . $notes[$i]["LastEdit"]. " by " . $notes[$i]["LastAuthor"] . "</span><p></p>";
                            echo "<textarea readonly>" . $notes[$i]["Note"] . "</textarea><p></p>";
                            echo "<a href='updateNote.php?id=". $notes[$i]["NationalID"] ."&nid=". $notes[$i]["NoteID"] ."'><button class='submit'>Edit</button></a> ";
                            echo "<a href='confirmDelete.php?delete=note&id=". $notes[$i]["NationalID"] . "&nid=" . $notes[$i]["NoteID"] ."'><button class='delete'>Delete</button></a>";
                        echo '</div>';
                    }
                ?>
                <p></p><a href='<?php echo "viewPatient.php?id=" . $id;?>'><button class="submit">Back</button></a> <a href="?add=true&id=<?php echo $id;?>&index=<?php echo count($notes);?>"><button class="submit">Add</button></a><p></p>

                <?php 
                    //setup pagination here
                    if (isset($page)) {
                        if ($back)
                            echo "<a href='viewNotes.php?id=" . $id . "&page=". ($page - 1) ."'><button class='submit'>Back</button></a>";
                        for($i = 0, $j = $page - $left; $i < $left; $i++, $j++)
                            echo "<a href='viewNotes.php?id=" . $id . "&page=" . $j . "'><button class='submit'>". $j ."</button></a>";
                        echo "<button class='submit active'>". $page ."</button>";
                        for($i = 0, $j = $page + 1; $i < $right; $i++, $j++)
                            echo "<a href='viewNotes.php?id=" . $id . "&page=". $j . "'><button class='submit'>". $j ."</button></a>";
                        if ($forward)
                            echo "<a href='viewNotes.php?id=" . $id . "&page=". ($page + 1) . "'><button class='submit'>Forward</button></a>";
                    }
                ?>
            </div>
        </div>
    </body>
</html>
