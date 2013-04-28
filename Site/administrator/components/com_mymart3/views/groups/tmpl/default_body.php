<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<?php foreach($this->items as $i => $item): ?>
	<tr class="row<?php echo $i % 2; ?>">
		<td>
			<?php echo $item->id; ?>
		</td>
		<td>
			<?php echo JHtml::_('grid.id', $i, $item->id); ?>
		</td>
		<td>
		  <a href="<?php echo JRoute::_('index.php?option=com_mymart3&task=group.edit&id='.(int) $item->id); ?>">
			<?php echo $item->title; ?>
			</a>
		</td>
		<td align="center">
		  <?php echo JHtml::_('grid.boolean', $i, $item->onlinelearning, null, null); ?>
		</td>
	</tr>
<?php endforeach; ?>