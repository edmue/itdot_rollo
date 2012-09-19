<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: round.inc.php 2 2011-06-06 12:08:34Z siekiera $
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

function round($number, $precision) {
	if (strpos($number, '.') && (strlen(substr($number, strpos($number, '.')+1)) > $precision)) {
		$number = substr($number, 0, strpos($number, '.') + 1 + $precision + 1);

		if (substr($number, -1) >= 5) {
			if ($precision > 1)
				$number = substr($number, 0, -1) + ('0.' . str_repeat(0, $precision-1) . '1');
			elseif ($precision == 1)
				$number = substr($number, 0, -1) + 0.1;
			else
				$number = substr($number, 0, -1) + 1;

		} else
			$number = substr($number, 0, -1);
	}

	return $number;
}
?>