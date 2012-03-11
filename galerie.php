<?php
include_once("connect_db.php");

$query = "SELECT id, title, path, filename FROM galleries, images WHERE id = id_galleries";

$result = mysql_query($query, $link);
echo $query;
$gal_id = false;
while($row = mysql_fetch_assoc($result))
{
	//if($gal_id != $row['id'])
	//{
		$gal_id = $row['id'];
		
	//}
	
	$galleries[$gal_id]['path'][] = $row['path'].'/'.$row['filename'];
	
	$galleries[$gal_id]['title'] = $row['title'];
	//echo $row['path'].'/'.$row['filename'].'<br/>';	
}

echo '<pre>'.print_r($galleries, 1).'</pre>';
?>