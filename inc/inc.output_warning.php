<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: output_warning.inc.php 272 2011-09-18 10:10:20Z siekiera $
* 	Letzter Stand:			$Revision: 272 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-09-18 12:10:20 +0200 (Sun, 18 Sep 2011) $
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

function output_warning($warning) {
	print_r('<ul style="margin-left:0;display:block;width:100%;position:fixed;top:0;left:0;z-index:9999"><li style="display:block;padding:10px;margin-bottom:2px;border:1px solid #ccc; background:url(images/error_bg.gif) center left repeat-x;color:#fff;font-weight:700">'.$warning.'</li></ul>');
}
?>