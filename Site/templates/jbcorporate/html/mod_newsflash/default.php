<?php // @version $Id: default.php 10381 2008-06-01 03:35:53Z pasamio $
defined('_JEXEC') or die('Restricted access');
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @Type        Core Framework Files
 * @version		v2.0
 * @author		Joomal Bamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

/***********************************************************************************************************************
 * 
 *  User override for 1.5. J1.7 uses articles_latest
 * 
**********************************************************************************************************************/

if (substr(JVERSION, 0, 3) == '1.5') {

?>

<?php
srand((double) microtime() * 1000000);
$flashnum = rand(0, $items - 1);
$item = $list[$flashnum];
modNewsFlashHelper::renderItem($item, $params, $access);
}
?>
