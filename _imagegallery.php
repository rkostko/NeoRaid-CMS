<?php
include_once("connect_db.php");

$galleries = array();
$folder = "galleries";
$path = getcwd();
$slash = '/'; 

(stristr($path, $slash)) ? '' : $slash = '\\';
$path = getcwd().$slash.$folder;

/*$query = "SELECT id, title, path FROM galleries";
$result = mysql_query($query, $link);
while($row = mysql_fetch_assoc($result))
{
    $galleries[$row['id']]['path'] = stripslashes($row['path']);
}*/

//foreach($galleries as $id => $item)
//{
	//$gallery = $item['path'];
	//echo '<b>'.$gallery.'</b><br/>';
    $gallery = 'klimatyczne_foto_z_biwaku';
	if ($dh = opendir($path.$slash.$gallery)) 
    {
        while (($file = readdir($dh)) !== false) 
        {
            if ($file != '..' && $file != '.')
            {
            	//echo $file.'<br/>';
            	$query = "INSERT INTO images SET id_galleries=54, filename='".$file."'";
            	mysql_query($query, $link);	
            }
        }
        closedir($dh);
    }
//}

?>