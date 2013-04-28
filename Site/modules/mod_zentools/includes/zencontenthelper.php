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

require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');

	// Joomla content
	class modzentoolsHelper
	{
		function getList($params, $id)
		{
					
			global $mainframe;

			$db			=& JFactory::getDBO();
			$user		=& JFactory::getUser();
			$userId		= (int) $user->get('id');
			$count		= (int) $params->get('count', 5);
			$catid		= $params->get('catid');
			$secid		= trim($params->get('secid'));
			$show_front	= $params->get('show_front', 1);
			$aid		= $user->get('aid', 0);
			$link = $params->get('link');
			$contentConfig = &JComponentHelper::getParams( 'com_content' );
			$access		= !$contentConfig->get('show_noauth');
			$nullDate	= $db->getNullDate();
			$date =& JFactory::getDate();
			$now = $date->toMySQL();
			
			// Word Count
			$wordCount	= $params->get( 'wordCount','');
			$titlewordCount	= $params->get( 'titlewordCount','');
			$strip_tags = $params->get('strip_tags',0);
			$titleSuffix = $params->get('titleSuffix','');
			$tags	= $params->get( 'allowed_tags','');
			
			// Image Size and container, remove px if user entered
			$resizeImage = $params->get('resizeImage',1);
			$option = $params->get( 'option', 'crop');
			$img_width = str_replace('px', '', $params->get( 'image_width','170'));
			$img_height = str_replace('px', '', $params->get( 'image_height','85'));
			
			$thumb_width = str_replace('px', '', $params->get( 'thumb_width','20'));
			$thumb_height = str_replace('px', '', $params->get( 'thumb_height','20'));
			
			// Other Params
			$dateFormat		= $params->get('dateFormat', 'j M, y');
			$translateDate		= $params->get('translateDate', '0');
			$dateString		= $params->get('dateString', 'DATE_FORMAT_LC3');
			$showCategory = $params->get('showCategory',1);
			$textsuffix	= $params->get( 'textsuffix','');
			

			$where		= 'a.state = 1'
				. ' AND ( a.publish_up = '.$db->Quote($nullDate).' OR a.publish_up <= '.$db->Quote($now).' )'
				. ' AND ( a.publish_down = '.$db->Quote($nullDate).' OR a.publish_down >= '.$db->Quote($now).' )'
				;

			// User Filter
			switch ($params->get( 'user_id' ))
			{
				case 'by_me':
					$where .= ' AND (created_by = ' . (int) $userId . ' OR modified_by = ' . (int) $userId . ')';
					break;
				case 'not_me':
					$where .= ' AND (created_by <> ' . (int) $userId . ' AND modified_by <> ' . (int) $userId . ')';
					break;
			}

			// Ordering
			switch ($params->get( 'ordering' ))
			{
					case 'm_dsc':
						$ordering		= 'a.modified DESC, a.created DESC';
						break;
					case 'c_dsc':
					default:
						$ordering		= 'a.created DESC';
						break;
				case 'mostread':
						$ordering		= 'a.hits DESC';
						break;
				case 'item_order':
						$ordering		= 'a.ordering ASC ';
						break;
					case 'alpha' :
						$ordering 		= 'a.title ';
						break;
					case 'ralpha' :
						$ordering 		= 'a.title DESC ';
						break;

					case 'rand' :
						$ordering 		= 'RAND() ';
						break;
			}

			if ($catid)
			{
				if( is_array( $catid ) ) {
					if(!($catid[0])) {$catCondition = "";}else{
					$catCondition = ' AND (cc.id IN ( ' . implode( ',', $catid ) . ') )';}
				} else {
					$catCondition = ' AND (cc.id = '.$catid.')';
				}
			}
			if ($secid)
			{
				$ids = explode( ',', $secid );
				JArrayHelper::toInteger( $ids );
				$secCondition = ' AND (s.id=' . implode( ' OR s.id=', $ids ) . ')';
			}

			// Content Items only
			$query = 'SELECT a.*, ' .
				' cc.title as catname,'.
				' CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug,'.
				' CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(":", cc.id, cc.alias) ELSE cc.id END as catslug'.
				' FROM #__content AS a' .
				($show_front == '0' ? ' LEFT JOIN #__content_frontpage AS f ON f.content_id = a.id' : '') .
				' INNER JOIN #__categories AS cc ON cc.id = a.catid' .
				' INNER JOIN #__sections AS s ON s.id = a.sectionid' .
				' WHERE '. $where .' AND s.id > 0' .
				($access ? ' AND a.access <= ' .(int) $aid. ' AND cc.access <= ' .(int) $aid. ' AND s.access <= ' .(int) $aid : '').
				($catid ? $catCondition : '').
				($secid ? $secCondition : '').
				($show_front == '0' ? ' AND f.content_id IS NULL ' : '').
				' AND s.published = 1' .
				' AND cc.published = 1' .
				' ORDER BY '. $ordering;
			$db->setQuery($query, 0, $count);
			$rows = $db->loadObjectList();

			$i		= 0;
			$lists	= array();
			foreach ( $rows as $row )
			{
	
	
				/**
				* 
				* Joomla 1.5 Image Logic
				* 
				**/
					
				$imghtml= $row->introtext;
				$imghtml .= "alt='...' title='...' />";
				$pattern = '/<img[^>]+src[\\s=\'"]';
				$pattern .= '+([^"\'>\\s]+)/is';
				if(preg_match(
				$pattern,
				$imghtml,
				$match))
				$lists[$i]->image = "$match[1]";
				else $lists[$i]->image = "";
				
				
				/**
				* 
				* Joomla 1.5 Resize Images
				* 
				**/
				$lists[$i]->thumb ="";
				if($lists[$i]->image !=="") {
					
					$lists[$i]->modalimage = $lists[$i]->image;
					
					if ($resizeImage) {
						$lists[$i]->image =  resizeImageHelper::getResizedImage($lists[$i]->image, $img_width, $img_height, $option);
					}
				else {
					$lists[$i]->image = $lists[$i]->image;
					
					}
						
				$lists[$i]->thumb = resizeImageHelper::getResizedImage($lists[$i]->image, $thumb_width, $thumb_height, $option);
				}
				/**
				* 
				* Joomla 1.5 Link Behaviour
				* 
				**/										
				
				
				if($row->access <= $aid)
				{
					if($link == 0) {
						$lists[$i]->link = '';
						$lists[$i]->closelink = '';
					}
					elseif($link == 1) {
						$lists[$i]->link = 'href="#data'.$row->id.'"';
						$lists[$i]->closelink = '</a>';
					}
					else { 
						$lists[$i]->link = 'href="'.JRoute::_(ContentHelperRoute::getArticleRoute($row->slug, $row->catslug, $row->sectionid)).'"';
						$lists[$i]->closelink = '</a>';
					}
					
				
				
				/**
				* 
				* Joomla 1.5 Category Name and Link
				* 
				**/
				$lists[$i]->catlink = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($row->catslug,$row->sectionid).'&layout=blog').'">';
					
				} else {
					$lists[$i]->link = '<a href="'.JRoute::_('index.php?option=com_user&view=login').'">';
					
				}
				
				if($showCategory)$lists[$i]->category = $row->catname;
				
				
				/**
				* 
				* Joomla 1.5 Title
				* 
				**/
				$titletext = htmlspecialchars( $row->title );
				$lists[$i]->modaltitle = htmlspecialchars( $row->title );
				$lists[$i]->title = $titlewordCount ? zenHelper::truncate($titletext, $titlewordCount, $titleSuffix) : $titletext;
				
				
				/**
				* 
				* Joomla 1.5 Metakeywords
				* 
				**/
				
				$lists[$i]->metakey = $row->metakey;
				
				
				/**
				* 
				* Joomla 1.5 Intro Text
				* 
				**/
				
				if($strip_tags) {
					$introtext = $strip_tags ? zenHelper::_cleanIntrotext($row->introtext,$tags) : $item->introtext;	
				}		
				else {
					$introtext = $row->introtext;
				}
				$lists[$i]->text = $wordCount ? zenHelper::truncate($introtext, $wordCount, $textsuffix) : $tempintro;
		
				/**
				* 
				* Joomla 1.5 Full Text
				* 
				**/
				
				$lists[$i]->fulltext = $row->fulltext;
				$lists[$i]->modaltext = $row->introtext;	
			
				
				/**
				* 
				* Joomla 1.5 Date
				* 
				**/
				
				if (!$translateDate) {
					$lists[$i]->date = date($dateFormat,  (strtotime($row->created)));
				}
				else {
					$lists[$i]->date = JHTML::_('date', $row->created, JText::_(''.$dateString.''));
				}


				/**
				* 
				* Joomla 1.5 IDs
				* 
				**/
				
				$lists[$i]->id = $row->id;
				
				/**
				* 
				* null
				* 
				**/
				
				$lists[$i]->video = "";
				$lists[$i]->more = false;
				$lists[$i]->featured = 0;
				$lists[$i]->newlink = 0;
				$i++;
			}
		
			return $lists;
		}
		
		
	}