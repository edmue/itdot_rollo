<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: random_image_name.inc.php 204 2011-08-26 09:33:25Z siekiera $
* 	Letzter Stand:			$Revision: 204 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-08-26 11:33:25 +0200 (Fri, 26 Aug 2011) $
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

function random_name() {
    $letters = 'abcdefghijklmnopqrstuvwxyz';
    $dirname = 'button_';
    $length = floor(rand(16,20));
    for ($i = 1; $i <= $length; $i++) {
		$q = floor(rand(1,26));
		$dirname .= $letters[$q];
    }
    return $dirname;
}
?>