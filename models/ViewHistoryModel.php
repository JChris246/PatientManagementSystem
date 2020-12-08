<?php
    class ViewHistoryModel extends Model implements Reader, Writer, Deleter {

        public function find(array $id, $table): array {
            $id_name = ($table == "FamilyHistory") ? "FamilyID" : "HistoryID";
            $query_str = "SELECT * FROM " . $table . " WHERE ";
            
            foreach ($id as $key => $val)
                $query_str .= $key . " = '" . $val . "' AND ";
            $query_str = substr($query_str, 0, strlen($query_str) - 4);
            $query_str .= " ORDER BY " . $id_name . " DESC";

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

        public function findLimit(array $id, string $table, string $offset, string $range): array {
            $id_name = ($table == "FamilyHistory") ? "FamilyID" : "HistoryID";
            $query_str = "SELECT * FROM " . $table . " WHERE ";
            
            foreach ($id as $key => $val)
                $query_str .= $key . " = '" . $val . "' AND ";
            $query_str = substr($query_str, 0, strlen($query_str) - 4);
            $query_str .= " ORDER BY " . $id_name . " DESC";
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

        private function getUniqueID($current_id, $id_name, $table) {
            while (count($this->find([$id_name => $current_id], $table)) > 0)
                $current_id++;
            return $current_id;
        }

        public function add(array $fields, $table) {
            $id_name = ($table == "FamilyHistory") ? "FamilyID" : "HistoryID";

            // make sure that the id suggested doesnt already exist
            $fields[$id_name] = $this->getUniqueID($fields[$id_name], $id_name, $table);

            $query_str = "INSERT INTO " . $table . " (" . $id_name . ", NationalID, Issue)";
            $query_str .= " VALUES ('" . $fields[$id_name] . "', '" . $fields["NationalID"] . "', 
                        '" . $fields["Issue"] . "')";

            if (!$result = $this->sqli->query($query_str)) 
                return ["error" => "Database query error: " . $this->sqli->error];
            else return ["success" => true];
        }

        public function del(array $ids, string $table) {
            $id_name = ($table == "FamilyHistory") ? "FamilyID" : "HistoryID";

            $query_str = "DELETE FROM " . $table . "
                        WHERE NationalID = '" . $ids["NationalID"] . "'
                        AND ". $id_name ." = '" . $ids[$id_name] . "'";

            if (!$result = $this->sqli->query($query_str)) 
                return ["error" => "Database query error: " . $this->sqli->error];
            else return ["success" => "Successfully deleted history item from patient with National ID: " . $ids['NationalID'] . " and history id: " . $ids[$id_name]];
        }
    }
?>