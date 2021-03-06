<?php
    class User {
        private $_db, $_data, $_sessionname;


        public function __construct($user = null) {
            $this->_db = DB::getInstance();
            $this->_sessionname = Config::get('session/session_name');

        }

        public function create($fields = array()) {
            if(!$this->_db->insert('users', $fields)){
                throw new Exception('there was an error');
            }
        }
        public function find($user = null) {
	    if($user){
		    $field = (is_numeric($user)) ? 'id' : 'username';
		    $data = $this->_db->get('user', array($field, '=', $user));

		if($data->count()) {
			$this->_data = $data->first();
			return true;
		}

	}
    return false;
}
        public function login($username =null , $password = null) {
        	$user = $this->find($username);
            	if($user){
	        if($this->data()->password === Hash::make($password, $this->data()->salt))
            {
		Session::put($this->_sessionname, $this->data()->id);
		return true;
	}
}



	                return false;
	    }
        private function data() {
                return $this->_data;
        }
}

?>
