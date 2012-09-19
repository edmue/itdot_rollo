<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: get_download.inc.php 126 2011-08-05 15:18:24Z peter $
* 	Letzter Stand:			$Revision: 126 $
* 	zuletzt geaendert von:	$Author: peter $
* 	Datum:					$Date: 2011-08-05 17:18:24 +0200 (Fri, 05 Aug 2011) $
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

function get_download($content_id) {
	global $db;

	$content_data = $db->db_query("	SELECT
										content_file,
										content_read
									FROM 
										".TABLE_PRODUCTS_CONTENT."
									WHERE 
										content_id='".$content_id."'");
	
	$db->db_query("	UPDATE 
						".TABLE_PRODUCTS_CONTENT." 
					SET 
						content_read='".($content_data->fields['content_read']+1)."'
					WHERE 
						content_id='".$content_id."'");
	
	$filename = DIR_FS_CATALOG.'media/products/'.$content_data->fields['content_file'];
	$backup_filename = DIR_FS_CATALOG.'media/products/backup/'.$content_data->fields['content_file'];
	
	$orign_hash_id = md5_file($filename);
	
	clearstatcache();
	
	$timestamp=str_replace('.','',microtime());
	$timestamp=str_replace(' ','',$timestamp);
	$new_filename=DIR_FS_CATALOG.'media/products/'.$timestamp.strstr($content_data->fields['content_file'],'.');
	
	rename($filename,$new_filename);
	
	
	if (file_exists($new_filename)) {
		header("Content-type: application/force-download");
		header("Content-Disposition: attachment; filename=".$new_filename);
		@readfile($new_filename);	
		rename($new_filename,$filename);
		$new_hash_id=md5_file($filename);
		clearstatcache();	
	
		if ($new_hash_id!=$orign_hash_id) 
			copy($backup_filename,$filename);
	}
}
?>