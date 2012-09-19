<?php
/* -----------------------------------------------------------------------------------------
   $Id: cleanName.inc.php 2 2011-06-06 12:08:34Z siekiera $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce

   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/


 function cleanName($name) {
 	$search_array=array('Р Т‘','Р вЂќ','РЎвЂ ','Р В¦','РЎРЉ','Р В¬','&auml;','&Auml;','&ouml;','&Ouml;','&uuml;','&Uuml;');
 	$replace_array=array('ae','Ae','oe','Oe','ue','Ue','ae','Ae','oe','Oe','ue','Ue');
 	$name=str_replace($search_array,$replace_array,$name);   	
 	
     $replace_param='/[^a-zA-Z0-9]/';
     $name=preg_replace($replace_param,'-',$name);    
     return $name;
 }

?>
