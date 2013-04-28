<?php
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @version		v2.0
 * @author		Joomlabamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * The Zen Grid Framework is a templating framework that uses the Joomla Content Manament System (http://www.joomla.org)
 * This file is called if the top layout override is enabled and is placed in the templates/[your template name]/layout folder. 
 */
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
?>
<div id="contentwrap" <?php if(!$this->countModules('background')) : ?>class="nobg"<?php endif;?>>
	<div class="container <?php echo $containerPosition ?> topborder">
		<div class="contentrow">
			<div class="inner">
<?php if($this->countModules('tab1') || $this->countModules('tab2')  || $this->countModules('tab3')  || $this->countModules('tab4')) : ?>
										<!-- Tab Row wrapper -->
										<div id="tabwrap">
											<div class="container <?php echo $containerPosition ?>">
												<div class="row">
													<div class="inner">
															<div id="jbtabbedArea">
																<ul class="jbtabs">
																	<?php if($debug) { echo $tabtitledebug; } ?>
														    		<?php if($this->countModules('tab1')) : ?>
															        	<li class="jbtab1" >
																			<a href="#jbtab1">
																				<?php if($this->params->get("tab1image") !=="-1") { ?>
																					<span class="grid_three">
																						<img src="templates/<?php echo $this->template ?>/images/icons/<?php echo $this->params->get("tab1image"); ?>" alt="<?php echo $this->params->get("tab1alt"); ?>" title="<?php echo $this->params->get("tab1alt"); ?>">
																					</span>
																				<?php } ?>
																				<span class="<?php if($this->params->get("tab1image") !=="-1") { ?>grid_nine  zenlast<?php } else { ?>grid_twelve<?php } ?>">
																				<?php if(($zenTranslate)) {
																							echo $tab1Title;
																						} 
																						else {
																							echo JText::_("Tab1");
																				} ?>
																				</span>
																				</a>
																				
																		</li>
															        <?php endif; ?>

															        <?php if($this->countModules('tab2')) : ?>
															        	<li class="jbtab2" >
																				<a href="#jbtab2">
																					<?php if($this->params->get("tab2image") !=="-1") { ?>
																						<span class="grid_three">
																							<img src="templates/<?php echo $this->template ?>/images/icons/<?php echo $this->params->get("tab2image"); ?>" alt="<?php echo $this->params->get("tab2alt"); ?>" title="<?php echo $this->params->get("tab2alt"); ?>">
																						</span>
																					<?php } ?>
																					<span class="<?php if($this->params->get("tab2image") !=="-1") { ?>grid_nine  zenlast<?php } else { ?>grid_twelve<?php } ?>">
																						<?php if(($zenTranslate)) {
																									echo $tab2Title;
																								} 
																								else {
																									echo JText::_("Tab2");
																						} ?>
</span>
															        			</a></li>
															        <?php endif; ?>

															        <?php if($this->countModules('tab3')) : ?>
															        	<li class="jbtab3" >
																				<a href="#jbtab3">
																					<?php if($this->params->get("tab3image") !=="-1") { ?>
																						<span class="grid_three">
																							<img src="templates/<?php echo $this->template ?>/images/icons/<?php echo $this->params->get("tab3image"); ?>" alt="<?php echo $this->params->get("tab3alt"); ?>" title="<?php echo $this->params->get("tab3alt"); ?>">
																						</span>
																					<?php } ?>
																					<span class="<?php if($this->params->get("tab3image") !=="-1") { ?>grid_nine  zenlast<?php } else { ?>grid_twelve<?php } ?>">
																						<?php if(($zenTranslate)) {
																									echo $tab3Title;
																								} 
																								else {
																									echo JText::_("Tab3");
																						} ?>
																						</span>
																				</a>
																		</li>
															        <?php endif; ?>

															        <?php if($this->countModules('tab4')) : ?>
															       	 <li class="jbtab4" >
																			<a href="#jbtab4">
																				<?php if($this->params->get("tab4image") !=="-1") { ?>
																					<span class="grid_three">
																						<img src="templates/<?php echo $this->template ?>/images/icons/<?php echo $this->params->get("tab4image"); ?>" alt="<?php echo $this->params->get("tab4alt"); ?>" title="<?php echo $this->params->get("tab4alt"); ?>">
																					</span>
																				<?php } ?>
																				<span class="<?php if($this->params->get("tab4image") !=="-1") { ?>grid_nine  zenlast<?php } else { ?>grid_twelve<?php } ?>">
																					<?php if(($zenTranslate)) {
																								echo $tab4Title;
																							} 
																							else {
																								echo JText::_("Tab4");
																					} ?>
																					</span>
																			</a>
																		</li>
															        <?php endif; ?>
															    </ul>
															    <div class="jbtab_container">

															    	<?php if($this->countModules('tab1')) : ?>
															        	<div id="jbtab1" class="jbtab_content grid_<?php echo $tab1Count; ?>">
															           		<div class="jbtab1">
																				<?php if($debug) { echo $tab1debug; } ?>
																					<jdoc:include type="modules" name="tab1" style="jbChrome" />
																			</div>
																		</div>
																	<?php endif; ?>


																	<?php if($this->countModules('tab2')) : ?>
															        	<div id="jbtab2" class="jbtab_content grid_<?php echo $tab2Count; ?> <?php echo $tab2class ?>">
															           		<div class="jbtab2">
																					<?php if($debug) { echo $tab2debug; } ?>
																					<jdoc:include type="modules" name="tab2" style="jbChrome" />
																			</div>
																		</div>
																	<?php endif; ?>

																	<?php if($this->countModules('tab3')) : ?>
															        	<div id="jbtab3" class="jbtab_content grid_<?php echo $tab3Count; ?> <?php echo $tab3class ?>">
															           		<div class="jbtab3">
																					<?php if($debug) { echo $tab3debug; } ?>
																					<jdoc:include type="modules" name="tab3" style="jbChrome" />
																			</div>
																		</div>
																	<?php endif; ?>

																	<?php if($this->countModules('tab4')) : ?>
															        	<div id="jbtab4" class="jbtab_content grid_<?php echo $tab4Count; ?> zenlast">
															           		<div class="jbtab4">
																					<?php if($debug) { echo $tab4debug; } ?>
																					<jdoc:include type="modules" name="tab4" style="jbChrome" />
																			</div>
																		</div>
																	<?php endif; ?>

															       </div>
															</div>			

														<div class="clear"></div>

													</div>
												</div>
											</div>
										</div>
										<!-- Tabs wrapper -->
<?php endif; ?>