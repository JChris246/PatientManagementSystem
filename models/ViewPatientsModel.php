<?php
    class ViewPatientsModel extends Model implements Reader {
        public function find(array $id, string $table): array {
            $query_str = "SELECT * FROM " . $table ." WHERE ";
            
            foreach ($id as $key => $val)
                $query_str .= $key . " = '" . $val . "' AND ";
            $query_str = substr($query_str, 0, strlen($query_str) - 4);

            return $this->runComand($query_str);
        }

        public function findLimit(array $id, string $offset, string $range): array {
            $query_str = "SELECT * FROM Patient WHERE ";
            
            foreach ($id as $key => $val)
                $query_str .= $key . " = '" . $val . "' AND ";
            $query_str = substr($query_str, 0, strlen($query_str) - 4);
            $query_str .= " LIMIT ". $offset . ", " .$range;

            return $this->runComand($query_str);
        }

        public function findRegex(array $id, string $table): array {
            $query_str = "SELECT * FROM " . $table ." WHERE ";
            
            foreach ($id as $key => $val) {
                if (in_array($key, regexQualified))
                    $query_str .= $key . " LIKE '%" . $val . "%' AND ";
                else $query_str .= $key . " = '" . $val . "' AND ";
            }
            $query_str = substr($query_str, 0, strlen($query_str) - 4);

            return $this->runComand($query_str);
        }

        public function findRegexLimit(array $id, string $offset, string $range): array {
            $query_str = "SELECT * FROM Patient WHERE ";
            
            foreach ($id as $key => $val) {
                if (in_array($key, regexQualified))
                    $query_str .= $key . " LIKE '%" . $val . "%' AND ";
                else $query_str .= $key . " = '" . $val . "' AND ";
            }

            $query_str = substr($query_str, 0, strlen($query_str) - 4);
            $query_str .= " LIMIT ". $offset . ", " .$range;

            return $this->runComand($query_str);
        }

        private function runComand($query_str) : array {
            if($result = $this->sqli->query($query_str)) {
                $results = [];
                for($i = 0; $row = $result->fetch_assoc(); $i++)
                    $results += [$i => $row];
                return $results;
            } else
                return ["error" => "Database query error: " . $this->sqli->error];
        }

        // query db for all patients assigned to specifc doctor
        public function findAllAssigned(array $id): array {
            $getPersonelID = "(SELECT PersonnelID FROM MedicalPersonnel 
                        WHERE MedicalPersonnel.Role = '{$id["Role"]}'
                        AND MedicalPersonnel.FirstName = '{$id["FirstName"]}'
                        AND MedicalPersonnel.LastName = '{$id["LastName"]}')";

            // if($result = $this->sqli->query($query_str)) {
                // $PersonnelId = $result->fetch_assoc()["PersonnelID"];
                $query_str = "SELECT Patient.NationalID, Sex, Patient.FirstName, Patient.LastName, OtherNames, HospitalRegNo, DOB
                        FROM Patient, AssignedOfficial
                        WHERE AssignedOfficial.PersonnelID = " . $getPersonelID . "
                        AND Patient.NationalID = AssignedOfficial.NationalID
                        ORDER BY Patient.LastName";

                if($result = $this->sqli->query($query_str)) {
                    $results = [];
                    for($i = 0; $row = $result->fetch_assoc(); $i++)
                        $results += [$i => $row];
                    return $results;
                } else
                    return ["error" => "Database query error: " . $this->sqli->error];
            // } else
               // return ["error" => "Database query error: " . $this->sqli->error];
        }
        
        public function findAll(array $ids): array {
            // query db for all patients
            $query_str = "SELECT NationalID, Sex, FirstName, LastName, OtherNames, HospitalRegNo, DOB
                        FROM Patient
                        ORDER BY LastName";
            
            return $this->runComand($query_str);
        }

        // query db for all patients assigned to specifc doctor...return only range amount from offset
        public function findAllAssignedLimit(array $id, string $offset, string $range): array {
            $getPersonelID = "(SELECT PersonnelID FROM MedicalPersonnel 
                        WHERE MedicalPersonnel.Role = '{$id["Role"]}'
                        AND MedicalPersonnel.FirstName = '{$id["FirstName"]}'
                        AND MedicalPersonnel.LastName = '{$id["LastName"]}')";

            // if($result = $this->sqli->query($query_str)) {
                // $PersonnelId = $result->fetch_assoc()["PersonnelID"];
                $query_str = "SELECT Patient.NationalID, Sex, Patient.FirstName, Patient.LastName, OtherNames, HospitalRegNo, DOB
                        FROM Patient, AssignedOfficial
                        WHERE AssignedOfficial.PersonnelID = " . $getPersonelID . "
                        AND Patient.NationalID = AssignedOfficial.NationalID
                        ORDER BY Patient.LastName
                        LIMIT ". $offset . ", " .$range;

                if($result = $this->sqli->query($query_str)) {
                    $results = [];
                    for($i = 0; $row = $result->fetch_assoc(); $i++)
                        $results += [$i => $row];
                    return $results;
                } else
                    return ["error" => "Database query error: " . $this->sqli->error];
            // } else
               // return ["error" => "Database query error: " . $this->sqli->error];
        }

        public function findAllLimit(array $ids, string $offset, string $range): array {
            // query db for all patients...return only range amount from offset
            $query_str = "SELECT NationalID, Sex, FirstName, LastName, OtherNames, HospitalRegNo, DOB
                        FROM Patient
                        ORDER BY LastName
                        LIMIT " . $offset . ", " .$range;
            
            if($result = $this->sqli->query($query_str)) {
                $results = [];
                for($i = 0; $row = $result->fetch_assoc(); $i++)
                    $results += [$i => $row];
                return $results;
            } else
                return ["error" => "Database query error: " . $this->sqli->error];

            return $this->runComand($query_str);
        }

        public function getField(string $field) : array {
            $query_str = "SELECT " .  $field . " FROM " . $table;

            if($result = $this->sqli->query($query_str)) {
                $results = [];
                for($i = 0; $row = $result->fetch_assoc(); $i++)
                    $results += [$i => $row[$field]];
                return $results;  
            } else
                return ["error" => "Database query error: " . $this->sqli->error];
        }

        public function count(string $table): array {
            $query_str = "SELECT COUNT(*) FROM " . $table;

            if($result = $this->sqli->query($query_str))
                return $result->fetch_assoc();
            else
                return ["error" => "Database query error: " . $this->sqli->error];
        }
    }
?>