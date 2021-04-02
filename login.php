<?php
    if(Input::exists()){
	if(Token::check(Input::get('token'))){

		$validate = new Validate();
		$validation = $validate->check(array(
			'username' => array('required' => true),
			'password' => array('required' => true)
		));

		if($validation->passed) {
			$user = new User();
			$login = $user->login(Input::get('username'), Input::get('password'));

			if($login){
				echo 'success';
			} else {
				echo '<p>sorry,logging in failed.</p>';
            }
		} else {
		   foreach($validation->errors() as $error){
			echo $error, '<br>';
			}
		}
	}
}


