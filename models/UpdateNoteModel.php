<?php
    class UpdateNoteModel extends Model implements Updater, Reader {
        private $numbers = ["Author", "LastAuthor"];

        public function update(array $fields, string $table) {
            $query_str = "UPDATE " . $table ." SET ";
            foreach($fields as $key => $value) {
                if (in_array($key, $this->numbers))
                    $query_str .= $key . ' = ' . $value . ', ';
                else $query_str .= $key . ' = "' . $value . '", ';
            }

            $query_str = substr($query_str, 0, strlen($query_str) - 2);
            $query_str .= " WHERE NationalID = '" . $fields["NationalID"] . "'
                            AND NoteID = '". $fields["NoteID"] . "'";

            echo $query_str;

            if (!$result = $this->sqli->query($query_str))
                return "Database query error: " . $this->sqli->error;
            else return "success";
        }

        public function find(array $id, string $table="Note"): array {
            $query_str = "SELECT * FROM ". $table ." WHERE ";
            
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