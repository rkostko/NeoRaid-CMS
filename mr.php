<?php
if( array_key_exists('argStr', $_GET)) 
{ 

    $arr = explode(',', $_GET['argStr']); 
	for($i=0; $i < count($arr); $i++)
	{
		$a = 'ARG'.$i;
		$$a = $arr[$i];
	}
	unset($_GET['argStr']);
} 
?>