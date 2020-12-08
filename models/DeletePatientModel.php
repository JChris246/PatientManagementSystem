<?php
    class DeletePatientModel extends Model implements Deleter {
        public function del(array $id, string $table="Patient") {
            $query_strs = [];

            //delete patient notes, assigned personnel, history, family history
            array_push($query_strs, "DELETE FROM Note WHERE NationalID ='" . $id['NationalID'] . "'");
            array_push($query_strs, "DELETE FROM FamilyHistory WHERE NationalID ='" . $id['NationalID'] . "'");
            array_push($query_strs, "DELETE FROM PatientHistory WHERE NationalID ='" . $id['NationalID'] . "'");
            array_push($query_strs, "DELETE FROM AssignedOfficial WHERE NationalID ='" . $id['NationalID'] . "'");
            array_push($query_strs, "DELETE FROM " . $table ." WHERE NationalID ='" . $id['NationalID'] . "'");

            for($i = 0; $i < count($query_strs); $i++)
                if (!$result = $this->sqli->query($query_strs[$i])) 
                    return "Database query error". $i .": " . $this->sqli->error;
            return "Successfully deleted patient with National ID: " . $id['NationalID'];
        }
    }
?>