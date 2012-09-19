<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: random_name.inc.php 2 2011-06-06 12:08:34Z siekiera $
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

   
  // Returns a random name, 16 to 20 characters long
  // There are more than 10^28 combinations
  // The directory is "hidden", i.e. starts with '.'
  function random_name() {
    $letters = 'abcdefghijklmnopqrstuvwxyz';
    $dirname = '.';
    $length = floor(rand(16,20));
    for ($i = 1; $i <= $length; $i++) {
     $q = floor(rand(1,26));
     $dirname .= $letters[$q];
    }
    return $dirname;
  }
 ?>