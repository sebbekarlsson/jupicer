<?php

	header('content-type: image/jpg');
	
	$url = $_GET['url'];
	$w = $_GET['width'];
	$h = $_GET['height'];
	
	/*===================================================================================
	Output goes here!
	====================================================================================*/
	resizeImage($url,$w,$h);

	/*===================================================================================
	Resize images to certain scale!
	====================================================================================*/
	function resizeImage($file, $width, $height){
		$ext = strtolower(end(explode('.', $file)));
		$newwidth = $width;
		$newheight = $height;
		list($width, $height) = getimagesize($file);

		$thumb = imagecreatetruecolor($newwidth, $newheight);
		if($ext == "jpg" || $ext == "jpeg"){
			$source = imagecreatefromjpeg($file);
		}else if($ext == "png"){
			$source = imagecreatefrompng($file);
		}else if($ext == "gif"){
			$source = imagecreatefromgif($file);
		}
		
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		imagejpeg($thumb);
	}


?>