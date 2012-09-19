<?php
/* -------------------------------------------------------------------------------------
* 	ID:						$Id: commerce_seo.inc.php 30 2011-06-16 15:41:19Z siekiera $
* 	Letzter Stand:			$Revision: 30 $
* 	zuletzt geaendert von:	$Author: siekiera $
* 	Datum:					$Date: 2011-06-16 17:41:19 +0200 (Thu, 16 Jun 2011) $
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
* 	Released under the GNU General License
* ----------------------------------------------------------------------------------- */

class SeoUrl {
	var $db;

	function __construct() {
		global $db;
		
		$this->db = $db;
				
		require_once(DIR_FS_INC.'inc.get_url_friendly_text.php');
	}
	
	function __destruct() {}

	function blog_da() {
		$ist_blog_da = 'blog.php';
		if(file_exists($ist_blog_da))
			return true;
		else
			return false;
	}

	public function getSiteLink($type, $param) {		
        $params = '';
		foreach($_GET AS $key => $value) {
			if(	$key != $type &&
				$key != 'cat' &&
				$key != 'view_as' &&
				$key != 'per_site' &&
				$key != 'language' &&
				$key != 'page' && 
				$key != 'filter' && 
				$key != 'sub_filter'
				) {
				if(!empty($params))
					$sep = '&';
				$params .= $sep.$key.'='.$value;
			}
		}
		
		if(!empty($params))
			$params = '?'.$params;
			
		switch($type) {
			
			case 'products_id':
				$product_link = $this->db->db_query("SELECT url_text FROM ".TABLE_SEO_URL." WHERE products_id = '".$_GET['products_id']."' AND language_id='".$_SESSION['languages_id']."'");
				return $product_link->fields['url_text'].'.html';
				break;
			
			case 'cPath':
				$category_link = $this->db->db_query("SELECT url_text FROM ".TABLE_SEO_URL." WHERE categories_id = '".$param."' AND language_id='".$_SESSION['languages_id']."'");
				return $category_link->fields['url_text'].$params;
				break;
			
			case 'coID':
				$content_link = $this->db->db_query("SELECT url_text FROM ".TABLE_SEO_URL." WHERE content_group = '".$_GET['coID']."' AND language_id='".$_SESSION['languages_id']."'");
				return $content_link->fields['url_text'].'.html'.$params;
				break;
				
			case 'keywords':
				return 'keywords/'.$param.'/'.$params;
				break;
				
			case 'brand':
				$brand_link = $this->db->db_query("SELECT brand_name FROM ".TABLE_BRAND." WHERE brand_id = '".$_GET['brand']."'");
				return 'brand-'.$param.'/'.get_url_friendly_text($brand_link->fields['brand_name']).'/'.$params;
				break;
				
			case 'tag':
				return 'tag/'.$param.'/'.$params;
				break;
			
			case 'blog_item':
				$blog_link = $this->db->db_query("SELECT url_text FROM ".TABLE_SEO_URL." WHERE blog_id = '".$_GET['blog_item']."' AND language_id='".$_SESSION['languages_id']."'");
				return $blog_link->fields['url_text'].'.html'.$params;
				break;
				
			case 'blog_cat':
				$blog_link = $this->db->db_query("SELECT url_text FROM ".TABLE_SEO_URL." WHERE blog_cat = '".$_GET['blog_cat']."' AND language_id='".$_SESSION['languages_id']."'");
				
				return $blog_link->fields['url_text'].$params;
				break;
		}
		
		return $uri;
	}

	function getProductLink($parameters = '', $connection = 'NONSSL', $language) {

		$explodedParams = explode('&',$parameters);
		foreach($explodedParams as $value)
			if (substr($value,0,12) == 'products_id=')
				$productId = substr($value,12,strlen($value));

		if($connection == 'SSL' && ENABLE_SSL)
        	$link = HTTPS_SERVER.DIR_WS_CATALOG;
        else
            $link = HTTP_SERVER.DIR_WS_CATALOG ;

		$product_link = $this->db->db_query("SELECT url_text FROM ".TABLE_SEO_URL." WHERE products_id = '".$productId."' AND language_id = ".$this->db->db_prepare($language));
		
		$params = '';
		foreach($explodedParams AS $value) {
			if(substr($value,0,4) == 'qty=') {
				$qty = substr($value,4,strlen($value));
				$params .= $sep.'qty='.$qty;
			}
		}
		return $link.$product_link->fields['url_text'].'.html'.(!empty($params)?'?'.$params:'');
	}

	function getCategoryLink($parameters = '', $connection = 'NONSSL', $language) {

		$explodedParams = explode('&',$parameters);
		
		foreach($explodedParams AS $value) {
			if(substr($value,0,6) == 'cPath=') {
				$CategoryParameter = substr($value,6,strlen($value));
				if(strpos($CategoryParameter,'_'))
					$categoryId = substr(substr($value,6,strlen($value)),strrpos($CategoryParameter,'_')+1);
				else
					$categoryId = substr($value,6,strlen($value));
			}
		}

		if ($connection == 'SSL' && ENABLE_SSL)
        	$link = HTTPS_SERVER.DIR_WS_CATALOG;
        else
            $link = HTTP_SERVER.DIR_WS_CATALOG ;

		$category_link = $this->db->db_query("SELECT url_text FROM ".TABLE_SEO_URL." WHERE categories_id = '".$categoryId."' AND language_id = '".$language."'");

		$params = '';
		foreach($explodedParams AS $value) {
			if(substr($value,0,9) == 'per_site=') {
				$perSite = substr($value,9,strlen($value));
				$params .= $sep.'per_site='.$perSite;
			}
			if(substr($value,0,8) == 'view_as=') {
				$viewAs = substr($value,8,strlen($value));
				if(!empty($params))
					$sep = '&';
				$params .= $sep.'view_as='.$viewAs;
			}
			if(substr($value,0,10) == 'filter_id=') {
				$filterId = substr($value,10,strlen($value));
				if(!empty($params))
					$sep = '&';
				$params .= $sep.'filter_id='.$filterId;
			}
			if(substr($value,0,10) == 'multisort=') {
				$multisort = substr($value,10,strlen($value));
				if(!empty($params))
					$sep = '&';
				$params .= $sep.'multisort='.$multisort;
			}
		}

		return $link.$category_link->fields['url_text'].(!empty($params)?'?'.$params:'');
	}

	function getContentLink($parameters,$connection='NONSSL',$language) {

		$explodedParams=explode('&',$parameters);

		foreach($explodedParams as $value)
			if (substr($value,0,4) == 'coID')
				$contentGroupId=substr($value,5,strlen($value));

		if ($connection == 'SSL' && ENABLE_SSL)
        	$link = HTTPS_SERVER.DIR_WS_CATALOG;
        else
            $link = HTTP_SERVER.DIR_WS_CATALOG;

		$content_link = $this->db->db_query("SELECT url_text FROM ".TABLE_SEO_URL." WHERE content_group = '".$contentGroupId."' AND language_id='".$language."'");

		return $link.$content_link->fields['url_text'].'.html';

	}

	function getBlogLink($parameters,$connection='NONSSL',$language) {
		$explodedParams=explode('&',$parameters);

		foreach($explodedParams as $value) {
			if (substr($value,0,9) == 'blog_item') {
				$blogID = substr($value,10,strlen($value));
			}
		}

		if ($connection == 'SSL' && ENABLE_SSL)
        	$link = HTTPS_SERVER.DIR_WS_CATALOG;
        else
            $link = HTTP_SERVER.DIR_WS_CATALOG;

		$blog_link = $this->db->db_query("SELECT url_text FROM ".TABLE_SEO_URL." WHERE blog_id = '".$blogID."' AND language_id='".$language."'");

		return $link.$blog_link->fields['url_text'].'.html';
	}

	function getBlogCatLink($parameters,$connection='NONSSL',$language) {

		$explodedParams=explode('&',$parameters);

		foreach($explodedParams as $value)
			if (substr($value,0,8) == 'blog_cat')
				$blogCatID = substr($value,9,strlen($value));

		if ($connection == 'SSL' && ENABLE_SSL)
        	$link = HTTPS_SERVER.DIR_WS_CATALOG;
        else
            $link = HTTP_SERVER.DIR_WS_CATALOG;

		$blog_cat_link = $this->db->db_query("SELECT url_text FROM ".TABLE_SEO_URL." WHERE blog_cat = '".$blogCatID."' AND language_id='".$language."'");

		return $link.$blog_cat_link->fields['url_text'];
	}

	function getLanguageChangeLink($page, $parameters, $connection='NONSSL') {
		
		$languageParamStartPos = strpos($parameters,'language=');
		$language = substr($parameters, ($languageParamStartPos+9), 2);
		$language = str_replace('/', '', $language);
		$languageId_result = $this->db->db_query("SELECT
														languages_id
													FROM
														".TABLE_LANGUAGES."
													WHERE
														code = '".$language."'");

		if ($connection == 'SSL' && ENABLE_SSL)
        	$link = HTTPS_SERVER.DIR_WS_CATALOG;
        else
            $link = HTTP_SERVER.DIR_WS_CATALOG ;

        $categoryId = ' IS NULL';
        $productId =' IS NULL';
        if($this->blog_da()) {
			$blogID = ' IS NULL';
			$blogCAT = ' IS NULL';
		}
        $coID =' IS NULL';

		$explodedParams = explode('&', $parameters);
		switch ($page) {
			case 'product_info.php':
				foreach($explodedParams AS $value) {
					if (substr($value, 0, 12) == 'products_id=')
						$productId = '=\''.substr($value, 12, strlen($value)).'\'';
				}
				break;

			case 'index.php':
				$catIdFound = false;
				foreach($explodedParams AS $value) {
					if (substr($value, 0, 6) == 'cPath=') {
						$categoryId = '=\''.substr($value, 6, strlen($value)).'\'';
						$catIdFound=true;
					}
				}

				if(!$catIdFound)
					return $link.$language;

				break;

			case 'blog.php' :
				foreach($explodedParams AS $value)
					if (substr($value, 0, 10) == 'blog_item=')
						$blogID = '=\''.substr($value, 10, strlen($value)).'\'';

			case 'shop_content.php':
				foreach($explodedParams AS $value)
					if (substr($value, 0, 5) == 'coID=')
						$coID='=\''.substr($value, 5, strlen($value)).'\'';

				break;

			case 'seo_url.php':
				$categoryId=' IS NULL';
				$productId=' IS NULL';
				if($this->blog_da()){
					$blogID = ' IS NULL';
					$blogCAT = ' IS NULL';
				}
				$coID=' IS NULL';

				if(substr_count($parameters,'products_id=') > 0) {
					foreach($explodedParams AS $value)
						if (substr($value,0,12) == 'products_id=')
							$productId='=\''.substr($value,12,strlen($value)).'\'';

				} elseif (substr_count($parameters,'cPath=') > 0 && substr_count($parameters,'blog_cat=') == 0) {
					foreach($explodedParams AS $value) {
						if (substr($value, 0, 6) == 'cPath=') {
							$categoryId='=\''.substr($value, 6, strlen($value)).'\'';
							$catIdFound=true;
						}
					}
				} elseif (substr_count($parameters,'coID=') > 0) {
					foreach($explodedParams AS $value)
						if (substr($value,0,5) == 'coID=')
							$coID='=\''.substr($value,5,strlen($value)).'\'';

				} elseif (substr_count($parameters,'blog_item') > 0) {
					foreach($explodedParams as $value)
						if (substr($value,0,10) == 'blog_item=')
							$blogID = '=\''.substr($value,10,strlen($value)).'\'';

				} elseif (substr_count($parameters,'blog_cat=') > 0) {
					foreach($explodedParams as $value)
						if (substr($value,0,9) == 'blog_cat=')
							$blogCAT = '=\''.substr($value,9,strlen($value)).'\'';
				}
				break;
		}

		if($this->blog_da())
			$blog_request = "AND blog_cat".$blogCAT." AND blog_id".$blogID;
		else
			$blog_request = '';

		$link_db = $this->db->db_query("SELECT
											url_text
										FROM
											".TABLE_SEO_URL."
										WHERE 1>0
										AND
											products_id".$productId."
										AND
											categories_id".$categoryId."
										AND
											content_group".$coID."
											".$blog_request."
										AND
											language_id=".$languageId_result->fields['languages_id']);
		switch ($page) {
			// product
			case 'product_info.php':
				return $link.$link_db->fields['url_text'].'.html';
				break;
			// Category
			case 'index.php':
				return $link.$link_db->fields['url_text'];
				break;
			// Content
			case 'shop_content.php':
				return $link.$link_db->fields['url_text'].'.html';
				break;
			// Blog
			case 'blog.php':
				if($this->blog_da())
					return $link.$link_db->fields['url_text'].'.html';
				break;
			case 'seo_url.php':
				if ($productId != ' IS NULL' && $link_db->fields['url_text'] != '')
					return $link.$link_db->fields['url_text'].'.html';
				elseif($categoryId != ' IS NULL' && $link_db->fields['url_text'] != '')
					return $link.$link_db->fields['url_text'];
				elseif($coID != ' IS NULL' && $link_db->fields['url_text'] != '')
					return $link.$link_db->fields['url_text'].'.html';
				elseif($blogCAT != ' IS NULL' && $link_db->fields['url_text'] != '')
					return $link.$link_db->fields['url_text'];
				elseif($blogID != ' IS NULL' && $link_db->fields['url_text'] != '')
					return $link.$link_db->fields['url_text'].'.html	';
				else {
					return $link.$language;
				}
				break;
			}
	}

	function getCategoryPathForProduct($productId,$language) {
		require_once(DIR_FS_INC.'inc.get_product_path.php');
		$ProductPath = get_product_path($productId);
		$pathExploded = explode('_',$ProductPath);
		foreach($pathExploded as $value) { $i++;
			($pathExploded[0] <> '' && $i > 1) ? $productPath .= MODULE_CATEGORY_SPACER : false;
			$productPath .= $this->getCategoryNameForId($value, $language);
		}
		return $productPath;
	}

	function getCategoryPathForCategory($categoryId, $language) {

		require_once(DIR_FS_INC.'inc.get_category_path.php');
		$CategoryPath = get_category_path($categoryId);
		$pathExploded = explode('_',$CategoryPath);

		foreach($pathExploded AS $value) {
			$pathExploded[0] <> '' ? $categoryPath .= MODULE_CATEGORY_SPACER : false;
			$categoryPath .= $this->getCategoryNameForId($value, $language);
		}
		return $categoryPath;
	}

	function getCategoryNameForId($categoryId, $language) {
		
    	$category = $this->db->db_query("SELECT
												categories_name,
												categories_url_alias
											FROM
												".TABLE_CATEGORIES_DESCRIPTION."
											WHERE
												categories_id = '".$categoryId."'
											AND
												language_id = '".$language."'");

		if($category->fields['categories_url_alias'] !='')
			$cat_name = $category->fields['categories_url_alias'];
		else
			$cat_name = $category->fields['categories_name'];

   		return get_url_friendly_text($cat_name);
	}

	function createSeoDBTable() {

		$useLanguageUrl = false;
		
		if($_REQUEST['configuration']['MODULE_SEO_URL_INDEX_LANGUAGEURL'] == 'True')
			$useLanguageUrl = true;
		elseif(!$_REQUEST['configuration']['MODULE_SEO_URL_INDEX_LANGUAGEURL'] && MODULE_SEO_URL_INDEX_LANGUAGEURL == 'True')
			$useLanguageUrl = true;
		
		$this->db->db_query("TRUNCATE TABLE ".TABLE_SEO_URL);
		
		$languages = $this->get_languages();
		foreach($languages AS $lang) {
			if($useLanguageUrl) {
				$this->db->db_query("INSERT INTO
										".TABLE_SEO_URL."
										(url_md5,
										url_text,
										language_id)
									VALUES
										('".md5($lang['code'].'/')."',
										'".$lang['code'].'/'."',
										'".$lang['id']."')");
			}
			
			// ******* Products Index ********//
			$productList = $this->db->db_query("SELECT
													products_id,
													products_name,
													products_url_alias
												FROM
													".TABLE_PRODUCTS_DESCRIPTION."
												WHERE
													language_id = '".$lang['id']."'");
	
			while(!$productList->EOF) {
				if($_REQUEST['configuration']['MODULE_SEO_URL_URL_LENGHT'] == 'True')
					$productPath = '';
				else
					$productPath = $this->getCategoryPathForProduct($productList->fields['products_id'], $lang['id']);
	
				if($productList->fields['products_url_alias'] !='')
					$products_name = $productList->fields['products_url_alias'];
				else
					$products_name = $productList->fields['products_name'];
	
				if($useLanguageUrl)
					$productLink = $lang['code'].'/'. $productPath .get_url_friendly_text($products_name);
				else
					$productLink = $productPath.get_url_friendly_text($products_name);
	
	
				$productLink = $this->validateDBKeyLink($productLink,'');
	
				$this->db->db_query("INSERT INTO 
											".TABLE_SEO_URL." 
											(url_md5,url_text,products_id,language_id) 
										VALUES 
											('".md5($productLink)."',
											'".$productLink."',
											'".$productList->fields['products_id']."',
											'".$lang['id']."')");
				$productList->MoveNext();
			}
	
			// ******* Categories Index ********//
			$categoryList = $this->db->db_query("SELECT
													categories_id
												FROM
													".TABLE_CATEGORIES_DESCRIPTION."
												WHERE
													language_id = '".$lang['id']."'");
	
			while(!$categoryList->EOF) {
				$categoryPath = $this->getCategoryPathForCategory($categoryList->fields['categories_id'], $lang['id']);
	
				if($useLanguageUrl)
					$categoryLink = $lang['code'].$categoryPath;
				else
					$categoryLink = substr($categoryPath,1);
	
				$categoryLink = $this->validateDBKeyLink($categoryLink,'', '-', '/');
	
				$this->db->db_query("INSERT INTO
										".TABLE_SEO_URL."
											(url_md5,
											url_text,
											categories_id,
											language_id)
										VALUES
											('".md5($categoryLink)."',
											'".$categoryLink."',
											'".$categoryList->fields['categories_id']."',
											'".$lang['id']."')");
				$categoryList->MoveNext();
			}

			if($this->blog_da()) {
				// ******* Blog Kategorie Indexierung  ********//
				$blogList = $this->db->db_query("SELECT
													categories_id,
													titel
												FROM
													".TABLE_BLOG_CATEGORIES."
												WHERE
													language_id = '".$lang['id']."'");
	
				while(!$blogList->EOF) {
					if ($useLanguageUrl)
						$blogLink = $lang['code'].'/'.get_url_friendly_text($blogList->fields['titel']);
					else
						$blogLink = get_url_friendly_text($blogList->fields['titel']);
	
					$blogLink = $this->validateDBKeyLink($blogLink,'').'/';
	
					$this->db->db_query("INSERT INTO 
												".TABLE_SEO_URL." 
												(url_md5,
												url_text,
												blog_cat,
												language_id) 
											VALUES 
												('".md5($blogLink)."',
												'".$blogLink."',
												'".$blogList->fields['categories_id']."',
												'".$lang['id']."')");
	
					$blogList->MoveNext();
				}
	
				// ******* Blog Item Indexierung  ********//
				$blogList = $this->db->db_query("SELECT
														bi.item_id as blog_item_id,
														bi.language_id as blog_item_lang,
														bi.name AS blog_item_title,
														bc.categories_id as blog_cat_id,
														bc.titel as blog_cat_titel
													FROM
														".TABLE_BLOG_ITEMS." bi,
													 	".TABLE_BLOG_CATEGORIES." bc
													 WHERE
													 	bi.language_id = '".$lang['id']."'
													 AND
													 	bc.language_id = '".$lang['id']."'
													 AND
													 	bi.categories_id = bc.categories_id");
	
				while(!$blogList->EOF) {
					if ($useLanguageUrl)
						$blogLink = $lang['code'].'/'.get_url_friendly_text($blogList->fields['blog_cat_titel']).'/'.get_url_friendly_text($blogList->fields['blog_item_title']);
					else
						$blogLink = get_url_friendly_text($blogList->fields['blog_cat_titel']).'/'.get_url_friendly_text($blogList->fields['blog_item_title']);
	
					$blogLink = $this->validateDBKeyLink($blogLink,'');
	
					$this->db->db_query("INSERT INTO 
											".TABLE_SEO_URL." 
											(url_md5,
											url_text,
											blog_id,
											language_id) 
										VALUES 
											('".md5($blogLink)."',
											'".$blogLink."',
											'".$blogList->fields['blog_item_id']."',
											'".$lang['id']."')");
					$blogList->MoveNext();
				}
			}
	
			// ******* Content Index ********//
			$contentList = $this->db->db_query("SELECT
													content_group,
													languages_id,
													content_title,
													content_url_alias
												FROM
													".TABLE_CONTENT_MANAGER."
												WHERE
													languages_id = '".$lang['id']."'");
	
			while(!$contentList->EOF) {
				if($contentList->fields['content_url_alias'] !='')
					$content_url = $contentList->fields['content_url_alias'];
				else
					$content_url = $contentList->fields['content_title'];
	
				if ($useLanguageUrl)
					$contentLink = $lang['code'].'/'.get_url_friendly_text($content_url);
				else
					$contentLink = get_url_friendly_text($content_url);
	
				$contentLink = $this->validateDBKeyLink($contentLink,'');
	
				$this->db->db_query("INSERT INTO 
										".TABLE_SEO_URL." 
										(url_md5,
										url_text,
										content_group,
										language_id) 
									VALUES 
										('".md5($contentLink)."',
										'".$contentLink."',
										'".$contentList->fields['content_group']."',
										'".$lang['id']."')");
				$contentList->MoveNext();
			}
		}
	}

	function updateSeoDBTable($elementType, $id) {
		
		if(empty($id)) 
			return;
		
		switch ($elementType) {
			// ******* Product Update ********//
			case 'product':
				$resultList	= $this->db->db_query("SELECT
														pd.products_id,pd.language_id,
														pd.products_name,
														pd.products_url_alias,
														l.code
													FROM
														".TABLE_PRODUCTS_DESCRIPTION ." pd,
														".TABLE_LANGUAGES." l
													WHERE
														pd.products_id = ".$id."
													AND
														pd.language_id  = l.languages_id");

				while(!$resultList->EOF) {
					if(MODULE_SEO_URL_URL_LENGHT == 'True')
						$productPath = '';
					else
						$productPath = $this->getCategoryPathForProduct($resultList->fields['products_id'],$resultList->fields['language_id']);

					if($resultList->fields['products_url_alias'] !='')
						$product_name = $resultList->fields['products_url_alias'];
					else
						$product_name = $resultList->fields['products_name'];

					if (MODULE_SEO_URL_INDEX_LANGUAGEURL=='True')
						$productLink = $resultList->fields['code'].'/'.$productPath.get_url_friendly_text($product_name);
					else
						$productLink = $productPath.get_url_friendly_text($product_name);

					$productPath = $this->validateDBKeyLink($productLink,'');
					$this->db->db_query("UPDATE
											".TABLE_SEO_URL."
										SET
											url_md5='".md5($productPath)."',
											url_text='".$productLink."'
										WHERE
											products_id='".$id."'
										AND
											language_id='".$resultList->fields['language_id']."'");
					
					$resultList->MoveNext();
				}
				break;

			/**
				Kategorie Update
			*/
			case 'category':
				$resultList = $this->db->db_query("SELECT
														cd.categories_id,
														cd.language_id,
														l.code
													FROM
														".TABLE_CATEGORIES_DESCRIPTION." cd,
														".TABLE_LANGUAGES." l
													WHERE
														cd.categories_id = '".$id."'
													AND
														cd.language_id = l.languages_id");

				while(!$resultList->EOF) {
					$categoryPath = $this->getCategoryPathForCategory($resultList->fields['categories_id'], $resultList->fields['language_id']);

					if (MODULE_SEO_URL_INDEX_LANGUAGEURL=='True')
						$categoryLink = $resultList->fields['code'].$categoryPath;
					else
						$categoryLink = substr($categoryPath, 1);

					$old_categorylink = $this->db->db_query("SELECT
																url_text
															FROM
																".TABLE_SEO_URL."
															WHERE
																categories_id = '".$id."'
															AND
																language_id = '".$resultList->fields['language_id']."'");

					if($categoryLink != $old_categorylink->fields['url_text']) {
						$categoryLink = $this->validateDBKeyLink($categoryLink, '', '-', '/', true);
						$this->db->db_query("UPDATE
												".TABLE_SEO_URL."
											SET
												url_md5 = '".md5($categoryLink)."',
												url_text = '".$categoryLink."'
											WHERE
												categories_id = '".$id."'
											AND
												language_id = '".$resultList->fields['language_id']."'");
					}
					$resultList->MoveNext();
				}
				break;

			case 'content':
				$content = $this->db->db_query("SELECT
													cm.content_group,
													cm.languages_id,
													cm.content_title,
													cm.content_url_alias,
													l.code
												FROM
													".TABLE_CONTENT_MANAGER." cm,
													".TABLE_LANGUAGES." l
												WHERE
													cm.content_group = '".$id."'
												AND
													l.languages_id = cm.languages_id");

				while(!$content->EOF) {
					if($content->fields['content_url_alias'] !='')
						$content_url = $content->fields['content_url_alias'];
					else
						$content_url = $content->fields['content_title'];
	
					if(MODULE_SEO_URL_INDEX_LANGUAGEURL=='True')
						$contentLink = $content->fields['code'].'/'.get_url_friendly_text($content_url);
					else
						$contentLink = get_url_friendly_text($content_url);
	
					$this->db->db_query("UPDATE
											".TABLE_SEO_URL."
										SET
											url_md5 = '".md5($contentLink)."',
											url_text = '".$contentLink."'
										WHERE
											content_group = '".$id."'");
					$content->MoveNext();
				}
				break;
			
			case 'blog_item':
				if($this->blog_da()) {
					$blogList = $this->db->db_query("SELECT
															bi.item_id AS blog_item_id,
															bi.language_id AS blog_item_lang,
															bi.title AS blog_item_title,
															bc.categories_id  as blog_cat_id, 
															l.code AS code,
															bc.titel AS blog_cat_titel
														FROM
															".TABLE_BLOG_ITEMS." bi,
															".TABLE_BLOG_CATEGORIES." bc,
															".TABLE_LANGUAGES." l
														WHERE
															bi.language_id = l.languages_id
														AND
															bc.language_id = bi.language_id
														AND
															bi.item_id = '".$id."'
														AND
															bi.categories_id = bc.categories_id");

					while(!$blogList->EOF) {
						if(MODULE_SEO_URL_INDEX_LANGUAGEURL=='True')
							$blogLink = $blogList->fields['code'].get_url_friendly_text($blogList->fields['blog_cat_titel']).'/'.get_url_friendly_text($blogList->fields['blog_item_title']);

						else
							$blogLink = get_url_friendly_text($blogList->fields['blog_cat_titel']).'/'.get_url_friendly_text($blogList->fields['blog_item_title']);

						$this->db->db_query("UPDATE
												".TABLE_SEO_URL."
											SET
												url_md5 = '".md5($blogLink)."',
												url_text = '".$blogLink."'
											WHERE
												blog_id = '".$blogList->fields['blog_item_id']."'
											AND
												language_id = '".$blogList->fields['language_id']."'");

						$blogList->MoveNext();
					}
				}
				break;
			
			case 'blog_cat':
				if($this->blog_da()) {
					$blogList = $this->db->db_query("SELECT
															bc.categories_id as blog_cat_id,
															bc.language_id as blog_item_lang,
															l.code AS code,
															bc.titel as blog_cat_titel
														FROM
															".TABLE_BLOG_CATEGORIES." bc,
															".TABLE_LANGUAGES." l
														WHERE
															bc.language_id = l.languages_id");

					while(!$blogList->EOF) {
						if(MODULE_SEO_URL_INDEX_LANGUAGEURL=='True') {
							$blogLink = $blogList->fields['code'].get_url_friendly_text($blogList->fields['blog_cat_titel']).'/'.get_url_friendly_text($blogList->fields['blog_cat_titel']);

						} else
							$blogLink = get_url_friendly_text($blogList->fields['blog_cat_titel']).'/';

						$blogLink = $this->validateDBKeyLink($blogLink,'');

						$this->db->db_query("UPDATE
												".TABLE_SEO_URL."
											SET
												url_md5 = '".md5($blogLink)."',
												url_text = '".$blogLink."'
											WHERE
												blog_cat = '".$blogList->fields['blog_cat_id']."'
											AND
												language_id = '".$blogList->fields['language_id']."'");

						$blogList->MoveNext();
					}
				}
				break;
		}
	}

	function insertSeoDBTable($elementType, $id = '') {
		$and = '';
		
		if (!get_cfg_var('safe_mode'))
			set_time_limit(180);
		
		switch ($elementType) {

			case 'product':
				if(!empty($id))
					$and = " AND pd.products_id = '".$id."'";
					
				$resultList = $this->db->db_query("SELECT
														pd.products_id,
														pd.language_id,
														pd.products_name,
														pd.products_url_alias,
														l.code
													FROM
														".TABLE_PRODUCTS_DESCRIPTION ." pd
														LEFT JOIN
																".TABLE_SEO_URL." seourl
															ON								pd.products_id = seourl.products_id
														INNER JOIN
															". TABLE_LANGUAGES ." l
															ON
																pd.language_id = l.languages_id
													WHERE
														seourl.products_id IS NULL".$and);

				while(!$resultList->EOF) {
					if(MODULE_SEO_URL_URL_LENGHT == 'True')
						$productPath = '';
					else
						$productPath = $this->getCategoryPathForProduct($resultList->fields['products_id'],$resultList->fields['language_id']);

					if($resultList->fields['products_url_alias'] !='')
						$product_name = $resultList->fields['products_url_alias'];
					else
						$product_name = $resultList->fields['products_name'];
										
					if (MODULE_SEO_URL_INDEX_LANGUAGEURL=='True')
						$productLink = $resultList->fields['code'].'/'.$productPath .get_url_friendly_text($product_name);
					else
						$productLink = $productPath .get_url_friendly_text($product_name);

					$productLink = $this->validateDBKeyLink($productLink, '');
					$this->db->db_query("REPLACE INTO
											".TABLE_SEO_URL."
												(url_md5,
												url_text,
												products_id,
												language_id)
											VALUES 
												('".md5($productLink)."',
												'".$productLink."',
												'".$resultList->fields['products_id']."',
												'".$resultList->fields['language_id']."')");

					$resultList->MoveNext();
				}
			break;

			case 'category':
				if(!empty($id))
					$and = " AND cd.categories_id = '".$id."'";
					
				$resultList = $this->db->db_query("SELECT
														cd.categories_id,
														cd.language_id,
														cd.categories_name,
														l.code
													FROM
														".TABLE_CATEGORIES_DESCRIPTION ." cd
														LEFT JOIN ".TABLE_SEO_URL." AS seo
															ON cd.categories_id = seo.categories_id
														INNER JOIN ". TABLE_LANGUAGES ." l
															ON cd.language_id = l.languages_id
													WHERE
														seo.categories_id IS NULL".$and);

				while(!$resultList->EOF) {
					$categoryPath = $this->getCategoryPathForCategory($resultList->fields['categories_id'], $resultList->fields['language_id']);

					if (MODULE_SEO_URL_INDEX_LANGUAGEURL=='True')
						$categoryLink = $resultList->fields['code'].$categoryPath;
					else
						$categoryLink = substr($categoryPath,1);
					
					$categoryLink = $this->validateDBKeyLink($categoryLink, '', '-', '/');

					$this->db->db_query("INSERT INTO
											".TABLE_SEO_URL."
												(url_md5,
												url_text,
												categories_id,
												language_id)
										VALUES 
											('".md5($categoryLink)."',
											'".$categoryLink."',
											'".$resultList->fields['categories_id']."',
											'".$resultList->fields['language_id']."')");
					$resultList->MoveNext();
				}
				break;
			
			case 'blog_cat':
				if(!empty($id))
					$and = " AND bc.categories_id = '".$id."'";
					
				$blogList = $this->db->db_query("SELECT
														bc.categories_id,
														bc.titel,
														bc.language_id,
														l.code
													FROM
														".TABLE_BLOG_CATEGORIES." bc 
														LEFT JOIN ".TABLE_SEO_URL." AS seo
															ON bc.categories_id = seo.blog_cat
														INNER JOIN ".TABLE_LANGUAGES." l
															ON bc.language_id = l.languages_id
													WHERE
														seo.blog_cat IS NULL".$and);

				while(!$blogList->EOF) {
					if(MODULE_SEO_URL_INDEX_LANGUAGEURL == 'True')
						$blogLink = $blogList->fields['code'].'/'.get_url_friendly_text($blogList->fields['titel']);
					else
						$blogLink = get_url_friendly_text($blogList->fields['titel']);

					$blogLink = $this->validateDBKeyLink($blogLink, '', '-', '/');
					
					$this->db->db_query("INSERT INTO
												".TABLE_SEO_URL."
													(url_md5,
													url_text,
													blog_cat,
													language_id)
											VALUES 
												('".md5($blogLink)."',
												'".$blogLink."',
												'".$blogList->fields['categories_id']."',
												'".$blogList->fields['language_id']."')");
					
					$blogList->MoveNext();
				}
				break;
				
			case 'blog_item':	
				if(!empty($id))
					$and = " AND bi.item_id = '".$id."'";

				$blogList = $this->db->db_query("SELECT
														bi.item_id,
														bi.language_id,
														bi.title,
														bc.categories_id,
														bc.titel,
														l.code
													FROM
														".TABLE_BLOG_ITEMS." bi
														LEFT JOIN ".TABLE_SEO_URL." AS seo
															ON bi.item_id = seo.blog_id
														LEFT JOIN ".TABLE_BLOG_CATEGORIES." AS bc
															ON (bc.categories_id = bi.categories_id AND bc.language_id = bi.language_id)
														INNER JOIN ".TABLE_LANGUAGES." l
															ON bi.language_id = l.languages_id
													WHERE
														seo.blog_id IS NULL".$and);

				while(!$blogList->EOF) {
					
					if(MODULE_SEO_URL_URL_LENGHT=='True')
						$blogLink = get_url_friendly_text($blogList->fields['title']);
					else
						$blogLink = get_url_friendly_text($blogList->fields['titel']).'/'.get_url_friendly_text($blogList->fields['title']);
						
					if(MODULE_SEO_URL_INDEX_LANGUAGEURL == 'True')
						$blogLink = $blogList->fields['code'].$blogLink;

					$blogLink = $this->validateDBKeyLink($blogLink, '');
					
					$this->db->db_query("INSERT INTO
												".TABLE_SEO_URL."
													(url_md5,
													url_text,
													blog_id,
													language_id)
											VALUES 
												('".md5($blogLink)."',
												'".$blogLink."',
												'".$blogList->fields['item_id']."',
												'".$blogList->fields['language_id']."')");
					
					$blogList->MoveNext();
				}
				
				break;
				
			case 'content' :
				if(!empty($id))
					$and = " AND cm.content_group = '".$id."'";
				
				$contentList = $this->db->db_query("SELECT
														cm.content_group,
														cm.languages_id,
														cm.content_title,
														cm.content_url_alias,
														l.code
													FROM
														".TABLE_CONTENT_MANAGER." cm 
														LEFT JOIN ".TABLE_SEO_URL." AS seo
															ON cm.content_group = seo.content_group
														INNER JOIN ".TABLE_LANGUAGES." l
															ON cm.languages_id = l.languages_id
													WHERE
														seo.content_group IS NULL");
		
				while(!$contentList->EOF) {
					if($contentList->fields['content_url_alias'] !='')
						$content_url = $contentList->fields['content_url_alias'];
					else
						$content_url = $contentList->fields['content_title'];
					
					$contentLink = get_url_friendly_text($content_url);
					
					if(MODULE_SEO_URL_INDEX_LANGUAGEURL == 'True')
						$contentLink = $contentList->fields['code'].'/'.$contentLink;
		
					$contentLink = $this->validateDBKeyLink($contentLink,'');
		
					$this->db->db_query("INSERT INTO 
											".TABLE_SEO_URL." 
											(url_md5,
											url_text,
											content_group,
											language_id) 
										VALUES 
											('".md5($contentLink)."',
											'".$contentLink."',
											'".$contentList->fields['content_group']."',
											'".$contentList->fields['languages_id']."')");
					$contentList->MoveNext();
				}
				break;
		}
	}
	
	function deleteFromDB($type, $id) {
		if(!empty($id))
			$this->db->db_query("DELETE FROM ".TABLE_SEO_URL." WHERE ".$type." = ".$this->db->db_prepare($id));
	}
	
	function validateDBKeyLink($url, $counter, $sep = '-', $s = '', $update = false) {
		if(!$update) {	
			$check = $this->db->db_query("SELECT url_text FROM ".TABLE_SEO_URL." WHERE url_md5 = '".md5($url.(!empty($counter) ? $sep.$counter : ''))."' ");
	
			if(!$check->_numOfRows)
				return $url.(!empty($counter) ? $sep.$counter : '').$s;
			else {
				$counter++;
				return $this->validateDBKeyLink($url, $counter);
			}
		} else
			return $url.$s;
	}

	function getIdForURL($linkUrl, $type) {

		if($this->blog_da())
			$query = "SELECT products_id, categories_id, content_group, blog_id FROM ".TABLE_SEO_URL." WHERE url_md5 = '".md5($linkUrl)."' LIMIT 0,1";
		else
			$query = "SELECT products_id, categories_id, content_group FROM ".TABLE_SEO_URL." WHERE url_md5 = '".md5($linkUrl)."' LIMIT 0,1";
			
   	 	$id = $this->db->db_query($query);

		switch ($type) {
			case 'product':
				return $id->fields['products_id'];
			case 'category':
				return $id->fields['categories_id'];
			case 'content':
				return $id->fields['content_group'];
			case 'blog':
				return $id->fields['blog_id'];
		}
	}

	function getIdForXTCSumaFriendlyURL($fileName) {
		if (($fileName=='product_info.php' && $_GET['products_id']<>'' && $_GET['action']=='') || ($fileName == 'index.php' && $_GET['page']=='' && $_GET['action']=='') || ($fileName == 'index.php' && $_GET['cPath']<>'' && $_GET['page']=='' && $_GET['action']=='') || ($fileName == 'shop_content.php' && $_GET['coID']<>'' && $_GET['action']=='')) {
			require_once(DIR_WS_CLASSES.'class.language.php');
			!$temp_lng ? $temp_lng = new language(input_validation($_GET['language'], 'char', '')) : false;

			if (!isset ($_SESSION['language']) || isset ($_GET['language'])) {

				if (!isset ($_GET['language']))
					$temp_lng->get_browser_language();
				$_SESSION['languages_id'] = $temp_lng->language['id'];

			}

			if (isset($_SESSION['language']) && !isset($_SESSION['language_charset'])) {
				$_SESSION['languages_id'] = $temp_lng->language['id'];

			}
		}


		// *******************************************************************
		// * PRODUCT 301 REDIRECT ********************************************
		// *******************************************************************

		// Create 301 redirect for PRODUCT LINKS without xtc:Suma friendly URLS
		// e.g.: http://www.shopname.com/product_info.php?info=p124_Produkt-1.html
		if ($fileName=='product_info.php' && $_GET['info']<>'' && $_GET['products_id']=='' && $_GET['action']=='') {
			$parameters='info='.$_GET['info'];
			$redirectLink = $this->getProductLink($parameters,$connection,$_SESSION['languages_id']);
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$redirectLink);
			exit;
		}

		// Create 301 redirect for PRODUCT LINKS with xtc:Suma friendly URLS
		// e.g.: http://www.shopname.com/product_info.php/products_id/124
		if ($fileName=='product_info.php' && $_GET['products_id']<>'' && $_GET['info']==''&& $_GET['action']=='') {
			$parameters='products_id='.$_GET['products_id'];
			$redirectLink = $this->getProductLink($parameters,$connection,$_SESSION['languages_id']);

			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$redirectLink);
			exit;
		}

		// *******************************************************************
		// * CATEGORY 301 REDIRECT *******************************************
		// *******************************************************************

		// Create 301 redirect for CATEGORY LINKS without xtc:Suma friendly URLS
		// e.g.: http://www.shopname.com/index.php?cat=c10_Kategorie-5.html
		if ($fileName == 'index.php' && $_GET['cat']=='' && $_GET['page']=='' && $_GET['action']=='') {
			$parameters='cPath='.$_GET['cat'];
			$redirectLink = $this->getCategoryLink($parameters,$connection,$_SESSION['languages_id']);
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$redirectLink);
			exit;
		}

		// Create 301 redirect for CATEGORY LINKS with xtc:Suma friendly URLS (cPath)
		// e.g.: http://www.shopname.com/index.php/cPath/10
		if ($fileName == 'index.php' && $_GET['cPath']<>'' && $_GET['page']=='' && $_GET['action']=='') {

			// Extract last Category ID if subcategories are submitted
			// e.g.: http://www.shopname.com/index.php/cPath/77_78
			// (78 is the subcategory)
			$explodedCategoryParameters = explode('_',$_GET['cPath']);
			//$_GET['cPath']=end($explodedCategoryParameters);

			$parameters='cPath='.$_GET['cPath'];
			$redirectLink = $this->getCategoryLink($parameters,$connection,$_SESSION['languages_id']);
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$redirectLink);
			exit;
		}

		// *******************************************************************
		// * CONTENT 301 REDIRECT ********************************************
		// *******************************************************************
		if ($fileName == 'shop_content.php' && $_GET['coID']<>'' && $_GET['action']=='') {
			$parameters='coID='.$_GET['coID'];
			$redirectLink = $this->getContentLink($parameters,$connection,$_SESSION['languages_id']);
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$redirectLink);
			exit;
		}

		// *******************************************************************
		// * Blog-Item 301 REDIRECT ********************************************
		// *******************************************************************
		if ($fileName == 'blog.php' && $_GET['blog_item']<>'' && $_GET['delete_comment'] == '') {
			$parameters='blog_item='.$_GET['blog_item'];

			$redirectLink = $this->getBlogLink($parameters,$connection,$_SESSION['languages_id']);
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$redirectLink);
			exit;
		}

		// *******************************************************************
		// * Blog-Cat 301 REDIRECT ********************************************
		// *******************************************************************
		if ($fileName == 'blog.php' && $_GET['blog_cat']<>'' && $_GET['blog_item']=='') {
			$parameters='blog_cat='.$_GET['blog_cat'];

			$redirectLink = $this->getBlogCatLink($parameters,$connection,$_SESSION['languages_id']);
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".$redirectLink);
			exit;
		}

		return false;
	}
	
	function get_languages() {
		$languages = $this->db->db_query("SELECT
												languages_id,
												name,
												code,
												image,
												directory,
												status,
												status_admin
											FROM
												".TABLE_LANGUAGES."
											ORDER BY
												sort_order");
		while(!$languages->EOF) {
			$languages_array[] = array('id' => $languages->fields['languages_id'], 'code' => $languages->fields['code']);
			$languages->MoveNext();
		}
		return $languages_array;
	}
}
?>