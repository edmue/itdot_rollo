<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_db_cache.inc.php 123 2011-08-04 15:56:13Z peter $
* 	Letzter Stand:			$Revision: 123 $
* 	zuletzt geaendert von:	$Author: peter $
* 	Datum:					$Date: 2011-08-04 17:56:13 +0200 (Thu, 04 Aug 2011) $
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


function get_db_cache($sql, &$var, $filename, $refresh = false){
	global $db;

	$var = array();

	if(($refresh == true)|| !read_cache($var, $filename)) {
		$rec = $db->db_query($sql);

		while (!$rec->EOF) {
			$var[] = $rec->fields;
			$rec->MoveNext();
		}
		
		write_cache($var, $filename);
	}
}

?>