<?php 

    class Model {
        protected $sqli;

        public function __construct(string $user, string $pass, string $db, string $host) {
            $this->sqli = new mysqli($host, $user, $pass, $db);
        }
    }
?>