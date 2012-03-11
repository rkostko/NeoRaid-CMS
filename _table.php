<?php
include_once("connect_db.php");
$_table_ = "calendarium";
$query = "SELECT `tables`.`title`, `".$_table_."`.* 
								FROM `".$_table_."`, `tables` 
								WHERE tables.path = '".$_table_."' 
								ORDER BY ".$_table_.".id ASC";
echo $query;
$result = mysql_query($query, $link);

$table_result=array();
$r = 0;
while($row = mysql_fetch_assoc($result))
{
    $arr_row=array();
    $c = 0;
    while ($c < mysql_num_fields($result)) 
    {        
        $col = mysql_fetch_field($result, $c);    
        $arr_row[$col -> name] = $row[$col -> name];            
        $c++;
    }    
    $table_result[$r] = $arr_row;
    $r++;
}

    //echo '<pre>'.print_r($table_result,1).'</pre>';
    
    $empty = array();
				$table = '<table class="table" cellspacing="1" cellpadding="5" border="1">';
				foreach($table_result as $k => $v)
				{
					if($k === 0)
					{
						$table .= '<thead>';
						$table .= '<tr>';
							foreach($v as $key => $fieldname)
							{
								if(empty($fieldname) || $key == 'title')
								{
									if($key == 'title')
									{
										$title = $data;
									}
									$empty[] = $key;
									continue;
								}
								$table .= '<th>'.$fieldname.'</th>';
							}
						$table .= '</tr>';
						$table .= '</thead>';
						$table .= '<tbody>';
					}
					elseif($k >= 1)
					{
						$table .= '<tr>';
							foreach($v as $field => $data)
							{
								$even_odd = ($k%2)? 'even' : 'odd';
								if(in_array($field, $empty)) continue;
								
								$table .= '<td class="'.$even_odd.'">'.$data.'</td>';
							}
						$table .= '</tr>';	
					}

				}
				$table .= '</tbody>';
				$table .= '</table>';
				
echo $table;				