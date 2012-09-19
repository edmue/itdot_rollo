<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: account_edit.php 2 2011-06-06 12:08:34Z siekiera $
* 	Letzter Stand:			$Revision: 2 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-06-06 14:08:34 +0200 (Mon, 06 Jun 2011) $
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

function get_img_size($img_src, $max_width = '') {
	if($img_src !='' && file_exists($img_src)) {
		$size = getimagesize($img_src);
		
		$breite = $size[0];
		$hoehe = $size[1];
		
		if(!empty($max_width)) {
			if ($size[0] > $max_width) {		        
		        $breite = $max_width; 
		        $hoehe = round($size[1]*$breite/$size[0], 2);
		    }
		}
				
		return 'width="'.$breite.'" height="'.round($hoehe).'"';
		
	} else
		return false;
}