<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: expire_specials.inc.php 60 2011-06-24 09:19:36Z siekiera $
* 	Letzter Stand:			$Revision: 60 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-06-24 11:19:36 +0200 (Fri, 24 Jun 2011) $
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

require_once(DIR_FS_INC.'inc.set_specials_status.php');

function expire_specials() {
	global $db;
	
	$specials = $db->db_query("SELECT specials_id FROM ".TABLE_SPECIALS." WHERE status = '1' AND NOW() >= expires_date AND expires_date > 0");
	if ($specials->_numOfRows) {
		while (!$specials->EOF) {
			set_specials_status($specials->fields['specials_id'], '0');
			$specials->MoveNext();
		}
	}
}
?>