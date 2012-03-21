<?php
class contentProcessor
{
	public $link;
	public $galleries;
	public $articles;
    public $news;
	public $_width_;
	public $_height_;
	public $_quality_;
	public $_offset_;
	public $_count_;
	public $_slider_width_;
	public $_slider_height_;
	public $treeManager;
	
    function __construct()
    {
    	ob_start(array(&$this, "_getContent"));
   	
    	define("IN_PHP", true);
		require_once('includes/config.php');
		require_once('includes/classes/Mysql.php');
		require_once('includes/classes/DBTreeManager.php');
		$db = new MySQL($dbHost, $dbUsername, $dbPassword, $dbName);
			
		$this->treeManager = new DBTreeManager($db);
    	
    	$this->link = $GLOBALS['link'];
    	$this->galleries = $GLOBALS['galleries'];
    	$this->articles = $GLOBALS['articles'];
        $this->news = $GLOBALS['news'];
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
	
	private function setTopDimensions()
	{
		$this->_width_ = 328;
    	$this->_height_ = 75;	
	}
	
	private function _analyzeBuffer($buffer)
	{
		if(preg_match_all("#({)(articles|galleries|tables|news|movies|sliders)_view(})#s", $buffer,$matches))
		{
		  
			foreach($matches[2] as $k => $v)
			{
				switch($v)
				{
					case 'articles' :
						return $this->_getArticles($buffer);
					break;
					case 'tables' :
						return $this->_getTables($buffer);
					break;
					/*case 'movies' :
						return $this->_getMovies($buffer);
					break;
					case 'sliders' :
						return $this->_getSliders($buffer);
					break;*/
					case 'galleries' :
						return $this->_getView($buffer);
					break;
                    case 'news' :
						return $this->_getNews($buffer);
					break;
				}
			}			
		}
		else return $buffer;		
	}

	private function _getView($buffer)
	{
		  $html = '';	
		  if (preg_match_all("#{galleries_view}(.*?){/galleries_view}#s", $buffer, $matches, PREG_PATTERN_ORDER) > 0) 
		  {
			  $sigcount = -1;
			  foreach ($matches[0] as $match) 
			  {
				$sigcount++;
				$_view_ = preg_replace("/{.+?}/", "", $match);		
			
				unset($images);
				$noimage = 0;
				
				
				
				$result = $this->treeManager->getGallery($_view_);
				 
				while($row = mysql_fetch_assoc($result))
				{
					$noimage++;
					$images[$row['id']] = array('filename' => $row['filename'], 'id' => $row['id'], 'visible' => $row['isVisible']);
			        $title = $row['title'];
			        $_images_dir_ = $row['path'];	
				}
		
                $article_result = $this->treeManager->getGalleryArticle($_view_);

                $article = '';

                if(mysql_num_rows($article_result) === 1)
                {
                    $row = mysql_fetch_assoc($article_result);
					$article = array(
                                    'id' => $row['id'],
                                    'title' => $row['title'], 
                                    'path' => $row['path'],
                                    );
                    $filename = '../'.$this->articles.'/'.$article['path'].'.html';
                    $article_id = $article['id'];
                    $article = file_get_contents($filename);
                    $tree_result = $this->treeManager->getTreeIdByContentId($article_id);
                    if(mysql_num_rows($tree_result) === 1)
                    {
                        $row = mysql_fetch_assoc($tree_result);
                        $tree_id = $row['id'];
                    }
                }
                
				if($_images_dir_ == 'top')
				{
					$this->setTopDimensions();
					$result = $this->treeManager->getDefault();
					while($row = mysql_fetch_assoc($result))
					{
						$default_id = $row['id_images'];
					}
				}
				
				if($noimage) 
				{
				   	 $html .= '<div id="contentLeft">';
				   	 $html .= '<div id="articleContainer" style="margin-left:40px;">';
                     if(!empty($article))
                     {
                        $html .= '<div class="articons" style="float:left;clear:both">';
                        $html .= '<img id="unlink_'.$tree_id.'" src="unlink.png" alt="Unlink" class="common_icons" />';
                        $html .= '<img id="viewedit_'.$tree_id.'" src="view_edit.png" alt="View/Edit" class="common_icons" />';
                        $html .= '</div><br/><br/>';
                        $html .= $article;
                     }
                     $html .= '</div>';
				   	 $html .= '<ul class="thumbnails">';
  	 	 			

				     foreach($images as $a => $image) 
				     {
					     if($image['filename'] != '') 
					     {
					     	$src = ($image['visible'] == 0)? 'show.png' : 'stop.png';
					     	$rel = ($image['visible'] == 0)? 'rel="stop"' : 'rel="show"';
						    $html .= '<li class="sig_cont" id="image_'.$image['id'].'">';
						    $html .= '<div id="div">';
						    $html .= '<a href="../'.$this->galleries.'/'.$_images_dir_.'/'.$image['filename'].'" rel="lightbox[sig'.$sigcount.']">';
						    $html .= '<img '.$rel.' id="pic_'.$image['id'].'" src="showthumb.php?img='.$_images_dir_.'/'.$image['filename'].'&width='.$this->_width_.'&height='.$this->_height_.'&quality='.$this->_quality_.'" width="'.$this->_width_.'" height="'.$this->_height_.'"/>';
						    $html .= '</a>';
						    $html .= '</div>';
						    $html .= '<img onclick="hideImg(this)" id="hid_'.$image['id'].'" class="hide" src="'.$src.'" alt="Ukryj" style="float:left; margin:3px"/>';
						    
						    if($_images_dir_ == 'top')
						    {
						    	$checked = ($image['id'] == $default_id)? ' checked="checked"' : '';
						    	$html .= '<input type="radio" id="default" name="default" value="'.$image['id'].'"'.$checked.'/><label id="lbl_'.$image['id'].'" style="color: #ff0000" for="default">123abc</label>';
						    	$html .= '<img src="top_bg.png" id="drop_'.$image['id'].'" style="margin: 2px auto 0 20px"/>';
						    }
						    $imageSize = @getimagesize('../'.$this->galleries.'/'.$_images_dir_.'/'.$image['filename']);
                            $dimensions = (is_array($imageSize))? $imageSize[0].'x'.$imageSize[1] : 0;
                            
                            $html .= '<img onclick="insertImg(this, \''.$dimensions.'\')" src="insert.png" id="insert_'.$image['id'].'" style="width:16px; height:16px; margin: 2px auto 0 20px"/>';
                            
                            
						    $html .= '<img onclick="delImg(this)" id="del_'.$image['id'].'" class="delete" src="cross.png" alt="Usuń"/ style="float:right; margin:3px"/>';
						    $html .= '</li>';
					      	if($_images_dir_ == 'top')
				          	{
				     	  		$html .= '<br style="clear:both"/>';
				     		}
					     }
				     }	
					 $html .='</ul>';
					 $html .='</div>';
					
					 $html .= "\n";					 
					 $html .= '<script type="text/javascript">';
					 $html .= "\n";
                     $html .= "var _images_dir_ =\"".$_images_dir_."\"";
                     $html .= "\n";

				 $html .= '</script>';
				 $html .= "\n";
				 $html .= "\n";
			   }
			   $buffer = preg_replace( "#{galleries_view}".$_view_."{/galleries_view}#s", $html , $buffer);
			}      
		  }
		  return $this->_analyzeBuffer($buffer);
	}
    
    private function _getArticles($buffer)
    {
   	      $html = '';	
		  if (preg_match_all("#{articles_view}(.*?){/articles_view}#s", $buffer, $matches, PREG_PATTERN_ORDER) > 0) 
		  {
			  $sigcount = -1;
			  foreach ($matches[0] as $match) 
			  {

				$_view_ = preg_replace("/{.+?}/", "", $match);		
			
				$result = $this->treeManager->getArticle($_view_);

                if(mysql_num_rows($result) === 1)
                {
                    $row = mysql_fetch_assoc($result);
					$article = array(
                                    'id' => $row['id'],
                                    'title' => $row['title'], 
                                    'path' => $row['path'],
                                    );
                    $filename = '../'.$this->articles.'/'.$article['path'].'.html';
                    $html .= file_get_contents($filename);
                }
                $buffer = preg_replace( "#{articles_view}".$_view_."{/articles_view}#s", $html , $buffer);
			  }      
		  }
		  return $this->_analyzeBuffer($buffer);
    }
    
    private function _getTables($buffer)
    {
   	      $html = '';	
		  if (preg_match_all("#{tables_view}(.*?){/tables_view}#s", $buffer, $matches, PREG_PATTERN_ORDER) > 0) 
		  {
			  $sigcount = -1;
			  foreach ($matches[0] as $match) 
			  {
    				$_view_ = preg_replace("/{.+?}/", "", $match);
    				$result = $this->treeManager->getTable($_view_);
                    //$html .= implode(';',$result);
                    $empty = array('id', 'isVisible'); // pola ktorych wartosci nie pokazujemy
					$table = '<table class="tabled" cellspacing="1" cellpadding="5">';
					foreach($result as $k => $v)
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

                    $buffer = preg_replace( "#{tables_view}".$_view_."{/tables_view}#s", $html , $buffer);
			  }      
		  }
		  return $this->_analyzeBuffer($buffer);
    }
    
    private function _getNews($buffer)
    {
   	      $html = '';	
		  if (preg_match_all("#{news_view}(.*?){/news_view}#s", $buffer, $matches, PREG_PATTERN_ORDER) > 0) 
		  {
			  $sigcount = -1;
			  foreach ($matches[0] as $match) 
			  {

				$_view_ = preg_replace("/{.+?}/", "", $match);		
			
$result = $this->treeManager->getNews($_view_);
//$html .= $result;
foreach($result as $k => $v)
{
    if(is_array($v))
    {
foreach($v as $key => $val) $html .= $key." => ".$val.'<br/>';
        $src = ($v['visible'] == 0)? 'show.png' : 'stop.png';
        $class = ($v['visible'] == 0)? 'show_news' : 'hide_news';
        $html .= '<div class="newsitem" id="news_'.$v['id'].'">
            <table cellpadding="5" class="newstable">
                <tbody>
                    <tr>
                        <td style="width:auto"><div class="newsdate" id="date_'.$v['id'].'">'.$v['date'].'</div><input type="hidden" id="dateh_'.$v['id'].'" class="datepicker" value="'.$v['date'].'" /></td>
                        <td style="width: 85%"><div class="newstitle" id="title_'.$v['id'].'">'.$v['title'].'</div></td>
                        <td style="width:36px"><div class="newsdate"><div rel="'.$v['id'].'" class="'.$class.'"  title="Ukryj"/><div rel="'.$v['id'].'" class="delete_news" title="Usuń"/></div></td> 
                    </tr>
                    <tr>
                        <td colspan="3">
                            <table class="newscontent">
                                <tbody>
                                    <tr>';
        if(isset($v['gallery']) && !empty($v['gallery']) && isset($v['image']) && !empty($v['image']))
        {
            $html .= '<td class="newsobject"><div>';
            if(isset($v['url']) && !empty($v['url']))
            {
                $html .= '<a href="http://'.$v['url'].'"';
                $html .= (isset($v['target']) && !empty($v['target']))? ' target="'.$v['target'].'">' : '>';
            }
            $html .= '<img style="border:none" src="image.php?img='.$v['gallery'].'/';
            $src_arr = explode('.', $v['image']);
            $html .= (isset($v['dimensions']) && !empty($v['dimensions']))? $src_arr[0].','.$v['dimensions'].'.'.$src_arr[1] : $src_arr[0].'.'.$src_arr[1];
            $html .= '" />';
            $html .= (isset($v['url']) && !empty($v['url']))? '</a>' : '';
            '</div></td>';    
        }                                                            
        $html .= '<td class="newsheadline">';
        if(isset($v['headline']) && !empty($v['headline']))
        {
            $filename = '../'.$this->news.'/'.$v['headline'].'.html';
            $html .= file_get_contents($filename);
        }    
        $html .= '<div class="newsmore"><a href="'.$v['id_articles'].',articles.php" class="link"><span class="more">więcej <b>»</b></span></a></div>';
        $html .= '</td>';
        $html .= '</tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>';
    }
}

                
                $buffer = preg_replace( "#{news_view}".$_view_."{/news_view}#s", $html , $buffer);
			  }      
		  }
		  return $this->_analyzeBuffer($buffer);
    }
}
?>