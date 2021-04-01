<?php
    class DB {
        private static $_instance = null;
        private $_pdo,
                $_query,
                $_error = false ,
                $_result,
                $_count = 0;

        private function __construct() {
            try {
                $this->_pdo = new PDO (
                    'mysql:host='.config::get('mysql/host').'; dbname=' . config::get('mysql/db') ,
                     config::get('mysql/username') ,config::get('mysql/password')) ;
            } catch(PDOException $e) {
                die($e->getMessage());
            }
        }

        public static function getInstance() {
            if(!isset(self::$_instance)) {
                self::$_instance = new DB();
            }
            return self::$_instance;
        }

        public function query($sql, $params = array()) {
            $this->_error = false;
            if($this->_query = $this->_pdo->prepare($sql)){
                $count = 1;
                if(count($params)) {
                    foreach($params as $param) {
                        $this-> _query->bindValue($count, $param);
                        $count++;
                    }
                }
                if($this->_query->execute()) {
                    $this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
                    $this->_count =  $this->_query->rowCount();
                  
                } else {
                    $this->_error = true;
                }
            }
            return  $this;
        }

        private function filter($filter, $table, $where = array()){
            /*
                check if the field have 3 values
                Example ('users', array('username', '=' , 'jheave')); 
            */
            if(count($where) === 3) { 
                $operators = array('=', '<', '>', '>=', '<=');
                $field = $where[0];
                $operator = $where[1];
                $value = $where[2];

                if(in_array($operator, $operators)){
                    $sql = "{$filter} FROM {$table} WHERE {$field} {$operator} ?";
                    if(!$this->query($sql, array($value))->error()){
                        return $this;

                    }
                }
            }
        }
        public function get($table, $where){
            return $this->filter("SELECT *", $table, $where);
        }
        
        public function delete($table, $where){
            return $this->filter("DELETE *", $table, $where);
        }

        public function count(){
            return  $this->_count;
        }

        public function error() {
            return  $this->_error;
        }

    }
?>
