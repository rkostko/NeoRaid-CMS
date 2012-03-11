<?php
//$_GET["img"] = 'rajdy_przeprawowe/24abfae491da8df392ca98c205f599d6,1115,836,480,141,250,309.jpg';
if(isset($_GET["img"]) && !empty($_GET["img"]))
{
    $params = array();
    $file_path =dirname(__FILE__);
    $slash = '/'; 	
	(stristr($path, $slash)) ? '' : $slash = '\\';
    $_GET["img"] = str_replace('/', $slash, $_GET["img"]);
    $pos = strpos($file_path, "admin");
    $file_path = substr_replace($file_path, "galleries".$slash, $pos).$_GET["img"];
    
    $filename_arr = explode('.', basename($file_path));
    (stristr($filename_arr[0], ','))? $params = explode(',', $filename_arr[0]) : '';
    
    if(!empty($params))
    {
       array_shift($params);
       $file_path = str_replace(",".implode(",", $params), '', $file_path);
       $info = getimagesize($file_path);
       header("Content-type: {$info['mime']}");
       $img = (count($params) > 2)? ResizeAndCrop($file_path, $params) : Resize($file_path, $params); 
    }
    else
    {
        $info = getimagesize($file_path);
        $img = file_get_contents($file_path);
        header("Content-type: {$info['mime']}");
        echo $img;    
    }
        
}

function Resize($img_src, $params)
{
    $ext = end(explode(".",$img_src));
    $function = returnCorrectFunction($ext);
    $image = $function($img_src);
    $width = imagesx($image);
    $height = imagesy($image);
    // Resample
    $image_p = imagecreatetruecolor($params[0], $params[1]);
    setTransparency($image,$image_p,$ext);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $params[0], $params[1], $width, $height);
    imagedestroy($image);
    return parseImage($ext,$image_p,$file = null);   
}

function ResizeAndCrop($img_src, $params)
{
    $ext = end(explode(".",$img_src));
    $function = returnCorrectFunction($ext);
    $image = $function($img_src);
    $width = imagesx($image);
    $height = imagesy($image);
    // Resample first
    $image_p = imagecreatetruecolor($params[0], $params[1]);
    setTransparency($image,$image_p,$ext);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $params[0], $params[1], $width, $height);
    imagedestroy($image);
    $pWidth = imagesx($image_p);
    $pHeight = imagesy($image_p);
    $viewport = imagecreatetruecolor($params[4], $params[5]);
    setTransparency($image_p,$viewport,$ext);
    imagecopy($viewport, $image_p, 0, 0, $params[2], $params[3], $params[4], $params[5]);
    imagedestroy($image_p);
    return parseImage($ext,$viewport,$file = null);   
}


function parseImage($ext,$img,$file = null){
	switch($ext){
		case "png":
			imagepng($img,($file != null ? $file : ''));
			break;
		case "jpeg":
			imagejpeg($img,($file ? $file : ''),90);
			break;
		case "jpg":
			imagejpeg($img,($file ? $file : ''),90);
			break;
		case "gif":
			imagegif($img,($file ? $file : ''));
			break;
	}
}

function returnCorrectFunction($ext){
	$function = "";
	switch($ext){
		case "png":
			$function = "imagecreatefrompng";
			break;
		case "jpeg":
			$function = "imagecreatefromjpeg";
			break;
		case "jpg":
			$function = "imagecreatefromjpeg";
			break;
		case "gif":
			$function = "imagecreatefromgif";
			break;
	}
	return $function;
}

function setTransparency($imgSrc,$imgDest,$ext){

	if($ext == "png" || $ext == "gif"){
		$trnprt_indx = imagecolortransparent($imgSrc);
		// If we have a specific transparent color
		if ($trnprt_indx >= 0) {
			// Get the original image's transparent color's RGB values
			$trnprt_color    = imagecolorsforindex($imgSrc, $trnprt_indx);
			// Allocate the same color in the new image resource
			$trnprt_indx    = imagecolorallocate($imgDest, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
			// Completely fill the background of the new image with allocated color.
			imagefill($imgDest, 0, 0, $trnprt_indx);
			// Set the background color for new image to transparent
			imagecolortransparent($imgDest, $trnprt_indx);
		}
		// Always make a transparent background color for PNGs that don't have one allocated already
		elseif ($ext == "png") {
			// Turn off transparency blending (temporarily)
			imagealphablending($imgDest, true);
			// Create a new transparent color for image
			$color = imagecolorallocatealpha($imgDest, 0, 0, 0, 127);
			// Completely fill the background of the new image with allocated color.
			imagefill($imgDest, 0, 0, $color);
			// Restore transparency blending
			imagesavealpha($imgDest, true);
		}

	}
}
?>