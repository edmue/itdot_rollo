<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: reviews.php 89 2011-07-07 14:39:43Z siekiera $
* 	Letzter Stand:			$Revision: 89 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-07-07 16:39:43 +0200 (Thu, 07 Jul 2011) $
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

function get_review_score($pID, $count) {
	global $db;
	
	$get = $db->db_query("SELECT 
								((SUM(reviews_rating) / (".$count." * 5)) * 5) AS anteilig
							FROM 
								".TABLE_REVIEWS." 
							WHERE 
								products_id = '".$pID."'
							AND 
								reviews_status = 1 ");
								
	return (round($get->fields['anteilig']*2)/2);
}
?>