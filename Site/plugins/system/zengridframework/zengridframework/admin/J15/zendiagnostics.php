<?php
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @Type        Core Framework Files
 * @version		v2.0
 * @author		Joomal Bamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
/**
 * Renders a editors element
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */
class JElementZendiagnostics extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'Zendiagnostics';
	function fetchElement($name, $value, &$node, $control_name)
	{
		$zgfEnabled = JPluginHelper::isEnabled ( 'system', 'zengridframework' )	;

		if ($zgfEnabled) {
			
			global $mainframe;
			$controlMainArea = Zengrid::getParam('controlMainArea');
			$logoType = Zengrid::getParam('logoType');
			
			$superfish = Zengrid::getParam('superfish');
			$splitmenu = Zengrid::getParam('splitMenu');
			$splitMenuNavPos = Zengrid::getParam('splitMenuNavPos');
			$csscompress = Zengrid::getParam('csscompress');
			$jQuery = Zengrid::getParam('jQueryVersion');
			
			$manifest = Zengrid::getManifest();
			$style = Zengrid::getParam('style');
			
			$oldframework = JPATH_SITE.DS.'templates'.DS.'zengridframework'.DS.'index.php';
			
			
			$html = '';
			$html .= '<h3 class="toggler atStart"></h3><div class="element atStart"></div>';
			$html .= '<div class="diagnostics">';
			$html .='<span class="diagnosticsoverview">'.JText::_('ZENDIAGNOSTICSDESCRIPTION').'</span>';
			$html .='<ul>';
			
			if($jQuery =="none") {
			
				$html .= '<li><span class="warning important">'.JText::_("ZENJQUERYDISABLEDWARNING").'</span></li>';
			}
			
			if ($controlMainArea) {
				$mainAreaWarning = "<li><span class='warning'>".JText::_('ZENPLEASENOTETHATYOURMAINCONTENTAREAISHIDDENONTHEFRONTPAGE').'&nbsp;'.JText::_('ZENYOUCANCHANGETHATSETTING')."<a href='#' onclick='accordion.display(12)'>".JText::_('ZENHERE')."</a></span></li>";
				
				$html .= ''. $mainAreaWarning.'<br />';
			}
			
			if($superfish && $splitmenu && $splitMenuNavPos=="menu") {
			
				$html .= '<li><span class="warning">'.JText::_("ZENSUPERFISHWARNING").'</span></li>';
			}
			if($csscompress) {
			
				$html .= '<li><span class="warning">'.JText::_("ZENCSSCOMPRESSWARNING").'</span></li>';
			}
			
			if(file_exists($oldframework)) {
					$html .= '<li><span class="warning">'.JText::_("ZENOLDFRAMEWORKWARNING").'</span></li>';
			}
			$html .= '</ul>';
			$html .= '</div>';
	
			return $html;
		}


		function fetchTooltip($label, $description, &$xmlElement, $control_name='', $name='') {
			return false;
		}
	}
}
?>
