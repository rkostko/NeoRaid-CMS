<?php
include_once("connect_db.php");
$path_arr = explode(",", basename($_SERVER["REQUEST_URI"]));
$menu_id = (isset($path_arr[count($path_arr)-2]) && !empty($path_arr[count($path_arr)-2]))? $path_arr[count($path_arr)-2] : 1;

$query = "SELECT Id, name, slave, ownerEl FROM tree_menu ORDER BY ownerEl ASC";
$result = mysql_query($query, $link);
while($row=mysql_fetch_assoc($result))
{
	$menu_arr[$row['Id']] = array(
								 'id' => $row['Id'],
								 'name' => $row['name'],
								 'owner' => $row['ownerEl'],
								 'slave' => $row['slave'],
								 );		
}

foreach($menu_arr as $key => $item)
{
	if($item['owner'] == 0)
	{
		$roots[$key] = array($key);	
	}
	else
	{
		if($item['slave'] == 0)
		{
			$branches[$key] = array(
									'id' => $key,
									'owner' => $item['owner'],
			);
			$roots[$key][] = $key;
		}
		else
		{
			$leaves[$key] = array(
									'owner' => $item['owner'],
									'root'  => null,
			); 
		}
	}
}

foreach($leaves as $key => $leave)
{
	if(isset($branches[$leave['owner']]))
	{
		$main = $branches[$leave['owner']]['owner'];
		$roots[$main][] = $key;
	}
	elseif(isset($roots[$leave['owner']]))
	{
		$roots[$leave['owner']][] = $key;
	}
}

foreach($roots as $tree_id => $set)
{
	if(isset($menu_id) && in_array($menu_id, $set))
	{
		$top_id = $tree_id;
		break;
	}
}

$top_id = (isset($top_id) && !empty($top_id))? $top_id : 0;
$query = "SELECT filename, tree_menu_Id FROM top WHERE tree_menu_Id=".$top_id." OR tree_menu_Id=0 ORDER BY tree_menu_Id ASC";
$result = mysql_query($query, $link);
$i = 0;
while($row=mysql_fetch_assoc($result))
{
	$filenames[$i] = array(
						'image' => $row['filename'],
					    'id'    => $row['tree_menu_Id'],
						  ); 
	$i++;
}

$image = '';
foreach($filenames as $filename)
{
	if($filename['id'] == $top_id)
	{
		$image = $filename['image'];
		break;
	}
	elseif(empty($image) && $filename['id'] == 0)
	{
		$image = $filename['image'];
	}
}

echo '<div style="width: 876px; height: 200px; background: #ddd url(';
echo 'galleries/top/'.$image;
echo ') no-repeat;">';
?>
	<div style="position: relative; left: 680px; top: 15px; width: 209px; height: 127px; background: url(images/logo.png) no-repeat"><a href="."><img src="images/tr.gif" width="209" height="127" alt="NeoRaid Rally Team" style="border: none"/></a></div>
</div>