<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_country_list.inc.php 149 2011-08-16 13:39:57Z siekiera $
* 	Letzter Stand:			$Revision: 149 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-08-16 15:39:57 +0200 (Tue, 16 Aug 2011) $
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

include_once(DIR_FS_INC.'inc.draw_pull_down_menu.php');
include_once(DIR_FS_INC.'inc.get_countries.php');

function get_country_list($name, $selected = '', $parameters = '') {
	$countries = get_countriesList();

	for ($i=0, $n=sizeof($countries); $i<$n; $i++)
		$countries_array[] = array('id' => $countries[$i]['countries_id'], 'text' => $countries[$i]['countries_name']);

	if (is_array($name))
		return draw_pull_down_menuNote($name, $countries_array, $selected, $parameters);

	return draw_pull_down_menu($name, $countries_array, $selected, $parameters);
}
?>