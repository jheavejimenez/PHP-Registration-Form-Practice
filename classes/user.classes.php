<?php
    class User extends Dbh {
        protected function getAllUsers() {
            $sql = "SELECT * FROM user";
            $result = $this->connect()->query($sql);
        }
    }
?>