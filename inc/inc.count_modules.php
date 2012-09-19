<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: count_modules.inc.php 2 2011-06-06 12:08:34Z siekiera $
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


function count_modules($modules = '') {
    $count = 0;

    if(empty($modules))
    	return $count;

    $modules_array = explode(';', $modules);

    if(in_array('productsshipping.php', $modules_array)) {
    	return 1;

    } else {
		for ($i=0, $n=sizeof($modules_array); $i<$n; $i++) {
			$class = substr($modules_array[$i], 0, strrpos($modules_array[$i], '.'));

			if (is_object($GLOBALS[$class]))
				if ($GLOBALS[$class]->enabled)
					$count++;

		}
		return $count;
    }
}
?>