<!doctype html>
<html lang="en"> 
    <head>
        <title>ElectroHealth Management System - Edit Patient Note</title>
        <meta charset="utf-8">
		<meta name="description" content="ElectroHealth Management System - Edit Patient Note">
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
                <h1 class=blue>Edit Note</h1>
            </div>
            <span class="red" id="error"><?php if (isset($error)) echo $error;?></span>
            <div id="content3">
                <?php require(TEMPLATE_DIR . "/sidebar_template.php"); // old habits ?>
                <form id="editNoteForm" action="updateNote.php" name="editNoteForm" method="post">
                    <div class="inputs">
                        <textarea name="Note"><?php if (isset($note["Note"])) echo $note["Note"]?></textarea>
                        <input type="hidden" name="NoteID" value='<?php echo $note["NoteID"];?>'>
                        <input type="hidden" name="EntryTime" value='<?php echo $note["EntryTime"];?>'>
                        <input type="hidden" name="Author" value='<?php if (isset($note["Author"])) echo $note["Author"]; else echo "0";?>'>
                        <input type="hidden" name="LastAuthor" value='<?php if (isset($note["LastAuthor"])) echo $note["LastAuthor"]; else echo "0";?>'>
                        <input type="hidden" name="LastEdit" value='<?php if (isset($note["LastEdit"])) echo $note["LastEdit"]; else echo "0";?>'>
                        <input type="hidden" name="NationalID" value='<?php echo $note["NationalID"]; ?>'>
                    </div>
                    <button class="submit" id="EditNoteBtn">Save</button><p></p>
                </form>
                <a href="viewNotes.php?id=<?php echo $note["NationalID"];?>"><button class="submit">Cancel</button></a>
                <noscript><i class="blue">Site performs better with javascript enabled</i></noscript>
            </div>
        </div>
    </body>
</html>