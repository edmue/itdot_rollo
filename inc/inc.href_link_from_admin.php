<?php
/*-----------------------------------------------------------------------
    Version: $Id: href_link_from_admin.inc.php 2 2011-06-06 12:08:34Z siekiera $

    xtC-SEO-Module by www.ShopStat.com (Hartmut KРЎвЂ nig)
    http://www.shopstat.com
    info@shopstat.com
    Р’В© 2004 ShopStat.com
    All Rights Reserved.
------------------------------------------------------------------------*/

    function href_link_from_admin($page= '',$parameters= '',$connection= 'NONSSL',$add_session_id= true,$search_engine_safe = true) {

    global $request_type, $session_started, $http_domain, $https_domain;

    require_once(DIR_FS_INC.'inc.check_agent.php');

    if (!not_null($page)) {
      die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine the page link ('.$page.')!<br><br>');
    }

    if ($connection == 'NONSSL') {
        $link = HTTP_SERVER . DIR_WS_CATALOG;
    } elseif ($connection == 'SSL') {
        if (ENABLE_SSL == true) {
            $link = HTTPS_SERVER . DIR_WS_CATALOG;
        } else{
            $link = HTTP_SERVER . DIR_WS_CATALOG;
        }
    } else{
        die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine connection method on a link!<br><br>Known methods: NONSSL SSL</b><br><br>');
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


    if (check_agent()==1) {

    $sid=NULL;

    }
    if (isset($sid)) {
      $link .= $separator . $sid;
    }

//--- SEO Hartmut KРЎвЂ nig -------------------------//

    return $link;
  }

 ?>