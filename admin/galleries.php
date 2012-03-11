<?php
include_once("config.inc.php");
include_once("connect_db.php");
include_once("content.php");
$init = new contentProcessor();
?>
<div class="content">
<?php
$gallery = ''; 
$gallery .= (isset($ARG0) && !empty($ARG0))? $ARG0 : '';

$gallery .= (isset($ARG1) && !empty($ARG1))? ','.$ARG1 : '';
$gallery .= (isset($ARG2) && !empty($ARG2))? ','.$ARG2 : '';

if(!empty($gallery))
{
	/*if(!isset($ARG1) || (int)$ARG1 == 1)
	{		
		echo "\n{articles}";
		echo (strpos($gallery, ',') !== false)? substr($gallery, 0, strpos($gallery, ',')) : $gallery;
		echo "{/articles}\n"; 
	}*/
	print("\n{galleries}".$gallery."{/galleries}\n");
    /*if(!isset($ARG1) || (int)$ARG1 == 1)
	{		
		echo "\n{movies}";
		echo (strpos($gallery, ',') !== false)? substr($gallery, 0, strpos($gallery, ',')) : $gallery;
		echo "{/movies}\n"; 
	}*/
}
?>
</div>

<?php

ob_end_flush();

?>