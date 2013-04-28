<?php // @version $Id: default.php 11917 2009-05-29 19:37:05Z ian $
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
 *  Content Override for Joomla 1.7 +
 * 
**********************************************************************************************************************/
	
	
		JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers');
		// Create shortcuts to some parameters.
		$params		= $this->item->params;
		$images = json_decode($this->item->images);
		$urls = json_decode($this->item->urls);
		$canEdit	= $this->item->params->get('access-edit');
		$user		= JFactory::getUser();
		?>

		<div id="jbArticle">

			<?php if ($this->params->get('show_page_heading', 1)) : ?>
				<!-- Page Heading -->
				<h1 class="componentheading<?php echo $this->escape($params->get('pageclass_sfx')); ?>">
					<?php echo $this->escape($this->params->get('page_heading')); ?>
				</h1>
			<?php endif; ?>

			<?php if ($params->get('show_title')|| $params->get('access-edit')) : ?>
				<!-- Item Title -->
				<h1 class="contentheading<?php echo $this->escape($params->get('pageclass_sfx')); ?>">
						<?php if ($params->get('link_titles') && !empty($this->item->readmore_link)) : ?>
						<a href="<?php echo $this->item->readmore_link; ?>" class="contentpagetitle<?php echo $this->escape($params->get('pageclass_sfx')); ?>">
								<?php echo $this->escape($this->item->title); ?></a>
						<?php else : ?>
								<?php echo $this->escape($this->item->title); ?>
						<?php endif; ?>
				</h1>
				<?php endif; ?>



				<?php if (
							$params->get('show_author') ||
							$params->get('show_create_date') ||
							$params->get('show_publish_date') ||
							$params->get('show_hits') ||
							$canEdit ||
							$params->get('show_print_icon') ||
							$params->get('show_email_icon') || 
							$params->get('show_category') ||
							$params->get('show_parent_category') ||
							!$params->get('show_intro')
						) : ?>

				<!-- JB Meta -->
				<div class="jbMeta">
					
						
						<?php if ($params->get('show_create_date')) : ?>
						<!-- Create Date -->
							<div class="jbCreatedate">
								<?php echo JText::sprintf( JHTML::_('date',$this->item->created, JText::_('DATE_FORMAT_LC3'))); ?>
							</div>
						<?php endif; ?>

						<?php if ($params->get('show_publish_date')) : ?>
						<!-- Published Date -->
		                	<span class="jbPublished">
		                    		<?php echo JText::sprintf( JHTML::_('date',$this->item->publish_up, JText::_('DATE_FORMAT_LC3'))); ?>
		                		</span>
		        		<?php endif; ?>
		
		
							<?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
							<!-- Author -->
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
									<div class="jbSectCat">

									<?php if ($params->get('show_parent_category')) : ?>
									<!-- JParent Category -->
					                    <span class="jbParentCategories">
					                            <?php $title = $this->escape($this->item->parent_title);
					                                    $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_id)) . '">' . $title . '</a>'; ?>
					                            <?php if ($params->get('link_parent_category') AND $this->item->parent_id) : ?>
					                                    <?php echo JText::sprintf($url); ?>
					                                    <?php else : ?>
					                                    <?php echo JText::sprintf($title); ?>
					                            <?php endif; ?>
					                    </span>
					    			<?php endif; ?>

									<?php if ($params->get('show_category')) : ?>
									<!-- Category -->
					                    <span class="jbCategories">
					                            <?php $title = $this->escape($this->item->category_title);
					                                    $url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catid)).'">'.$title.'</a>';?>
					                            <?php if ($params->get('link_category') AND $this->item->catid) : ?>
					                                    <?php echo JText::sprintf( $url); ?>
					                                    <?php else : ?>
					                                    <?php echo JText::sprintf('CATEGORY', $title); ?>
					                            <?php endif; ?>
					                    </span>
					    			<?php endif; ?>
								</div>
							<?php endif; ?>
							<!-- End JB MEta -->		


				<?php  if (!$params->get('show_intro')) :
		        	echo $this->item->event->afterDisplayTitle;
				endif; ?>

				<?php if ($canEdit ||  $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
					<div class="buttons">

						<?php if (!$this->print) : ?>
						<!-- Print -->
		            		<?php if ($params->get('show_print_icon')) : ?>
		                           <?php echo JHtml::_('icon.print_popup',  $this->item, $params); ?>
		            	<?php endif; ?>

		            	<?php if ($params->get('show_email_icon')) : ?>
						<!-- Email -->
		                          <?php echo JHtml::_('icon.email',  $this->item, $params); ?>
		            	<?php endif; ?>

						<?php if ($canEdit) : ?>
						<!-- Edit -->
		                          <?php echo JHtml::_('icon.edit', $this->item, $params); ?>
		            	<?php endif; ?>

						<?php else : ?>
						<!-- Print Screen -->
		            		<?php echo JHtml::_('icon.print_screen',  $this->item, $params); ?>
		        		<?php endif; ?>
					</div>
				<?php endif; ?>

			
				</div>
				<?php endif; ?>

				<?php if ($params->get('access-view')):?>
				<div class="jbIntroText">
					<?php if (isset ($this->item->toc)) : ?>
						<div id="tableofcontents">
							<?php echo $this->item->toc; ?>
						</div>
					<?php endif; ?>
						<?php
						if (!empty($this->item->pagination) AND $this->item->pagination AND !$this->item->paginationposition AND !$this->item->paginationrelative):
							echo $this->item->pagination;
						 endif;
						?>

						<?php if (isset($urls) AND ((!empty($urls->urls_position) AND ($urls->urls_position=='0')) OR  ($params->get('urls_position')=='0' AND empty($urls->urls_position) ))
								OR (empty($urls->urls_position) AND (!$params->get('urls_position')))): ?>
						<?php echo $this->loadTemplate('links'); ?>
						<?php endif; ?>

					<?php  if (isset($images->image_fulltext) and !empty($images->image_fulltext)) : ?>
		                <?php $imgfloat = (empty($images->float_fulltext)) ? $params->get('float_fulltext') : $images->float_fulltext; ?>
		                <div class="img-fulltext-<?php echo htmlspecialchars($imgfloat); ?>">
		                <img
		                    <?php if ($images->image_fulltext_caption):
		                        echo 'class="caption"'.' title="' .htmlspecialchars($images->image_fulltext_caption) .'"';
		                    endif; ?>
		                    src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>"/>
		                </div>
		            <?php endif; ?>
		
					
				<!-- Introtext -->
							<?php echo $this->item->text; ?>

								<?php if (isset($urls) AND ((!empty($urls->urls_position)  AND ($urls->urls_position=='1')) OR ( $params->get('urls_position')=='1') )): ?>
								<?php echo $this->loadTemplate('links'); ?>
								<?php endif; ?>						
								
								<?php
								if (!empty($this->item->pagination) AND $this->item->pagination AND $this->item->paginationposition AND!$this->item->paginationrelative):
									 echo $this->item->pagination;?>
								<?php endif; ?>
								
								
									<?php if ($params->get('show_hits')) : ?>
									<!-- Hits -->
									<div class="clear"></div>
										<span class="jbHits">
											<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
										</span>
										<div class="clear"></div>
									<?php endif; ?>
								
										<?php if ($params->get('show_modify_date')) : ?>
										<!-- Modify Date -->
											<span class="jbModifydate">
												<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date',$this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
								        	</span>
										<?php endif; ?>
				</div>
					<?php //optional teaser intro text for guests ?>
				<?php elseif ($params->get('show_noauth') == true AND  $user->get('guest') ) : ?>
					<?php echo $this->item->introtext; ?>
					<?php //Optional link to let them register to see the whole article. ?>
					<?php if ($params->get('show_readmore') && $this->item->fulltext != null) :
						$link1 = JRoute::_('index.php?option=com_users&view=login');
						$link = new JURI($link1);?>
						<p class="readmore">
						<a href="<?php echo $link; ?>">
						<?php $attribs = json_decode($this->item->attribs);  ?> 
						<?php 
						if ($attribs->alternative_readmore == null) :
							echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
						elseif ($readmore = $this->item->alternative_readmore) :
							echo $readmore;
							if ($params->get('show_readmore_title', 0) != 0) :
							    echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
							endif;
						elseif ($params->get('show_readmore_title', 0) == 0) :
							echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');	
						else :
							echo JText::_('COM_CONTENT_READ_MORE');
							echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
						endif; ?></a>
						</p>
					<?php endif; ?>
				<?php endif; ?>
		</div>	<?php echo $this->item->event->afterDisplayContent; ?>
<?php } else { 

	/***********************************************************************************************************************
	 * 
	 *  Content Override for Joomla 1.5
	 * 
	**********************************************************************************************************************/	
?>

<div id="jbArticle">

<!-- Edit Icon -->
<?php if (($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own')) && !($this->print)) : ?>
<div class="contentpaneopen_edit<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	<?php echo JHTML::_('icon.edit', $this->article, $this->params, $this->access); ?>
</div>
<?php endif; ?>
<!-- Edit Icon -->

<!-- page title -->
<?php if ($this->params->get('show_page_title',1) && $this->params->get('page_title') != $this->article->title) : ?>
<h1 class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
        <?php echo $this->escape($this->params->get('page_title')); ?>
</h1>
<?php endif; ?>
<!-- page title -->

	<?php if($this->params->get('show_title') || 
			$this->params->get('show_create_date') ||
			$this->params->get('show_pdf_icon') || 
			$this->params->get('show_print_icon') || 
			$this->params->get('show_email_icon') ||
			($this->params->get('show_author')) && ($this->article->author != "") ||
			($this->params->get('show_section') && $this->article->sectionid) || ($this->params->get('show_category') && $this->article->catid) ||
			$this->params->get('show_url') && $this->article->urls	
	): ?>
	<div class="jbMeta">
	
			<!-- Content Title -->
			<?php if ($this->params->get('show_title')) : ?>
				<h1 class="contentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
					<?php echo $this->escape($this->article->title); ?>				
				</h1>
			<?php endif; ?>
			<!-- Content Title -->
				
				
				<!-- Createdate -->
				<?php if ($this->params->get('show_create_date')) : ?>
					<div class="jbCreatedate">
						<?php echo JHTML::_('date', $this->article->created, JText::_('DATE_FORMAT_LC3')) ?>
					</div>
				<?php endif; ?>
				<!-- Author -->


				<?php if (!$this->params->get('show_intro')) :
				echo $this->article->event->afterDisplayTitle;
			endif; ?>


			<!-- PDF Buttons-->
			<?php if ($this->params->get('show_pdf_icon') || $this->params->get('show_print_icon') || $this->params->get('show_email_icon')) : ?>
				<div class="buttons">
					<?php if ($this->print) :
					echo JHTML::_('icon.print_screen', $this->article, $this->params, $this->access);
				elseif ($this->params->get('show_pdf_icon') || $this->params->get('show_print_icon') || $this->params->get('show_email_icon')) : ?>

				<?php if ($this->params->get('show_pdf_icon')) :
				echo JHTML::_('icon.pdf', $this->article, $this->params, $this->access);
			endif;
			if ($this->params->get('show_print_icon')) :
			echo JHTML::_('icon.print_popup', $this->article, $this->params, $this->access);
			endif;
			if ($this->params->get('show_email_icon')) :
			echo JHTML::_('icon.email', $this->article, $this->params, $this->access);
			endif;
			endif; ?>
		</div>
		<?php endif; ?>
		<!-- PDF Buttons-->
		
		
		<!-- Author -->
		<?php if (($this->params->get('show_author')) && ($this->article->author != "")) : ?>
				<span class="jbAuthor">
					<?php JText::printf('Written by', ($this->article->created_by_alias ? $this->escape($this->article->created_by_alias) : $this->escape($this->article->author))); ?>	
				</span>
		<?php endif; ?>
		<!-- Author -->



		<!-- Section and Category-->
		<?php if (($this->params->get('show_section') && $this->article->sectionid) || ($this->params->get('show_category') && $this->article->catid)) : ?>
			<div class="jbSectCat">
				<?php if ($this->params->get('show_section') && $this->article->sectionid) : ?>
					<span class="jbSections">
						<?php if ($this->params->get('link_section')) : ?>
							<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getSectionRoute($this->article->sectionid)).'">'; ?>
							<?php endif; ?>
							<?php echo $this->escape($this->article->section); ?>
							<?php if ($this->params->get('link_section')) : ?>
								<?php echo '</a>'; ?>
							<?php endif; ?>
							<?php if ($this->params->get('show_category')) : ?>
								<?php echo ' - '; ?>
							<?php endif; ?>
						</span>
					<?php endif; ?>


					<?php if ($this->params->get('show_category') && $this->article->catid) : ?>
						<span class="jbCategories">
							<?php if ($this->params->get('link_category')) : ?>
								<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->article->catslug, $this->article->sectionid)).'">'; ?>
								<?php endif; ?>
								<?php echo $this->escape($this->article->category); ?>
								<?php if ($this->params->get('link_category')) : ?>
									<?php echo '</a>'; ?>
								<?php endif; ?>
							</span>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<!-- Section and Category-->


				<?php echo $this->article->event->beforeDisplayContent; ?>


				<?php if ($this->params->get('show_url') && $this->article->urls) : ?>
					<!-- Url-->
					<span class="small">
						<a href="<?php echo $this->escape($this->article->urls); ?>" target="_blank">
							<?php echo $this->escape($this->article->urls); ?>
						</a>
					</span>
				<?php endif; ?>


	</div>
	<!-- End JB Meta-->
	<?php endif; ?>
	<div class="clear"></div>
	
	<!-- Introtext-->
	<div class="jbintrotext">
		<?php if (isset ($this->article->toc)) :
			echo $this->article->toc;
		endif; ?>

		<?php echo JFilterOutput::ampReplace($this->article->text); ?>
	</div>
	<!-- End Introtext-->
	<div class="clear"></div>	
	
	<?php echo $this->article->event->afterDisplayContent; ?>
	
		<!-- Modify Date -->
		<?php if (intval($this->article->modified) !=0 && $this->params->get('show_modify_date')) : ?>
		<span class="jbModifydate">
					<?php echo JText::sprintf('LAST_UPDATED2', JHTML::_('date', $this->article->modified, JText::_('DATE_FORMAT_LC2'))); ?>
		</span>
		<?php endif; ?>
</div>
<?php } ?>