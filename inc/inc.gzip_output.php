<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: gzip_output.inc.php 259 2011-09-09 22:06:04Z siekiera $
* 	Letzter Stand:			$Revision: 259 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-09-10 00:06:04 +0200 (Sat, 10 Sep 2011) $
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

function gzip_output($level = 5) {
	require_once(DIR_FS_INC.'inc.check_gzip.php');
	if ($encoding = check_gzip()) {
		$contents = ob_get_contents();
		ob_end_clean();
		
		header('Content-Encoding: ' . $encoding);
		
		$size = strlen($contents);
		$crc = crc32($contents);
		
		$contents = gzcompress($contents, $level);
		$contents = substr($contents, 0, strlen($contents) - 4);
		
		echo "\x1f\x8b\x08\x00\x00\x00\x00\x00";
		echo $contents;
		echo pack('V', $crc);
		echo pack('V', $size);
		
	} else
		ob_end_flush();
}
?>