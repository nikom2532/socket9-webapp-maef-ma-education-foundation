<?php // @version $Id: default_form.php 11917 2009-05-29 19:37:05Z ian $
defined('_JEXEC') or die('Restricted access');
if (substr(JVERSION, 0, 3) >= '1.6') {
	JHtml::_('behavior.keepalive');
	JHtml::_('behavior.formvalidation');
	JHtml::_('behavior.tooltip');
	 if (isset($this->error)) : ?>
		<div class="contact-error">
			<?php echo $this->error; ?>
		</div>
	<?php endif; ?>

	<div class="contact-form">
		<form id="contact-form" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate">
			<fieldset>
				<legend><?php echo JText::_('COM_CONTACT_FORM_LABEL'); ?></legend>
				<dl>
					<dt><?php echo $this->form->getLabel('contact_name'); ?></dt>
					<dd><?php echo $this->form->getInput('contact_name'); ?></dd>
					<dt><?php echo $this->form->getLabel('contact_email'); ?></dt>
					<dd><?php echo $this->form->getInput('contact_email'); ?></dd>
					<dt><?php echo $this->form->getLabel('contact_subject'); ?></dt>
					<dd><?php echo $this->form->getInput('contact_subject'); ?></dd>
					<dt><?php echo $this->form->getLabel('contact_message'); ?></dt>
					<dd><?php echo $this->form->getInput('contact_message'); ?></dd>
					<?php 	if ($this->params->get('show_email_copy')){ ?>
							<dt> <?php echo $this->form->getInput('contact_email_copy'); ?> <?php echo $this->form->getLabel('contact_email_copy'); ?></dt>
							<!-- <dd></dd> -->
					<?php 	} ?>
				<?php //Dynamically load any additional fields from plugins. ?>
				     <?php foreach ($this->form->getFieldsets() as $fieldset): ?>
				          <?php if ($fieldset->name != 'contact'):?>
				               <?php $fields = $this->form->getFieldset($fieldset->name);?>
				               <?php foreach($fields as $field): ?>
				                    <?php if ($field->hidden): ?>
				                         <?php echo $field->input;?>
				                    <?php else:?>
				                         <dt>
				                            <?php echo $field->label; ?>
				                            <?php if (!$field->required && $field->type != "Spacer"): ?>
				                               <span class="optional"><?php echo JText::_('COM_CONTACT_OPTIONAL');?></span>
				                            <?php endif; ?>
				                         </dt>
				                         <dd><?php echo $field->input;?></dd>
				                    <?php endif;?>
				               <?php endforeach;?>
				          <?php endif ?>
				     <?php endforeach;?>
					<dt></dt>
					<dd><button class="button validate zenbutton" type="submit"><span><?php echo JText::_('COM_CONTACT_CONTACT_SEND'); ?></span></button>
						<input type="hidden" name="option" value="com_contact" />
						<input type="hidden" name="task" value="contact.submit" />
						<input type="hidden" name="return" value="<?php echo $this->return_page;?>" />
						<input type="hidden" name="id" value="<?php echo $this->contact->slug; ?>" />
						<?php echo JHtml::_( 'form.token' ); ?>
					</dd>
				</dl>
			</fieldset>
		</form>
	</div>
	
<?php }
else {
?>

<script type="text/javascript">
	function validateForm( frm ) {
		var valid = document.formvalidator.isValid(frm);
		if (valid == false) {
			// do field validation
			if (frm.email.invalid) {
				alert( "<?php echo JText::_( 'Please enter a valid e-mail address.', true );?>" );
			} else if (frm.text.invalid) {
				alert( "<?php echo JText::_( 'CONTACT_FORM_NC', true ); ?>" );
			}
			return false;
		} else {
			frm.submit();
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php'); ?>" class="form-validate" method="post" name="emailForm" id="emailForm">
	<div class="contact_email<?php echo $this->escape($this->params->get( 'pageclass_sfx' )); ?>">
		<label for="contact_name">
		<?php echo JText::_( 'Enter your name' ); ?>:</label>
		<input type="text" name="name" id="contact_name" size="30" class="inputbox" value="" />
	</div>
	<div class="contact_email<?php echo  $this->escape($this->params->get( 'pageclass_sfx' )); ?>"><label id="contact_emailmsg" for="contact_email">
		<?php echo JText::_( 'Email address' ); ?>*:</label>
		<input type="text" id="contact_email" name="email" size="30" value="" class="inputbox required validate-email" maxlength="100" />
	</div>
	<div class="contact_email<?php echo  $this->escape($this->params->get( 'pageclass_sfx' )); ?>"><label for="contact_subject">
		<?php echo JText::_( 'Message subject' ); ?>:</label>
		<input type="text" name="subject" id="contact_subject" size="30" class="inputbox" value="" />
	</div>
		<div class="contact_email<?php echo $this->escape($this->params->get( 'pageclass_sfx' )); ?>"><label id="contact_textmsg" for="contact_text" class="textarea">
		<?php echo JText::_( 'Enter your message' ); ?>*:</label>
		<textarea name="text" id="contact_text" class="inputbox required" rows="10" cols="40"></textarea>
	</div>
	<?php if ($this->contact->params->get( 'show_email_copy' )): ?>
	<div class="contact_email_checkbox<?php echo $this->escape($this->params->get( 'pageclass_sfx' )); ?>">
	<input type="checkbox" name="email_copy" id="contact_email_copy" value="1"  />
	<label for="contact_email_copy" class="copy">
	<?php echo JText::_( 'EMAIL_A_COPY' ); ?>
	</label>
	</div>
	<?php endif; ?>
	<button class="button validate zenbutton" type="submit"><span><?php echo JText::_('Send'); ?></span></button>
	<input type="hidden" name="view" value="contact" />
	<input type="hidden" name="id" value="<?php echo (int)$this->contact->id; ?>" />
	<input type="hidden" name="task" value="submit" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
<?php } ?>