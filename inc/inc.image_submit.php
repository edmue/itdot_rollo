<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: image_submit.inc.php 2 2011-06-06 12:08:34Z siekiera $
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

if(CSS_BUTTON_ACTIVE == 'true' || CSS_BUTTON_ACTIVE == 'text') {
	function image_submit($image, $alt = '', $parameters = '', $mouseover = false, $mousedown = false) {
		$image_submit = '<button type="submit" class="css_img_button" onfocus="this.blur()"';
		if (not_null($alt))
	    	$image_submit .= ' title=" '.parse_input_field_data($alt, array('"' => '&quot;')).' "';

	    if (not_null($parameters))
	    	$image_submit .= ' '.$parameters;

		$image_submit .= '>'.parse_input_field_data($alt, array('"' => '&quot;')).'</button>';

    	return $image_submit;
  	}

} else {
	function image_submit($image, $alt = '', $parameters = '', $mouseover = true, $mousedown = true) {
		$src = parse_input_field_data('templates/'.CURRENT_TEMPLATE.'/buttons/'.$_SESSION['language'].'/'. $image, array('"' => '&quot;'));

		$image_submit = '<button type="image" src="'.$src.'" onfocus="this.blur()"';

		if (not_null($alt))
			$image_submit .= ' title=" '.parse_input_field_data($alt, array('"' => '&quot;')).' "';

		if (not_null($parameters))
			$image_submit .= ' '.$parameters;

		if ($mouseover == true || $mousedown == true) {
			require_once(DIR_FS_INC.'inc.image.php');
			$image_submit .= image_mouseover($mouseover, $mousedown, $src);
		}

		$image_submit .= '>'.parse_input_field_data($alt, array('"' => '&quot;')).'</button>';

		return $image_submit;
	}
}