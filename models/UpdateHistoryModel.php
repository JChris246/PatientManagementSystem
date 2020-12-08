<?php
    class UpdateHistoryModel extends Model implements Updater, Reader {
        public function update(array $fields, string $table) {
            $id_name = ($table == "FamilyHistory") ? "FamilyID" : "HistoryID";

            $query_str = "UPDATE " . $table ." SET ";
            foreach($fields as $key => $value)
                $query_str .= $key . ' = "' . $value . '", ';

            $query_str = substr($query_str, 0, strlen($query_str) - 2);
            $query_str .= " WHERE NationalID = '" . $fields["NationalID"] . "'
                            AND " . $id_name . " = '". $fields[$id_name] . "'";

            echo $query_str;

            if (!$result = $this->sqli->query($query_str))
                return "Database query error: " . $this->sqli->error;
            else return "success";
        }

        public function find(array $id, string $table): array {
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