<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: browser.inc.php 2 2011-06-06 12:08:34Z siekiera $
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

   
function browser($browser) {
	switch($browser) {
		case 'MSIE': $browser = 'images/icons/icons_browser/iexplore.jpg'; break;
		case 'Netscape': $browser = 'images/icons/icons_browser/netscape.jpg'; break;
		case 'Opera': $browser = 'images/icons/icons_browser/opera.jpg'; break;
		case 'Mozilla': $browser = 'images/icons/icons_browser/mozilla.jpg'; break;
		case 'Safari': $browser = 'images/icons/icons_browser/safari.jpg'; break;
		case 'Firefox': $browser = 'images/icons/icons_browser/firefox.jpg'; break;
		case 'Firebird': $browser = 'images/icons/icons_browser/firebird.jpg'; break;
		case 'AOL': $browser = 'images/icons/icons_browser/aol.jpg'; break;
		case 'Unknown': $browser = 'images/icons/icons_browser/unknown.jpg'; break;
		case 'Konqueror': $browser = 'images/icons/icons_browser/konqueror.jpg'; break;
		case 'Camino': $browser = 'images/icons/icons_browser/camino.jpg'; break;
		case 'Thunderbird': $browser = 'images/icons/icons_browser/thunderbird.jpg'; break;
		case 'Mac': $browser = 'images/icons/icons_browser/mac.jpg'; break;
		case 'AvantGo': $browser = 'images/icons/icons_browser/avantgo.jpg'; break;
		case 'Nautilus': $browser = 'images/icons/icons_browser/nautilus.jpg'; break; // added 7/20/04
		case 'Avant Browser': $browser = 'images/icons/icons_browser/avant.jpg'; break; // added 7/23/04
		default: $browser = 'images/icons/icons_browser/no_icon.jpg'; break;
		
	}
	//if($browser && trim($browser) != 'images/icons/') { $browser = 'images/icons/icons_browser/no_icon.jpg'; }
	if(trim($browser) == 'images/icons/') { $browser = 'images/icons/icons_browser/unknown.jpg'; }
	
	//echo "BROWSER: $browser<br>"; // TEST
	return $browser;
}
?>