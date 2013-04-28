<?php
/**
 * JB Type
 * @version 1.1
 * @author Joomla Bamboo
 * http://www.joomlabamboo.com
 * Based on JW AllVideos Plugin by Joomlaworks.gr and Xtypo from www.templateplazza.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 *
 **/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

class plgSystemJbtype extends JPlugin {
	function onAfterRender() {
	
		// Get Plugin info
		jimport( 'joomla.html.parameter' );
		$plugin		= & JPluginHelper::getPlugin('system','jbtype');
		$param		= new JParameter( $plugin->params );
		$app        = & JFactory::getApplication();
		$document   = & JFactory::getDocument();
		$doctype    = $document->getType();
		$output     = JResponse::getBody();
		$urlOption  = JRequest::getVar('option','none');
		$urlTask    = JRequest::getVar('task','none');
		$iconStyle = $param->get('iconStyle','coquette');
		$enabled   = $param->get('enabled', 1);
		//$modbase    = ''.JURI::base().'plugins/system/jbtype/';


		if (substr(JVERSION, 0, 3) >= '1.6') {
			require_once (JPATH_SITE.DS.'plugins/system/jbtype/jbtype/styles.php');
		}
		else {
			require_once (JPATH_SITE.DS.'plugins/system/jbtype/styles.php');
		}
		
		if($app->isAdmin()) {
			return;
		}

		if($doctype !== 'html') {
			return;
		}

		if(($urlOption == 'com_content') and ($urlTask == 'edit')) {
			return;
		}
		
		unset($app, $doctype, $urlTask, $urlOption, $param, $plugin);

		
		$jbListPattern = '#{jb_list.*}(.*?){/jb_list.*}#s';
		//$jbListRegex = '#(^(.*?)\|)|(\|(.*?)\|)|(\|(.*?)$)#s';
		$jbListReplace = '<li>***listcode***</li>';

		$regex = array(
			// Boxes
			'jb_blackbox'  => array('<p class="jb_blackbox">***code***</p>', '#{jb_blackbox}(.*?){/jb_blackbox}#s') ,
			'jb_greenbox'  => array('<p class="jb_greenbox">***code***</p>', '#{jb_greenbox}(.*?){/jb_greenbox}#s') ,
			'jb_bluebox'   => array('<p class="jb_bluebox">***code***</p>', '#{jb_bluebox}(.*?){/jb_bluebox}#s') ,
			'jb_redbox'    => array('<p class="jb_redbox">***code***</p>', '#{jb_redbox}(.*?){/jb_redbox}#s') ,
			'jb_yellowbox' => array('<p class="jb_yellowbox">***code***</p>', '#{jb_yellowbox}(.*?){/jb_yellowbox}#s') ,
			'jb_brownbox'  => array('<p class="jb_brownbox">***code***</p>', '#{jb_brownbox}(.*?){/jb_brownbox}#s') ,
			'jb_purplebox' => array('<p class="jb_purplebox">***code***</p>', '#{jb_purplebox}(.*?){/jb_purplebox}#s') ,

			// Discs
			'jb_bluedisc'     => array('<span class="jb_bluedisc">***code***</span>', '#{jb_bluedisc}(.*?){/jb_bluedisc}#s') ,
			'jb_greendisc'    => array('<span class="jb_greendisc">***code***</span>', '#{jb_greendisc}(.*?){/jb_greendisc}#s') ,
			'jb_reddisc'      => array('<span class="jb_reddisc">***code***</span>', '#{jb_reddisc}(.*?){/jb_reddisc}#s') ,
			'jb_browndisc'    => array('<span class="jb_browndisc">***code***</span>', '#{jb_browndisc}(.*?){/jb_browndisc}#s') ,
			'jb_greydisc'     => array('<span class="jb_greydisc">***code***</span>', '#{jb_greydisc}(.*?){/jb_greydisc}#s') ,
			'jb_charcoaldisc' => array('<span class="jb_charcoaldisc">***code***</span>', '#{jb_charcoaldisc}(.*?){/jb_charcoaldisc}#s') ,
			'jb_purpledisc'   => array('<span class="jb_purpledisc">***code***</span>', '#{jb_purpledisc}(.*?){/jb_purpledisc}#s') ,
			'jb_orangedisc'   => array('<span class="jb_orangedisc">***code***</span>', '#{jb_orangedisc}(.*?){/jb_orangedisc}#s') ,
			'jb_yellowdisc'   => array('<span class="jb_yellowdisc">***code***</span>', '#{jb_yellowdisc}(.*?){/jb_yellowdisc}#s') ,
			'jb_blackdisc'    => array('<span class="jb_blackdisc">***code***</span>', '#{jb_blackdisc}(.*?){/jb_blackdisc}#s') ,


			// Typography
			'jb_dropcap'    => array('<span class="jb_dropcap">***code***</span>', '#{jb_dropcap}(.*?){/jb_dropcap}#s') ,
			'jb_quote'      => array('<blockquote><p>***code***</p></blockquote>', '#{jb_quote}(.*?){/jb_quote}#s') ,
			'jb_author'      => array('<span class="jb_author">***code***</span>', '#{jb_author}(.*?){/jb_author}#s') ,
			'jb_quoteleft'  => array('<div class="jb_quoteleft"><p>***code***</p></div>', '#{jb_quoteleft}(.*?){/jb_quoteleft}#s') ,
			'jb_quoteright' => array('<div class="jb_quoteright"><p>***code***</p></div>', '#{jb_quoteright}(.*?){/jb_quoteright}#s') ,

			// Layout
			'jb_left45'  => array('<div class="jb_left45">***code***</div>', '#{jb_left45}(.*?){/jb_left45}#s') ,
			'jb_right45' => array('<div class="jb_right45">***code***</div>', '#{jb_right45}(.*?){/jb_right45}#s') ,
			'jb_clear'   => array('<div class="jbclear">***code***</div>', '#{jb_clear}(.*?){/jb_clear}#s') ,
			
			'zenbutton'   => array('<div class="zenbutton"><span>***code***</span></div>', '#{zenbutton}(.*?){/zenbutton}#s') ,
			
			// Zengrid Style
			'grid1'  => array('<div class="grid_one">***code***</div>', '#{grid1}(.*?){/grid1}#s') ,
			'grid2'  => array('<div class="grid_two">***code***</div>', '#{grid2}(.*?){/grid2}#s') ,
			'grid3'  => array('<div class="grid_three">***code***</div>', '#{grid3}(.*?){/grid3}#s') ,
			'grid4'  => array('<div class="grid_four">***code***</div>', '#{grid4}(.*?){/grid4}#s') ,
			'grid5'  => array('<div class="grid_five">***code***</div>', '#{grid5}(.*?){/grid5}#s') ,
			'grid6'  => array('<div class="grid_six">***code***</div>', '#{grid6}(.*?){/grid6}#s') ,
			'grid7'  => array('<div class="grid_seven">***code***</div>', '#{grid7}(.*?){/grid7}#s') ,
			'grid8'  => array('<div class="grid_eight">***code***</div>', '#{grid8}(.*?){/grid8}#s') ,
			'grid9'  => array('<div class="grid_nine">***code***</div>', '#{grid9}(.*?){/grid9}#s') ,
			'grid10'  => array('<div class="grid_ten">***code***</div>', '#{grid10}(.*?){/grid10}#s') ,
			'grid11'  => array('<div class="grid_eleven">***code***</div>', '#{grid11}(.*?){/grid11}#s') ,
			'grid12'  => array('<div class="grid_twelve">***code***</div>', '#{grid12}(.*?){/grid12}#s') ,
			
			// ZenlastStyle
			'grid1_last'  => array('<div class="grid_one zenlast">***code***</div>', '#{grid1_last}(.*?){/grid1_last}#s') ,
			'grid2_last'  => array('<div class="grid_two zenlast">***code***</div>', '#{grid2_last}(.*?){/grid2_last}#s') ,
			'grid3_last'  => array('<div class="grid_three zenlast">***code***</div>', '#{grid3_last}(.*?){/grid3_last}#s') ,
			'grid4_last'  => array('<div class="grid_four zenlast">***code***</div>', '#{grid4_last}(.*?){/grid4_last}#s') ,
			'grid5_last'  => array('<div class="grid_five zenlast">***code***</div>', '#{grid5_last}(.*?){/grid5_last}#s') ,
			'grid6_last'  => array('<div class="grid_six zenlast">***code***</div>', '#{grid6_last}(.*?){/grid6_last}#s') ,
			'grid7_last'  => array('<div class="grid_seven zenlast">***code***</div>', '#{grid7_last}(.*?){/grid7_last}#s') ,
			'grid8_last'  => array('<div class="grid_eight zenlast">***code***</div>', '#{grid8_last}(.*?){/grid8_last}#s') ,
			'grid9_last'  => array('<div class="grid_nine zenlast">***code***</div>', '#{grid9_last}(.*?){/grid9_last}#s') ,
			'grid10_last'  => array('<div class="grid_ten zenlast">***code***</div>', '#{grid10_last}(.*?){/grid10_last}#s') ,
			'grid11_last'  => array('<div class="grid_eleven zenlast">***code***</div>', '#{grid11_last}(.*?){/grid11_last}#s') ,
			'grid12_last'  => array('<div class="grid_twelve zenlast">***code***</div>', '#{grid12_last}(.*?){/grid1_last2}#s') ,
			
			
			// Break out Style
			'jb_breakout'  => array('<div class="jb_breakout">***code***</div>', '#{jb_breakout}(.*?){/jb_breakout}#s') ,
			'jb_action'  => array('<div class="jb_action">***code***</div>', '#{jb_action}(.*?){/jb_action}#s') ,

			// Spans
			'jb_black'  => array('<span class="jb_black">***code***</span>', '#{jb_black}(.*?){/jb_black}#s') ,
			'jb_blue'   => array('<span class="jb_blue">***code***</span>', '#{jb_blue}(.*?){/jb_blue}#s') ,
			'jb_red'    => array('<span class="jb_red">***code***</span>', '#{jb_red}(.*?){/jb_red}#s') ,
			'jb_green'  => array('<span class="jb_green">***code***</span>', '#{jb_green}(.*?){/jb_green}#s') ,
			'jb_yellow' => array('<span class="jb_yellow">***code***</span>', '#{jb_yellow}(.*?){/jb_yellow}#s') ,
			'jb_white'  => array('<span class="jb_white">***code***</span>', '#{jb_white}(.*?){/jb_white}#s') ,
			'jb_brown'  => array('<span class="jb_brown">***code***</span>', '#{jb_brown}(.*?){/jb_brown}#s') ,
			'jb_purple' => array('<span class="jb_purple">***code***</span>', '#{jb_purple}(.*?){/jb_purple}#s') ,

			// Lists
			'jb_listblack'  => array('<ul class="jb_black">***code***</ul>', '#{jb_listblack}(.*?){/jb_listblack}#s') ,
			'jb_listblue'   => array('<ul class="jb_blue">***code***</ul>', '#{jb_listblue}(.*?){/jb_listblue}#s') ,
			'jb_listred'    => array('<ul class="jb_red">***code***</ul>', '#{jb_listred}(.*?){/jb_listred}#s') ,
			'jb_listgreen'  => array('<ul class="jb_green">***code***</ul>', '#{jb_listgreen}(.*?){/jb_listgreen}#s') ,
			'jb_listyellow' => array('<ul class="jb_yellow">***code***</ul>', '#{jb_listyellow}(.*?){/jb_listyellow}#s') ,
			'jb_listwhite'  => array('<ul class="jb_white">***code***</ul>', '#{jb_listwhite}(.*?){/jb_listwhite}#s') ,
			'jb_listbrown'  => array('<ul class="jb_brown">***code***</ul>', '#{jb_listbrown}(.*?){/jb_listbrown}#s') ,
			'jb_listpurple' => array('<ul class="jb_purple">***code***</ul>', '#{jb_listpurple}(.*?){/jb_listpurple}#s') ,

			// Iconic Icons
			'jb_iconic_info'      => array('<span class="jb_iconic_info"></span><span>***code***</span>', '#{jb_iconic_info}(.*?){/jb_iconic_info}#s') ,
			'jb_iconic_star'      => array('<span class="jb_iconic_star"></span><span>***code***</span>', '#{jb_iconic_star}(.*?){/jb_iconic_star}#s') ,
			'jb_iconic_heart'     => array('<span class="jb_iconic_heart"></span><span>***code***</span>', '#{jb_iconic_heart}(.*?){/jb_iconic_heart}#s') ,
			'jb_iconic_tag'       => array('<span class="jb_iconic_tag"></span><span>***code***</span>', '#{jb_iconic_tag}(.*?){/jb_iconic_tag}#s') ,
			'jb_iconic_arrival'   => array('<span class="jb_iconic_arrival"></span><span>***code***</span>', '#{jb_iconic_arrival}(.*?){/jb_iconic_arrival#s') ,
			'jb_iconic_truck'     => array('<span class="jb_iconic_truck"></span><span>***code***</span>', '#{jb_iconic_truck}(.*?){/jb_iconic_truck}#s') ,
			'jb_iconic_arrow'     => array('<span class="jb_iconic_arrow"></span><span>***code***</span>', '#{jb_iconic_arrow}(.*?){/jb_iconic_arrow}#s') ,
			'jb_iconic_article'   => array('<span class="jb_iconic_article"></span><span>***code***</span>', '#{jb_iconic_article}(.*?){/jb_iconic_article}#s') ,
			'jb_iconic_email'     => array('<span class="jb_iconic_email"></span><span>***code***</span>', '#{jb_iconic_email}(.*?){/jb_iconic_email}#s') ,
			'jb_iconic_beaker'    => array('<span class="jb_iconic_beaker"></span><span>***code***</span>', '#{jb_iconic_beaker}(.*?){/jb_iconic_beaker}#s') ,
			'jb_iconic_book'      => array('<span class="jb_iconic_book"></span><span>***code***</span>', '#{jb_iconic_book}(.*?){/jb_iconic_book}#s') ,
			'jb_iconic_bolt'      => array('<span class="jb_iconic_bolt"></span><span>***code***</span>', '#{jb_iconic_bolt}(.*?){/jb_iconic_bolt}#s') ,
			'jb_iconic_box'       => array('<span class="jb_iconic_box"></span><span>***code***</span>', '#{jb_iconic_box}(.*?){/jb_iconic_box}#s') ,
			'jb_iconic_calendar'  => array('<span class="jb_iconic_calendar"></span><span>***code***</span>', '#{jb_iconic_calendar}(.*?){/jb_iconic_calendar}#s') ,
			'jb_iconic_comment'   => array('<span class="jb_iconic_comment"></span><span>***code***</span>', '#{jb_iconic_comment}(.*?){/jb_iconic_comment}#s') ,
			'jb_iconic_tick'      => array('<span class="jb_iconic_tick"></span><span>***code***</span>', '#{jb_iconic_tick}(.*?){/jb_iconic_tick}#s') ,
			'jb_iconic_cloud'     => array('<span class="jb_iconic_cloud"></span><span>***code***</span>', '#{jb_iconic_cloud}(.*?){/jb_iconic_cloud}#s') ,
			'jb_iconic_document'  => array('<span class="jb_iconic_document"></span><span>***code***</span>', '#{jb_iconic_document}(.*?){/jb_iconic_document}#s') ,
			'jb_iconic_image'     => array('<span class="jb_iconic_image"></span><span>***code***</span>', '#{jb_iconic_image}(.*?){/jb_iconic_image}#s') ,
			'jb_iconic_quote'     => array('<span class="jb_iconic_quote"></span><span>***code***</span>', '#{jb_iconic_quote}(.*?){/jb_iconic_quote}#s') ,
			'jb_iconic_lightbulb' => array('<span class="jb_iconic_lightbulb"></span><span>***code***</span>', '#{jb_iconic_lightbulb}(.*?){/jb_iconic_lightbulb}#s') ,
			'jb_iconic_search'    => array('<span class="jb_iconic_search"></span><span>***code***</span>', '#{jb_iconic_search}(.*?){/jb_iconic_search}#s') ,
			'jb_iconic_mail'      => array('<span class="jb_iconic_mail"></span><span>***code***</span>', '#{jb_iconic_mail}(.*?){/jb_iconic_mail}#s') ,
			'jb_iconic_dash'      => array('<span class="jb_iconic_dash"></span><span>***code***</span>', '#{jb_iconic_dash}(.*?){/jb_iconic_dash}#s') ,
			'jb_iconic_movie'     => array('<span class="jb_iconic_movie"></span><span>***code***</span>', '#{jb_iconic_movie}(.*?){/jb_iconic_movie}#s') ,
			'jb_iconic_download'  => array('<span class="jb_iconic_download"></span><span>***code***</span>', '#{jb_iconic_download}(.*?){/jb_iconic_download}#s') ,

			// Icons
			'jb_new'        => array('<span class="jb_new">***code***</span>', '#{jb_new}(.*?){/jb_new}#s') ,
			'jb_code'       => array('<span class="jb_code">***code***</span>', '#{jb_code}(.*?){/jb_code}#s') ,
			'jb_attachment' => array('<span class="jb_attachment">***code***</span>', '#{jb_attachment}(.*?){/jb_attachment}#s') ,
			'jb_calculator' => array('<span class="jb_calculator">***code***</span>', '#{jb_calculator}(.*?){/jb_calculator}#s') ,
			'jb_cut'        => array('<span class="jb_cut">***code***</span>', '#{jb_cut}(.*?){/jb_cut}#s') ,
			'jb_dollar'     => array('<span class="jb_dollar">***code***</span>', '#{jb_dollar}(.*?){/jb_dollar}#s') ,
			'jb_euro'       => array('<span class="jb_euro">***code***</span>', '#{jb_euro}(.*?){/jb_euro}#s') ,
			'jb_dollar'     => array('<span class="jb_dollar">***code***</span>', '#{jb_dollar}(.*?){/jb_dollar}#s') ,
			'jb_pound'      => array('<span class="jb_pound">***code***</span>', '#{jb_pound}(.*?){/jb_pound}#s') ,
			'jb_support'    => array('<span class="jb_support">***code***</span>', '#{jb_support}(.*?){/jb_support}#s') ,
			'jb_next'       => array('<span class="jb_next">***code***</span>', '#{jb_next}(.*?){/jb_next}#s') ,
			'jb_previous'   => array('<span class="jb_previous">***code***</span>', '#{jb_previous}(.*?){/jb_previous}#s') ,
			'jb_calculator' => array('<span class="jb_calculator">***code***</span>', '#{jb_calculator}(.*?){/jb_calculator}#s') ,
			'jb_cart'       => array('<span class="jb_cart">***code***</span>', '#{jb_cart}(.*?){/jb_cart}#s') ,
			'jb_save'       => array('<span class="jb_save">***code***</span>', '#{jb_save}(.*?){/jb_save}#s') ,
			'jb_sound'      => array('<span class="jb_sound">***code***</span>', '#{jb_sound}(.*?){/jb_sound}#s') ,
			'jb_info'       => array('<span class="jb_info">***code***</span>', '#{jb_info}(.*?){/jb_info}#s') ,
			'jb_warning'    => array('<span class="jb_warning">***code***</span>', '#{jb_warning}(.*?){/jb_warning}#s') ,
			'jb_camera'     => array('<span class="jb_camera">***code***</span>', '#{jb_camera}(.*?){/jb_camera}#s') ,
			'jb_comment'    => array('<span class="jb_comment">***code***</span>', '#{jb_comment}(.*?){/jb_comment}#s') ,
			'jb_chat'       => array('<span class="jb_chat">***code***</span>', '#{jb_chat}(.*?){/jb_chat}#s') ,
			'jb_document'   => array('<span class="jb_document">***code***</span>', '#{jb_document}(.*?){/jb_document}#s') ,
			'jb_accessible' => array('<span class="jb_accessible">***code***</span>', '#{jb_accessible}(.*?){/jb_accessible}#s') ,
			'jb_star'       => array('<span class="jb_star">***code***</span>', '#{jb_star}(.*?){/jb_star}#s') ,
			'jb_heart'      => array('<span class="jb_heart">***code***</span>', '#{jb_heart}(.*?){/jb_heart}#s') ,
			'jb_mail'       => array('<span class="jb_mail">***code***</span>', '#{jb_mail}(.*?){/jb_mail}#s') ,
			'jb_film'       => array('<span class="jb_film">***code***</span>', '#{jb_film}(.*?){/jb_film}#s') ,
			'jb_pin'        => array('<span class="jb_pin">***code***</span>', '#{jb_pin}(.*?){/jb_pin}#s') ,
			'jb_recycle'    => array('<span class="jb_recycle">***code***</span>', '#{jb_recycle}(.*?){/jb_recycle}#s') ,
			'jb_lightbulb'  => array('<span class="jb_lightbulb">***code***</span>', '#{jb_lightbulb}(.*?){/jb_lightbulb}#s') ,

			//BB Code
			'jb_b'    => array('<strong>***code***</strong>', '#{jb_b}(.*?){/jb_b}#s') ,
			'jb_i'    => array('<em>***code***</em>', '#{jb_i}(.*?){/jb_i}#s') ,
			'jb_br'   => array('<br />', '#({jb_br})#s') ,
			
			// Other Tags
			'jb_span' => array('<span class="jbspan">***code***</span>', '#{jb_span}(.*?){/jb_span}#s') ,
			'jb_img'  => array('<img src="***code***" alt="***code***"/>', '#{jb_img}(.*?){/jb_img}#s')
		);

		// prepend and append code
		//$tagsToStrip     = array('title', 'div class="breadcrumb');
		//$tagsToExclude   = array('textarea', 'input', 'script');
		$breadcrumbRegex = '/\<(div|span).*class=".*breadcrumbs.*".*\>(.*[^0-9,\n\r]*.*)\<\/\1\>/im';
		if (preg_match_all($breadcrumbRegex, $output, $breadcrumbs, PREG_PATTERN_ORDER) > 0) {

			unset($breadcrumbRegex);
			
			$breadcrumbs = $breadcrumbs[2];
			
			$cleanbc = null;
			foreach ($breadcrumbs as $breadcrumb) {
				$cleanbc = $breadcrumb;
				
				foreach ($regex as $key => $value) {
					if (preg_match_all($value[1], $cleanbc, $matches, PREG_PATTERN_ORDER) > 0) {
						$matches = $matches[0];
						
						foreach ($matches as $match) {
							if ($key === 'jb_br')
							{
								$cleanbc = preg_replace($regex[$key][1], ' ', $cleanbc);
							}
							else
							{
								$cleanbc = preg_replace('/{'.$key.'}(.*[\n\r.]*.*){\/'.$key.'}/im', '$1', $cleanbc);
							}
						}
					}
				}
				$breadcrumb = str_replace('#', '\#', $breadcrumb);
				$breadcrumb = preg_quote($breadcrumb );
				//$output = preg_replace('#('.$breadcrumb.')#Us',$cleanbc, $output);
			}
			
			unset($cleanbc, $breadcrumbs, $breadcrumb, $matches, $match, $key, $value);
		}
		
		if ( ! $enabled ) {
			foreach ($regex as $key => $value) {
				unset($value);
				$output = preg_replace( $regex[$key][1], '', $output );
			}
			
			return;
		}
		unset($enabled);
		
		// Remove jbtags from meta tags
		$metaRegex = '/(<meta.*content=")(.*)("[^>]*\/>)/im';
		if (preg_match_all($metaRegex, $output, $meta) > 0) {
			$i = 0;
			foreach($meta[0] as $metaDirty)
			{
				$metaClean = $meta[1][$i];
				$metaClean .= preg_replace('/{[\/]*jb_[^}]*}/i', '', $meta[2][$i]);
				$metaClean .= $meta[3][$i];
				$output = str_replace($metaDirty, $metaClean, $output);
				$i++;
			}
		}
		unset($metaRegex, $metaClean, $meta, $metaDirty, $i);
		
		// Remove jbtags from title tag
		$titleRegex = '/(<title[^>]*>)(.*)(<\/title>)/im';
		if (preg_match($titleRegex, $output, $title) > 0) {
			$titleClean = preg_replace('/{[\/]*jb_[^}]*}/im', ' ', $title[2]);
			$titleClean = preg_replace('/[\s]+/im', ' ', $titleClean);
			$titleClean = $title[1].trim($titleClean).$title[3];
			$output = str_replace($title[0], $titleClean, $output);
		}
		unset($titleRegex, $titleClean, $title);
		
		// Parse JB Tags
		$startcode       = '';
		$endcode         = '';
		$classes         = array();
		$uniqueClasses   = array();
		
		foreach ($regex as $key => $value) {
			// searching for marks
			// foreach ($tagsToExclude as $excludeTag) {
			// 				$tagStart = '<'.$excludeTag;
			// 				$element = explode(" ",$excludeTag,1);
			// 				$tagEnd = '</'.$element[0].'>';
			// 				$excludeRegex = "#".$tagStart."(.*?)".$tagEnd."#s";
			// 			}

			if (preg_match_all($value[1], $output, $matches, PREG_PATTERN_ORDER) > 0) {
				foreach ($matches[1] as $match) {
					
					$classes[] = $key;

					if (preg_match($jbListPattern, $value[1])) {
						$listMatches = explode("|", $match);
						$listCode = "";
						foreach ($listMatches as $listMatch) {
							$listCode .= str_replace("***listcode***", $listMatch, $jbListReplace );
						}
					
						$code = str_replace("***code***", $listCode, $value[0]);
					}
					else {
						$code = str_replace("***code***", $match, $value[0]);
					}
				
					if ($value[1] == "#({jb_br})#s")
					{
						$output = preg_replace($value[1], $startcode.$code.$endcode , $output );
					}
					else
					{
						$output = str_replace("{".$key."}".$match."{/".$key."}", $startcode.$code.$endcode , $output);
					}
				}
		 	}
		}
		unset(
			$key,
			$value,
			$regex,
			$match,
			$matches,
			$jbListPattern,
			$jbListReplace,
			$code,
			$startcode,
			$endcode/*,
				$tagsToStrip,
				$tagsToExclude,*/
			);

		if ( ! empty($classes)) {
			$uniqueClasses = array_unique($classes);
			$pageStyles = getTypeCss($iconStyle, $uniqueClasses, $jbTypeStyles);
			$document->addCustomTag($pageStyles);
			$output = str_replace('</head>', $pageStyles .'</head>', $output);
		}
		
		unset(
			$iconStyle,
			$uniqueClasses,
			$jbTypeStyles,
			$classes,
			$pageStyles,
			$document
			);
		
		// Remove tags from title in page
		$titleRegex = '/(<div[^>]*id="topHeaderRight">[\n.\s\t\w\r]*<h2[^>]*>)(.*)(<\/h2>)/im';
		if (preg_match_all($titleRegex, $output, $title) > 0) {
			$title = $title[2][0];
			$title = preg_replace('/<br[^>]*>/i', '&nbsp;', $title);
			$cleanTitle = strip_tags($title); // Remove just tags
			$output = preg_replace($titleRegex, '$1'.$cleanTitle.'$3', $output);
		}
		
		unset($titleRegex, $title, $cleanTitle, $attribs);
		
		JResponse::setBody($output);
		
		unset($output);
		
		return true;
	}
}
?>