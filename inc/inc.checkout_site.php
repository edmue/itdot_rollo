<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: checkout_site.inc.php 101 2011-07-13 15:49:50Z siekiera $
* 	Letzter Stand:			$Revision: 101 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-07-13 17:49:50 +0200 (Wed, 13 Jul 2011) $
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

function checkout_site($site) {
	global $db;

    if (!$_SESSION['customer_id'] || ($site != 'cart' && $site != 'shipping' && $site != 'payment' && $site != 'confirm' && $site != 'checkout'))
        return false;

    $check = $db->db_query("SELECT checkout_site FROM ".TABLE_CUSTOMERS_BASKET." WHERE customers_id=".$_SESSION['customer_id']);

    compareSite($site, $check->fields['checkout_site']);
}

function compareSite($currentSite, $oldSite) {
	global $db;

    $cart = 1;
    $shipping = 2;
    $payment = 3;
    $confirm = 4;
    $checkout = 5;

    if ($currentSite > $oldSite) {
        $db->db_query("UPDATE
        					".TABLE_CUSTOMERS_BASKET."
        				SET
        					checkout_site = ".$db->db_prepare($currentSite).",
        					language = ".$db->db_prepare($_SESSION['language'])."
        				WHERE
        					customers_id = ".(int)$_SESSION['customer_id']);
    }
}
?>