<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: inc.delete_cache.php 445M 2012-07-03 15:40:44Z (local) $
* 	Letzter Stand:			$Revision: 445M $
* 	zuletzt geaendert von:	$Author: (local) $
* 	Datum:					$Date: 2012-07-03 17:40:44 +0200 (Tue, 03 Jul 2012) $
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

function deleteCacheFolders($msg = false) {
	if(MEMCACHE_USE == 'true' && class_exists('Memcache')) {
		$memcache_obj = memcache_connect(MEMCACHE_HOSTS, MEMCACHE_PORT);
		memcache_flush($memcache_obj);
	}
	
	$del_array = array(	array(DIR_FS_CATALOG.'cache/', 'Cache Ordner im Shoproot'),
						array(DIR_FS_CATALOG.'templates_c/', 'Template Cache im Shoproot'));
	
	foreach($del_array AS $key => $value) {
		$dir = $value[0];
		$desc = $value[1];
	
		if(is_dir($dir)) {
			$error = false;
			$no_file = false;
		    if($dh = opendir($dir)) {
		        while (($file = readdir($dh)) !== false) {
		            if($file != '..' && $file != '.' && $file != 'index.html' && $file != '.htaccess' && $file != '.svn' && $file != '.git' && $file != 'cache_xajax.min.js' && $file != 'xajax.js') {
		            	if(is_dir($dir.$file))
							rrmdir($dir.$file);
						elseif(@unlink($dir.$file))
							$i++;
					}
		        }
		        closedir($dh);
		    }
		}
	}
	if($msg)
		echo 'Cache geleert';
}

function rrmdir($dir) {
	if(is_dir($dir)) {
		$objects = scandir($dir);
		foreach($objects AS $object) {
			if($object != "." && $object != "..") {
				if(filetype($dir."/".$object) == "dir")
					rrmdir($dir."/".$object);
				else 
					@unlink($dir."/".$object);
			}
		}
		reset($objects);
		rmdir($dir);
	}
}