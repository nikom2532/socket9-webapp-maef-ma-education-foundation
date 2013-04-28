<?php
/**
 * @package		Zentools
 * @version		v1.1
 * @author		Joomlabamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2012 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

class modzentoolsK2Helper
{
	function getList($params, $id,$format = 'html')
	{
		require_once(JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'route.php');
		require_once(JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'utilities.php');

		jimport('joomla.filesystem.file');
		$mainframe = &JFactory::getApplication();
		
		//K2 parameters
		$componentParams = &JComponentHelper::getParams('com_k2');
		$limit = $params->get('count', 2);
		$cid = $params->get('category_id', NULL);
		$ordering = $params->get('itemsOrdering');
		$limitstart = JRequest::getInt('limitstart');
		$user = &JFactory::getUser();
		$aid = $user->get('aid');
		$db = &JFactory::getDBO();
		$jnow = &JFactory::getDate();
		$now = $jnow->toMySQL();
		$nullDate = $db->getNullDate();
		$itemid = $params->get('itemid','');
		
		
		// Text Params
		$wordCount	= $params->get( 'wordCount','');
		$titlewordCount	= $params->get( 'titlewordCount','');
		$strip_tags = $params->get('strip_tags',0);
		$titleSuffix = $params->get('titleSuffix','');
		$textsuffix = $params->get('textsuffix','');
		$tags = $params->get('allowed_tags','');
		$translateDate	= $params->get('translateDate', 0);
		$dateFormat	= $params->get('dateFormat', 'j M, y');	
		$dateString	= $params->get('dateString', 'DATE_FORMAT_LC1');
		
		$link = $params->get('link');

		// Image Size and container, remove px if user entered
		$resizeImage = $params->get('resizeImage',1);
		$option = $params->get( 'option', 'crop');
		$img_width = str_replace('px', '', $params->get( 'image_width','170'));
		$img_height = str_replace('px', '', $params->get( 'image_height','85'));
		$thumb_width = str_replace('px', '', $params->get( 'thumb_width','20'));
		$thumb_height = str_replace('px', '', $params->get( 'thumb_height','20'));
		
	
		
		$query = "SELECT i.*, c.name AS categoryname,c.id AS categoryid, c.alias AS categoryalias, c.params AS categoryparams";

		if ($ordering == 'best')
			$query .= ", (r.rating_sum/r.rating_count) AS rating";

		$query .= " FROM #__k2_items as i LEFT JOIN #__k2_categories c ON c.id = i.catid";

		if ($ordering == 'best')
			$query .= " LEFT JOIN #__k2_rating r ON r.itemID = i.id";

		$query .= " WHERE i.published = 1 AND i.trash = 0 AND c.published = 1 AND c.trash = 0";
		
			if(K2_JVERSION=='16'){
				$query .= " AND i.access IN(".implode(',', $user->authorisedLevels()).") ";
			}
			else {
				$query .=" AND i.access<={$aid} ";
			}
			
			if(K2_JVERSION=='16'){
				$query .= " AND c.access IN(".implode(',', $user->authorisedLevels()).") ";
			}
			else {
				$query .=" AND c.access<={$aid} ";
			}
		

		$query .= " AND ( i.publish_up = ".$db->Quote($nullDate)." OR i.publish_up <= ".$db->Quote($now)." )";

		$query .= " AND ( i.publish_down = ".$db->Quote($nullDate)." OR i.publish_down >= ".$db->Quote($now)." )";

	
		// If content source is categories
		if($params->get('k2contentSource') != 'items'){
			if (!is_null($cid)) {
				if (is_array($cid)) {
					if ($params->get('getChildren')) {
						require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'models'.DS.'itemlist.php');
						$categories = K2ModelItemlist::getCategoryTree($cid);
						$sql = @implode(',', $categories);
						$query .= " AND i.catid IN ({$sql})";

					} else {
						JArrayHelper::toInteger($cid);
						$query .= " AND i.catid IN(".implode(',', $cid).")";
					}

				} else {
					if ($params->get('getChildren')) {
						require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'models'.DS.'itemlist.php');
						$categories = K2ModelItemlist::getCategoryTree($cid);
						$sql = @implode(',', $categories);
						$query .= " AND i.catid IN ({$sql})";
					} else {
						$query .= " AND i.catid=".(int)$cid;
					}

				}
			}
		}

		// If content source is just items
		if($params->get('k2contentSource') == 'items'){
		
			if(is_array($itemid)) {
				JArrayHelper::toInteger( $itemid );
				$query .= ' AND (i.id=' . implode( ' OR i.id=', $itemid ) . ')';
			}
			else {
				$query .= ' AND (i.id=' . $itemid  . ')';
			}
		}


		if ($params->get('FeaturedItems') == '0')
		$query .= " AND i.featured != 1";

		if ($params->get('FeaturedItems') == '2')
		$query .= " AND i.featured = 1";

		if ($params->get('videosOnly'))
		$query .= " AND (i.video IS NOT NULL AND i.video!='')";

		if ($ordering == 'comments')
		$query .= " AND comments.published = 1";

		if(K2_JVERSION=='16'){
			if($mainframe->getLanguageFilter()) {
				$languageTag = JFactory::getLanguage()->getTag();
				$query .= " AND c.language IN (".$db->Quote($languageTag).", ".$db->Quote('*').") AND i.language IN (".$db->Quote($languageTag).", ".$db->Quote('*').")";
			}
		}

		switch ($ordering) {

			case 'date':
			$orderby = 'i.created ASC';
			break;

			case 'rdate':
			$orderby = 'i.created DESC';
			break;

			case 'alpha':
			$orderby = 'i.title';
			break;

			case 'ralpha':
			$orderby = 'i.title DESC';
			break;

			case 'order':
				if ($params->get('FeaturedItems') == '2')
				$orderby = 'i.featured_ordering';
				else
				$orderby = 'i.ordering';
				break;

			case 'hits':
			$orderby = 'i.hits DESC';
			break;

			case 'rand':
			$orderby = 'RAND()';
			break;

			case 'best':
			$orderby = 'rating DESC';
			break;

			default:
			$orderby = 'i.id DESC';
			break;
		}

		$query .= " ORDER BY ".$orderby;
		$db->setQuery($query, 0, $limit);
		$items = $db->loadObjectList();

		require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'models'.DS.'item.php');
		$model = new K2ModelItem;

		require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'route.php');

		if (count($items)) {
			$i		= 0;
			$lists	= array();
			
			foreach ($items as $item) {
					
					$item->imageMedium = false;
					$item->imageXSmall = false;
					$item->imageSmall = false;
					$item->imageLarge = false;
					$item->imageXLarge = false;
					$item->imageGeneric = false;
					$item->closelink = false;
				
				//Clean title
				$titletext = JFilterOutput::ampReplace($item->title);
				$item->modaltitle = JFilterOutput::ampReplace($item->title);
				$item->title = $titlewordCount ? zenHelper::truncate($titletext, $titlewordCount, $titleSuffix) : $titletext;
				

				//Images
				$item->featured = $item->featured;

				    $date =& JFactory::getDate($item->modified);
		            $timestamp = '?t='.$date->toUnix();
					$item->imageSmall ="";
					
				
				$item->imageintrotext = false;
				$item->image = "";
				
				if(!($params->get('itemImgSize') == "introtext")) { 
					if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_XS.jpg')){
					    $item->imageXSmall = JURI::base(true).'/media/k2/items/cache/'.md5("Image".$item->id).'_XS.jpg';
					    if($componentParams->get('imageTimestamp')){
					        $item->imageXSmall.=$timestamp;
					    }
					}

					if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_S.jpg')){
					    $item->imageSmall = JURI::base(true).'/media/k2/items/cache/'.md5("Image".$item->id).'_S.jpg';
						if($componentParams->get('imageTimestamp')){
					        $item->imageSmall.=$timestamp;
					    }
					}

					if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_M.jpg')){
					    $item->imageMedium = JURI::base(true).'/media/k2/items/cache/'.md5("Image".$item->id).'_M.jpg';
						if($componentParams->get('imageTimestamp')){
					        $item->imageMedium.=$timestamp;
					    }					    
					}

					if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_L.jpg')){
					    $item->imageLarge = JURI::base(true).'/media/k2/items/cache/'.md5("Image".$item->id).'_L.jpg';
						if($componentParams->get('imageTimestamp')){
					        $item->imageLarge.=$timestamp;
					    }	
					}

					if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_XL.jpg')){
					    $item->imageXLarge = JURI::base(true).'/media/k2/items/cache/'.md5("Image".$item->id).'_XL.jpg';
						if($componentParams->get('imageTimestamp')){
					        $item->imageXLarge.=$timestamp;
					    }	
					}

					if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_Generic.jpg')){
					    $item->imageGeneric = JURI::base(true).'/media/k2/items/cache/'.md5("Image".$item->id).'_Generic.jpg';
						if($componentParams->get('imageTimestamp')){
					        $item->imageGeneric.=$timestamp;
					    }	
					}

					$image = 'image'.$params->get('itemImgSize','Small');

					if (isset($item->$image)) 
						
						
						// Resize Image
						if ($resizeImage && !(empty($item->$image))) {
						
								$item->image =  resizeImageHelper::getResizedImage($item->$image, $img_width, $img_height, $option);	
													
						}
						elseif (!$resizeImage  && !(empty($item->$image))) {
							$item->image = $item->$image;
						}
						$item->modalimage = $item->$image;
				
				}
												
				// If the k2 item image isnt set lets grab the image fromt he introtext	
				if(($params->get('itemImgSize') == "introtext") or (empty($item->$image))) {
						$imghtml= $item->introtext;
						$imghtml .= "alt='...' title='...' />";
						$pattern = '/<img[^>]+src[\\s=\'"]';
						$pattern .= '+([^"\'>\\s]+)/is';
							if(preg_match(
							$pattern,
							$imghtml,
							$match)) {		
							$item->image = "$match[1]";

						 	}
							else {
									$item->image = "";
							}

						// Set the modal image
						if($item->image !=="") {
							$item->modalimage = $item->image;
						}
						// Resize Image
						if ($resizeImage) {
							if($item->image !=="") {
								$item->image =  resizeImageHelper::getResizedImage($item->image, $img_width, $img_height, $option);	
							}							
						}
						else {
							$item->image = $item->image;
						}											
				}

				
				
				$item->thumb ="";
				if($item->image !=="") {
					$item->thumb =  resizeImageHelper::getResizedImage($item->image, $thumb_width, $thumb_height,  $option);
				}
					

				//Read more link
				if($link == 0) {
					$item->link = '';
					$item->closelink = '';
				}
				elseif($link == 1) {
					$item->link = 'href="#data'.$item->id.'"';
					$lists[$i]->closelink = '</a>';
				}
				else {
					$item->link = 'href="'.urldecode(JRoute::_(K2HelperRoute::getItemRoute($item->id.':'.urlencode($item->alias), $item->catid.':'.urlencode($item->categoryalias)))).'"';
					$lists[$i]->closelink = '</a>';
				}
			
				// Introtext
				$item->modaltext = $item->introtext;
					
				if($strip_tags) {
					$introtext = $strip_tags ? zenHelper::_cleanIntrotext($item->introtext,$tags) : $item->introtext;	
				}		
				else {
					$introtext = $item->introtext;
				}
				$item->text = $wordCount ? zenHelper::truncate($introtext, $wordCount, $textsuffix) : $item->introtext;				
		
			
			
			

				$item->category = $item->categoryname;				
				$item->catlink = '<a href="'.urldecode(JRoute::_(K2HelperRoute::getCategoryRoute($item->catid.':'.urlencode($item->categoryalias)))).'">';
				

				// Date Format
				if (!$translateDate) {
					$item->date= date($dateFormat, (strtotime($item->created))); 
				}
				else {
					$item->date=  JHtml::_('date',$item->created, JText::_(''.$dateString.''));
				}
				
				$item->extrafields = $model->getItemExtraFields($item->extra_fields);
				$item->comments = $model->countItemComments($item->id).' comment';
				$item->attachments = $model->getItemAttachments($item->id);	
				$item->newlink = 0;
				$rows[] = $item;
			}

			return $rows;

		}

	}

}