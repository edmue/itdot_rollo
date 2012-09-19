<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: redirect.inc.php 2 2011-06-06 12:08:34Z siekiera $
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

function redirect($url) {
	if((ENABLE_SSL == true) && (getenv('HTTPS') == 'on' || getenv('HTTPS') == '1'))
		if (substr($url, 0, strlen(HTTP_SERVER)) == HTTP_SERVER)
			$url = HTTPS_SERVER . substr($url, strlen(HTTP_SERVER));

	$patterns = array('/\t/i', '/\n/i', '/\r/i');
	$replacements = array('', '', '');
	header('Location: ' . preg_replace($patterns, $replacements, $url));

	exit();
}
?>