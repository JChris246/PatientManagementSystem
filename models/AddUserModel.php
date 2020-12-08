<?php
    class AddUserModel extends Model implements Writer {
        private $attrs = ["Role", "FirstName", "LastName", "Pass"];

        public function add(array $fields, $table="MedicalPersonnel") {
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
    }
?>