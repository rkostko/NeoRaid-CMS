<?php
define("IN_PHP", true);
require_once('includes/config.php');
	require_once('includes/classes/Mysql.php');
	require_once('includes/classes/DBTreeManager.php');
	$db = new MySQL($dbHost, $dbUsername, $dbPassword, $dbName);	
	$treeManager = new DBTreeManager($db);
	
    $out = '';
	if(isset($_POST['id']))
    {
        $action = 'UPDATE';
        foreach($_POST as $k => $v)
        {
            if($k == 'id')
            {
                if(!is_numeric($v)) $action = 'INSERT';
                continue;    
            } 
            $out = $treeManager->setNews($_POST['id'], $k, $v, $action);
        }
        echo $out;
    }
?>