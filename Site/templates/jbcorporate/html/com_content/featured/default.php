<?php // @version $Id: default.php 11917 2009-05-29 19:37:05Z ian $
defined('_JEXEC') or die('Restricted access');

JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers');
?>

<?php if ($this->params->get('show_page_heading',1)) : ?>
<h1 class="componentheading<?php echo $this->pageclass_sfx; ?>">
	<?php echo $this->escape($this->params->get('page_heading')); ?>
</h1>
<?php endif; ?>

<div class="blog<?php echo $this->pageclass_sfx; ?>">

	<?php $leadingcount=0 ; ?>
        <?php if (!empty($this->lead_items)) : ?>
                <?php foreach ($this->lead_items as &$item) : ?>
                        <div class="leading<?php echo $this->pageclass_sfx; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
                                <?php
                                        $this->item = &$item;
                                        echo $this->loadTemplate('item');
                                ?>
                        </div>
                        <?php
                                $leadingcount++;
                        ?>
                <?php endforeach; ?>
        <?php endif; ?>


        <?php
                $introcount=(count($this->intro_items));
                $counter=0;
        ?>
        <?php if ($introcount) : ?>
        <?php foreach ($this->intro_items as $key => &$item) : ?>

            <?php
                    $key= ($key-$leadingcount)+1;
                    $rowcount=( ((int)$key-1) %	(int) $this->columns) +1;
                    $row = $counter / $this->columns ;
                    $colcount = $this->columns ? $this->columns : 1;

                    if ($rowcount==1) : ?>

                            <div class="article_row<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
                    <?php endif; ?>
                    <div class="article_column column<?php echo $rowcount;?>  cols<?php echo $colcount; ?><?php echo $item->state == 0 ? ' system-unpublished"' : null; ?>">
                            <?php
                                            $this->item = &$item;
                                            echo $this->loadTemplate('item');
                            ?>
                    </div>
                    <?php $counter++; ?>
                            <?php if (($rowcount == $this->columns) or ($counter ==$introcount)): ?>
                                    <span class="row_separator<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">&nbsp;</span>
                                    </div>

                            <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (!empty($this->link_items)) : ?>
                <div class="blog_more<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
                <?php echo $this->loadTemplate('links'); ?>
                </div>
        <?php endif; ?>

	<?php if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->get('pages.total') > 1)) : ?>
                <?php if ($this->params->def('show_pagination_results', 1)) : ?>
                                <p class="counter">
                                        <?php echo $this->pagination->getPagesCounter(); ?>
                                </p>
                        <?php  endif; ?>
                                        <?php echo $this->pagination->getPagesLinks(); ?>
        <?php endif; ?>

</div>
