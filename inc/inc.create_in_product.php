<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: currencies.php 109 2011-07-18 10:45:48Z siekiera $
* 	Letzter Stand:			$Revision: 109 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-07-18 12:45:48 +0200 (Mon, 18 Jul 2011) $
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

function create_in_product($pids = '', $sess = false) {
	
	$id = (!empty($pids) ? $pids : ($sess ? $_SESSION['products_filters']['in_products'] : ''));
	
	return " AND p.products_id IN ('".(!empty($id) ? implode('\',\'', $id) : '')."') ";
}
?>