<?php
define("IN_PHP", true);
    require_once('includes/config.php');
	require_once('includes/classes/Mysql.php');
	require_once('includes/classes/DBTreeManager.php');
	$db = new MySQL($dbHost, $dbUsername, $dbPassword, $dbName);	
	$treeManager = new DBTreeManager($db);
	$html = '';

	if(isset($_POST['id']) && is_numeric($_POST['id']))
	{
		$result = $treeManager->getArticle($_POST['id']);
        if(mysql_num_rows($result) === 1)
        {
            $row = mysql_fetch_assoc($result);
			$article = array(
                            'id' => $row['id'],
                            'title' => $row['title'], 
                            'path' => $row['path'],
                            );
            $filename = '../articles/'.$article['path'].'.html';
            $html = file_get_contents($filename);
        }
	}
    echo $html; 
?>