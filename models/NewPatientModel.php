<?php
    class NewPatientModel extends Model implements Writer, Reader {
        private $attrs = ["NationalID", "Sex", "FirstName", "LastName", "OtherNames", "HospitalRegNo",
        "DOB", "NextOfKin", "Occupation", "Address", "Diagnosis", "Temperature", "Pulse", "Respiration",
        "BloodPressure", "SpO2", "Investigations", "TreatmentPlan", "Symptoms", "PresentingProblems",
        "AdmissionDate", "MaritalStatus"];

        public function add(array $fields, $table="Patient") {
            $query_str = "INSERT INTO " . $table . " (";
            for($i = 0; $i < count($this->attrs); $i++)
                $query_str .= $this->attrs[$i] . ", ";
            $query_str = substr($query_str, 0, strlen($query_str) - 2);
            
            $query_str .= ") VALUES (";
            
            for($i = 0; $i < count($this->attrs); $i++)
                $query_str .= "'" . $fields[$this->attrs[$i]] . "' , ";
            $query_str = substr($query_str, 0, strlen($query_str) - 2);

            $query_str .= ")";

            if (!$result = $this->sqli->query($query_str)) 
                return ["error" => "Database query error: " . $this->sqli->error];
            else return ["success" => true];
        }

        public function addDoctor(array $fields, $table="AssignedOfficial") {
            $query_str = "INSERT INTO " . $table ." (NationalID, PersonnelID) 
                        VALUES ('" . $fields['NationalID'] ."', '". $fields['PersonnelID'] . "')";

            if($result = $this->sqli->query($query_str))
                return ["Success" => "Added"];
            else return ["error" => "Database query error 2: " . $this->sqli->error];
        }

        public function find(array $id, string $table="Patient"): array {
            $query_str = "SELECT * FROM " . $table . " WHERE ";
            
            foreach ($id as $key => $val)
                $query_str .= $key . " = '" . $val . "' AND ";
            $query_str = substr($query_str, 0, strlen($query_str) - 4);

            if($result = $this->sqli->query($query_str)) {
                $results = [];
                for($i = 0; $row = $result->fetch_assoc(); $i++)
                    $results += [$i => $row];
                return $results;
            } else
                return ["error" => "Database query error: " . $this->sqli->error];
        }

        public function findAll(array $ids): array { }

        public function findAllLimit(array $id, string $offset, string $range): array { }

        public function count(string $table): array { }
    }
?>