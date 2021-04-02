<?php
    class Hash {
        public static function make($string, $salt = '') {
            return hash('sha256', $string, $salt);

        }

        public function salt($lenght) {
           return bin2hex(random_bytes($lenght));

        }

        public function unique() {
           return self::make(uniqid());

        }
    }
?>
