<?php
    class ViewPatientDoctorModel extends Model implements Reader, Writer, Deleter {
        public function find(array $id, $table="AssignedOfficial"): array {
            $query_str ="SELECT MedicalPersonnel.FirstName, MedicalPersonnel.LastName, MedicalPersonnel.Role 
                        FROM AssignedOfficial, MedicalPersonnel
                        WHERE NationalID = '" . $id['NationalID'] . "' 
                        And MedicalPersonnel.PersonnelID = AssignedOfficial.PersonnelID
                        ORDER BY MedicalPersonnel.FirstName";

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

        public function findLimit(array $id, string $offset, string $range): array {
            $query_str ="SELECT MedicalPersonnel.FirstName, MedicalPersonnel.LastName, MedicalPersonnel.Role 
                        FROM AssignedOfficial, MedicalPersonnel
                        WHERE NationalID = '" . $id . "' 
                        And MedicalPersonnel.PersonnelID = AssignedOfficial.PersonnelID
                        ORDER BY MedicalPersonnel.FirstName";
            $query_str .= " LIMIT ". $offset . ", " .$range;

            if($result = $this->sqli->query($query_str)) {
                $results = [];
                for($i = 0; $row = $result->fetch_assoc(); $i++)
                    $results += [$i => $row];
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

        public function add(array $fields, $table="AssignedOfficial") {
            $query_str = "SELECT PersonnelID FROM MedicalPersonnel 
                        WHERE MedicalPersonnel.Role = '{$fields["Role"]}'
                        AND MedicalPersonnel.FirstName = '{$fields["FirstName"]}'
                        AND MedicalPersonnel.LastName = '{$fields["LastName"]}'";

            if($result = $this->sqli->query($query_str)) {
                $id = $result->fetch_assoc();
                if (empty($id)) // No doctor with this description exists
                    return ["error" => "Couldn't find Medical Personnel by that description in the System"];
                else {
                    $query_str = "INSERT INTO " . $table ." (NationalID, PersonnelID) 
                                VALUES ('" . $fields['NationalID'] ."', '". $id['PersonnelID'] . "')";
                    if($result = $this->sqli->query($query_str))
                        return ["Success" => "Added"];
                    else return ["error" => "Database query error 2: " . $this->sqli->error];
                }
            } else
                return ["error" => "Database query error: " . $this->sqli->error];
        }

        public function del(array $ids, string $table="AssignedOfficial") {
            $query_str = "SELECT PersonnelID FROM MedicalPersonnel 
                        WHERE MedicalPersonnel.Role = '{$ids["Role"]}'
                        AND MedicalPersonnel.FirstName = '{$ids["FirstName"]}'
                        AND MedicalPersonnel.LastName = '{$ids["LastName"]}'";

            if($result = $this->sqli->query($query_str)) {
                $id = $result->fetch_assoc();
                if (empty($id)) // No doctor with this description exists
                    return ["error" => "Couldn't find Medical Personnel Id"];
                else {
                    $query_str = "DELETE FROM " . $table . "
                                WHERE PersonnelID = '" . $id['PersonnelID'] ."' AND
                                NationalID = '". $ids["NationalID"] ."'";
                    if($result = $this->sqli->query($query_str))
                        return ["Success" => "Removed"];
                    else return ["error" => "Database query error 2: " . $this->sqli->error];
                }
            } else return ["error" => "Database query error: " . $this->sqli->error];
        }
    }
?>