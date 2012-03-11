<?php
class contentProcessor
{
	public $link;
	public $galleries;
	public $articles;
    public $news;
    public $news_count;
	public $_width_;
	public $_height_;
	public $_quality_;
	public $_offset_;
	public $_count_;
	public $_slider_width_;
	public $_slider_height_;
	
	
    function __construct()
    {
    	ob_start(array(&$this, "_getContent"));
    	include_once("config.inc.php");
    	include_once("connect_db.php");
    	$this->link = $GLOBALS['link'];
    	$this->galleries = $GLOBALS['galleries'];
    	$this->articles = $GLOBALS['articles'];
        $this->news = $GLOBALS['news'];
        $this->news_count = $GLOBALS['news_count'];
    	$this->_width_ = $GLOBALS['_width_'];
    	$this->_height_ = $GLOBALS['_height_'];
    	$this->_quality_ = $GLOBALS['_quality_'];
    	$this->_offset_ = $GLOBALS['_offset_'];
    	$this->_count_ = $GLOBALS['_count_'];
    	$this->_slider_width_ = $GLOBALS['_slider_width_'];
		$this->_slider_height_ = $GLOBALS['_slider_height_'];  	
    }
	
	public function _getContent($buffer)
	{
		  return $this->_analyzeBuffer($buffer);
	}
	
	private function _analyzeBuffer($buffer)
	{
		if(preg_match_all("#({)(articles|galleries|tables|news|movies|sliders|objects)(})#s", $buffer,$matches))
		{
			foreach($matches[2] as $k => $v)
			{
				switch($v)
				{
					case 'articles' :
						return $this->_getArticles($buffer);
					break;
					case 'galleries' :
						return $this->_getGalleries($buffer);
					break;
					case 'tables' :
						return $this->_getTables($buffer);
					break;
					case 'movies' :
						return $this->_getMovies($buffer);
					break;
					case 'sliders' :
						return $this->_getSliders($buffer);
					break;
					case 'objects' :
						return $this->_getObjects($buffer);
					break;
                    case 'news' :
						return $this->_getNews($buffer);
					break;
				}
			}			
		}
		else return $buffer;		
	}
	
	
	private function _getGalleries($buffer)
	{
		  $html = '';	
		  if (preg_match_all("#{galleries}(.*?){/galleries}#s", $buffer, $matches, PREG_PATTERN_ORDER) > 0) 
		  {
			  $sigcount = -1;
			  foreach ($matches[0] as $match) 
			  {
				$sigcount++;
				$_images_dir_ = preg_replace("/{.+?}/", "", $match);		
				$params_images = explode(',', $_images_dir_);
				$_images_dir_ = (count($params_images) > 0)? $params_images[0] : $_images_dir_;
                $menu_id = (count($params_images) > 0)? $params_images[1] : false;
				$page = (count($params_images) > 0 && isset($params_images[2]) && $params_images[2] <= 1)? 0 : ($params_images[2]-1);
				$this->_count_  = (count($params_images) > 0 && isset($params_images[3]))? $params_images[3] : $this->_count_;
				$this->_offset_ = ($page > 0)? ($this->_count_*$page) : 0;

				unset($images);
				$noimage = 0;

                if($menu_id !== false)
                {
                    $query = "SELECT action_id FROM tree_menu WHERE Id=".$menu_id;
                    $result = mysql_query($query, $this->link);
                    if(mysql_num_rows($result) == 1)
                    {
                        $gallery_id = mysql_result($result, 0, 0);    
                    }
                    $where = " galleries.id = ".$gallery_id;    
                }
                else
                {
                    $where = " galleries.path = '".$_images_dir_."'";
                }
                
                $where .= " AND images.isVisible=1 "; 
				$query = "SELECT 
								SQL_CALC_FOUND_ROWS 
								path, 
								filename, 
								title,
								images.id, 
                                galleries.id AS gallery   
						  FROM galleries 
						  LEFT JOIN images ON images.id_galleries=galleries.id 
						  WHERE ".$where.
                          "ORDER BY images.position ASC LIMIT ".$this->_offset_.",".$this->_count_;
				//$html .= $query; 	
				$result = mysql_query($query, $this->link);
				$quant = mysql_result(mysql_query("SELECT FOUND_ROWS()", $this->link), 0);
				while($row = mysql_fetch_assoc($result))
				{
					$noimage++;
					$images[$row['id']] = array('filename' => $row['filename'], 'id' => $row['id']);
			        $title = $row['title'];
                    $gallery = $row['gallery'];	
				}
		
                if(!empty($title))
                {
                    $html .= "<h1>".$title."</h1>";
                }
        
                if($this->_offset_ === 0)
                {
                    $query = "SELECT path, title FROM articles WHERE id_galleries=".$gallery;
                    $result = mysql_query($query, $this->link);
                    if(mysql_num_rows($result) > 0)
                    {
                        $i = 0;
                        $articles = array();
                        while($row = mysql_fetch_assoc($result))
                        {
                            $title[$i] = $row['title'];
                            $filename[$i] = $row['path'];
                            $i++;
                        }
                        $path = getcwd();
                        $slash = '/'; 
                        (stristr($path, $slash)) ? '' : $slash = '\\';
                        $path = getcwd().$slash.$this->articles;
                        foreach($filename as $idx => $_filename_)
                        {
                            if(file_exists($path.$slash.$_filename_.".html"))
    				        {
    					       $articles[$idx] = file_get_contents($path.$slash.$_filename_.".html");
    				        }      
                        }  
                    }
                    
                    if(isset($articles) && !empty($articles))
                    {
                        $html .= '<script type="text/javascript">
                        $("<link>").attr("rel","stylesheet")
                                  .attr("type","text/css")
                                  .attr("href","css/articles.css")
                                  .appendTo("head");
                        </script>';
                        foreach($articles as $article)
                        {
                            $article = preg_replace("#{sliders}.+?{\/sliders}#s", '', $article);
                            $html .=  $article;   
                        }
                        $html .= '<br/><br/>';
                    }
                }
				if($noimage) 
				{
				   	 $html .= '<div class="sig">';
				     $i = 0;
				     foreach($images as $a => $image)
				     {
					     if($image['filename'] != '') 
					     {
						    $html .= '<div class="sig_cont">';
						    $html .= '<div class="sig_thumb">';
						    $html .= '<a href="'.$this->galleries.'/'.$_images_dir_.'/'.$image['filename'].'" rel="lightbox[sig'.$sigcount.']">';
						    $html .= '<img src="showthumb.php?img='.$_images_dir_.'/'.$image['filename'].'&width='.$this->_width_.'&height='.$this->_height_.'&quality='.$this->_quality_.'"></a>';
						    $html .= '</div>';
						    $html .= '</div>';
					     }
					     $i++;
				     }
					 $html .='<div class="sig_clr"></div>';
					 $html .='</div>';
					 
				     if($params_images[2] > 1)
					 {
					 	$html .= '<div class="galmore_prev"><a class="link" href="'.$_images_dir_;
					 	$html .= (isset($params_images[1]) && !empty($params_images[1]))? ','.$params_images[1] : '';
					 	$html .= (isset($params_images[2]) && !empty($params_images[2]))? ','.($params_images[2]-1) : '';
					 	$html .= (isset($params_images[3]) && !empty($params_images[3]))? ','.$params_images[3] : '';
					 	$html .= ',galleries.php"><span class="more">&#171;</span> Poprzednie</a></div>';
					 }
					 if(($this->_offset_+$this->_count_) < $quant)
					 {
					 	$html .= '<div class="galmore_next"><a class="link" href="'.$_images_dir_;
					 	$html .= (isset($params_images[1]) && !empty($params_images[1]))? ','.$params_images[1] : '';
					 	$html .= (isset($params_images[2]) && !empty($params_images[2]))? ','.($params_images[2]+1) : ','.($this->_offset_+2);
					 	$html .= (isset($params_images[3]) && !empty($params_images[3]))? ','.$params_images[3] : ','.$this->_count_;
					 	$html .= ',galleries.php">Następne <span class="more">&#187;</span></a></div>';
					 }
			   }
			   $_images_dir_ .= (isset($params_images[1]) && !empty($params_images[1]))? ','.$params_images[1] : '';
			   $_images_dir_ .= (isset($params_images[2]) && !empty($params_images[2]))? ','.$params_images[2] : '';
			   $_images_dir_ .= (isset($params_images[3]) && !empty($params_images[3]))? ','.$params_images[3] : '';
			   $buffer = preg_replace( "#{galleries}".$_images_dir_."{/galleries}#s", $html , $buffer);
			   $buffer = preg_replace("#(\<title\>)(.*?)(\<\/title\>)#", '$1$2'.' - '.$title.'$3', $buffer);
			}      
		  }
		  return $this->_analyzeBuffer($buffer);
	}
		
	private function _getArticles($buffer)
	{
		  if(preg_match_all("#{articles}(.*?){/articles}#s", $buffer, $matches, PREG_PATTERN_ORDER) > 0) 
		  {
		  	  $html = '';
		  	  $path = getcwd();
			  $slash = '/'; 
		
		      (stristr($path, $slash)) ? '' : $slash = '\\';
		      $path = getcwd().$slash.$this->articles;
			  $sigcount = -1;
			  
			  foreach ($matches[0] as $match) 
			  {
				$sigcount++;
				$_filename_ = preg_replace("/{.+?}/", "", $match);
                if(is_numeric($_filename_))
                {
                    $id = $_filename_;
                    $query = "SELECT path, title FROM articles WHERE id=".$id;
                    $result = mysql_query($query, $this->link);
                    while($row = mysql_fetch_assoc($result))
                    {
                        $title = $row['title'];
                        $_filename_ = $row['path'];
                    }
                }

				if(file_exists($path.$slash.$_filename_.".html"))
				{
					$html .= file_get_contents($path.$slash.$_filename_.".html");
				}
                $_filename_ = (isset($id))?	$id : $_filename_;			
				$buffer = preg_replace( "#{articles}".$_filename_."{/articles}#s", $html , $buffer);
                if(isset($title))
                {
                    $buffer = preg_replace("#(\<title\>)(.*?)(\<\/title\>)#", '$1$2'.' - '.$title.'$3', $buffer);    
                }
				
			  }

		  }
		  return $this->_analyzeBuffer($buffer);	
	}
	
    private function _getTables($buffer)
	{
		  if(preg_match_all("#{tables}(.*?){/tables}#s", $buffer, $matches, PREG_PATTERN_ORDER) > 0) 
		  {
		  	  $html = '';
			  
			  foreach ($matches[0] as $match) 
			  {
				$_table_ = preg_replace("/{.+?}/", "", $match);
				$query = "SELECT `tables`.`title`, `".$_table_."`.* 
								FROM `".$_table_."`, `tables` 
								WHERE tables.path = '".$_table_."' 
								ORDER BY ".$_table_.".id ASC";
				$result = mysql_query($query, $this->link);
				
				$table_result=array();
				$r = 0;
				if(mysql_num_rows($result) > 0)
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

	    			$empty = array('id', 'isVisible'); // pola ktorych wartosci nie pokazujemy
					$table = '<table class="tabled" cellspacing="1" cellpadding="5">';
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
											$title = $fieldname;
										}
										$empty[] = $key;
										continue;
									}
									if(!is_numeric($fieldname))
									{
										$table .= '<th>'.$fieldname.'</th>';
									}
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
					
					$html .= '<div class="tab_title">'.$title.'</div>';
					$html .= $table;
					$html .= '<br style="clear:all" />';
				}
				$buffer = preg_replace( "#{tables}".$_table_."{/tables}#s", $html , $buffer);
				$buffer = preg_replace("#(\<title\>)(.*?)(\<\/title\>)#", '$1$2'.' - '.$title.'$3', $buffer);
			  }
		  }
		  return $this->_analyzeBuffer($buffer);	
	}
		
	private function _getMovies($buffer)
	{
		  if(preg_match_all("#{movies}(.*?){/movies}#s", $buffer, $matches, PREG_PATTERN_ORDER) > 0) 
		  {
		  	  $html = '';
			  $movies = array();
			  foreach ($matches[0] as $match) 
			  {
				$_movie_ = preg_replace("/{.+?}/", "", $match);
				$query = "SELECT id, title, path, url, width, height 
								FROM `movies`  
								WHERE path = '".$_movie_."'";
				$result = mysql_query($query, $this->link);
				

				if(mysql_num_rows($result) > 0)
				{
					while($row = mysql_fetch_assoc($result))
					{
						$movies[$row['id']]['title'] = stripslashes($row['title']);
						$movies[$row['id']]['url'] = stripslashes($row['url']);
						$movies[$row['id']]['width'] = $row['width'];
						$movies[$row['id']]['height'] = $row['height'];	
					}
					
					foreach($movies as $movie)
					{
						$html .= '<div class="movie">';
						$html .= '<div class="movie_title">'.$movie['title'].'</div>';
						$html .= '<object height="'.$movie['height'].'" width="'.$movie['width'].'"><param value="'.$movie['url'].'" name="movie"><param value="true" name="allowFullScreen">';
						$html .= '<embed height="'.$movie['height'].'" width="'.$movie['width'].'" allowfullscreen="true" type="application/x-shockwave-flash" src="'.$movie['url'].'">';
						$html .= '</object>';
						$html .= '</div>';
					}	
				}
				$buffer = preg_replace( "#{movies}".$_movie_."{/movies}#s", $html , $buffer);
			  }
		  }
		  return $this->_analyzeBuffer($buffer);
	}

    private function _getSliders($buffer)
	{
		  $html = '';	
		  if (preg_match_all("#{sliders}(.*?){/sliders}#s", $buffer, $matches, PREG_PATTERN_ORDER) > 0) 
		  {
			  $sigcount = -1;
			  foreach ($matches[0] as $match) 
			  {
				$sigcount++;
				$_images_dir_ = preg_replace("/{.+?}/", "", $match);		
				$params_images = explode(',', $_images_dir_);
				$_images_dir_ = (count($params_images) > 0)? $params_images[0] : $_images_dir_;
				$inView = (count($params_images) > 0 && isset($params_images[1]))? $params_images[1] : false;
				$advance = (count($params_images) > 0 && isset($params_images[2]))? $params_images[2] : false;
				
				unset($images);
				$noimage = 0;
				
				$query = "SELECT 
								SQL_CALC_FOUND_ROWS 
								path, 
								filename, 
								title, 
								images.id  
						  FROM galleries 
						  LEFT JOIN images ON images.id_galleries=galleries.id 
						  WHERE galleries.path = '".$_images_dir_."' AND images.isVisible=1 ORDER BY images.position ASC  LIMIT ".$this->_offset_.",".$this->_count_;
				 	
				$result = mysql_query($query, $this->link);
				$quant = mysql_result(mysql_query("SELECT FOUND_ROWS()", $this->link), 0);

				while($row = mysql_fetch_assoc($result))
				{
					$noimage++;
					////$images[] = array('filename' => $row['filename']);
			        ////array_multisort($images, SORT_ASC, SORT_REGULAR);
			        $images[$row['id']] = array('filename' => $row['filename'], 'id' => $row['id']);
			        $title = $row['title'];	
				}
		
				if($noimage) 
				{
					 $id = uniqid('carousel_');
				   	 $html .= '<div id="'.$id.'">';
				   	 $html .= '<ul>';
				     ////for($a = 0; $a < $noimage; $a++)
				     $i = 0;
				     foreach($images as $a => $image) 
				     {
					     if($image['filename'] != '') 
					     {
						    $html .= '<li>';
						    $html .= '<a href="'.$this->galleries.'/'.$_images_dir_.'/'.$image['filename'].'" rel="lightbox[sig'.$sigcount.']">';
						    $html .= '<img style="border: none" width="'.$this->_slider_width_.'" height="'.$this->_slider_height_.'" alt="" src="showthumb.php?img='.$_images_dir_.'/'.$image['filename'].'&width='.$this->_slider_width_.'&height='.$this->_slider_height_.'&quality='.$this->_quality_.'" />';
						    $html .= '</a>';
						    $html .= '</li>';
					     }
				     }
				     $html .= '</ul>';
					 $html .= '</div>';
					 $html .= '<script type="text/javascript">';
					 $html .= "\r\n$(function(){\r\n";
					 $html .= "$('#".$id."').infiniteCarousel(";
					 $html .= (count($params_images) > 1)? '{' : '';
					 $html .= ($inView)? "inView: ".$inView.",\r\n" : '';
					 $html .= ($advance)? "advance: ".$advance.",\r\n" : '';
					 $html .= (count($params_images) > 1)? '}' : '';
					 $html .= ");\r\n}\r\n);";
					 $html .= "</script>\r\n";
	
			   }
			   $_images_dir_ .= (isset($params_images[1]) && !empty($params_images[1]))? ','.$params_images[1] : '';
			   $_images_dir_ .= (isset($params_images[2]) && !empty($params_images[2]))? ','.$params_images[2] : '';
			   $buffer = preg_replace( "#{sliders}".$_images_dir_."{/sliders}#s", $html , $buffer);
			}      
		  }
		  return $this->_analyzeBuffer($buffer);
	}
	
    private function _getObjects($buffer)
	{
		  if(preg_match_all("#{objects}(.*?){/objects}#s", $buffer, $matches, PREG_PATTERN_ORDER) > 0) 
		  {			  
			  foreach ($matches[0] as $match) 
			  {
			  	$html = '';
				$_id_ = preg_replace("/{.+?}/", "", $match);
				$query = "SELECT id, position, title, path, images_id, url, text, target, width, height, container, class 
								FROM `objects`  
								WHERE id = '".$_id_."' AND isVisible=1";
				
				$result = mysql_query($query, $this->link);
				
				if(mysql_num_rows($result) > 0)
				{
					$object = array();
					$i = 0;
					while($row = mysql_fetch_assoc($result))
					{
						$object['title'] = stripslashes($row['title']);
						$object['path'] = stripslashes($row['path']);
						$object['img_id'] = stripslashes($row['images_id']);
						$object['url'] = stripslashes($row['url']);
						$object['target'] = stripslashes($row['target']);
						$object['width'] = $row['width'];
						$object['height'] = $row['height'];
						$object['container'] = $row['container'];
						$object['class'] = $row['class'];
                        $object['text'] = stripslashes($row['text']);	
					}
					$html .= (!empty($object['container']))? '<'.$object['container'] : '';
					$html .= (!empty($object['class']))? ' class="'.$object['class'].'">' : '>';
                    $html .= '<div class="image">';
					$html .= (!empty($object['url']))? '<a href="http://'.$object['url'].'"' : '';
					$html .= (!empty($object['target']) && !empty($object['url']))? ' target="'.$object['target'].'"' : '';
                    $html .= (!empty($object['url']))? '>' : '';
					$html .= (!empty($object['path']))? '<img src="galleries/'.$object['path'].'"  style="border: none"/>' : '';
					$html .= (!empty($object['url']))? '</a>' : '';
                    $html .= '</div>';
                    $html .= (!empty($object['text']))? '<div class="text">'.$object['text'].'</div>' : '';
					$html .= (!empty($object['container']))? '</'.$object['container'].'>' : '';	
				}
				$buffer = preg_replace( "#{objects}".$_id_."{/objects}#s", $html , $buffer);
			  }
		  }
		  return $this->_analyzeBuffer($buffer);
	}
	
    private function _getNews($buffer)
	{
		  if(preg_match_all("#{news}(.*?){/news}#s", $buffer, $matches, PREG_PATTERN_ORDER) > 0) 
		  {	
		      
              $html = '';
		  	  $path = getcwd();
			  $slash = '/'; 
		
		      (stristr($path, $slash)) ? '' : $slash = '\\';
		      $path = getcwd().$slash.$this->news;
              //$path = $this->news;
              $_id_ = 5;
			  
              $query = "SELECT  date, 
                                title,
                                headline, 
                                id_articles,
                                id_galleries,
                                id_images,
                                id_objects
                                            FROM news
                                            WHERE isVisible = 1 
                                            ORDER BY date DESC
                                            LIMIT 0 , 30";
	
				$result = mysql_query($query, $this->link);
				
				if(mysql_num_rows($result) > 0)
				{
					$news = array();
					$i = 0;
					while($row = mysql_fetch_assoc($result))
					{
						$news[$i]['date'] = (!empty($row['date']))? $row['date'] : date("Y-m-d");
                        $news[$i]['title'] = stripslashes($row['title']);
						$news[$i]['headline'] = stripslashes($row['headline']);
                        $news[$i]['article'] = (!empty($row['id_articles']) && $row['id_articles'] != 0)? $row['id_articles'] : false;
                        $news[$i]['gallery'] = (!empty($row['id_galleries']) && $row['id_galleries'] != 0)? $row['id_galleries'] : false;
                        if($news[$i]['gallery'] !== false)
                        {
                            $query = "SELECT g.path AS path, t.Id AS tree_id FROM galleries AS g 
                            LEFT JOIN tree_menu AS t ON g.id=t.action_id WHERE g.id=".$news[$i]['gallery'];
                            $result2 = mysql_query($query, $this->link);
                            if(mysql_num_rows($result2) > 0)
                            {
                               while($row2 = mysql_fetch_assoc($result2))
                                {
                                    $news[$i]['gallery_path'] = $row2['path'];
                                    $news[$i]['tree_id'] = $row2['tree_id'];
                                }   
                            }
                            else
                            {
                                $news[$i]['gallery_path'] = false;    
                            }  
                        }
                        
                        $news[$i]['object'] = (!empty($row['id_objects']) && $row['id_objects'] != 0)? $row['id_objects'] : false;
						$i++;	
					}

                    foreach($news as $item)
                    {
                       $html .= '<div class="newsitem">';
                       $html .= '<table class="newstable" cellpadding="5">';
                       $html .= '<tr>';
                       $html .= '<td class="newsdate">'.$item['date'].'</td>';
                       $html .= '<td class="newstitle" style="width: 90%">'.$item['title'].'</td>';
                       $html .= '</tr>';
                       $html .= '<tr>';
                       $html .= '<td colspan="2">';
                       $html .= '<table ';
                       $html .= ($item['object'])? '' : ' style="margin:0 auto"';
                       $html .= ' class="newscontent">';
                       if($item['object'])
                       {
                            $html .= '<td class="newsobject">';
                            $html .= '{objects}'.$item['object'].'{/objects}';
                            $html .= '</td>';
                       }
                       $html .= '<td class="newsheadline">';
                       if(file_exists($path.$slash.$item['headline'].".html"))
				       {
					       $html .= file_get_contents($path.$slash.$item['headline'].".html");
                       }
                       if($item['article'])
                       {
                            $html .= '<div class="newsmore">';
                            $html .= '<a class="link" href="'.$item['article'].',articles.php"><span class="more">więcej <b>&#187;</b></span></a>'; 
                            $html .= '</div>';
                       }
                       elseif($item['article'] == false && $item['gallery'] !== false && $item['gallery_path'] !== false)
                       {
                            $html .= '<div class="newsmore">';
                            $html .= '<a class="link" href="'.$item['gallery_path'].','.$item['tree_id'].',galleries.php"><span class="more">zobacz zdjęcia <b>&#187;</b></span></a>'; 
                            $html .= '</div>';
                       }
                       $html .= '</td>';
                       $html .= '</table>';
                       $html .= '</td>';
                       $html .= '</tr>';
                       $html .= '</table>';  
                       $html .= '</div>'; 
                    }
                }
				$buffer = preg_replace( "#{news}".$_id_."{/news}#s", $html , $buffer);
			  }
		  return $this->_analyzeBuffer($buffer);
	}
}
?>