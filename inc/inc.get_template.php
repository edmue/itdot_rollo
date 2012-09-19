<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: inc.get_template.php 125 2012-03-19 09:08:48Z siekiera $
* 	Letzter Stand:			$Revision: 433 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2012-03-30 10:03:56 +0200 (Fri, 30 Mar 2012) $
*
* 	SEO:mercari by Siekiera Media
* 	http://www.seo-mercari.de
*
* 	Copyright © since 2011 SEO:mercari
* --------------------------------------------------------------------------------------
* 	based on:
* 	© 2000-2001 The Exchange Project  (earlier name of osCommerce)
* 	© 2002-2003 osCommerce - www.oscommerce.com
* 	© 2003     nextcommerce - www.nextcommerce.org
* 	© 2005     xt:Commerce - www.xt-commerce.com
*
* 	Released under the GNU General Public License
* ----------------------------------------------------------------------------------- */

function get_template() {
	global $db, $browser;
	
	if($browser->isMobile(USE_MOBILE_TEMPLATE))
		define('CURRENT_TEMPLATE', 'mobile');
	else {
		$get_template = $db->db_query("SELECT configuration_value FROM ".TABLE_CONFIGURATION." WHERE configuration_key = 'CURRENT_TEMPLATE'", true);
		define('CURRENT_TEMPLATE', $get_template->fields['configuration_value']);
	}
}