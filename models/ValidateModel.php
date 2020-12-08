<?php
    class ValidateModel extends Model implements Reader {
        public function find(array $id, string $table="MedicalPersonnel"): array {
            // query db for username (role firstname lastname) and pass pair (already validated by checkLogin / js)
            $tokens = explode(" ", $id["username"]);
            if (count($tokens) < 3)
                return ["error" => "Invalid username - Use your Role Fname Lname"];
            if (count($tokens) > 3) {
                $tokens[0] .= " " . $tokens[1];
                $tokens[1] = $tokens[2];
                $tokens[2] = $tokens[3];
            }

            $query_str = "SELECT Pass
                        FROM " . $table . "
                        WHERE FirstName = '{$tokens[1]}'
                        AND LastName = '{$tokens[2]}'
                        AND Role = '{$tokens[0]}';";
            
            if($result = $this->sqli->query($query_str)) {
                if($result->num_rows <> 1)
                    return ["error" => "Invalid username and password combination"];
                else {
                    if (password_verify($id["pass"], $result->fetch_assoc()["Pass"]))
                        return ["Success" => true];
                    else return ["error" => "Invalid password"];
                }
            } else
                return ["error" => "Database query error: " . $this->sqli->error];
        }

        public function findAll(array $ids): array {
            return [];
        }

        public function findLimit(array $id, string $offset, string $range): array { return [];}
        public function findAllLimit(array $ids, string $offset, string $range): array { return []; }
        public function count(string $table): array { return null; }
    }
?>