<?php
$db=new mysql("localhost", "slumlords", "aD3slum");
if($db->connect_errno !== 0) {
	exit("Unable to connect to database: ".$db->connect_error);
}
echo "Connected";
$db->close();
?>
