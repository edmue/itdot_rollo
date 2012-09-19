<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: count_cart.inc.php 89 2011-07-07 14:39:43Z siekiera $
* 	Letzter Stand:			$Revision: 89 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-07-07 16:39:43 +0200 (Thu, 07 Jul 2011) $
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

function count_cart() {
	unset($_SESSION['actual_content']);
	
	$id_list = $_SESSION['cart']->get_product_id_list();
	$id_list = explode(', ', $id_list);
	$actual_content = array ();

	for ($i = 0, $n = sizeof($id_list); $i < $n; $i ++)
		$actual_content[] = array ('id' => $id_list[$i], 'qty' => $_SESSION['cart']->get_quantity($id_list[$i]));

	$content = array ();
	for ($i = 0, $n = sizeof($actual_content); $i < $n; $i ++) {
		if (strpos($actual_content[$i]['id'], '{'))
			$act_id = substr($actual_content[$i]['id'], 0, strpos($actual_content[$i]['id'], '{'));
		else
			$act_id = $actual_content[$i]['id'];
		
		$_SESSION['actual_content'][$act_id] = array ('qty' => $_SESSION['actual_content'][$act_id]['qty'] + $actual_content[$i]['qty']);
	}
}
?>