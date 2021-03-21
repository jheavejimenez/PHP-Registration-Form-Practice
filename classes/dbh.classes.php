<?php
    class Dbh {
        private $host;
        private $user;
        private $pwd;
        private $dbName;

        protected function connect() {
           $this->host  = "localhost";
           $this->user  = "root";
           $this->pwd  = "";
           $this->dbName  = "";

           $conn = new mysqli($this->host, $this->user,
                $this->pwd, $this->dbName);
            return $conn;
        }
    }
?>