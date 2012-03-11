<?php
define("IN_PHP", true);
require_once('includes/config.php');
	require_once('includes/classes/Mysql.php');
	require_once('includes/classes/DBTreeManager.php');
	$db = new MySQL($dbHost, $dbUsername, $dbPassword, $dbName);	
	$treeManager = new DBTreeManager($db);
	
	if(isset($_POST['id']) && is_numeric($_POST['id']))
	{
		$out = $treeManager->setDefault($_POST['id']);
		if($out) echo $_POST['id'];
	}
?>