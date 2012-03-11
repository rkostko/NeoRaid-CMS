<?php
include_once("config.inc.php");
include_once("connect_db.php");
include_once("content.php");
$init = new contentProcessor();
?>
<!-- div class="content" -->
<?php
 
$id = (isset($ARG0) && !empty($ARG0))? $ARG0 : '';

if(!empty($id))
{
	print("\n{articles_view}".$id."{/articles_view}\n");
}
?>
<!-- /div -->

<?php

ob_end_flush();

?>