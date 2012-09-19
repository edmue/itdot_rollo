<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: validate_email.inc.php 2 2011-06-06 12:08:34Z siekiera $
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

function validate_email($email) {
	$valid_address = true;
	
	$mail_pat = '^(.+)@(.+)$';
	$valid_chars = "[^] \(\)<>@,;:\.\\\"\[]";
	$atom = "$valid_chars+";
	$quoted_user='(\"[^\"]*\")';
	$word = "($atom|$quoted_user)";
	$user_pat = "^$word(\.$word)*$";
	$ip_domain_pat='^\[([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\]$';
	$domain_pat = "^$atom(\.$atom)*$";
	
	if (preg_match('/'.$mail_pat.'/i', $email, $components)) {
		$user = $components[1];
		$domain = $components[2];
		if (preg_match('/'.$user_pat.'/i', $user)) { 
			if (preg_match('/'.$ip_domain_pat.'/i', $domain, $ip_components)) { 
				for ($i=1;$i<=4;$i++) {
					if ($ip_components[$i] > 255) {
						$valid_address = false;
						break;
					}
				}
				
			} else {
				if (preg_match('/'.$domain_pat.'/i', $domain)) {
					$domain_components = explode(".", $domain);
					if (sizeof($domain_components) < 2)
						$valid_address = false;
					else {
						$top_level_domain = strtolower($domain_components[sizeof($domain_components)-1]);

						if (preg_match('/^[a-z][a-z]$/i', $top_level_domain) != 1) { 
							$tld_pattern = '';
							$tlds = file(DIR_FS_INC.'tld.txt');
							while (list(,$line) = each($tlds)) {
								$words = explode('#', $line);
								$tld = trim($words[0]);
								
								if (preg_match('/^[a-z]{3,}$/i', $tld) == 1)
									$tld_pattern .= '^' . $tld . '$|';
							}
							$tld_pattern = substr($tld_pattern, 0, -1);
							if (preg_match('/'.$tld_pattern.'/i', $top_level_domain) == 0)
								$valid_address = false;
						}
					}
					
				} else
					$valid_address = false;
			}
			
		} else
			$valid_address = false;
		
	} else
		$valid_address = false;
	
	if ($valid_address && ENTRY_EMAIL_ADDRESS_CHECK == 'true')
		if (!checkdnsrr($domain, "MX") && !checkdnsrr($domain, "A"))
			$valid_address = false;

	return $valid_address;
}
?>