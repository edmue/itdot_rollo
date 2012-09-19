<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: inc.get_mail_data.php 347 2011-10-31 22:51:44Z siekiera $
* 	Letzter Stand:			$Revision: 347 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-10-31 23:51:44 +0100 (Mon, 31 Oct 2011) $
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

$search = array('{$store_name}', '{$shop_besitzer}');
$replace = array(STORE_NAME, STORE_OWNER);

function replaceVar($var) {
	global $db, $search, $replace;
	return str_replace($search, $replace, $var);
}

function get_mail_data($name = '') {
	global $db;
	if($name != '') {
		$subject = $db->db_query("	SELECT 
										email_address,
										email_address_name,
										email_replay_address,
										email_replay_address_name,
										email_subject,
										email_forward  
									FROM 
										".TABLE_EMAILS." 
									WHERE 
										email_name = '".$name."' 
									AND 
										languages_id = '".(int)$_SESSION['languages_id']."' ");

														
		return array('EMAIL_ADDRESS' => replaceVar($subject->fields['email_address']),
					  'EMAIL_ADDRESS_NAME' => replaceVar($subject->fields['email_address_name']),
					  'EMAIL_REPLAY_ADDRESS' => replaceVar($subject->fields['email_replay_address']),
					  'EMAIL_REPLAY_ADDRESS_NAME' => replaceVar($subject->fields['email_replay_address_name']),
					  'EMAIL_SUBJECT' => replaceVar($subject->fields['email_subject']),
					  'EMAIL_FORWARD' => $subject->fields['email_forward']);
		
	} else
		return 'Die Maildaten konnten nicht gefunden werden!';
}
?>