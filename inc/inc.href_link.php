<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: href_link.inc.php 189 2011-08-22 14:45:29Z siekiera $
* 	Letzter Stand:			$Revision: 189 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-08-22 16:45:29 +0200 (Mon, 22 Aug 2011) $
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

function href_link($page = 'index.php', $parameters = '', $connection = 'NONSSL', $add_session_id = true, $search_engine_safe = true) {
	global $request_type, $session_started, $http_domain, $https_domain, $truncate_session_id;

	$ist_blog_da = 'blog.php';
	if(file_exists($ist_blog_da))
		$blog_da = true;
	else
		$blog_da = false;

    if ($connection == 'NONSSL') {
      $link = HTTP_SERVER . DIR_WS_CATALOG;
    } elseif ($connection == 'SSL') {
      if (ENABLE_SSL == true) {
        $link = HTTPS_SERVER . DIR_WS_CATALOG;
      } else {
        $link = HTTP_SERVER . DIR_WS_CATALOG;
      }
    } else {
      die('</td></tr></table></td></tr></table><br /><br /><font color="#ff0000"><b>Error!</b></font><br /><br /><b>Unable to determine connection method on a link!<br /><br />Known methods: NONSSL SSL</b><br /><br />');
    }

    while ( (substr($link, -1) == '&') || (substr($link, -1) == '?') ) $link = substr($link, 0, -1);

	if (MODULE_SEO_URL_INDEX_STATUS <> 'True') {
		if (not_null($parameters)) {
      		$link .= $page . '?' . $parameters;
		    $separator = '&';
	  } else {
    		$link .= $page;
		    $separator = '?';
      }
	}

	if(MODULE_SEO_URL_INDEX_STATUS == 'True') {

		require_once(DIR_FS_INC.'inc.seo_url.php');
		$seo_url = new SeoUrl;

		$realUrl = false;
		
		if ($page=='product_info.php' && strpos($parameters,'products_id')!==false && strpos($parameters,'action=')===false) {
			$realUrl = true;
			$link = $seo_url->getProductLink($parameters,$connection,$_SESSION['languages_id']);
		}

		if (strpos($parameters,'cPath')!==false && strpos($parameters,'action=')===false && strpos($parameters,'page=')===false) {
			$realUrl = true;
			$link = $seo_url->getCategoryLink($parameters,$connection,$_SESSION['languages_id']);
		}
		
		if ($page=='shop_content.php' && strpos($parameters,'coID')!==false && strpos($parameters,'action=')===false) {
			$realUrl = true;
			$link = $seo_url->getContentLink($parameters,$connection,$_SESSION['languages_id']);
		}

		if($blog_da == true) {
			if ($page=='blog.php' && strpos($parameters,'blog_item')!==false && strpos($parameters,'action=')===false) {
				$realUrl = true;
				$link = $seo_url->getBlogLink($parameters,$connection,$_SESSION['languages_id']);
			}
			elseif	($page=='blog.php' && strpos($parameters,'blog_item')===false && strpos($parameters,'action=')===false) {
				$realUrl = true;
				$link = $seo_url->getBlogCatLink($parameters,$connection,$_SESSION['languages_id']);
			}
		}

		if (($page=='product_info.php' || $page=='index.php' || $page == 'seo_url.php' || $page=='shop_content.php' || $page=='blog.php') && MODULE_SEO_URL_INDEX_STATUS=='True' && strpos($parameters,'language=')!==false && strpos($parameters,'action=')===false && strpos($parameters,'page=')===false) {

			$link = $seo_url->getLanguageChangeLink($page,$parameters,$connection='NONSSL');
			$realUrl = true;
		}

		$separator = '?';

		if (not_null($parameters)) {
      		// Append GET Parameters if it isn't a Real URL
			if (!$realUrl) {
				$link .= $page . '?' . $parameters;
      			$separator = '&';
			}				
		} else {
			// Set Standard Link if it isn't a Real URL
			
			if (!$realUrl) {
				$link .= $page;
      			$separator = '?';
			}
		}
	}

    if ( ($add_session_id == true) && ($session_started == true) && (SESSION_FORCE_COOKIE_USE == 'False') ) {
      if (defined('SID') && not_null(SID)) {
        $sid = SID;
      } elseif ( ( ($request_type == 'NONSSL') && ($connection == 'SSL') && (ENABLE_SSL == true) ) || ( ($request_type == 'SSL') && ($connection == 'NONSSL') ) ) {
        if ($http_domain != $https_domain) {
          $sid = session_name() . '=' . session_id();
        }
      }
    }

	// remove session if useragent is a known Spider
    if($truncate_session_id) 
    	$sid=NULL;

    if (isset($sid)) {
      $link .= $separator . $sid;
    }
	
	if(substr($link, -1) == '&')
		$link = substr($link, 0, -1);
	
    return $link;
  }

  function href_link_admin($page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = true, $search_engine_safe = true) {
    global $request_type, $session_started, $http_domain, $https_domain;

    if (!not_null($page)) {
      die('</td></tr></table></td></tr></table><br /><br /><font color="#ff0000"><b>Error!</b></font><br /><br /><b>Unable to determine the page link!<br /><br />');
    }

    if ($connection == 'NONSSL') {
      $link = HTTP_SERVER . DIR_WS_CATALOG;
    } elseif ($connection == 'SSL') {
      if (ENABLE_SSL == true) {
        $link = HTTPS_SERVER . DIR_WS_CATALOG;
      } else {
        $link = HTTP_SERVER . DIR_WS_CATALOG;
      }
    } else {
      die('</td></tr></table></td></tr></table><br /><br /><font color="#ff0000"><b>Error!</b></font><br /><br /><b>Unable to determine connection method on a link!<br /><br />Known methods: NONSSL SSL</b><br /><br />');
    }

    if (not_null($parameters)) {
      $link .= $page . '?' . $parameters;
      $separator = '&';
    } else {
      $link .= $page;
      $separator = '?';
    }

    while ( (substr($link, -1) == '&') || (substr($link, -1) == '?') ) $link = substr($link, 0, -1);

// Add the session ID when moving from different HTTP and HTTPS servers, or when SID is defined
    if ( ($add_session_id == true) && ($session_started == true) && (SESSION_FORCE_COOKIE_USE == 'False') ) {
      if (defined('SID') && not_null(SID)) {
        $sid = SID;
      } elseif ( ( ($request_type == 'NONSSL') && ($connection == 'SSL') && (ENABLE_SSL == true) ) || ( ($request_type == 'SSL') && ($connection == 'NONSSL') ) ) {
        if ($http_domain != $https_domain) {
          $sid = session_name() . '=' . session_id();
        }
      }
    }

    if ($truncate_session_id) $sid=NULL;

    if (isset($sid)) {
      $link .= $separator . $sid;
    }

    return $link;
  }

 ?>