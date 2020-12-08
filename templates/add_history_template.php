<!doctype html>
<html lang="en"> 
    <head>
        <title>ElectroHealth Management System - Add <?php echo ($type == "patient" ? "Patient" : "Family")?> History</title>
        <meta charset="utf-8">
		<meta name="description" content="ElectroHealth Management System - Add <?php echo ($type == "patient" ? "Patient" : "Family")?> Note">
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
                <div class="" id="menu">
                    <div class="hamburger bluebg"></div>
                    <div class="hamburger bluebg"></div>
                    <div class="hamburger bluebg"></div>
                </div>
            </button>
            <div id="header">
                <h1 class="blue">Add <?php echo ($type == "patient" ? "Patient" : "Family")?> History</h1>
            </div>
            <span class="red" id="error"><?php if (isset($error)) echo $error;?></span>
            <div id="content3">
                <?php require(TEMPLATE_DIR . "/sidebar_template.php"); // old habits ?>
                <form id="addHistoryForm" action="viewHistory.php" name="addHistoryForm" method="post">
                    <div class="inputs">
                        <textarea name="issue"><?php if (isset($issue)) echo $issue;?></textarea>
                        <input type="hidden" name="index" value='<?php if (isset($index)) echo $index; else echo "0";?>'>
                        <input type="hidden" name="id" value='<?php echo $id;?>'>
                        <input type="hidden" name="addHistory" value="add">
                        <input type="hidden" name="type" value=<?php echo $type?>>
                    </div>
                    <button class="submit" id="AddHistoryBtn">Add</button><p></p>
                </form>
                <a href="viewHistory.php?id=<?php echo $id;?>&type=<?php echo $type;?>"><button class="submit">Cancel</button></a>
                <noscript><i class="blue">Site performs better with javascript enabled</i></noscript>
            </div>
        </div>
    </body>
</html>