<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<div class="breadcrumbs">
<?php for ($i = 0; $i < $count; $i ++) :

	// If not the last item in the breadcrumbs add the separator
	if ($i < $count -1) {
		if(!empty($list[$i]->link)) {
			echo '<a href="'.$list[$i]->link.'" class="pathway">'.$list[$i]->name.'</a>';
		} else {
			echo '<span class="breadcrumbs zencrumb">'.$list[$i]->name.'</span>';
		}

	}  else if ($params->get('showLast', 1)) { // when $i == $count -1 and 'showLast' is true
	    echo '<span class="breadcrumbs zencrumb last">'.$list[$i]->name.'</span>';
	}
endfor; ?>
</div>

