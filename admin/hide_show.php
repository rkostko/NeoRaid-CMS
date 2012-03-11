<?php
define("IN_PHP", true);
    require_once('includes/config.php');
	require_once('includes/classes/Mysql.php');
	require_once('includes/classes/DBTreeManager.php');
	$db = new MySQL($dbHost, $dbUsername, $dbPassword, $dbName);	
	$treeManager = new DBTreeManager($db);
	
	if(isset($_POST['id']) && is_numeric($_POST['id']))
	{
		$id     = $_POST['id'];
		$action = $_POST['action'];
		$visible = ($action == "hide")? 0 : 1;
		$out = $treeManager->imageShowHide($id, $visible);
		echo $out;
	}
?>