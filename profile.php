<?php
require_once 'core/init.php';

if(session::exists('success'))
{
	echo session::flash('successs');
}
?>
