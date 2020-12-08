<!doctype html>
<html lang="en">
    <head>
        <title>Patient Management System - Edit Patient</title>
        <meta charset="utf-8">
		<meta name="description" content="ElectroHealth Management System - Edit Patient">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/colors.css">
        <link rel="stylesheet" href="css/buttons.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/panels.css">
        <script type="text/javascript" src="js/interaction.js"></script>
    </head>
    <body class="heartBg">
        <div class="center_text text_color center pagebg">
            <button class="toggle" id="toggleMenu">
                <div class="" id="menu">
                    <div class="hamburger bluebg"></div>
                    <div class="hamburger bluebg"></div>
                    <div class="hamburger bluebg"></div>
                </div>
            </button>
            <div id="header">
                <h1 class="blue">Edit Patient</h2>
            </div>
            <div id="content2">
                <?php require(TEMPLATE_DIR . "/sidebar_template.php"); // old habits ?>
                <form method="post" action="updatePatient.php">
                    <?php
                        echo "<span class='tag'>National ID: </span><input name='NationalID' value='".$patient["NationalID"]."' readonly><br/>";
                        echo '<span class="tag">First Name: </span><input type="text" name="FirstName" placeholder="First Name" value="'; if (isset($patient)) echo $patient["FirstName"]; echo '"><span class="red" id="fErr">'; if (isset($error["FirstName"]) && $error["FirstName"]) echo "Invalid First Name"; echo '</span><br/>';
                        echo '<span class="tag">Last Name: </span><input type="text" name="LastName" placeholder="Last Name" value="'; if (isset($patient)) echo $patient["LastName"]; echo '"><span class="red" id="lErr">'; if (isset($error["LastName"]) && $error["LastName"]) echo "Invalid Last Name"; echo '</span></br>';
                        echo '<span class="tag">Other Names: </span><input type="text" name="OtherNames" placeholder="Other Names" value="'; if (isset($patient)) echo $patient["OtherNames"]; echo '"><span class="red" id="eErr">'; if (isset($error["OtherNames"]) && $error["OtherNames"]) echo "Invalid Value for other names"; echo '</span></br>';
                        echo '<span class="tag">Hospital Registration No: </span><input type="text" name="HospitalRegNo" placeholder="Hospital Registration Number"  value="'; if (isset($patient)) echo $patient["HospitalRegNo"]; echo '"><span class="red" id="hosErr">'; if (isset($error["HospitalRegNo"]) && $error["HospitalRegNo"]) echo "Invalid Hospital Registration Number"; echo '</span></br>';
                        echo '<span class="tag">Next of Kin: </span><input type="text" name="NextOfKin" placeholder="Next of kin" value="'; if (isset($patient)) echo $patient["NextOfKin"]; echo '"><span class="red" id="kinErr">'; if (isset($error["NextOfKin"]) && $error["NextOfKin"]) echo "Invalid Name"; echo '</span></br>';
                        echo '<br/>Date of Birth: ';
                        echo '<input type="date" name="DOB" value="'; if (isset($patient)) echo $patient["DOB"]; echo '"><span class="red" id="DOBErr">'; if (isset($error["DOB"]) && $error["DOB"]) echo "Invalid Date of Birth"; echo '</span></br>';
                        echo '<span class="tag">Occupation: </span><input type="text" name="Occupation" placeholder="Occupation" value="'; if (isset($patient)) echo $patient["Occupation"]; echo '"><span class="red" id="occErr">'; if (isset($error["DOB"]) && $error["DOB"]) echo "Invalid value for Occupation"; echo '</span>';
                        echo '<textarea cols="18" rows="4" name="Address" placeholder="Address">'; if (isset($patient)) echo $patient["Address"]; echo '</textarea><span class="red" id="aErr">'; if (isset($error["Address"]) && $error["Address"]) echo "Invalid Address"; echo '</span>';
                        echo '<textarea cols="18" rows="4" placeholder="Presenting Problems" name="PresentingProblems">'; if (isset($patient)) echo $patient["PresentingProblems"]; echo '</textarea><span class="red" id="presErr">'; if (isset($error["PresentingProblems"]) && $error["PresentingProblems"]) echo "Invalid Value"; echo '</span>';
                        echo '<textarea cols="18" rows="4" placeholder="Symptoms" name="Symptoms">'; if (isset($patient)) echo $patient["Symptoms"]; echo '</textarea><span class="red" id="symErr">'; if (isset($error["Symptoms"]) && $error["Symptoms"]) echo "Invalid Value"; echo '</span>';
                        echo '<p><b>Vital Signs</b></p><table class="inputs">';
                        echo '<tr><td>Temperature:</td><td><input type="number" step="0.01" name="Temperature" value="'; if (isset($patient)) echo $patient["Temperature"]; echo '"><span class="red" id="tempErr">'; if (isset($error["Temperature"]) && $error["Temperature"]) echo "Invalid Temperature value"; echo '</span></td></tr>';
                        echo '<tr><td>Pulse:</td><td><input type="number" name="Pulse" value="'; if (isset($patient)) echo $patient["Pulse"]; echo '"><span class="red" id="pulseErr">'; if (isset($error["Pulse"]) && $error["Pulse"]) echo "Invalid Pulse value"; echo '</span></td></tr>';
                        echo '<tr><td>Respiration:</td><td><input type="number" name="Respiration" value="'; if (isset($patient)) echo $patient["Respiration"]; echo '"><span class="red" id="respErr">'; if (isset($error["Respiration"]) && $error["Respiration"]) echo "Invalid Respiration value"; echo '</span></td></tr>';
                        echo '<tr><td>Blood Pressure:</td><td><input type="text" name="BloodPressure" value="'; if (isset($patient)) echo $patient["BloodPressure"]; echo '"><span class="red" id="bloodErr">'; if (isset($error["BloodPressure"]) && $error["BloodPressure"]) echo "Invalid Blood Pressure value"; echo '</span></td></tr>';
                        echo '<tr><td>S<sub>p</sub>O<sub>2</sub>:</td><td><input type="text" name="SpO2" value="'; if (isset($patient)) echo $patient["SpO2"]; echo '"><span class="red" id="SpO2Err">'; if (isset($error["SpO2"]) && $error["SpO2"]) echo "Invalid S<sub>p</sub>O<sub>2</sub> value"; echo '</span></td></tr>';
                        echo '</table>';
                        echo '<textarea cols="18" rows="4" placeholder="Investigations" name="Investigations">'; if (isset($patient)) echo $patient["Investigations"]; echo '</textarea><span class="red" id="investErr">'; if (isset($error["Investigations"]) && $error["Investigations"]) echo "Invalid Value"; echo '</span>';
                        echo '<textarea cols="18" rows="4" placeholder="Diagnosis" name="Diagnosis">'; if (isset($patient)) echo $patient["Diagnosis"]; echo '</textarea><span class="red" id="diagErr">'; if (isset($error["Diagnosis"]) && $error["Diagnosis"]) echo "Invalid Value"; echo '</span>';
                        echo '<textarea cols="18" rows="4" placeholder="Treatment Plan" name="TreatmentPlan">'; if (isset($patient)) echo $patient["TreatmentPlan"]; echo '</textarea><span class="red" id="treatErr">'; if (isset($error["TreatmentPlan"]) && $error["TreatmentPlan"]) echo "Invalid Value"; echo '</span>';
                        echo '<p></p>Admission Date: <input type="date" name="AdmissionDate" value="'; if (isset($patient)) echo $patient["AdmissionDate"]; echo '"><span class="red" id="AdmissionDateErr">'; if (isset($error["AdmissionDate"]) && $error["AdmissionDate"]) echo "Invalid date value"; echo '</span>'; 
                        echo '<br/>Admission Time: <input type="time" name="AdmissionTime" value="'; if (isset($patient)) echo $patient["AdmissionTime"]; echo '"><span class="red" id="AdmissionTimeErr">'; if (isset($error["AdmissionTime"]) && $error["AdmissionTime"]) echo "Invalid time value"; echo '</span></br>'; 
                        echo 'Marital Status: <br/><select name="MaritalStatus">';
                            echo '<option value="Married">Married</option><option value="Separated">Separated</option><option value="Widowed">Widowed</option><option value="Single">Single</option><option value="Divorced">Divorced</option>';
                        echo '</select>';
                        echo '<br/> Sex: <br/><select name="Sex">';
                            echo '<option value="male">Male</option><option value="female">Female</option>';
                        echo '</select><p></p>';
                        echo '<input type="hidden" name="newpatient" value="">';
                    ?>
                    <p></p>
                    <button class="submit">Save</button><p></p>
                </form>
                <a href='<?php echo "viewPatient.php?id=". $patient["NationalID"]; ?>'><button class="submit yellowbg">Cancel</button></a>
            </div>
        </div>
    </body>
</html>
