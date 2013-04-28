<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<?php foreach($this->items as $i => $item): ?>
	<tr class="row<?php echo $i % 2; ?>">
		<td>
			<?php echo $item->joomlaid; ?>
		</td>
		<td>
			<?php echo JHtml::_('grid.id', $i, $item->joomlaid); ?>
		</td>
		<td>
			<?php echo $item->joomlausername; ?>
		</td>
		<td>
			<?php echo $item->email; ?>
		</td>
		<td align="center">
		  <?php echo JHtml::_('grid.boolean', $i, !is_null($item->mymart3id), null, null); ?>
		</td>
		<td align="center">
		  <?php echo JHtml::_('grid.boolean', $i, $item->onlinelearningenabled, null, null); ?>
		</td>
		<td>
			<?php echo $item->mymart3id; ?>
		</td>
	</tr>
<?php endforeach; ?>