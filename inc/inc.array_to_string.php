<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: array_to_string.inc.php 2 2011-06-06 12:08:34Z siekiera $
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
  
function array_to_string($array, $exclude = '', $equals = '=', $separator = '&') {
	if (!is_array($exclude)) $exclude = array();

	$get_string = '';
	if (sizeof($array) > 0) {
		while (list($key, $value) = each($array))
			if ( (!in_array($key, $exclude)) && ($key != 'x') && ($key != 'y'))
				$get_string .= $key . $equals . $value . $separator;
	
		$remove_chars = strlen($separator);
		$get_string = substr($get_string, 0, -$remove_chars);
	}

	return $get_string;
}
?>