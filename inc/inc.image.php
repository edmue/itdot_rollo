<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: image.inc.php 96 2011-07-12 14:06:27Z siekiera $
* 	Letzter Stand:			$Revision: 96 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-07-12 16:06:27 +0200 (Tue, 12 Jul 2011) $
*
* 	SEO:mercari by Siekiera Media
* 	http://www.seo-mercari.de
*
* 	Copyright (c) since 2011 SEO:mercari
* --------------------------------------------------------------------------------------
* 	based on:
* 	(c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
* 	(c) 2002-2003 osCommerce - www.oscommerce.com
* 	(c) 2003     nextcommerce - www.nextcommerce.org
* 	(c) 2005     xt:Commerce - www.xt-commerce.com
*
* 	Released under the GNU General Public License
* ----------------------------------------------------------------------------------- */
 
$hover_suffix = '_hover';
$down_suffix = '_down';
$file_ext = '.gif';

require_once(DIR_FS_INC.'inc.parse_input_field_data.php');

function image($src, $alt = '', $width = '', $height = '', $parameters = '', $mouseover = false, $mousedown = false, $title = '') {
	if ((empty($src) || ($src == DIR_WS_IMAGES)) || ( $src == DIR_WS_THUMBNAIL_IMAGES) && (IMAGE_REQUIRED == 'false') ) {
  		return false;
	}

	$image = '<img src="'.parse_input_field_data($src, array('"' => '&quot;')).'" alt="'.parse_input_field_data($alt, array('"' => '&quot;')).'"';
	
	if($width =='' || $height == '')
		$image .= ' '.get_img_size($src).' ';
	else
		$image .= ' width="'.$width.'" height="'.$height.'" ';
	
	if (not_null($alt)) {
  		$image .= ' title="'.parse_input_field_data($alt, array('"' => '&quot;')).'"';
	}

	if($mouseover == true || $mousedown == true)
		$image .= image_mouseover($mouseover, $mousedown, $src);
	
	if (not_null($parameters)) 
		$image .= ' '.$parameters;
	
	$image .= ' />';
	
	return $image;
}
 
function image_mouseover($mouseover, $mousedown, $src){
	$str_mouse_over = '';
	global $hover_suffix, $down_suffix, $file_ext;
	
    require_once(DIR_FS_INC.'inc.random_image_name.php');
	$name = random_name();
	$str_mouse_over .= ' id="'. $name.'"';
	
	$load_files = '';
		
	if ($mouseover == true)	{
		$hover_file = str_replace($file_ext,'', $src).$hover_suffix.$file_ext;
		if (file_exists($hover_file)) {
			$str_mouse_over .= ' onmouseover="javascript:MM_swapImage(\''. $name .'\',\'\',\''.$hover_file .'\',1)" onmouseout="javascript:MM_swapImgRestore()"';
			$load_files .= '\''.$hover_file.'\'';
		}  
	}

	if ($mousedown == true) {
	  $down_file = str_replace($file_ext, '', $src).$down_suffix.$file_ext;

	  if (file_exists($down_file)) {
	    $str_mouse_over .= ' onmousedown="javascript:MM_swapImage(\''. $name .'\',\'\',\''.$down_file .'\',1)" onmouseup="javascript:MM_swapImgRestore()"';
		if ($load_files!=''){
		  $load_files .= ',\''.$down_file .'\'';   
		}else{
		  $load_files .= ',\''.$down_file.'\'';   
		}
	  }  
	}
	
	return $str_mouse_over;
}
?>
