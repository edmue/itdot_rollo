<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: inc.check_for_special.php 2 2011-06-06 12:08:34Z siekiera $
* 	Letzter Stand:			$Revision: 2 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-06-06 14:08:34 +0200 (Mon, 06 Jun 2011) $
*
* 	SEO:mercari by Siekiera Media
* 	http://www.seo-mercari.de
*
* 	Copyright © since 2011 SEO:mercari
* --------------------------------------------------------------------------------------
* 	based on:
* 	© 2000-2001 The Exchange Project  (earlier name of osCommerce)
* 	© 2002-2003 osCommerce - www.oscommerce.com
* 	© 2003     nextcommerce - www.nextcommerce.org
* 	© 2005     xt:Commerce - www.xt-commerce.com
*
* 	Released under the GNU General Public License
* ----------------------------------------------------------------------------------- */

function check_for_special($pID) {
	global $db, $price;
	
	$check = $db->db_query("SELECT 
								products_id,
								specials_price_".$price->actualGroup."
							FROM
								".TABLE_SPECIALS." 
							WHERE 
								products_id = '".(int)$pID."' 
							AND
								specials_price_".$price->actualGroup." !='0.0000'
							AND 
								status = '1'");
	if($check->_numOfRows)
		return true;
	else
		return false;
}