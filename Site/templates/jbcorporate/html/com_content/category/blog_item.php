<?php // @version $Id: blog_item.php 11917 2009-05-29 19:37:05Z ian $
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
	
	
	/***********************************************************************************************************************
	 * 
	 *  Content Override for Joomla 2.5 +
	 * 
	**********************************************************************************************************************/
	
	$params = &$this->item->params;
		$images = json_decode($this->item->images);
	$canEdit	= $this->item->params->get('access-edit');
	JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
	JHtml::_('behavior.tooltip');
	JHtml::core();
	?>

	<?php if ($this->item->state == 0) : ?>
	<div class="system-unpublished">
	<?php endif; ?>

	<div class="jbCategory">

		<?php if ($params->get('show_title')) : ?>
		<!-- Title -->
		<h1 class="contentheading<?php echo $this->escape($this->item->params->get('pageclass_sfx')); ?>">
			<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
				<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>" class="contentpagetitle<?php echo $this->escape($this->item->params->get('pageclass_sfx')); ?>">
	            	<?php echo $this->escape($this->item->title); ?>
				</a>
	            <?php else : ?>
	                 <?php echo $this->escape($this->item->title); ?>
	            <?php endif; ?>
	    </h1>
		<?php endif; ?>

		<?php if (!$params->get('show_intro')) : ?>
		<!-- After Title Display -->
			<?php echo $this->item->event->afterDisplayTitle; ?>
		<?php endif; ?>


		<?php if (
			$params->get('show_print_icon') || 
			$params->get('show_email_icon') || 
			$canEdit ||
			$params->get('show_category') || 
			$params->get('show_parent_category') ||
			$params->get('show_category') ||
			$params->get('show_author') ||
			$params->get('show_create_date') ||
			$params->get('show_publish_date'))
			: ?>

			<!-- Start JB Meta -->
			<div class="jbMeta">
				
				<?php if ($params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit) : ?>
					<!-- Start PDF - Print - Edit -->
					<div class="buttons">
						<?php if ($params->get('show_print_icon')) : ?>
		                	<?php echo JHtml::_('icon.print_popup', $this->item, $params); ?>
		        		<?php endif; ?>

						<?php if ($params->get('show_email_icon')) : ?>
		                	<?php echo JHtml::_('icon.email', $this->item, $params); ?>
		        		<?php endif; ?>

						<?php if ($canEdit) : ?>
		                	<?php echo JHtml::_('icon.edit', $this->item, $params); ?>
		        		<?php endif; ?>
					</div>
				<!-- Start PDF - Print - Edit -->
				<?php endif; ?>
				
					<?php if ($params->get('show_create_date')) : ?>
						<div class="jbCreatedate">
							<?php echo JText::sprintf(JHTML::_('date',$this->item->created, JText::_('DATE_FORMAT_LC3'))); ?>
						</div>
					<?php endif; ?>

 					<?php if ($params->get('show_publish_date')) : ?>
                   		<div class="jbCreatedate">
                    		<?php echo JText::sprintf(JHTML::_('date',$this->item->publish_up, JText::_('DATE_FORMAT_LC3'))); ?>
                   		</div>
        			<?php endif; ?>

				<!-- Start Author Dates Hits etc -->
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

							<?php if (($params->get('show_category')) || ($params->get('show_parent_category'))) : ?>
								<!-- Start JB Category Display -->
								<div class="clear"></div>
								<div class="jbSectCat">
				       				<?php if ($params->get('show_parent_category')) : ?>
									<!-- Start Parent Categories -->
				                    	<span>
				                            <?php $title = $this->escape($this->item->parent_title);
				                                    $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_id)) . '">' . $title . '</a>'; ?>
				                            <?php if ($params->get('link_parent_category') AND $this->item->parent_id) : ?>
				                                    <?php echo JText::sprintf($url); ?>
				                                    <?php else : ?>
				                                    <?php echo JText::sprintf($title); ?>
				                            <?php endif; ?> -
				              			</span>
				    				<?php endif; ?>

									<?php if ($params->get('show_category')) : ?>
										<!-- Start Categories -->
				                    	<span>
				                            <?php $title = $this->escape($this->item->category_title);
				                                    $url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catid)).'">'.$title.'</a>';?>
				                            <?php if ($params->get('link_category') AND $this->item->slug) : ?>
				                                    <?php echo JText::sprintf($url); ?>
				                                    <?php else : ?>
				                                    <?php echo JText::sprintf($title); ?>
				                            <?php endif; ?>
				                    	</span>
				    				<?php endif; ?>
								</div>
								<div class="clear"></div>
							<!-- Start JB Category Display -->
							<?php endif; ?>
			</div>		
			<!-- Start JB Meta -->
			<?php endif; ?>
			
				<?php  if (isset($images->image_intro) and !empty($images->image_intro)) : ?>
	                <?php $imgfloat = (empty($images->float_intro)) ? $params->get('float_intro') : $images->float_intro; ?>
	                <div class="img-intro-<?php echo htmlspecialchars($imgfloat); ?>">
	                <img
	                    <?php if ($images->image_intro_caption):
	                        echo 'class="caption"'.' title="' .htmlspecialchars($images->image_intro_caption) .'"';
	                    endif; ?>
	                    src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/>
	                </div>
	            <?php endif; ?>

			<!-- Start JB Category Text -->
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

			<!-- Start Readmore -->
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
				<span class="jbHits">
					<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
				</span>
			<?php endif; ?>
			
			<?php if ($params->get('show_modify_date')) : ?>
				<span class="jbModifydate">
					<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date',$this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
	        	</span>
			<?php endif; ?>

	</div>

	<?php if ($this->item->state == 0) : ?>
	</div>
	<?php endif; ?>

	<div class="item-separator"></div>
	<?php echo $this->item->event->afterDisplayContent; 
}
else {
	
	
	/***********************************************************************************************************************
	 * 
	 *  Content Override for Joomla 1.5
	 * 
	**********************************************************************************************************************/
?>
<div class="jbCategory">
	
	<!-- Edit Icon -->
	<?php if ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own')) : ?>
	<div class="contentpaneopen_edit<?php echo $this->escape($this->item->params->get('pageclass_sfx')); ?>">
		<?php echo JHTML::_('icon.edit', $this->item, $this->item->params, $this->access); ?>
	</div>
	<?php endif; ?>
	<!-- Edit Icon -->
	

		
		<!-- Item Title -->
		<?php if ($this->item->params->get('show_title')) : ?>
		<h1 class="contentheading<?php echo $this->escape($this->item->params->get('pageclass_sfx')); ?>">
			<?php if ($this->item->params->get('link_titles') && $this->item->readmore_link != '') : ?>
				<a href="<?php echo $this->item->readmore_link; ?>" class="contentpagetitle<?php echo $this->escape($this->item->params->get('pageclass_sfx')); ?>">
					<?php echo $this->escape($this->item->title); ?></a>
			<?php else :
				echo $this->escape($this->item->title);
			endif; ?>
		</h1>
		<?php endif; ?>
		<!-- Edit Icon -->

	<div class="jbMeta">
		<?php if (!$this->item->params->get('show_intro')) :
			echo $this->item->event->afterDisplayTitle;
		endif; ?>
		
		<!-- PDF Buttons -->
		<?php if ($this->item->params->get('show_pdf_icon') || $this->item->params->get('show_print_icon') || $this->item->params->get('show_email_icon')) : ?>
		<div class="buttons">
	
			<?php if ($this->item->params->get('show_pdf_icon')) :
				echo JHTML::_('icon.pdf', $this->item, $this->item->params, $this->access);
			endif;
			if ($this->item->params->get('show_print_icon')) :
				echo JHTML::_('icon.print_popup', $this->item, $this->item->params, $this->access);
			endif;
			if ($this->item->params->get('show_email_icon')) :
				echo JHTML::_('icon.email', $this->item, $this->item->params, $this->access);
			endif; ?>
		</div>
		<?php endif; ?>
		<!-- PDF Buttons -->
		
		<!-- Create Date -->
		<?php if ($this->item->params->get('show_create_date')) : ?>
			<div class="jbCreatedate">
				<?php echo JHTML::_('date', $this->item->created, JText::_('DATE_FORMAT_LC3')); ?>
			</div>
		<?php endif; ?>
		
		<!-- Author -->
		<?php if (($this->item->params->get('show_author')) && ($this->item->author != "")) : ?>
			<span class="jbAuthor">
				<?php JText::printf('Written by', ($this->escape($this->item->created_by_alias) ? $this->escape($this->item->created_by_alias) : $this->escape($this->item->author))); ?>
			</span>
		<?php endif; ?>
		<!-- Author -->	
		
		<!-- Sections and Categories -->
		<?php if (($this->item->params->get('show_section') && $this->item->sectionid) || ($this->item->params->get('show_category') && $this->item->catid)) : ?>
		<div class="jbSectCat">
		    <?php if ($this->item->params->get('show_section') && $this->item->sectionid && isset($this->item->section)) : ?>
		        <span class="jbSections">
		            <?php if ($this->item->params->get('link_section')) : ?>
		                <?php echo '<a href="'.JRoute::_(ContentHelperRoute::getSectionRoute($this->item->sectionid)).'">'; ?>
		            <?php endif; ?>
		            <?php echo $this->escape($this->item->section); ?>
		            <?php if ($this->item->params->get('link_section')) : ?>
		                <?php echo '</a>'; ?>
		            <?php endif; ?>
					<?php if ($this->item->params->get('show_category')) : ?>
		                <?php echo ' - '; ?>
		            <?php endif; ?>
		        </span>
		        <?php endif; ?>
		        <?php if ($this->item->params->get('show_category') && $this->item->catid) : ?>
		        <span class="jbCategories">
		            <?php if ($this->item->params->get('link_category')) : ?>
		                <?php echo '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug, $this->item->sectionid)).'">'; ?>
		            <?php endif; ?>
		            <?php echo $this->escape($this->item->category); ?>
		            <?php if ($this->item->params->get('link_category')) : ?>
		                <?php echo '</a>'; ?>
		            <?php endif; ?>
		        </span>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<!-- Sections and Categories -->
	


		<?php echo $this->item->event->beforeDisplayContent; ?>

		<!-- Url -->
		<?php if ($this->item->params->get('show_url') && $this->item->urls) : ?>
		<span class="small">
			<a href="<?php echo $this->item->urls; ?>" target="_blank">
				<?php echo $this->escape($this->item->urls); ?></a>
		</span>
		<?php endif; ?>
		<!-- Url-->
		
	</div>
	<!-- JB Meta -->
	<div class="clear"></div>
	
	<!-- Introtext -->
	<div class="jbintrotext">
		<?php if (isset ($this->item->toc)) :
			echo $this->item->toc;
		endif; ?>

		<?php echo JFilterOutput::ampReplace($this->item->text);  ?>

		<?php if ($this->item->params->get('show_readmore') && $this->item->readmore) : ?>
		<div class="jbReadmore zenbutton">
		<span>
				<a href="<?php echo $this->item->readmore_link; ?>" class="jbReadon<?php echo $this->escape($this->item->params->get('pageclass_sfx')); ?>">
				<?php if ($this->item->readmore_register) :
					echo JText::_('Register to read more...');
				elseif ($readmore = $this->item->params->get('readmore')) :
					echo $readmore;
				else :
					echo JText::sprintf('Read more', '');
				endif; ?></a></span>
		</div>
		<?php endif; ?>
	</div>
	<div class="clear"></div>
	<!-- Introtext -->
	
	<!-- Modify Date -->
	<?php if (intval($this->item->modified) !=0 && $this->item->params->get('show_modify_date')) : ?>
		<span class="jbModifydate">
			<?php echo JText::sprintf('LAST_UPDATED2', JHTML::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
		</span>
		<div class="clear"></div>
		<?php endif; ?>
	<!-- Modify Date -->
</div>
<?php echo $this->item->event->afterDisplayContent;
}