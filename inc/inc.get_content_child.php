<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: content.php 154 2011-08-16 16:58:37Z siekiera $
* 	Letzter Stand:			$Revision: 154 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-08-16 18:58:37 +0200 (Tue, 16 Aug 2011) $
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

function get_content_child($content_id) {
	global $db;
	$data = $db->db_query("SELECT
								content_title,
								content_group,
								content_out_link,
								content_link_target,
								content_link_type
							FROM
								".TABLE_CONTENT_MANAGER."
							WHERE
								parent_id = '".(int)$content_id."'
							AND
								languages_id = '".(int)$_SESSION['languages_id']."'
							ORDER BY
								sort_order", true);

	if($data->_numOfRows) {
		while(!$data->EOF) {
			if($data->fields['content_out_link']) {
				$content_child[] = array('content_title' => $data->fields['content_title'],
										'content_out_link' => $data->fields['content_out_link'],
										'content_link_target' => $data->fields['content_link_target'],
										'content_link_type' => $data->fields['content_link_type']);
			} else {
				$content_child[] = array('content_group' => $data->fields['content_group'],
										'content_title' => $data->fields['content_title']);
			}
			$data->MoveNext();
		}
		return $content_child;
	} else
		return false;
}