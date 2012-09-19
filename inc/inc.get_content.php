<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: application_top.php 143 2011-08-15 09:52:47Z siekiera $
* 	Letzter Stand:			$Revision: 143 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-08-15 11:52:47 +0200 (Mon, 15 Aug 2011) $
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

function get_content($flag, $name = '', $parent_id = 0, $level = 1) {
	global $db;

	if(GROUP_CHECK == 'true')
		$group_check = " AND group_ids LIKE '%c_".$_SESSION['customers_status']['customers_status_id']."_group%'";

	$content_data = $db->db_query("SELECT
										content_id,
										categories_id,
										parent_id,
										content_title,
										content_out_link,
										content_link_target,
										content_link_type,
										content_group
									FROM
										".TABLE_CONTENT_MANAGER."
									WHERE
										languages_id = '".(int)$_SESSION['languages_id']."'
									AND
										parent_id = '".$parent_id."'
									AND
										file_flag = '".$flag."'
										".$group_check."
									AND
										content_status = '1'
									ORDER BY
										sort_order");
	

	while(!$content_data->EOF) {
		if($content_data->fields['content_out_link'])
			$link = 'target="'.$content_data->fields['content_link_target'].'" href="'.$content_data->fields['content_out_link'].'"';
		else
			$link = 'href="'.href_link(FILENAME_CONTENT, 'coID='.$content_data->fields['content_group']).'"';

		$content_string .= '<li class="'.$name.'_'.$level.'">
								<a class="'.$name.'_link'.($_GET['coID'] == $content_data->fields['content_id'] ? ' '.$name.'_link_active' : '').'" '.$link.'>
									<span>'.$content_data->fields['content_title'].'</span>
								</a>';
		$content_string .= get_content($flag, $name, $content_data->fields['content_group'], $level+1);
		$content_string .= '</li>';
		$content_data->MoveNext();
	}

	return '<ul'.($level == 1 ? ' class="ul_'.$name.'"' : '').'>'.$content_string.'</ul>';
}