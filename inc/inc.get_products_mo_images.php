<?PHP
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_products_mo_images.inc.php 172 2011-08-18 14:14:01Z siekiera $
* 	Letzter Stand:			$Revision: 172 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-08-18 16:14:01 +0200 (Thu, 18 Aug 2011) $
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

function get_products_mo_images($pID = ''){
	global $db;

	$row = $db->db_query("SELECT
								image_id, image_nr, image_name, alt_langID_".$_SESSION['languages_id']."
							FROM
								".TABLE_PRODUCTS_IMAGES."
							WHERE
								products_id = '" . $pID ."'
							ORDER BY
								image_nr");

	while(!$row->EOF) {
		$results[($row->fields['image_nr']-1)] = $row->fields;
		$row->MoveNext();
	}

	if(is_array($results))
    	return $results;
	else
   		return false;
}
?>