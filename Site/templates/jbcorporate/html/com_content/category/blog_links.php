<?php // @version $Id: blog_links.php 11917 2009-05-29 19:37:05Z ian $
defined('_JEXEC') or die('Restricted access');

/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @Type        Core Framework Files
 * @version		v2.0
 * @author		Joomal Bamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
if (substr(JVERSION, 0, 3) >= '1.6') {
	include_once JPATH_ROOT.'/components/com_content/views/category/tmpl/blog_links.php';
}
else {
?>

<h2>
	<?php echo JText::_('More Articles...'); ?>
</h2>

<ul>
	<?php foreach ($this->links as $link) : ?>
	<li>
		<a class="blogsection" href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($link->slug, $link->catslug, $link->sectionid)); ?>">
			<?php echo $this->escape($link->title); ?></a>
	</li>
	<?php endforeach; ?>
</ul>
<?php } ?>