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

<link rel="stylesheet" type="text/css" href="css/articles.css" />
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

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=pl&region=PL""></script>
<script type="text/javascript" src="jquery/ddsmoothmenu.js"></script>
<script type="text/javascript" src="jquery/picbox.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	ddsmoothmenu.init({
		mainmenuid: "smoothmenu1", //menu DIV id
		orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
		classname: 'ddsmoothmenu', //class added to menu's outer DIV
		//customtheme: ["#1c5a80", "#18374a"],
		contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
	});
	
	var mapDiv = document.getElementById('map-canvas');
	var map = new google.maps.Map(mapDiv, {
				center : new google.maps.LatLng(50.016137,20.025115),
				zoom : 14,
				mapTypeId : google.maps.MapTypeId.ROADMAP
	});
	
	var marker = new google.maps.Marker( {
				map : map,
				position : map.getCenter(),
				draggable : true
	});
	
});

function initialize_map() {
	
	
}
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
$article = ''; 
$article .= (isset($ARG0) && !empty($ARG0))? $ARG0 : '';


if(!empty($article))
{
	print("\n{articles}".$article."{/articles}\n");
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