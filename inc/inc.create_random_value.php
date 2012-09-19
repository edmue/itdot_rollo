<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: create_random_value.inc.php 270 2011-09-16 09:56:54Z siekiera $
* 	Letzter Stand:			$Revision: 270 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-09-16 11:56:54 +0200 (Fri, 16 Sep 2011) $
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

function create_random_value($length, $type = 'mixed') {
	if(($type != 'mixed') && ($type != 'chars') && ($type != 'digits'))
		return false;

	$rand_value = '';
	while(strlen($rand_value) < $length) {
		if ($type == 'digits')
			$char = rand(0,9);
		else
			$char = chr(rand(0,255));
		
		if ($type == 'mixed') {
			if (preg_match('/^[a-z0-9]$/i', $char)) 
				$rand_value .= $char;
				
		} elseif ($type == 'chars') {
			if (preg_match('/^[a-z]$/i', $char))
				$rand_value .= $char;
				
		} elseif ($type == 'digits') {
			if (preg_match('/^[0-9]$/', $char))
				$rand_value .= $char;
		}
	}

	return $rand_value;
}
?>