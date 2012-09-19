<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_address_format_id.inc.php 2 2011-06-06 12:08:34Z siekiera $
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

function get_address_format_id($country_id) {
	global $db;

	$address_format = $db->db_query("SELECT
											address_format_id AS format_id
										FROM
											".TABLE_COUNTRIES."
										WHERE
											countries_id = '".$country_id."'");
	if($address_format->_numOfRows)
		return $address_format->fields['format_id'];
	else
		return '1';
}
?>