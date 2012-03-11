<?php
$folder = "galleries";
$path = getcwd();
$slash = '/'; 

(stristr($path, $slash)) ? '' : $slash = '\\';
$path = getcwd().$slash.$folder;

	if ($dh = opendir($path)) 
    {
    	echo $path;
        while (($file = readdir($dh)) !== false) 
        {
            if ($file != '..' && $file != '.' && $file == 'klimatyczne_foto_z_biwaku')
            {
            	$dh2 = opendir($path.$slash.$file);
            	while (($img = readdir($dh2)) !== false) 
        		{
            		if ($img != '..' && $img != '.')
            		{
            			$filename = explode('.', $img);
            			$newname = md5_file($path.$slash.$file.$slash.$img);
            			rename($path.$slash.$file.$slash.$img, strtolower($path.$slash.$file.$slash.$newname.".".end($filename)));
            		}
        		}
        		closedir($dh2);
            }
        }
        closedir($dh);
    }

?>