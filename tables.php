<?php
//include_once("connect_db.php");
//include_once("config.inc.php");
include_once("content.php");

$init = new contentProcessor();

?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>NeoRaid Rally Team</title>
<link rel="stylesheet" type="text/css" href="css/main.css" />
<link rel="stylesheet" type="text/css" href="css/picbox.css" />

<!-- link rel="stylesheet" type="text/css" href="css/jqueryslidemenu.css" / -->
<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />
<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu-v.css" />

<script type="text/javascript" src="jquery/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="jquery/jquery.infinitecarousel2.js"></script>
<script type="text/javascript" src="jquery/jquery.easing.1.3.js"></script> 
<!--[if lte IE 7]>
<style type="text/css">
html .jqueryslidemenu{height: 1%;} /*Holly Hack for IE7 and below*/
</style>
<![endif]-->

<!-- script type="text/javascript" src="jquery/jqueryslidemenu.js"></script -->
<script type="text/javascript" src="jquery/ddsmoothmenu.js"></script>
<script type="text/javascript" src="jquery/picbox.js"></script>
<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "smoothmenu1", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
});
</script>
</head>

<body>
<div class="sceleton">
	<div class="container">
<?php
include_once('top.php');
include_once('menu.php');
?>
		<div class="content">
<?php
$table = ''; 
$table .= (isset($ARG0) && !empty($ARG0))? $ARG0 : '';


if(!empty($table))
{
	print("\n{tables}".$table."{/tables}\n");
}
?>
		</div>
	</div>
</div>
</body>
</html>
<?php

ob_end_flush();

?>