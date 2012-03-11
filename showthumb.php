<?php

if($_GET['img'] == "")
exit;

$_GET['img'] = str_replace( '..', '', urldecode( $_GET['img'] ) );
$_image_ = 'galleries/'.$_GET['img'];

$folder = "cache";
$path = getcwd();
$slash = '/'; 

(stristr($path, $slash)) ? '' : $slash = '\\';
$path = getcwd().$slash.$folder.$slash.basename($_image_);

$_width_min_ = intval($_GET['width']);
$_height_min_ = intval($_GET['height']);
$_quality_ = intval($_GET['quality']);

$new_w = $_width_min_;
$imagedata = getimagesize($_image_);

if(!$imagedata[0])
exit();

$new_h = ceil($imagedata[1]*($new_w/$imagedata[0]));

if(($_height_min_) AND ($new_h != $_height_min_)) 
{
	$new_h = $_height_min_;
	$new_w = ceil($imagedata[0]*($new_h/$imagedata[1]));
}

if(strtolower(substr($_GET['img'],-3)) == "jpg") 
{
	header("Content-type: image/jpg");
	if(file_exists($path))
	{
		echo file_get_contents($path);
	}
	else
	{
		$dst_img=ImageCreate($new_w,$new_h);
		$src_img=ImageCreateFromJpeg($_image_);
		$dst_img = imagecreatetruecolor($new_w, $new_h);
		imagecopyresampled($dst_img,$src_img,0,0,0,0,$new_w,$new_h,ImageSX($src_img),ImageSY($src_img));
			ob_start();
		$img = Imagejpeg($dst_img,'', $_quality_);
		    $ob_contents = ob_get_contents();; 
		    // Save file
		    $fp = fopen ("$path",'wb');
		    fwrite ($fp, $ob_contents);
		    fclose ($fp);
		    ob_end_flush();
	}
}
if(substr($_GET['img'],-3) == "gif") 
{
	header("Content-type: image/gif");
	if(file_exists($path))
	{
		echo file_get_contents($path);
	}
	else
	{
		$dst_img=ImageCreate($new_w,$new_h);
		$src_img=ImageCreateFromGif($_image_);  
		ImagePaletteCopy($dst_img,$src_img);
		ImageCopyResized($dst_img,$src_img,0,0,0,0,$new_w,$new_h,ImageSX($src_img),ImageSY($src_img));
			ob_start();
		$img = Imagegif($dst_img,'', $_quality_);
			$ob_contents = ob_get_contents();; 
	    // Save file
	    $fp = fopen ("$path",'wb');
	    fwrite ($fp, $ob_contents);
	    fclose ($fp);
	    ob_end_flush();
	}
}
if(substr($_GET['img'],-3) == "png") 
{
	header("Content-type: image/png");
	if(file_exists($path))
	{
		echo file_get_contents($path);
	}
	else
	{
		if (strnatcmp(phpversion(),'4.3.0') > 0) 
	    { 
	        $_quality_ = (int) ($_quality_/10); 
	    }
		$src_img=ImageCreateFromPng($_image_);
		$dst_img = imagecreatetruecolor($new_w, $new_h); 
		ImagePaletteCopy($dst_img,$src_img);
		ImageCopyResized($dst_img,$src_img,0,0,0,0,$new_w,$new_h,ImageSX($src_img),ImageSY($src_img));
			ob_start();
		$img = Imagepng($dst_img,'', $_quality_);
			$ob_contents = ob_get_contents();; 
			    // Save file
	    $fp = fopen ("$path",'wb');
	    fwrite ($fp, $ob_contents);
	    fclose ($fp);
	    ob_end_flush();
	}
}
?>
