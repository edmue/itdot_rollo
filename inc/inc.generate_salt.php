<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: inc.generate_salt.php 52 2011-06-23 20:00:43Z siekiera $
* 	Letzter Stand:			$Revision: 52 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-06-23 22:00:43 +0200 (Do, 23. Jun 2011) $
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

function generate_salt($length=100) {
	 
	$dummy = array_merge(range('0', '9'), range('a', 'z'), range('A', 'Z'), array('#','&','@','$','_','%','?','+',',',' ','!','-','"','^'));
	 
	mt_srand((double)microtime()*1000000);
	for ($i = 1; $i <= (count($dummy)*2); $i++) {
		$swap = mt_rand(0,count($dummy)-1);
		$tmp = $dummy[$swap];
		$dummy[$swap] = $dummy[0];
		$dummy[0] = $tmp;
	}
	return substr(implode('',$dummy),0,$length);
}
?>