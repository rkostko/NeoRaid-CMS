<?php
include_once("connect_db.php");

$action                 = $_POST['action'];
$updateRecordsArray     = $_POST['image'];
$msg = '';
if ($action == "updateRecordsListings")
{
	$listingCounter = 1;	
	foreach ($updateRecordsArray as $recordIDValue) 
	{
		$query = "UPDATE images SET position = " . $listingCounter . " WHERE id = " . $recordIDValue;
		mysql_query($query, $link) or die('Error, insert query failed');	
		$listingCounter++;
		$msg .=	$query."; \n";
	}
}
//echo $msg;
?>