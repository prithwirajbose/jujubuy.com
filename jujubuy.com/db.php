<?php
function connectDb() {
$dbconn = mysqli_connect("localhost","root","9883246001");
mysqli_select_db($dbconn, "electronicsdb");
return $dbconn;
}

function closeDb($dbconn) {
	mysqli_close($dbconn);
}
?>