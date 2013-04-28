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

class modzentoolsImageHelper
{
	function getList($params, $id)
	{
		if (substr(JVERSION, 0, 3) >= '1.6') {
			$directory = $params->get('directory', '/images');
		}
		else {
			$directory = $params->get('directory', '/images/stories');
		}
		//Remove Slashes from directory
		$directory = ltrim($directory,'/');
		$directory = rtrim($directory,'/');
		$link = $params->get('link',1);
		$prefix = $params->get('prefix',0);

		// Image Size and container, remove px if user entered
		$resizeImage = $params->get('resizeImage',1);
		$option = $params->get( 'option', 'crop');
		$img_width = str_replace('px', '', $params->get( 'image_width','170'));
		$img_height = str_replace('px', '', $params->get( 'image_height','85'));
		$thumb_width = str_replace('px', '', $params->get( 'thumb_width','20'));
		$thumb_height = str_replace('px', '', $params->get( 'thumb_height','20'));
		$titlewordCount	= $params->get( 'titlewordCount','');
		$wordCount	= $params->get( 'wordCount','');
		$separator	= $params->get( 'separator','+');
		
		
	
			
		// Image Count
		$count = (int) $params->get('count');
				
		$titleSuffix	= $params->get( 'titleSuffix','');
		// list of filetypes you want to show
		$allowed_types = '\.png$|\.gif$|\.jpg$|\.$';

		// list of filetypes you want to exclude
		$exclude = array('.svn', 'CVS','.DS_Store','__MACOSX');
		if ((strpos(JPATH_ROOT, '/'))===FALSE){//windows
			$directory = str_replace('/', '\\', $directory);
			$path = JPATH_ROOT.'\\'.$directory;
		} else {//linux
			$directory = str_replace('\\', '/', $directory);
			$path = JPATH_ROOT.'/'.$directory;
		}

		//get list of images from dir
		$images = JFolder::files($path, $allowed_types, false, true, $exclude);
		
		// Randomize image array
		if ($params->get('random_image'))
		{
			list($usec, $sec) = explode(' ', microtime());
			mt_srand((float) $sec + ((float) $usec * 100000));
			shuffle($images);
		}
		
		//we create the array
		$items = array();
		$i		= 0;
		
		//create an array of items for template
		foreach ($images as $image)
		{
			// Check image count
			if ($i >= $count) break;
			
			//windows or linux, find local 
			$local_image = str_replace('\\', '/', $image);
			$pos = strpos($local_image, '/images');
			$local_image = substr_replace($local_image, '', 0, $pos);
			// remove file path
			$file = JFile::getName($image);
			// remove file extension
			$name = JFile::stripExt($file);
			// remove root path & File name
			$names = explode('-', $name);
								
			// Item Title
			if(!$prefix) {
				$title = (!empty($names[0]))? $names[0] : '';

				// Item Title
				$text = (!empty($names[1]))? $names[1] : '';
					
				if($link == 2) {
					$articleid  = (!empty($names[2]))? $names[2] : '';
					$itemid  = (!empty($names[3]))? $names[3] : '';
				}
			}
			else {
				$title = (!empty($names[1]))? $names[1] : '';

				// Item Title
				$text = (!empty($names[2]))? $names[2] : '';
					
				if($link == 2) {
					$articleid  = (!empty($names[3]))? $names[3] : '';
					$itemid  = (!empty($names[4]))? $names[4] : '';
				}
			}
			
						
	
			$new_image = JURI::base(true).$local_image;
			if ($resizeImage) {
				$image =  resizeImageHelper::getResizedImage($new_image, $img_width, $img_height, $option);
			}
			else {
				$image = $new_image;
			}
			
			$items[$i]->modalimage = $new_image;
			$items[$i]->thumb = resizeImageHelper::getResizedImage($new_image, $thumb_width, $thumb_height,  $option);

			// Output options for the gallery
			$items[$i]->image = ''.$image.'';
					
								
			// Item Title$titletext
			$titletext = str_replace(''.$separator.'',' ', ''.$title.'');
			$items[$i]->title = $titlewordCount ? zenHelper::truncate($titletext, $titlewordCount, $titleSuffix) : $titletext;
			$items[$i]->modaltitle = $titlewordCount ? zenHelper::truncate($titletext, $titlewordCount, $titleSuffix) : $titletext;
			
			
			// Item Description
			$text = str_replace('+',' ', ''.$text.'');
			$items[$i]->text = $wordCount ? zenHelper::truncate($text, $wordCount, $titleSuffix) : $text;
			
			
			
			
				// Link Behaviour
				if(!$link){
					$lightbox = '';
					$openlink = '';
					$closelink = '';
				}
				elseif($link == 1){
					$lightbox = '';
					$openlink ='href="'.JURI::base(true).$local_image.'" '.$lightbox.' title="'.$titletext.' '.$text.'"';
					$closelink = '</a>';
				}
				elseif($link == 2) {
					$lightbox = '';
					$openlink ='href="index.php?option=com_content&amp;view=article&id='.$articleid.'&amp;Itemid='.$itemid.'"';
					$closelink = '</a>';
				}



				$items[$i]->link = ''.$openlink.'';
				$items[$i]->closelink = ''.$closelink.'';
				$items[$i]->date = false;
				$items[$i]->category = false;
				$items[$i]->catlink = false;
				$items[$i]->featured = 0;
				$items[$i]->newlink = 0;
				$items[$i]->$id = "hello";
			$i++;
		}
	    return $items;
	}
}