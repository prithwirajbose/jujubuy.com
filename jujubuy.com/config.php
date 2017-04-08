<?php
if(!isset($_SESSION)) {
	session_start();
}
if(empty($_SESSION['defaults'])) {
	$_SESSION['defaults'] = [
			'pagesize'=>10
	];
}

$config = array(
		'site' => 'http://localhost/jujubuy.com/jujubuy.com'
);
?>