<?php
define("IN_PHP", true);

require_once("common.php");

$rootName = "Root";
$treeElements = $treeManager->getElementList(null, "manageStructure.php");

?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="keywords"  content="" />
<meta name="description" content="" />
<title>Site menu & Galleries CMS</title>
<link rel="stylesheet" type="text/css" href="js/jquery/plugins/simpleTree/style.css" />
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" href="themes/base/jquery.ui.all.css"  type="text/css" media="screen" />
<script type="text/javascript" src="js/jquery/jquery-1.6.2.js"></script>
<script type="text/javascript" src="js/jquery/jquery-ui-1.8.7.js"></script>
<!-- script src="js/jquery/jquery.ui.core.js"></script>
<script src="js/jquery/jquery.ui.widget.js"></script>
<script src="js/jquery/jquery.ui.mouse.js"></script>
<script src="js/jquery/jquery.ui.sortable.js"></script>
<script src="js/jquery/jquery.ui.draggable.js"></script>
<script src="js/jquery/jquery.ui.droppable.js"></script>
<script src="js/jquery/jquery.ui.tabs.js"></script>
<script src="js/jquery/jquery.ui.dialog.js"></script>
<script src="js/jquery/jquery.ui.resizable.js"></script>
<script src="js/jquery/jquery.ui.slider.js"></script -->

<script type="text/javascript" src="js/jquery/plugins/jquery.cookie.js"></script>
<script type="text/javascript" src="js/jquery/plugins/simpleTree/jquery.simple.tree.js"></script>
<script type="text/javascript" src="js/langManager.js" ></script>
<script type="text/javascript" src="js/treeOperations.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<!-- script type="text/javascript" src="js/gallery.js"></script -->
<script type="text/javascript" src="js/jquery-custom-file-input.js"></script>
<script src="js/picbox.js" type="text/javascript"></script>
<script src="js/tooltip.js" type="text/javascript"></script>

<script type="text/javascript" src="wymeditor/jquery.wymeditor.js"></script>
<script type="text/javascript" src="wymeditor/plugins/saveajax/jquery.wymeditor.saveajax.js"></script>
<script type="text/javascript" src="wymeditor/plugins/insertatcaret/jquery.wymeditor.insertatcaret.js"></script>
<script type="text/javascript" src="wymeditor/plugins/imgdialog/jquery.wymeditor.imgdialog.js"></script> 
<script type="text/javascript" src="wymeditor/plugins/imgdropdown/jquery.wymeditor.imgdropdown.js"></script>
<script type="text/javascript" src="wymeditor/plugins/hovertools/jquery.wymeditor.hovertools.js"></script>
<script type="text/javascript" src="wymeditor/plugins/extrabuttons/jquery.wymeditor.extrabuttons.js"></script>
<link rel="stylesheet" type="text/css" href="css/jrac.css" />
<script type="text/javascript" src="js/jquery.jrac.js"></script>

<link rel="stylesheet" href="css/picbox.css" type="text/css" media="screen" />
 
<script type="text/javascript" src="js/jquery.documentresize.js"></script>



<script type="text/javascript">
var linked = false;
var insertArr = new Array();
$(function() {
    	$("#tabs").tabs();
    	$( "#tabs" ).tabs({ selected: -1 });
    });



	
</script>

<style type="text/css">

#file-uploader {
width: 148px;
height: 122px;
float: left;
position: relative;
}

</style>

</head>
<body>
<table width="100%" border="0">
	<tr>
		<td style="vertical-align:top; width:10%">
			<div class="contextMenu" id="myMenu1">	
					<li class="addFolder"><img src="js/jquery/plugins/simpleTree/images/folder_add.png" /> </li>
                    <li class="addDoc2"><img src="js/jquery/plugins/simpleTree/images/article_add.png" /> </li>
					<li class="addDoc"><img src="js/jquery/plugins/simpleTree/images/page_add.png" /> </li>	
					<li class="edit"><img src="js/jquery/plugins/simpleTree/images/folder_edit.png" /> </li>
					<li class="hide"><img src="js/jquery/plugins/simpleTree/images/folder_hide.png" /> </li>
					<li class="delete"><img src="js/jquery/plugins/simpleTree/images/folder_delete.png" /> </li>
					<li class="expandAll"><img src="js/jquery/plugins/simpleTree/images/expand.png"/> </li>
					<li class="collapseAll"><img src="js/jquery/plugins/simpleTree/images/collapse.png"/> </li>	
			</div>
			<div class="contextMenu" id="myMenu2">
					<li class="edit"><img src="js/jquery/plugins/simpleTree/images/page_edit.png" /> </li>
					<li class="hide"><img src="js/jquery/plugins/simpleTree/images/page_hide.png" /> </li>
					<li class="delete"><img src="js/jquery/plugins/simpleTree/images/page_delete.png" /> </li>
			</div>
			
			<div id="wrap" class="ui-widget-content ui-corner-all">
				<div id="annualWizard"  style="float:left;">	
						<ul class="simpleTree" id='pdfTree'>		
								<li class="root" id='<?php echo $treeManager->getRootId();  ?>'><span><?php echo $rootName; ?></span>
									<ul><?php echo $treeElements; ?></ul>				
								</li>
						</ul>						
				</div>		
			</div>
		</td>
		<td style="vertical-align:top; width: 90%">
			<div id="info" style="float:right; width:100%">
				<div id="tabs">
					<ul>
						<li><a href="#tabs-1" rel="galleries">Galeria</a></li>
						<li><a href="#tabs-2" rel="articles">Artykuł</a></li>
                        <li><a href="#tabs-3" rel="tables">Tabela</a></li>
                        <li><a href="#tabs-4" rel="news">News</a></li>
						<!-- li><a href="#tabs-5" rel="movies">Film</a></li -->
						<!-- li><a href="#tabs-6" rel="objects">Objekt</a></li -->
					</ul>
					<div id="tabs-1" style="overflow: hidden;">
						
					</div>
					<div id="tabs-2" style="overflow: hidden;">
						
					</div>
                    <div id="tabs-3" style="overflow: hidden;">
						
					</div>
					<div id="tabs-4" style="overflow: hidden;">
						
					</div>
					<!-- div id="tabs-5" style="overflow: hidden;" -->
						
					</div>
                    <!-- div id="tabs-6" style="overflow: hidden;" -->
						
					</div>                    
				</div> 
			</div>
 		</td>
 	</tr>
</table>
<div id='dialog-modal'></div>
<div id='processing'></div>

</body>
</html>