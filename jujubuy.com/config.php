<?php
ini_set("date.timezone","Asia/Kolkata");
//error_reporting(E_STRICT);
ini_set("display_errors", "false");
ini_set("error_log", "C:/xampp/htdocs/jujubuy.com/jujubuy.com/logs/phperrors.".date('Ymd').".log");
date_default_timezone_set("Asia/Kolkata");

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
