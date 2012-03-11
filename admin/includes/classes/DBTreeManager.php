<?php
/**************************************
     File Name: DBTreeManager.php
     Begin:  Sunday, April, 12, 2009, 11:36 AM
     Author: Ozan Koroglu
 			 Ahmet Oguz Mermerkaya 	
     Email:  koroglu.ozan@gmail.com
     		 ahmetmermerkaya@hotmail.com
 ***************************************/ 
 
 require_once('ITreeManager.php');
 
 class DBTreeManager implements ITreeManager
 {
 	private $db;
	
    public function __construct($dbc){
    	$this->db = $dbc;
    } 
	
 	public function insertElement($name, $ownerEl, $slave, $galleryId = null, $type = null)
	{
		if($slave == 1 && !is_null($galleryId))
		{
			$action = (!is_null($type))? $type : 'galleries';	
			$action_id = $galleryId;
			
		}
		
		
		$ownerEl = (int) $ownerEl;
		$sql = sprintf('INSERT INTO ' 
								. TREE_TABLE_PREFIX . '_menu(name, position, ownerEl, slave, action, action_id, class)
							SELECT 
								\'%s\', ifnull(max(el.position)+1, 0), %d, %d, \'%s\', %d, NULL   
							FROM '
								. TREE_TABLE_PREFIX . '_menu el 
							WHERE 
								el.ownerEl = %d ',
							$name , $ownerEl, $slave, $action, $action_id, $ownerEl);
		$out = FAILED;
		if ($this->db->query($sql) == true) {
				$out = '({ "elementId":"'.$this->db->lastInsertId().'", "elementName":"'.$name.'", "slave":"'.$slave.'"})';
		}
		
		return $out; 	
 	}
 	
 	
 	
 	public function getElementList($ownerEl, $pageName)
	{
		if ($ownerEl == null) {
			$ownerEl = 0;
		}
		else {
			$ownerEl = (int) $ownerEl;
		}
		$sql = sprintf("SELECT 
        					Id, name, slave, action, isVisible   
        				FROM " 
        					. TREE_TABLE_PREFIX . "_menu
		      			WHERE
		      				ownerEl = %d  
		      			ORDER BY
		      				position ",
        				$ownerEl);
						
		$str = FAILED;
        $result = $this->db->query($sql);
        if ($result !== false)
        {
        	$str = NULL;
        	/*
            if ($this->db->numRows($result) > 0)
            {
                $str = NULL;
            }
            else
            {
                $str = NULL;
                //$str = "<li></li>";
            }
            */
            while ($row = $this->db->fetchObject($result))
            {
                $supp = NULL;
                if ($row->slave == 0)
                {
                    $supp = "<ul class='ajax'>"
                    ."<li id='".$row->Id."'>{url:".$pageName."?action=getElementList&ownerEl=".$row->Id."}</li>"
                    ."</ul>";
                }
        
                $rel = ($row->isVisible == 1)? " rel='visible'" : " rel='hidden'";
                
                $str .= "<li rel='".$row->action."' class='text' id='".$row->Id."'>"
                ."<span".$rel.">".$row->name."</span>"
                .$supp
                ."</li>";
            }
        }
        return $str;				
						
 	
 	}
 	
 	
 	public function updateElementName($name, $elementId, $ownerEl)
	{
		$elementId = (int) $elementId;
 		$sql = sprintf('UPDATE ' 
        						. TREE_TABLE_PREFIX.'_menu 
							SET 
								name = \'%s\'
					    	WHERE 
					    		Id = %d ',
        					$name, $elementId);
		$out = FAILED;					
		if ($this->db->query($sql) == true) {
				$out = '({"elementName":"'.$name.'", "elementId":"'.$elementId.'"})';
		}
		
		return $out;
 	}
 	
 	
   public function hideElement($isVisible, $elementId, $ownerEl)
	{
		$elementId = (int) $elementId;
 		$sql = sprintf('UPDATE ' 
        						. TREE_TABLE_PREFIX.'_menu 
							SET 
								isVisible = %d 
					    	WHERE 
					    		Id = %d ',
        					$isVisible, $elementId);				
		$out = FAILED;					
		if ($this->db->query($sql) == true) {
				$out = '({"visible":"'.$isVisible.'", "elementId":"'.$elementId.'"})';
		}
		return $out;
 	}
 	
 	
     public function deleteElement($elementId, &$index = 0, $ownerEl)
     {
     	$elementId = (int) $elementId;
         $sql = sprintf('SELECT
     				 		Id, slave, position, ownerEl 
     					FROM '. TREE_TABLE_PREFIX .'_menu
     					WHERE 
     						ownerEl = %d ',
         				$elementId);
         $row = NULL;
         $index++;
         if ($result = $this->db->query($sql))
         {
             while ($row = $this->db->fetchObject($result))
             {
                 // if element type is not slave,
                 // there can be childs belonging to that master
                 if ($row->slave == "0")
                 {
                     // recursive operation, to reach the deepest element
                     $this->deleteElement($row->Id, $index);
                 }
             }
         }
         $index--;
     
         // only update the elements' position on the same level of our first element
         if ($index == 0)
         {
             $sql = sprintf('SELECT 
     							position, ownerEl
     						FROM '
             .TREE_TABLE_PREFIX.'_menu
     						WHERE
     							Id = %d',
            				 $elementId);
     
     
             if ($result = $this->db->query($sql))
             {
                 if ($row = $this->db->fetchObject($result))
                 {
                     $sql = sprintf('UPDATE '
                    				 .TREE_TABLE_PREFIX.'_menu
     								SET 
     									position = position - 1
     								WHERE 
     									ownerEl = %d
     									AND
     									position > %d',
                     					$row->ownerEl, $row->position);
                     $this->db->query($sql);
                 }
             }
         }
     
         // start to delete it from bottom to top
         $sql = sprintf('DELETE FROM '
         					.TREE_TABLE_PREFIX.'_menu
     	        		WHERE 
     			        	ownerEl = %d 
     			        	OR
     			        	Id = %d ',  $elementId, $elementId);
     
	 	 $out = FAILED;
         if ($this->db->query($sql) == true)
         {
             $out = SUCCESS;
         }
         return $out;     
     }
 	
    public function deleteImage($elementId)
    {   	
          $sql = sprintf('DELETE FROM 
         					images
     	        		WHERE 
     			        	id = %d', $elementId);
     
	 	 $out = FAILED;
         if ($this->db->query($sql) == true)
         {
             $out = SUCCESS;
         }
         return $out;     
    } 

    public function imageShowHide($elementId, $isVisible)
    {
          $sql = sprintf('UPDATE 
          						images SET 
          						isVisible = %d 
          				  WHERE id = %d', $isVisible, $elementId);
     
	 	 $out = FAILED;
         if ($this->db->query($sql) == true)
         {
             $out = SUCCESS;
         }
         return $out;     
    } 
    
 	public function changeOrder($elementId, $oldOwnerEl, $destOwnerEl, $destPosition)
	{
		$sql = sprintf('SELECT
						 		ownerEl, position 
							FROM '
								. TREE_TABLE_PREFIX . '_menu 
							WHERE 
								Id = %d
							LIMIT 1',
							$elementId);
		$out = FAILED;					
		if ($result = $this->db->query($sql))
		{			
				if ($element = $this->db->fetchObject($result))
				{						
					$sql1 = sprintf('UPDATE '
										 . TREE_TABLE_PREFIX . '_menu 
									 SET 
									 	position = position - 1
									 WHERE  
									 	position > %d
									    AND
									    ownerEl = %d ',
									 $element->position, $element->ownerEl);
							   
					$sql2 = sprintf('UPDATE '
										. TREE_TABLE_PREFIX . '_menu 
									 SET 
									 	position = position + 1
									 WHERE
							 			 position >= %d 
									   	 AND
									   	 ownerEl = %d ',
									 $destPosition, $destOwnerEl);
							   
					$sql3 = sprintf('UPDATE '
										. TREE_TABLE_PREFIX . '_menu 
									 SET 
									 	position = %d , ownerEl = %d
									 WHERE 
									 	Id = %d ',
										$destPosition, $destOwnerEl, $elementId);
	
					
					if ($this->db->query($sql1) && $this->db->query($sql2) && $this->db->query($sql3)) {					
						$out = '({"oldElementId":"'.$elementId.'", "elementId":"'. $elementId .'"})';
					}					
				}
				
		}
		return $out;				
 	}
	
 	public function getGallery($id)
 	{
 		 $sql = sprintf("SELECT SQL_CALC_FOUND_ROWS 
								path, filename, title, tree_menu.id, galleries.id, images.id, images.position, images.isVisible   
								FROM galleries
								LEFT JOIN images ON images.id_galleries = galleries.id
								LEFT JOIN tree_menu ON tree_menu.action_id = galleries.id
								WHERE tree_menu.id = %d ORDER BY images.position ASC", $id);
 	     $result = $this->db->query($sql); 	     
         return $result;	
 	}
	
    public function getDefault()
 	{
 		 $sql = "SELECT id_images   
								FROM top
								WHERE tree_menu_Id = 0";
 	     $result = $this->db->query($sql); 	     
         return $result;	
 	}
 	
    public function setDefault($id)
 	{
 		 $sql = "UPDATE top
					   	   SET tree_menu_Id = NULL 
						   WHERE tree_menu_Id = 0";
 		 
 	     $out = FAILED;
         if ($this->db->query($sql) == true)
         {
         	 $sql = "UPDATE top
					   	   SET tree_menu_Id = 0 
						   WHERE id_images = ".$id;
         	 $this->db->query($sql);
             $out = SUCCESS;
         }
         return $out;	
 	}
 	
 	public function showTooltip($id)
 	{
 		$sql = "SELECT filename 
 								FROM top
 								        WHERE tree_menu_Id = ".$id;	
 		$result = $this->db->query($sql);
 		$filename = 0;
 		while ($row = $this->db->fetchObject($result))
        {
        	$filename = $row->filename;
        }
 		return $filename;
 	}
 	
 	
	public function getRootId(){
		return 0;
	}
 	
    public function getArticle($id)
 	{
 		 $sql = sprintf("SELECT a.id, a.title, a.path
                                                    FROM articles AS a
                                                    LEFT JOIN tree_menu AS m ON a.id = m.action_id
                                                    WHERE m.Id =%d
                                                    AND m.isVisible =1
                                                    AND m.action = 'articles'", $id);
 	     $result = $this->db->query($sql);
          //$result = $sql;  	     
         return $result;	
 	}
    
    function getTreeIdByContentId($id)
    {
        $sql = sprintf("SELECT m.Id AS id 
                                                    FROM tree_menu AS m
                                                    LEFT JOIN articles AS a ON a.id = m.action_id
                                                    WHERE a.id =%d
                                                    AND m.action = 'articles'", $id);
 	     $result = $this->db->query($sql);
          //$result = $sql;  	     
         return $result;
    }
    
    
    public function getGalleryArticle($id)
    {

        $sql = sprintf("SELECT a.id, a.title, a.path
                                                    FROM articles AS a,
                                                         galleries AS g 
                                                    LEFT JOIN tree_menu AS m ON g.id = m.action_id
                                                    WHERE m.Id = %d 
                                                    AND m.isVisible =1
                                                    AND m.action = 'galleries'
                                                    AND a.id_galleries = g.id", $id);                             
 	     $result = $this->db->query($sql);
//$result = $sql;  	     
         return $result;
    }
    
    
    public function getTable($id)
 	{
 		 $sql = sprintf("SELECT t.id, t.title, t.path
                                                    FROM tables AS t
                                                    LEFT JOIN tree_menu AS m ON t.id = m.action_id
                                                    WHERE m.Id =%d
                                                    AND m.isVisible =1
                                                    AND m.action = 'tables'", $id);

         if($table = $this->db->getRowAssoc($sql))
         {
            $sql = "SELECT `tables`.`title`, `".$table['path']."`.* 
							FROM `".$table['path']."`, `tables` 
							WHERE tables.path = '".$table['path']."' 
							ORDER BY ".$table['path'].".id ASC";
              
			$result = $this->db->query($sql);
			$table_result=array();
			$r = 0;
			if($this->db->numRows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
				    $arr_row=array();
				    $c = 0;
				    while ($c < mysql_num_fields($result)) 
				    {        
				        $col = mysql_fetch_field($result, $c);
				        if(!empty($row[$col -> name]))
				        {    
				        	$arr_row[$col -> name] = $row[$col -> name];
				        }            
				        $c++;
				    }    
				    $table_result[$r] = $arr_row;
				    $r++;
				}
            }     
         }
         return $table_result; 	     	
 	}
    
    
    public function getNews($id)
    {
        $sql = sprintf("SELECT action
                                    FROM tree_menu
                                    WHERE Id =%d
                                    AND isVisible =1
                                    AND action = 'news'", $id);

         if($table = $this->db->getRowAssoc($sql))
         {
            $sql = "SELECT id, date, title, headline, id_articles, id_galleries, id_images, id_objects,   
                            (SELECT `articles`.`path`
                                                    FROM `articles`
                                                    WHERE `articles`.`id` = `".$table['action']."`.`id_articles`
                                                    ) AS `article`, 
                            (SELECT `galleries`.`path`
                                                    FROM `galleries`
                                                    WHERE `galleries`.`id` = `".$table['action']."`.`id_galleries`
                                                    ) AS `gallery`, 
                            (SELECT `images`.`filename`
                                                    FROM `images`
                                                    WHERE `images`.`id` = `".$table['action']."`.`id_images`
                                                    ) AS `image`, 
                            (SELECT `objects`.`url`
                                                    FROM `objects`
                                                    WHERE `objects`.`id` = `".$table['action']."`.`id_objects`
                                                    ) AS `url`,
                            (SELECT CONCAT_WS(',',`objects`.`width`,`objects`.`height`,`objects`.`crop_x`,`objects`.`crop_y`,`objects`.`crop_width`,`objects`.`crop_height`)
                                                    FROM `objects`
                                                    WHERE `objects`.`id` = `".$table['action']."`.`id_objects`
                                                    ) AS `dimensions`,
                            (SELECT `objects`.`target`
                                                    FROM `objects`
                                                    WHERE `objects`.`id` = `".$table['action']."`.`id_objects`
                                                    ) AS `target`,
                            isVisible AS visible                          
                            FROM `".$table['action']."` 
                            ORDER BY `".$table['action']."`.`date` DESC
                            LIMIT 0 , 30";
              
			$result = $this->db->query($sql);
			$table_result=array();
			$r = 0;
			if($this->db->numRows($result) > 0)
			{
				while($row = mysql_fetch_assoc($result))
				{
				    $arr_row=array();
				    $c = 0;
				    while ($c < mysql_num_fields($result)) 
				    {        
				        $col = mysql_fetch_field($result, $c);
				        if(!empty($row[$col -> name]))
				        {    
				        	$arr_row[$col -> name] = $row[$col -> name];
				        }            
				        $c++;
				    }    
				    $table_result[$r] = $arr_row;
				    $r++;
				}
            }     
         }
         //return $sql;
         return $table_result;
    }
    
    public function setNews($id, $field, $value, $action)
    {
    $sql = $action." news SET ".$field."='".$this->db->escapeString($value)."'";
        $sql .= ($action == 'UPDATE')? " WHERE id=".$id : '';
                            
        $result = ($this->db->query($sql))? $this->db->lastInsertId() : false;
//$result = $sql;  	     
        return $result;
    }
}
?>