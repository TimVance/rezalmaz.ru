<?php
// PPP - Path Part of Page
function getPPP($suffix) {
	$path_info = pathinfo($_SERVER['SCRIPT_NAME']);
	return ($path_info['dirname']=='/'?'/':$path_info['dirname'].'/').$path_info['filename'] .'.'.$suffix.'.php';
}

function existPartOfPage($suffix) {
	return file_exists($_SERVER['DOCUMENT_ROOT'].getPPP($suffix));
}
function show_email_link($email, $subject=null) {
	return '<script type="text/javascript">document.write(base64_decode("'.base64_encode('<a href="mailto:'.$email.(($subject!==null)?'?subject='.$subject:null).'">'.$email.'</a>').'"))</script>';
}
function get_resized_image_path($source_path, $width=0, $height=0) {
	if ($width > 0 || $height > 0) {
		$source_path = pathinfo($source_path);
		$source_path = $source_path['dirname'].'/'.$source_path['filename'].'.'.$width.'x'.$height.'.'.$source_path['extension'];
	}
	
	return $source_path;
}
function resize_image($source_image, $max_width=0, $max_height=0) {
	CFile::ResizeImageFile($source_image, get_resized_image_path($source_image, $max_width, $max_height), array('width'=>$max_width?$max_width:9999,'height'=>$max_height?$max_height:9999));
}
function show_img($source_image, $max_width=0, $max_height=0) {
	$source_image = $_SERVER['DOCUMENT_ROOT'].$source_image;
	$size = getimagesize($source_image);
	if ($size && file_exists($source_image)) {
		if (($max_width > 0 && $size[0] > $max_width) || ($max_height > 0 && $size[1] > $max_height)) {
			if (!file_exists(get_resized_image_path($source_image, $max_width, $max_height)))
				resize_image($source_image, $max_width, $max_height);
			
			return CFile::ShowImage(str_replace($_SERVER['DOCUMENT_ROOT'], '', get_resized_image_path($source_image, $max_width, $max_height)));
		} else {
			return CFile::ShowImage(str_replace($_SERVER['DOCUMENT_ROOT'], '', $source_image));
		}
	}
}
function show_a_img($source_image, $preview_max_width=0, $preview_max_height=0, $max_width=0, $max_height=0) {
	return '<a href="'. get_img_path($source_image, $max_width, $max_height) .'">'. CFile::ShowImage(get_img_path($source_image, $preview_max_width, $preview_max_height)) .'</a>';
}
function get_img_path($source_image, $max_width=0, $max_height=0) {
	$source_image = $_SERVER['DOCUMENT_ROOT'].$source_image;
	$size = getimagesize($source_image);
	if ($size && file_exists($source_image)) {
		if (($max_width > 0 && $size[0] > $max_width) || ($max_height > 0 && $size[1] > $max_height)) {
			if (!file_exists(get_resized_image_path($source_image, $max_width, $max_height)))
				resize_image($source_image, $max_width, $max_height);
			
			return str_replace($_SERVER['DOCUMENT_ROOT'], '', get_resized_image_path($source_image, $max_width, $max_height));
		} else {
			return str_replace($_SERVER['DOCUMENT_ROOT'], '', $source_image);
		}
	}
}

function cropText($text, $length, $seporator_word=true) {
	if (strlen($text) > $length) {
		$text = substr($text, 0, strrpos(substr($text, 0, $length), ' ')) . '...';
	}
	
	return $text;
}
?>