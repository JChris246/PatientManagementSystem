<!doctype html>
<html lang="en"> 
    <head>
        <title>ElectroHealth Management System - Edit <?php echo ($type == "patient" ? "Patient" : "Family")?> History</title>
        <meta charset="utf-8">
		<meta name="description" content="ElectroHealth Management System - Edit <?php echo ($type == "patient" ? "Patient" : "Family")?> History">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="css/colors.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/buttons.css">
        <link rel="stylesheet" href="css/panels.css">
        <script type="text/javascript" src="js/validators.js"></script>
        <script type="text/javascript" src="js/interaction.js"></script>
    </head>
    <body id="addNote" class="heartBg">
        <div class="center_text text_color center pagebg">
            <button class="toggle" id="toggleMenu">
                <div class="right" id="menu">
                    <div class="hamburger bluebg"></div>
                    <div class="hamburger bluebg"></div>
                    <div class="hamburger bluebg"></div>
                </div>
            </button>
            <div id="header">
                <h1 class=blue>Edit <?php echo ($type == "patient" ? "Patient" : "Family")?> History</h1>
            </div>

            <span class="red" id="error"><?php if (isset($error)) echo $error;?></span>
            <div id="content3">
                <?php require(TEMPLATE_DIR . "/sidebar_template.php"); // old habits ?>
                <form id="editHistoryForm" action="updateHistory.php" name="editHistoryForm" method="post">
                    <div class="inputs">
                        <textarea name="Issue"><?php if (isset($history["Issue"])) echo $history["Issue"]?></textarea>
                        <input type="hidden" name=<?php echo $id_name;?> value='<?php echo $history[$id_name];?>'>
                        <input type="hidden" name="type" value='<?php echo $type;?>'>
                        <input type="hidden" name="NationalID" value='<?php echo $history["NationalID"]; ?>'>
                    </div>
                    <button class="submit" id="EditHistoryBtn">Save</button><p></p>
                </form>
                <a href="viewNotes.php?id=<?php echo $history["NationalID"];?>"><button class="submit">Cancel</button></a>
                <noscript><i class="blue">Site performs better with javascript enabled</i></noscript>
            </div>
        </div>
    </body>
</html>