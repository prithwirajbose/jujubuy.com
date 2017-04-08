<?php
function connectDb() {
$dbconn = mysqli_connect("localhost","root","9883246001") or die(mysqli_error());
mysqli_select_db($dbconn, "jujubuy") or die(mysqli_error($dbconn));
return $dbconn;
}

function closeDb($dbconn) {
	mysqli_close($dbconn);
}
?>