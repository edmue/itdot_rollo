<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id$
* 	Letzter Stand:			$Revision$
* 	zuletzt geaendert von:	$Author$
* 	Datum:					$Date$
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

function new_customer_id() {
	global $db;

    $nr = CUSTOMER_NUMBER_FORMAT;
    $nr = str_replace('#j#', date('Y'), $nr);
    $nr = str_replace('#m#', date('m'), $nr); 
    $nr = str_replace('#d#', date('d'), $nr);
    
    $last_id = $db->db_query("SELECT customers_id FROM ".TABLE_CUSTOMERS." ORDER BY customers_id DESC LIMIT 1");
    
    $nr = str_replace('#n#', ($last_id->fields['customers_id']+1), $nr);
    
	return $nr;
}
?>