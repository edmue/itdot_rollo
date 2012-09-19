<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: check_gzip.inc.php 245 2011-09-04 13:04:57Z siekiera $
* 	Letzter Stand:			$Revision: 245 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-09-04 15:04:57 +0200 (Sun, 04 Sep 2011) $
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

function check_gzip() {
	if (headers_sent() || connection_aborted())
	return false;
	
	if(strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'x-gzip') !== false) 
		return 'x-gzip';
	
	if(strpos($_SERVER['HTTP_ACCEPT_ENCODING'],'gzip') !== false) 
		return 'gzip';
	
	return false;
} 
?>