<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: inc.php_mail.php 422 2012-03-15 16:48:56Z siekiera $
* 	Letzter Stand:			$Revision: 422 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2012-03-15 17:48:56 +0100 (Thu, 15 Mar 2012) $
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

function php_mail($from_email_address, 
					$from_email_name, 
					$to_email_address, 
					$to_name, 
					$forwarding_to, 
					$reply_address, 
					$reply_address_name, 
					$path_to_attachement, 
					$path_to_more_attachements, 
					$email_subject, 
					$message_body_html, 
					$message_body_plain, 
					$order_mail = false) {

	global $mail_error, $db;

	if (SEND_EMAILS != 'true') 
		return;

	$mail = new PHPMailer();
	$mail->PluginDir = DIR_FS_DOCUMENT_ROOT.'includes/classes/';

	if (isset($_SESSION['language_charset']))
		$mail->CharSet = $_SESSION['language_charset'];
	
	if ($_SESSION['language'] == 'german')
		$mail->SetLanguage('de', DIR_WS_CLASSES);
	else
		$mail->SetLanguage('en', DIR_WS_CLASSES);
	
	if(DKIM_PASSPHRASE !='') {
		$mail->DKIM_identity = DKIM_IDENTITY;
		$mail->DKIM_passphrase = DKIM_PASSPHRASE;
		$mail->DKIM_domain = DKIM_DOMAIN;
		$mail->DKIM_private = DKIM_PRIVATE;
	}
	
	if (EMAIL_TRANSPORT == 'smtp') {
		$mail->IsSMTP();
		$mail->SMTPKeepAlive = true;
		$mail->SMTPAuth = SMTP_AUTH;
		$mail->Username = SMTP_USERNAME;
		$mail->Password = SMTP_PASSWORD;
		$mail->Host = SMTP_MAIN_SERVER.';'.SMTP_BACKUP_SERVER;
	}

	if (EMAIL_TRANSPORT == 'sendmail') {
		$mail->IsSendmail();
		$mail->Sendmail = SENDMAIL_PATH;
	}
	
	if (EMAIL_TRANSPORT == 'mail') 
		$mail->IsMail();

	if (EMAIL_USE_HTML == 'true'){
		$mail->MsgHTML($message_body_html);
		$message_body_plain = str_replace('<br />', " \n", $message_body_plain);
		$message_body_plain = strip_tags($message_body_plain);
		$mail->AltBody = $message_body_plain;

	} else {
		$message_body_plain = str_replace('<br />', " \n", $message_body_plain);
		$message_body_plain = strip_tags($message_body_plain);
		$mail->MsgHTML($message_body_plain);
		$mail->AltBody = $message_body_plain;
	}
	
	$mail->SetFrom($from_email_address, $from_email_name);
	$mail->AddAddress($to_email_address, $to_name);
	
	if ($forwarding_to != '')
		$mail->AddBCC($forwarding_to);
		
	$mail->AddReplyTo($reply_address, $reply_address_name);

	if((PDF_IN_ODERMAIL == 'true') && (PDF_IN_ORDERMAIL_COID != '')) {
		if($order_mail) {
			$co = explode(',',PDF_IN_ORDERMAIL_COID);
			for ($i = 0, $n = sizeof($co); $i < $n; $i++) {
				$content_data = $db->db_query("	SELECT
													content_id,
													content_title,
													content_heading,
													content_text,
													content_file
												FROM
													".TABLE_CONTENT_MANAGER."
												WHERE
													content_group='".$co[$i]."'
												AND
													languages_id='".(int) $_SESSION['languages_id']."'");

				$name  = get_url_friendly_text($content_data->fields['content_heading']);
				$name = str_replace(' ','-',$name).'.pdf';
				if(file_exists(DIR_WS_CLASSES.'fpdf/html_table.php'))
					require_once(DIR_WS_CLASSES.'fpdf/html_table.php');
				elseif(file_exists(DIR_FS_CATALOG.DIR_WS_CLASSES.'fpdf/html_table.php'))
					require_once(DIR_FS_CATALOG.DIR_WS_CLASSES.'fpdf/html_table.php');
				$pdf = new PDF_HTML_Table('P','mm','A4');
				$pdf->AddPage();
				$pdf->SetFont('Arial','U',12);
				$pdf->Cell(20,10, utf8_decode($content_data->fields['content_heading']));
				$pdf->Ln(20);
				$pdf->SetFont('Arial','',11);
				
				if($content_data->fields['content_file'] !='') {
					ob_start();
					include (DIR_FS_CATALOG.'media/content/'.$content_data->fields['content_file']);
					$text = stripslashes(ob_get_contents());
					ob_end_clean();
				} else
					$text = stripslashes(utf8_decode(html_entity_decode($content_data->fields['content_text'])));
					
				$pdf->WriteHTML($text);
				$pdftext = $pdf->Output('','S');
				$pdf = base64_decode($pdftext);
			  	$mail->AddStringAttachment($pdftext,$name,'base64','application/pdf');
			}
		}
	}

	if ($path_to_attachement != '')
		$mail->AddAttachment($path_to_attachement);

	if ($path_to_more_attachements != '')
		$mail->AddAttachment($path_to_more_attachements);

	$mail->Subject = $email_subject;

	if(!$mail->Send())
		 echo "Mailer Error: ".$mail->ErrorInfo;
}