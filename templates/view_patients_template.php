
<!doctype html>
<html lang="en"> 
    <head>
        <title>ElectroHealth Management System - View Patients</title>
        <meta charset="utf-8">
		<meta name="description" content="ElectroHealth Management System - View Patients">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/buttons.css">
        <link rel="stylesheet" href="css/colors.css">
        <link rel="stylesheet" href="css/panels.css">
        <script type="text/javascript" src="js/validators.js"></script>
        <script type="text/javascript" src="js/interaction.js"></script>
    </head>
    <body class="pagebg heartBg">
        <div class="center_text text_color">
            <div class="center pagebg">
                <div id="header">
                    <button class="toggle" id="toggleMenu">
                        <div class="right" id="menu">
                            <div class="hamburger bluebg"></div>
                            <div class="hamburger bluebg"></div>
                            <div class="hamburger bluebg"></div>
                        </div>
                    </button>
                    <?php echo '<h1 class="blue">' . (isset($my) ? "My" : "All") . " Patients</h2>"; ?>
                </div>
                <?php require(TEMPLATE_DIR . "/sidebar_template.php"); // old habits ?>

                <div id="content">
                    <form method="post" action="viewPatients.php" class="inline"><input id="SearchInput" class="search" placeholder="Search By First Name..." value="" name="SearchAll"> <button id="searchBtn" class="search">Search</button> </form> <a href="advancedSearch.php"><button class="search">Advanced Search</button></a>

                    <div id="data">
                        <table id="table">
                            <?php
                                if (count($patients) > 0)
                                    echo '<tr><th></th><th>National ID</th><th>First Name</th><th>Last Name</th></tr>'; //<th>Other Names</th></tr>';
                                else echo "No Patients Found";
                                for($i = 0; $i < count($patients); $i++) {
                                    $data = $patients[$i];
                                    echo "</td><td class='attr'><a href='viewPatient.php?id=". $data['NationalID']."'>View</a></td>";
                                    echo "<td class='attr'>" . $data['NationalID'] . "</td>";
                                    echo "<td class='attr'>" . $data['FirstName'] . "</td>";
                                    echo "<td class='attr'>" . $data['LastName'] . "</td></tr>";
                                    //echo "<td class='attr'>" . $data['OtherNames'] . "</td></tr>";
                                }
                            ?>
                        </table>
                        <?php 
                            //setup pagination here
                            if (isset($page)) {
                                if ($back)
                                    echo "<a href='viewPatients.php?page=". ($page - 1) . (isset($my) ? "&my=true" : "") . (isset($search) ? "&search=" . $search : "") . (isset($advancedSearch) ? "&" . $advancedSearch : "") ."'><button class='submit'>Back</button></a>";
                                for($i = 0, $j = $page - $left; $i < $left; $i++, $j++)
                                    echo "<a href='viewPatients.php?page=". $j . (isset($my) ? "&my=true" : "") . (isset($search) ? "&search=" . $search : "") . (isset($advancedSearch) ? "&" . $advancedSearch : "") . "'><button class='submit'>". $j ."</button></a>";
                                echo "<button class='submit active'>". $page ."</button>";
                                for($i = 0, $j = $page + 1; $i < $right; $i++, $j++)
                                    echo "<a href='viewPatients.php?page=". $j . (isset($my) ? "&my=true" : "") . (isset($search) ? "&search=" . $search : "") . (isset($advancedSearch) ? "&" . $advancedSearch : "") . "'><button class='submit'>". $j ."</button></a>";
                                if ($forward)
                                    echo "<a href='viewPatients.php?page=". ($page + 1) . (isset($my) ? "&my=true" : "") . (isset($search) ? "&search=" . $search : "") . (isset($advancedSearch) ? "&" . $advancedSearch : "") ."'><button class='submit'>Forward</button></a>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>