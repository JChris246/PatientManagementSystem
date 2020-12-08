<!doctype html>
<html lang="en">
    <head>
        <title>Patient Management System - Discharge Form</title>
        <meta charset="utf-8">
		<meta name="description" content="ElectroHealth Management System - Discharge Form">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/buttons.css">
        <link rel="stylesheet" href="css/colors.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/panels.css">
        <script type="text/javascript" src="js/validators.js"></script>
    </head>
    <body class="heartBg" id="discharge" >
        <div class="center_text text_color center pagebg">
            <div id="header">
                <h1 class="blue">Enter the National Id of the patient that you want to discharge</h2>
            </div>
            <span class="red" id="error"><?php if (isset($error)) echo $error;?></span>
            <div id="content3">
                <form id="dischargeForm" action="discharge.php" name="dischargeForm" method="post">
                    <div class="inputs">
                        <input type="text" name="id" placeholder="National ID..."><br/>
                        <input type="hidden" name="discharge" value="">
                    </div>
                    <button class="submit" id="dischargeEnterBtn">Enter</button><p></p>
                </form>
                <a href="dashboard.php"><button class="submit">Cancel</button></a>
            </div>
        </div>
    </body>
</html>
