<?php
include_once("config.inc.php");
include_once("connect_db.php");
$img = basename($_FILES['file']['name']);
$gallery = $_POST['gallery'];

$folder = $GLOBALS['galleries'];
$path = "../";
$slash = '/'; 

(stristr($path, $slash)) ? '' : $slash = '\\';
$path .= $folder;


if (move_uploaded_file($_FILES['file']['tmp_name'], $path.$slash.$gallery.$slash.$img))
{
	$filename = explode('.', $img);
    $newname = md5_file($path.$slash.$gallery.$slash.$img);
    if(!file_exists(strtolower($path.$slash.$gallery.$slash.$newname.".".end($filename))))
    {
    	rename($path.$slash.$gallery.$slash.$img, strtolower($path.$slash.$gallery.$slash.$newname.".".end($filename)));
    }
    $query = "INSERT INTO images 
								SET 
									filename='".$newname.".".strtolower(end($filename))."', 
									id_galleries = (SELECT id FROM galleries WHERE path='".$gallery."')";
	mysql_query($query, $link);
	$id = mysql_insert_id($link);
	if($gallery == 'top')
	{
		$query = "INSERT INTO top 
								SET
								   filename='".$newname.".".strtolower(end($filename))."', 
								   id_galleries = (SELECT id FROM galleries WHERE path='".$gallery."'),
								   id_images = ".$id;
		mysql_query($query, $link);
	}
	$data = array(
				  'path'     => $path,
				  'gallery'  => $gallery,
				  'filename' => $newname.".".strtolower(end($filename)),
				  'id'       => $id,
	);


    //$data = array('filename' => $filename);
//header('Content-type: text/javascript');
echo "<html><head><script type='text/javascript'>";
echo "\n";
echo "window.parent.showThumb(";
echo "'".json_encode($data)."'";
echo ");";
echo "\n";
echo "</script></head></html>";
}
