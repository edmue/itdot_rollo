<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: inc.free_shipping.php 2 2011-06-06 12:08:34Z siekiera $
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

function free_shipping() {
	if(defined('MODULE_SHIPPING_FREEAMOUNT_STATUS') && MODULE_SHIPPING_FREEAMOUNT_STATUS == 'True') {
		global $price;
		
		if($price->RemoveCurr($_SESSION['cart']->show_total()) < MODULE_SHIPPING_FREEAMOUNT_AMOUNT)
			return true;
		else
			return false;
	} else
		return true;
}
?>