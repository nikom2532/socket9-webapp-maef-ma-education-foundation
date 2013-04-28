	<?php // @version $Id: default_results.php 11917 2009-05-29 19:37:05Z ian $
defined('_JEXEC') or die('Restricted access');
if (substr(JVERSION, 0, 3) >= '1.6') { 
if ($this->results) :
?>

<div class="results">
	<h3><?php echo JText :: _('SEARCH RESULT'); ?></h3>
	<ol>
	<?php foreach($this->results as $result) : ?>
		<li>
			<h4>
				<?php if ($result->href) :?>
					<a href="<?php echo JRoute::_($result->href); ?>"<?php if ($result->browsernav == 1) :?> target="_blank"<?php endif;?>>
						<?php echo $this->escape($result->title);?>
					</a>
				<?php else:?>
					<?php echo $this->escape($result->title);?>
				<?php endif; ?>
			</h4>
			
			<?php if ($result->section) : ?>
			<p><?php echo JText::_('Category') ?>:
				<span class="small<?php echo $this->escape($this->params->get('pageclass_sfx')) ?>">
					<?php echo $this->escape($result->section); ?>
				</span>
			</p>
			<?php endif; ?>
			
			<?php echo $result->text; ?>
			
			<?php if ($this->params->get('show_date')) : ?>
				<span class="small<?php echo $this->pageclass_sfx; ?>">
					<?php echo JText::sprintf('JGLOBAL_CREATED_DATE_ON', $result->created); ?>
				</span>
			<?php endif; ?>
		</li>
	<?php endforeach; ?>
	</ol>
	<div class="clear"></div>
	<?php echo $this->pagination->getPagesLinks(); ?>
	<div class="clear"></div>
</div>

<?php endif; 

} else { 

if (!empty($this->searchword)) : ?>
<div class="searchintro<?php echo $this->escape($this->params->get('pageclass_sfx')) ?>">
	<p>
		<?php echo JText::_('Search Keyword') ?> <strong><?php echo $this->escape($this->searchword) ?></strong>
		<?php echo $this->result ?>
	</p>
	<p>
		<a href="#form1" onclick="document.getElementById('search_searchword').focus();return false" onkeypress="document.getElementById('search_searchword').focus();return false" ><?php echo JText::_('Search_again') ?></a>
	</p>
</div>
<?php endif; ?>

<?php if (count($this->results)) : ?>
<div class="results">
	<h3><?php echo JText :: _('Search_result'); ?></h3>
	<?php $start = $this->pagination->limitstart + 1; ?>
	<ol class="list<?php echo $this->escape($this->params->get('pageclass_sfx')) ?>" start="<?php echo (int)$start ?>">
		<?php foreach ($this->results as $result) : ?>
		<li>
			<?php if ($result->href) : ?>
			<h4>
				<a href="<?php echo JRoute :: _($result->href) ?>" <?php echo ($result->browsernav == 1) ? 'target="_blank"' : ''; ?> >
					<?php echo $this->escape($result->title); ?></a>
			</h4>
			<?php endif; ?>
			<?php if ($result->section) : ?>
			<p><?php echo JText::_('Category') ?>:
				<span class="small<?php echo $this->escape($this->params->get('pageclass_sfx')) ?>">
					<?php echo $this->escape($result->section); ?>
				</span>
			</p>
			<?php endif; ?>

			<?php echo $result->text; ?>
			<span class="small<?php echo $this->escape($this->params->get('pageclass_sfx')) ?>">
				<?php echo $this->escape($result->created); ?>
			</span>
		</li>
		<?php endforeach; ?>
	</ol>
	<div class="clear"></div>
	<?php echo $this->pagination->getPagesLinks(); ?>
	<div class="clear"></div>
</div>
<?php endif; ?>
<?php } ?>