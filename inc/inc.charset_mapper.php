<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: charset_mapper.inc.php 2 2011-06-06 12:08:34Z siekiera $
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


  //for HTML
  //echo charset_mapper('utf-8',true);
  // for DB
  //echo charset_mapper('utf8',true);

function charset_mapper ( $charset, $change = false) {
  $db = array(
              'big5',
              'latin1',
              'latin2',
              'ascii',
              'hebrew',
              'tis620',
              'euckr',
              'koi8u',
              'gb2312',
              'greek',
              'cp1250',
              'gbk',
              'latin5',
              'utf8',
              'latin7',
              'cp1251',
              'cp1256',
              'cp1257'
              );

  $html = array(
                'big5',
                'ISO-8859-15',
                'ISO-8859-2',
                'US-ASCII',
                'ISO-8859-8',
                'TIS-620',
                'EUC-KR',
                'KOI8-U',
                'gb2312',
                'ISO-8859-7',
                'windows-1250',
                'windows-936',
                'ISO-8859-5',
                'utf-8',
                'ISO-8859-7',
                'Windows-1251',
                'windows-1256',
                'windows-1257'
                );

  if($change == false) {
    return str_replace($db, $html, $charset);
  } elseif($change == true) {
    foreach($html as $key=>$name) {
      $html[$key] = strtolower($name);
    }
    return str_replace( $html, $db, $charset);
  }
  else return false;
}

?>
