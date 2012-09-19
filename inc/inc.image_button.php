<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: image_button.inc.php 167 2011-08-18 10:52:33Z siekiera $
* 	Letzter Stand:			$Revision: 167 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-08-18 12:52:33 +0200 (Thu, 18 Aug 2011) $
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

if(CSS_BUTTON_ACTIVE == 'true' || CSS_BUTTON_ACTIVE == 'text') {
	function image_button($image, $alt = '', $parameters = '', $mouseover = true, $mousedown = true) {
		$image = '<span class="css_img_button" '.$parameters.'>'.$alt.'</span>';
	 	return $image;
	 }

} else {
	function image_button($image, $alt = '', $parameters = '', $mouseover = true, $mousedown = true) {
  		return image('templates/'.CURRENT_TEMPLATE.'/buttons/'.$_SESSION['language'].'/'.$image, $alt, '', '', $parameters, $mouseover, $mousedown);
	}
}
?>