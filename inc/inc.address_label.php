<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: address_label.inc.php 2 2011-06-06 12:08:34Z siekiera $
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

require_once(DIR_FS_INC.'inc.get_address_format_id.php');
require_once(DIR_FS_INC.'inc.address_format.php');

function address_label($customers_id, $address_id = 1, $html = false, $boln = '', $eoln = "\n") {
	global $db;

	$address = $db->db_query("SELECT
									entry_firstname AS firstname,
									entry_lastname AS lastname,
									entry_company AS company,
									entry_street_address AS street_address,
									entry_suburb AS suburb,
									entry_city AS city,
									entry_postcode AS postcode,
									entry_state AS state,
									entry_zone_id AS zone_id,
									entry_country_id AS country_id
								FROM
									".TABLE_ADDRESS_BOOK."
								WHERE
									customers_id = '".$customers_id."'
								AND
									address_book_id = '".$address_id."'");

	$format_id = get_address_format_id($address->fields['country_id']);

	return address_format($format_id, $address->fields, $html, $boln, $eoln);
}
?>