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

require_once JPATH_SITE.'/components/com_content/helpers/route.php';

jimport('joomla.application.component.model');

JModel::addIncludePath(JPATH_SITE.'/components/com_content/models', 'ContentModel');

abstract class modzentoolsHelper
{
	public static function getList(&$params)
	{
		// Get the dbo
		$db = JFactory::getDbo();
		
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
		$dateString		= $params->get('dateString', 'DATE_FORMAT_LC3');
		$translateDate		= $params->get('translateDate', '0');
		$showCategory = $params->get('showCategory',1);
		$link	= $params->get( 'link','');
		$textsuffix	= $params->get( 'textsuffix','');
		
		// J2.5 and altlink
		if (substr(JVERSION, 0, 3) >= '2.5') {
			$joomla25 = 1;
			$altlink = $params->get('altlink');
		}
		else {
			$joomla25 = 0;
			$altlink = 0;
		}
		
		// Get an instance of the generic articles model
		$model = JModel::getInstance('Articles', 'ContentModel', array('ignore_request' => true));

		// Set application parameters in model
		$app = JFactory::getApplication();
		$appParams = $app->getParams();
		$model->setState('params', $appParams);

		// Set the filters based on the module params
		$model->setState('list.start', 0);
		$model->setState('list.limit', (int) $params->get('count', 5));
		$model->setState('filter.published', 1);

		// Access filter
		$access = !JComponentHelper::getParams('com_content')->get('show_noauth');
		$authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
		$model->setState('filter.access', $access);

		// Category filter
		$model->setState('filter.category_id', $params->get('catid', array()));

		// Filter by language
		$model->setState('filter.language',$app->getLanguageFilter());

		// Ordering
		$model->setState('list.ordering', $params->get('ordering', 'a.ordering'));
		$model->setState('list.direction', $params->get('ordering_direction', 'ASC'));

		$items = $model->getItems();

		foreach ($items as $item) {
			$item->slug = $item->id.':'.$item->alias;
			$item->catslug = $item->catid.':'.$item->category_alias;
			$item->text = $item->introtext;
			$item->modaltext = $item->text;
		
		
		
			if ($access || in_array($item->access, $authorised)) {
				// We know that user has the privilege to view the article
				if($link == 0) {
					$item->link = '';
					$item->closelink = '';
				}
				elseif($link == 1) {
					$item->link = 'href="#data'.$item->id.'"';
					$item->closelink = '</a>';
				}
				else { 
					$item->link = 'href="'.JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catslug)).'"';
					$item->closelink = '</a>';
				}
			
			
				
			/**
			* 
			* Joomla 1.7 & Joomla 2.5 Category Name and Link
			* 
			**/
			
			if ($showCategory) {
					$item->catlink = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($item->catslug).'&layout=blog').'">';

			} else {
				$item->link = '<a href="'.JRoute::_('index.php?option=com_user&view=login').'">';
			}
		 	
			$item->category = $item->category_title;
				
				
			} 
			
			else {
				$item->link = JRoute::_('index.php?option=com_users&view=login');
				
			}
			
			/**
			* 
			* Joomla 2.5  Alternate Links
			* 
			**/
			
			$item->newlink = 0;
			
			if($joomla25) {
				$links = json_decode($item->urls);
				
				if(isset($links->urla) and !empty($links->urla)) {
					$item->altlink = 'href="'.$links->urla.'"';
					$item->newlink = 1;
				}
				else {
					$item->altlink = $item->link;
					$item->newlink = 0;
				}
			}
			
			
			
			/**
			* 
			* Joomla 1.7 & 2.5 Image Logic
			* 
			**/
			
			// Grab the intro_image in Joomla 2.5 or otherwise use the introtext image.
			if(version_compare( JVERSION, '2.5', 'ge' )) {
				$images = json_decode($item->images);
			}
			else {
				$images="";
			}
			
			if(isset($images->image_intro) and !empty($images->image_intro)) {
				$item->image = $images->image_intro;
			}
			
			else {
				$imghtml= $item->introtext;
				$imghtml .= "alt='...' title='...' />";
				$pattern = '/<img[^>]+src[\\s=\'"]';
				$pattern .= '+([^"\'>\\s]+)/is';
				if(preg_match(
				$pattern,
				$imghtml,
				$match))
				$item->image = "$match[1]";
				else $item->image = "";
			}
			
			
			
			/**
			* 
			* Joomla 1.7 & Joomla 2.5 Resize Images
			* 
			**/
			$item->thumb="";
			if($item->image !=="") {
				
				// Sets the modal image
				$item->modalimage = $item->image;
				
			if ($resizeImage) {
				
					$item->image =  resizeImageHelper::getResizedImage($item->image, $img_width, $img_height, $option);	
										
			}
			else {
				$item->image = $item->image;
			}
			
			$item->thumb = resizeImageHelper::getResizedImage($item->image, $thumb_width, $thumb_height,  $option);
			}

			/**
			* 
			* Joomla 1.7 & Joomla 2.5 Title
			* 
			**/
			$titletext = htmlspecialchars( $item->title );
			$item->modaltitle = htmlspecialchars( $item->title );
			$item->title = $titlewordCount ? zenHelper::truncate($titletext, $titlewordCount, $titleSuffix) : $titletext;
			


			/**
			* 
			* Joomla 1.7 & Joomla 2.5 Metakeywords
			* 
			**/

			$item->metakey = $item->metakey;

			
			
			
			
			
			/**
			* 
			* Joomla 1.7 & Joomla 2.5 Intro Text
			* 
			**/
			
			if($strip_tags) {
				$introtext = $strip_tags ? zenHelper::_cleanIntrotext($item->introtext,$tags) : $item->introtext;	
			}		
			else {
				$introtext = $item->introtext;
			}
			
			if($wordCount !=="-1") {
				$tempintro = false;
				$item->text = $wordCount ? zenHelper::truncate($introtext, $wordCount, $textsuffix) : $tempintro;
			}
			else {
				$item->text = $item->introtext;
				$item->text = $item->text.$textsuffix;
			}
			
			
					
			/**
			* 
			* Joomla 1.7 & Joomla 2.5 Full Text
			* 
			**/

			//$item->fulltext = $item->fulltext;
			
			


			/**
			* 
			* Joomla 1.7 & Joomla 2.5 Date
			* 
			**/

			if (!$translateDate) {
				$item->date = date($dateFormat,  (strtotime($item->created)));
			}
			else {
				$item->date = JHTML::_('date', $item->created, JText::_(''.$dateString.''));
			}


			/**
			* 
			* Joomla 1.7 & Joomla 2.5 IDs
			* 
			**/

			$item->id = $item->id;

			/**
			* 
			* null
			* 
			**/
			
			$item->featured = 0;

			
		}

		return $items;
	}
}
