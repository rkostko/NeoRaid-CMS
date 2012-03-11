<?php

include_once("connect_db.php");

//$query = "SELECT id, lp, name,  link,  hasChildren,  parentId,  isVisible FROM menu WHERE isVisible <> 0 ORDER BY lp ASC, parentId ASC";
/*$query = "SELECT 
				menu.id AS id, 
				menu.lp AS lp, 
				menu.name AS name, 
				menu.action AS action, 
				galleries.path AS path, 
				hasChildren, 
				parentId, 
				isVisible 
		  FROM menu
		  LEFT JOIN galleries ON menu.action_id = galleries.id
		  WHERE isVisible <> 0
		  ORDER BY lp ASC , parentId ASC";*/
$query = "SELECT tree_menu.Id AS Id, tree_menu.position AS position, tree_menu.name AS name, tree_menu.action AS
action, articles.path AS path, slave, ownerEl, tree_menu.isVisible
FROM tree_menu
LEFT JOIN articles ON tree_menu.action_id = articles.id
WHERE tree_menu.isVisible <> 0
AND tree_menu.action = 'articles'
UNION
SELECT tree_menu.Id AS Id, tree_menu.position AS position, tree_menu.name AS name, tree_menu.action AS
action , galleries.path AS path, slave, ownerEl, tree_menu.isVisible
FROM tree_menu
LEFT JOIN galleries ON tree_menu.action_id = galleries.id
WHERE tree_menu.isVisible <> 0
AND tree_menu.action = 'galleries'
UNION
SELECT tree_menu.Id AS Id, tree_menu.position AS position, tree_menu.name AS name, tree_menu.action AS
action , tables.path AS path, slave, ownerEl, tree_menu.isVisible
FROM tree_menu
LEFT JOIN tables ON tree_menu.action_id = tables.id
WHERE tree_menu.isVisible <> 0
AND tree_menu.action = 'tables' 
UNION
SELECT tree_menu.Id AS Id, tree_menu.position AS position, tree_menu.name AS name, tree_menu.action AS
action , ".$GLOBALS['news_count']." AS path, slave, ownerEl, tree_menu.isVisible
FROM tree_menu
LEFT JOIN news ON tree_menu.action_id = news.id
WHERE tree_menu.isVisible <> 0
AND tree_menu.action = 'news' 
UNION
SELECT tree_menu.Id AS Id, tree_menu.position AS position, tree_menu.name AS name, tree_menu.action AS
action , '' AS path, slave, ownerEl, tree_menu.isVisible
FROM tree_menu
WHERE tree_menu.isVisible <> 0
AND tree_menu.action = ''
ORDER BY position ASC , ownerEl ASC";
//echo $query.'<hr/>';
$result = mysql_query($query, $link);

$menu_arr = array();
while($row=mysql_fetch_assoc($result))
{
	$menu_arr[$row['Id']] = array(
					  'id'   => $row['Id'],
					  'lp'   => $row['position'],
					  'name' => $row['name'],
					  'path' => $row['path'],
					  'action' => $row['action'],
					  'hasChildren' => ((int) $row['slave'] == 0)? true : false,
					  'parentId'  => (int) $row['ownerEl'],
					  'class' => $row['class'],     
					   );	
}
//echo '<pre>'.print_r($menu_arr, 1).'</pre>'; exit;
foreach($menu_arr as $key => $item)
{
	if($item['parentId'] != 0 && $item['hasChildren'] == false)
	{
		$parentId = $item['parentId'];
		addChild($menu_arr, $parentId, $item);
		unset($menu_arr[$key]);
	}
}

//echo '<pre>'.print_r($menu_arr, 1).'</pre><hr/>';

foreach($menu_arr as $key => $item)
{
	if($item['parentId'] == 0 && $item['hasChildren'] == true)
	{
		addChildren($menu_arr, $item['id'], $key);
	}
}

//echo '<pre>'.print_r($menu_arr, 1).'</pre>'; exit;

function addChild(&$menu_arr, $parentId, $child)
{
	foreach($menu_arr as $key => $item)
	{
		if($item['id'] == $parentId && $item['hasChildren'] != false)
		{
			//$menu_arr[$key]['children'][$child['id']] = $child;
			$menu_arr[$key]['children'][$child['lp']] = $child;
		}
	}
}

function addChildren(&$menu_arr, $id, $idx)
{
	foreach($menu_arr as $key => $item)
	{
		if($item['parentId'] != 0 && $item['parentId'] == $id)
		{
			$menu_arr[$idx]['children'][$item['lp']] = $item;
			unset($menu_arr[$key]);
		}
	}
}


$menu = '<div class="header">';
//$menu .= '<div id="myslidemenu" class="jqueryslidemenu">';
$menu .= '<div id="smoothmenu1" class="ddsmoothmenu">';
$menu .= "\r\n<ul>\r\n";
foreach($menu_arr as $key => $node)
{
	$menu .= "<li>";
	if(!empty($node['action']))
	{
		$menu .= '<a href="';
		$menu .= (!empty($node['path']))? $node['path'].',' : '';
		$menu .= (!empty($node['action']))? $node['id'].','.$node['action'].'.php' : '';
		$menu .= '">';
	}
	else
	{
		$menu .= '<a href=".">';
	}
	$menu .= $node['name'];
	$menu .= (!empty($node['action']))? '</a>' : '</a>';
	if($node['hasChildren'] && isset($node['children']))
	{
		$menu .= "<ul>\r\n";
		if(is_array($node['children']) && count($node['children']))
		{
			foreach($node['children'] as $key2 => $subnode)
			{
				if($subnode['hasChildren'] == false)
				{
					$menu .= '<li>';
					if(!empty($subnode['action']))
					{
						$menu .= '<a href="';
						$menu .= (!empty($subnode['path']))? $subnode['path'].',' : '';
						$menu .= (!empty($subnode['action']))? $subnode['id'].','.$subnode['action'].'.php' : '';
						$menu .= '">';
					}
					else
					{
						$menu .= '<a href=".">';
					}
					$menu .= $subnode['name'];
					$menu .= (!empty($subnode['action']))? '</a>' : '</a>';
					$menu .= "</li>\r\n";
				}
				elseif($subnode['hasChildren'] == true && count($subnode['children']))
				{					
					$menu .= "<li>\r\n";
					if(!empty($subnode['action']))
					{
						$menu .= '<a href="';
						$menu .= (!empty($subnode['path']))? $subnode['path'].',' : '';
						$menu .= (!empty($subnode['action']))? $subnode['id'].','.$subnode['action'].'.php' : '';
						$menu .= '">';
					}
					else
					{
						$menu .= '<a href=".">';
					}
					$menu .= $subnode['name'];
					$menu .= (!empty($subnode['action']))? '</a>' : '</a>';
					$menu .= "<ul>\r\n";
				
					foreach($subnode['children'] as $leaf)
					{		
						$menu .= '<li>';
						if(!empty($leaf['action']))
						{
							$menu .= '<a href="';
							$menu .= (!empty($leaf['path']))? $leaf['path'].',' : '';
							$menu .= (!empty($leaf['action']))? $leaf['id'].','.$leaf['action'].'.php' : '';
							$menu .= '">';
						}
						else
						{
							$menu .= '<a href=".">';
						}
						$menu .= $leaf['name'];
						$menu .= (!empty($leaf['action']))? '</a>' : '</a>';
						$menu .= "</li>\r\n";
					}	
					$menu .= "</ul>\r\n";
					$menu .= "</li>\r\n";
				}
			}	
		}
		$menu .= "</ul>\r\n";
	}
	$menu .= "</li>\r\n";
}
$menu .= "</ul>\r\n";
$menu .= '<br style="clear: left" />';
$menu .= '</div>';
$menu .= '</div>';
echo $menu;
?>