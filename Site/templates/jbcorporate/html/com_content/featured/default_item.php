<?php // @version $Id: default_item.php 11917 2009-05-29 19:37:05Z ian $
defined('_JEXEC') or die('Restricted access');

$params = &$this->item->params;
$canEdit	= $this->item->params->get('access-edit');
?>

<?php if ($this->item->state == 0) : ?>
<div class="system-unpublished">
<?php endif; ?>

    
<div class="jbFrontPage">
	<?php if ($params->get('show_title')) : ?>
	<h2 class="contentheading<?php echo $this->escape($this->item->params->get('pageclass_sfx')); ?>">
		<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
			<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>" class="contentpagetitle<?php echo $this->escape($this->item->params->get('pageclass_sfx')); ?>">
			<?php echo $this->escape($this->item->title); ?></a>
		<?php else : ?>
			<?php echo $this->escape($this->item->title); ?>
		<?php endif; ?>
	</h2>
	<?php endif; ?>

	<?php if (!$params->get('show_intro')) :
	echo $this->item->event->afterDisplayTitle;
	endif; ?>

		<?php if (
			$params->get('show_print_icon') || 
			$params->get('show_email_icon') || 
			$canEdit || 
			$params->get('show_author') || 
			$params->get('show_category') || 
			$params->get('show_create_date') || 
			$params->get('show_modify_date') || 
			$params->get('show_publish_date') || 
			$params->get('show_parent_category') || 
			$params->get('show_hits')
			) : ?>
			
			<!-- JB Meta -->
			<div class="jbMeta">
			
			<?php if (($params->get('show_author')) or ($params->get('show_create_date'))or ($params->get('show_publish_date')) or ($params->get('show_hits'))) : ?>
					<!-- Author Date Etc -->
				
						<?php if ($params->get('show_create_date')) : ?>
						<!-- Create Date -->
							<div class="jbCreatedate">
								<?php echo JText::sprintf(JHTML::_('date',$this->item->created, JText::_('DATE_FORMAT_LC3'))); ?>
							</div>
						<?php endif; ?>

						<?php if ($params->get('show_publish_date')) : ?>
	                   	<!-- Published -->
						<span class="jbPublished">
	                    		<?php echo JText::sprintf(JHTML::_('date',$this->item->publish_up, JText::_('DATE_FORMAT_LC3'))); ?>
	                   		</span>
	        			<?php endif; ?>
					
						
							<?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
							<span class="jbAuthor">
								<?php $author =  $this->item->author; ?>
								<?php $author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author);?>

								<?php if (!empty($this->item->contactid ) &&  $params->get('link_author') == true):?>
									<?php 	echo JText::sprintf('COM_CONTENT_WRITTEN_BY' ,
					 				JHTML::_('link',JRoute::_('index.php?option=com_contact&view=contact&id='.$this->item->contactid),$author)); ?>

								<?php else :?>
									<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
								<?php endif; ?>
							</span>
							<?php endif; ?>

					<?php endif; ?>
				
				
				<?php if (($params->get('show_category')) or ($params->get('show_parent_category'))) : ?>
					<div class="jbSectCat">
					<!-- Parent Categories -->
	    				<?php if ($params->get('show_parent_category')) : ?>
	                    	<span class="jbParentCategories">
	                            <?php $title = $this->escape($this->item->parent_title);
	                                    $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_id)) . '">' . $title . '</a>'; ?>
	                            <?php if ($params->get('link_parent_category') AND $this->item->parent_id) : ?>
	                                    <?php echo JText::sprintf('', $url); ?>
	                                    <?php else : ?>
	                                    <?php echo JText::sprintf('', $title); ?>
	                            <?php endif; ?>
	                    	</span>
	    				<?php endif; ?>

						<?php if ($params->get('show_category')) : ?>
						<!-- Categories -->
	                    <span class="jbCategories">
	                            <?php $title = $this->escape($this->item->category_title);
	                                    $url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catid)).'">'.$title.'</a>';?>
	                            <?php if ($params->get('link_category') AND $this->item->catid) : ?>
	                                    <?php echo JText::sprintf($url); ?>
	                                    <?php else : ?>
	                                    <?php echo JText::sprintf($title); ?>
	                            <?php endif; ?>
	                    </span>
	    				<?php endif; ?>
					</div>
				<?php endif; ?>
				
					<?php if (
						$this->item->params->get('show_print_icon') ||
						$this->item->params->get('show_email_icon') ||
						$canEdit				
						) : ?>
						<div class="buttons">
							<!-- PDF, Print, edit -->
							<?php if ($this->item->params->get('show_print_icon')) :
								echo JHTML::_('icon.print_popup', $this->item, $params);
							endif;

							if ($this->item->params->get('show_email_icon')) :
								echo JHTML::_('icon.email', $this->item, $params);
							endif;

							if ($canEdit) :
		                		echo JHtml::_('icon.edit', $this->item, $params);
		        			endif; ?>
						</div>
					<?php endif; ?>
		
		</div>
		<!-- End JB Meta -->
		<?php endif; ?>

		<div class="jbIntroText">
			<?php echo $this->item->introtext; ?>
		</div>

			<?php if ($params->get('show_readmore') && $this->item->readmore) :
				if ($params->get('access-view')) :
				$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
				else :
				$menu = JFactory::getApplication()->getMenu();
				$active = $menu->getActive();
				$itemId = $active->id;
				$link1 = JRoute::_('index.php?option=com_users&view=login&&Itemid=' . $itemId);
				$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
				$link = new JURI($link1);
				$link->setVar('return', base64_encode($returnURL));
				endif;
			?>
			
			<div class="jbReadmore zenbutton">
				<span>
					<a href="<?php echo $link; ?>" class="jbReadon<?php echo $this->item->params->get('pageclass_sfx'); ?>">
					<?php if (!$params->get('access-view')) :
						echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
					elseif ($readmore = $this->item->alternative_readmore) :
						echo $readmore;
						echo JHTML::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
					elseif ($params->get('show_readmore_title', 0) == 0) :
						echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
					else :
						echo JText::_('COM_CONTENT_READ_MORE');
						echo JHTML::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
					endif; ?>
					</a>
				</span>
			</div>
			<?php endif; ?>


			<?php if ($params->get('show_hits')) : ?>
			<!-- Hits -->
			<div class="clear"></div>
			<span class="jbHits">
					<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
				</span>
			<?php endif; ?>
				
			<?php if ($params->get('show_modify_date')) : ?>
				<div class="clear"></div>
				<span class="jbModifydate">
					<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date',$this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
        		</span>
			<?php endif; ?>
</div>

<?php if ($this->item->state == 0) : ?>
</div>
<?php endif; ?>

<div class="item-separator"></div>
<?php echo $this->item->event->afterDisplayContent; ?>