<?php
    class ViewNotesModel extends Model implements Reader, Writer, Deleter {
        private $attrs = ["NoteID", "NationalID", "Note", "EntryTime", "LastEdit", "Author", "LastAuthor"];

        private function getPersonnelInfo($personnelid, array $existing) : array {
            $query_str = "SELECT Role, FirstName, LastName FROM MedicalPersonnel 
                        WHERE PersonnelID = " . $personnelid;

            if (in_array($personnelid, $existing))
                return $existing;
            else {
                if($result = $this->sqli->query($query_str)) {
                    $result = $result->fetch_assoc();
                    $info = $result["Role"] . " " . $result["FirstName"] . " " . $result["LastName"];
                    $existing += [$personnelid => $info];
                } else
                    $existing += [$personnelid => "-"];
                return $existing;
            }
        }

        public function find(array $id, $table="Note", $skip=false): array {
            $query_str = "SELECT * FROM ". $table ." WHERE ";
            
            foreach ($id as $key => $val)
                $query_str .= $key . " = '" . $val . "' AND ";
            $query_str = substr($query_str, 0, strlen($query_str) - 4);
            $query_str .= " ORDER BY EntryTime DESC";

            if($result = $this->sqli->query($query_str)) {
                $results = [];
                // this list should get too long given a single patient shouldnt have more than 20 officials assigned
                // therefore instead of querying the database (containing potientially 1000s of personnel)
                // for each note to find the personnel id, query this array instead
                $ids = [];
                for($i = 0; $row = $result->fetch_assoc(); $i++) {
                    $results += [$i => $row];
                    if (!$skip) {
                        $ids = $this->getPersonnelInfo($results[$i]["Author"], $ids);
                        $results[$i]["Author"] = $ids[$results[$i]["Author"]]; // replace id with actual info
                        $ids = $this->getPersonnelInfo($results[$i]["LastAuthor"], $ids);
                        $results[$i]["LastAuthor"] = $ids[$results[$i]["LastAuthor"]]; // replace id with actual info
                    }
                }
                return $results;
            } else
                return ["error" => "Database query error: " . $this->sqli->error];
        }
        
        public function findAll(array $ids): array { }
        public function findAllLimit(array $id, string $offset, string $range): array { }

        public function findLimit(array $id, string $offset, string $range): array {
            $query_str = "SELECT * FROM Note WHERE ";
            
            foreach ($id as $key => $val)
                $query_str .= $key . " = '" . $val . "' AND ";
            $query_str = substr($query_str, 0, strlen($query_str) - 4);
            $query_str .= " ORDER BY EntryTime DESC";
            $query_str .= " LIMIT ". $offset . ", " .$range;

            if($result = $this->sqli->query($query_str)) {
                $results = [];
                // this list should get too long given a single patient shouldnt have more than 20 officials assigned
                // therefore instead of querying the database (containing potientially 1000s of personnel)
                // for each note to find the personnel id, query this array instead
                $ids = [];
                for($i = 0; $row = $result->fetch_assoc(); $i++) {
                    $results += [$i => $row];
                    $ids = $this->getPersonnelInfo($results[$i]["Author"], $ids);
                    $results[$i]["Author"] = $ids[$results[$i]["Author"]]; // replace id with actual info
                    $ids = $this->getPersonnelInfo($results[$i]["LastAuthor"], $ids);
                    $results[$i]["LastAuthor"] = $ids[$results[$i]["LastAuthor"]]; // replace id with actual info
                }
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

        private function getUniqueID($current_id) {
            while (count($this->find(["NoteID" => $current_id], "Note", true)) > 0)
                $current_id++;
            return $current_id;
        }

        public function add(array $fields, $table="Note") {
            // make sure that the id suggested doesnt already exist
            $fields["NoteID"] = $this->getUniqueID($fields["NoteID"]);

            $query_str = 'INSERT INTO ' . $table . ' (';
            for($i = 0; $i < count($this->attrs); $i++)
                $query_str .= $this->attrs[$i] . ", ";
            $query_str = substr($query_str, 0, strlen($query_str) - 2);
            
            $query_str .= ') VALUES (';
            
            for($i = 0; $i < count($this->attrs); $i++)
                $query_str .= '"' . $fields[$this->attrs[$i]] . '" , ';
            $query_str = substr($query_str, 0, strlen($query_str) - 2);

            $query_str .= ')';

            if (!$result = $this->sqli->query($query_str)) 
                return ["error" => "Database query error: " . $this->sqli->error];
            else return ["success" => true];
        }

        public function del(array $ids, string $table="Note") {
            $query_str = "DELETE FROM " . $table . " 
                        WHERE NationalID = '" . $ids["NationalID"] . "'
                        AND NoteID = '" . $ids["NoteID"] . "'";

            if (!$result = $this->sqli->query($query_str)) 
                return ["error" => "Database query error: " . $this->sqli->error];
            else return ["success" => "Successfully deleted patient note with National ID: " . $ids['NationalID'] . " and note id: " . $ids["NoteID"]];
        }
    }
?>