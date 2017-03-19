<?php
require_once 'db.php';
header("Content-type","application/json");
if(!empty($_REQUEST['action'])) {
	$resp = array();
	$actionFunc = $_REQUEST['action'];
	try {
		$obj = $actionFunc();
		$resp['success'] = true;
		$resp['data'] = $obj;
	}
	catch (Exception $e) {
		$resp['success'] = false;
		$resp['error'] = $e->getMessage();
	}
	echo json_encode($resp);
}
else {
	$resp = array();
	$resp['success'] = false;
	$resp['error'] = "Missing required parameter";
	echo json_encode($resp);
}

function listComponents() {
	$arr = array();
	$conn = connectDb();
	$q = "'%" . mysqli_real_escape_string($conn, strtolower($_REQUEST['q'])) . "%'";
	$data = mysqli_query($conn, "select component_name from components where lower(component_number) like ".$q
			." or lower(component_value) like ".$q." or lower(component_name) like ".$q." or lower(component_desc) like ".$q
			." or lower(component_ref_text) like ".$q." or lower(keywords) like ".$q." order by search_score desc, "
			." component_name asc limit 0,10") or die(mysqli_error($conn));
	if(mysqli_num_rows($data)>0) {
		while($row = mysqli_fetch_assoc($data)) {
			array_push($arr, $row['component_name']);
		}
	}
	return $arr;
}
?>