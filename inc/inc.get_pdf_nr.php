<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: inc.get_pdf_nr.php 197 2011-08-25 06:13:48Z siekiera $
* 	Letzter Stand:			$Revision: 197 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-08-25 08:13:48 +0200 (Thu, 25 Aug 2011) $
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

function get_pdf_nr($oID, $CheckNr = false, $GetNextNr = false, $is_send = false) {
	global $db;

	if($CheckNr) {
		$pdf = $db->db_query("SELECT pdf_bill_nr AS nr FROM ".TABLE_ORDERS_PDF." WHERE order_id = '".$oID."'");
		return $pdf->fields['nr'];

	} elseif($GetNextNr) {
		$pdf = $db->db_query("SELECT MAX(pdf_bill_nr) AS next_nr FROM ".TABLE_ORDERS_PDF."");
		return $pdf->fields['next_nr'] + 1;

	} elseif($is_send) {
		$pdf = $db->db_query("SELECT customer_notified FROM ".TABLE_ORDERS_PDF." WHERE order_id = '".$oID."'");
		if($pdf->fields['customer_notified'] > 0) {
			return true;
		} else
			return false;
	}
}
?>