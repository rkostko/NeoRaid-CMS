<?php
$server = 'localhost';
$username = 'noraid_noraid';
$password = 'lOA0hjMU';
$link = mysql_connect($server,$username,$password);
mysql_query("SET NAMES UTF8", $link);
mysql_query("SET CHARACTER SET UTF8", $link);
mysql_select_db('noraid_4x4',$link);
$GLOBALS['link'] = $link;
?>