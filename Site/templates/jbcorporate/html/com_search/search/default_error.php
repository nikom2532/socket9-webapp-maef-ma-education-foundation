<?php // @version $Id: default_error.php 11917 2009-05-29 19:37:05Z ian $
defined('_JEXEC') or die('Restricted access');

if (substr(JVERSION, 0, 3) >= '1.6') {
	include_once JPATH_ROOT.'/components/com_search/views/search/tmpl/default_error.php';
}
else {
?>

<h2 class="error<?php $this->escape($this->params->get( 'pageclass_sfx' )) ?>">
	<?php echo JText::_('Error') ?>
</h2>
<div class="error<?php echo $this->escape($this->params->get( 'pageclass_sfx' )) ?>">
	<p><?php echo $this->escape($this->error); ?></p>
</div>
<?php } ?>