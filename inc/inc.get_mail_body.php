<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: inc.get_mail_body.php 260 2011-09-12 10:51:25Z siekiera $
* 	Letzter Stand:			$Revision: 260 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-09-12 12:51:25 +0200 (Mon, 12 Sep 2011) $
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

function html_get_template ($tpl_name, &$tpl_source) {
	global $db;
	
	$tpl_data = $db->db_query("SELECT 
									email_content_html 
								FROM 
									".TABLE_EMAILS." 
								WHERE 
									email_name = '".$tpl_name."' 
								AND 
									languages_id = '".$_SESSION['languages_id']."' ");
	
	if ($tpl_data->_numOfRows > 0) {
		$tpl_source = stripslashes($tpl_data->fields['email_content_html']);
		return true;
	} else
		return false;
}

function html_get_timestamp($tpl_name, &$tpl_timestamp) {
	global $db;

	$tpl_data = $db->db_query("SELECT 
									email_timestamp 
								FROM 
									".TABLE_EMAILS." 
								WHERE 
									email_name = '".$tpl_name."' 
								AND 
									languages_id = '".$_SESSION['languages_id']."' ");

	if ($tpl_data->_numOfRows > 0) {
		$tpl_timestamp = $tpl_data->fields['email_timestamp'];
		return true;
	} else
		return false;
}

function html_get_secure($tpl_name, &$smarty_obj){
	return true;
}

function html_get_trusted($tpl_name, &$smarty_obj) {}

function txt_get_template ($tpl_name, &$tpl_source) {
	global $db;

	$tpl_data = $db->db_query("SELECT 
									email_content_text 
								FROM 
									".TABLE_EMAILS." 
								WHERE 
									email_name = '".$tpl_name."' 
								AND 
									languages_id = '".$_SESSION['languages_id']."'");

	if ($tpl_data->_numOfRows) {
		$tpl_source = stripslashes($tpl_data->fields['email_content_text']);
		return true;
	} else
		return false;
}

function txt_get_timestamp($tpl_name, &$tpl_timestamp) {
	global $db;

	$tpl_data = $db->db_query("SELECT 
									email_timestamp 
								FROM 
									".TABLE_EMAILS." 
								WHERE 
									email_name = '".$tpl_name."' 
								AND 
									languages_id = '".$_SESSION['languages_id']."' ");

	if ($tpl_data->_numOfRows) {
		$tpl_timestamp = $tpl_data->fields['email_timestamp'];
		return true;
	} else
		return false;
}

function txt_get_secure($tpl_name, &$smarty_obj) {
	return true;
}

function txt_get_trusted($tpl_name, &$smarty_obj) {}

$smarty->registerResource("html", array("html_get_template", "html_get_timestamp", "html_get_secure", "html_get_trusted"));

$smarty->registerResource("txt", array("txt_get_template", "txt_get_timestamp", "txt_get_secure", "txt_get_trusted"));

$smarty->assign('language', $_SESSION['language']);
$smarty->assign('tpl_path', 'templates/'.CURRENT_TEMPLATE.'/');
$smarty->assign('logo_path', HTTP_SERVER.DIR_WS_CATALOG.DIR_WS_IMAGES);

//Signatur
$signatursmarty = new Smarty;
$signatursmarty->caching = false;

$signatursmarty->registerResource("html", array("html_get_template", "html_get_timestamp", "html_get_secure", "html_get_trusted"));

$signatursmarty->registerResource("txt", array("txt_get_template", "txt_get_timestamp", "txt_get_secure", "txt_get_trusted"));

$adresse = $db->db_query("SELECT 
								entry_firstname, 
								entry_lastname, 
								entry_street_address, 
								entry_postcode, 
								entry_city 
							FROM 
								".TABLE_ADDRESS_BOOK." 
							WHERE 
								customers_id = 1");

$signatursmarty->assign('SHOP_NAME',STORE_NAME);
$signatursmarty->assign('SHOP_BESITZER',STORE_OWNER);
$signatursmarty->assign('SHOP_USTID',STORE_OWNER_VAT_ID);
$signatursmarty->assign('SHOP_ADRESSE_VNAME',$adresse->fields['entry_firstname']);
$signatursmarty->assign('SHOP_ADRESSE_NNAME',$adresse->fields['entry_lastname']);
$signatursmarty->assign('SHOP_ADRESSE_STRASSE',$adresse->fields['entry_street_address']);
$signatursmarty->assign('SHOP_ADRESSE_PLZ',$adresse->fields['entry_postcode']);
$signatursmarty->assign('SHOP_ADRESSE_ORT',$adresse->fields['entry_city']);
$signatursmarty->assign('SHOP_EMAIL',STORE_OWNER_EMAIL_ADDRESS);
$signatursmarty->assign('SHOP_URL',HTTP_SERVER);

$signatur_html = $signatursmarty->fetch('html:signatur');
$signatur_text = $signatursmarty->fetch('txt:signatur');
?>