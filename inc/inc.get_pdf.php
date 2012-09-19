<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: inc.get_pdf.php 293 2011-09-21 20:29:48Z siekiera $
* 	Letzter Stand:			$Revision: 293 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-09-21 22:29:48 +0200 (Wed, 21 Sep 2011) $
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

function get_pdf($oID, $createName = false, $checkPDF = false, $getNameShort = false, $getNameLong = false, $CheckMail = false) {
	global $db;

	if($createName) {
		include_once(DIR_WS_CLASSES.'order.php');
		$order = new order($oID);

		$name = str_replace('#bn#', $oID, TEXT_PDF_FILE_NAME);
		$name = str_replace('#rn#', $_POST['pdf_bill_nr'], $name);
		$name = str_replace('#vn#', $order->customer['firstname'], $name);
		$name = str_replace('#nn#', $order->customer['lastname'], $name);
		$name = str_replace('#d#', date("d-m-Y"), $name);

		$pfad = 'rechnungen/'.$name;
		return $pfad;

	} elseif($checkPDF) {
		$pdf = $db->db_query("SELECT bill_name FROM ".TABLE_ORDERS_PDF." WHERE order_id = '".(int)$oID."' ");
		if(file_exists($pdf->fields['bill_name']))
			return true;
  		else return false;

	} elseif($getNameShort) {
		$pdf_sql = $db->db_query("SELECT bill_name FROM ".TABLE_ORDERS_PDF." WHERE order_id = '".(int)$oID."' ");
		$pdf = explode('/', $pdf_sql->fields['bill_name']);
		$result = array_reverse($pdf);
		return $result[0];

	} elseif($getNameLong) {
		$pdf = $db->db_query("SELECT bill_name FROM ".TABLE_ORDERS_PDF." WHERE order_id = '".(int)$oID."' ");
		return $pdf->fields['bill_name'];

	} elseif($CheckMail) {
		$pdf = $db->db_query("SELECT customer_notified, notified_date FROM ".TABLE_ORDERS_PDF." WHERE order_id = '".(int)$oID."' ");
		if($pdf->_numOfRows) {
			if($pdf->fields['customer_notified'] == '1')
				return date_short($pdf->fields['notified_date']);
			else
				return false;
		} else
			return false;
	}
}

?>