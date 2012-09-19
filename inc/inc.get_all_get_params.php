<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_all_get_params.inc.php 135 2011-08-09 21:54:50Z siekiera $
* 	Letzter Stand:			$Revision: 135 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-08-09 23:54:50 +0200 (Tue, 09 Aug 2011) $
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

function get_all_get_params($exclude_array = '') {
  	global $InputFilter;

    if(!is_array($exclude_array))
    	$exclude_array = array();
	
    $get_url = '';
    if (is_array($_GET) && (sizeof($_GET) > 0)) {
		reset($_GET);
		while(list($key, $value) = each($_GET)) {
			if(is_array($value)) {
				while(list($sub_key, ) = each($value))
					$get_url .= rawurlencode(stripslashes($key)).'[]='.rawurlencode(stripslashes($sub_key)).'&';
			} elseif((strlen($value) > 0) && ($key != session_name()) && ($key != 'error') && (!in_array($key, $exclude_array)) && ($key != 'x') && ($key != 'y'))
				$get_url .= rawurlencode(stripslashes($key)).'='.rawurlencode(stripslashes($value)).'&';
		}
    }
    return $get_url;
}
?>