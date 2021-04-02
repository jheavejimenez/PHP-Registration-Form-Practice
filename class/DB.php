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
                $x = 1;
                if(count($params)) {
                    foreach($params as $param) {
                        $this-> _query->bindValue($x, $param);
                        $x++;
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
                $fields = $where[0];
                $operator = $where[1];
                $values = $where[2];

                if(in_array($operator, $operators)){
                    $sql = "{$filter} FROM {$table} WHERE {$fields} {$operator} ?";
                    if(!$this->query($sql, array($values))->error()){
                        return $this;

                    }
                }
            }
            return false;
        }
        public function get($table, $where){
            return $this->filter("SELECT *", $table, $where);
        }

        public function delete($table, $where){
            return $this->filter("DELETE *", $table, $where);
        }

        public function insert($table, $fields = array()){
             $keys = array_keys($fields);
             $values = '';
             $x = 1;
             foreach($fields as $field){
                 $values .= '?';
                 if($x < count($fields)){
                     $values .=', ';
                 }
                 $x++;
             }
             $sql = "INSERT INTO users (`" .implode('`, `', $keys). "`) VALUES ({$values})";
             if(!$this->query($sql, $fields)->error()){
                 return true;
             }
             return false;

        }

        public function update($table, $id, $fields){
            $set = '';
            $x = 1;

            foreach($fields as $name => $value){
                $set .= "{$name} = '$value' ";
                if($x < count($fields)) {
                    $set .= ', ';
                }
                $x++;
            }
            
            $sql = "UPDATE {$table} SET {$set} WHERE  id = {$id}";
            echo $sql;
            if(!$this->query($sql, $fields)->error()){
                return true;
            }
            return false;
           
        }

        public function results()
        {
            return $this->_results;
        }

        public function first()
        {
            return $this->results()[0];
        }

        public function count(){
            return  $this->_count;
        }

        public function error() {
            return  $this->_error;
        }

    }
?>
