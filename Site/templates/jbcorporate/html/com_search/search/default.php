<?php // @version $Id: default.php 11917 2009-05-29 19:37:05Z ian $
defined('_JEXEC') or die('Restricted access');

if (substr(JVERSION, 0, 3) >= '1.6') { ?>
	<div class="search<?php echo $this->pageclass_sfx; ?>">
		<?php if ($this->params->get('show_page_heading', 1)) : ?>
		<h1>
			<?php if ($this->escape($this->params->get('page_heading'))) :?>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			<?php else : ?>
				<?php echo $this->escape($this->params->get('page_title')); ?>
			<?php endif; ?>
		</h1>
		<?php endif; ?>
		<div class="zenblock">
			<?php if ($this->error==null && count($this->results) > 0) :
				echo $this->loadTemplate('results');
			else :
				echo $this->loadTemplate('error');
			endif; ?>
		</div>
		<div class="zenblock">
			<?php echo $this->loadTemplate('form'); ?>
		</div>
	</div>
	
<?php } else { ?>

<?php if($this->params->get('show_page_title',1)) : ?>
	<h1 class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')) ?>">
		<?php echo $this->escape($this->params->get('page_title')) ?>
	</h1>
	<?php endif; ?>

	<div id="searchpage">
		<div class="zenblock">
			<?php if (!$this->error) :
				echo $this->loadTemplate('results');
			else :
				echo $this->loadTemplate('error');
			endif; ?>
		</div>

			<?php echo $this->loadTemplate('form'); ?>

	</div>
<?php } ?>