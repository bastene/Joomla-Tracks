<?php
/**
* @version    $Id: form.php 96 2008-05-02 10:35:43Z julienv $ 
* @package    JoomlaTracks
* @copyright	Copyright (C) 2008 Julien Vonthron. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla Tracks is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

defined('_JEXEC') or die('Restricted access'); ?>

<?php JHTML::_('behavior.tooltip'); ?>

<?php
	// Set toolbar items for the page
	JToolBarHelper::title( JText::_('COM_TRACKS_PROJECT_SETTINGS' ) );
	JToolBarHelper::save();
	JToolBarHelper::apply();
	// for existing items the button is renamed `close`
	JToolBarHelper::cancel();
	JToolBarHelper::help( 'screen.tracks.projectsettings', true );
?>
<div id="tracksmain">

<?php JHTMLBehavior::formvalidation(); ?>
<script language="javascript" type="text/javascript">
	Joomla.submitbutton = function (pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			Joomla.submitform( pressbutton );
			return;
		}

		// do field validation
		if (document.formvalidator.isValid(form)) {
      Joomla.submitform( pressbutton );
      return true; 
    }
    else {
      alert('Some values are not acceptable.  Please retry.');
    }
    return false;
	}
</script>

<form action="index.php" method="post" name="adminForm" id="adminForm">

			<?php
	    // Iterate through the normal form fieldsets and display each one.
	    foreach ($this->projectparams->getFieldsets() as $fieldsets => $fieldset):
	    ?>
	    <fieldset class="adminform">
	        <legend>
	            <?php echo JText::_($fieldset->name.'_jform_fieldset_label'); ?>
	        </legend>
	        <dl>
			<?php
			// Iterate through the fields and display them.
			foreach($this->projectparams->getFieldset($fieldset->name) as $field):
			    // If the field is hidden, only use the input.
			    if ($field->hidden):
			        echo $field->input;
			    else:
			    ?>
			    <dt>
			        <?php echo $field->label; ?>
			    </dt>
			    <dd<?php echo ($field->type == 'Editor' || $field->type == 'Textarea') ? ' style="clear: both; margin: 0;"' : ''?>>
			        <?php echo $field->input ?>
			    </dd>
			    <?php
			    endif;
			endforeach;
			?>
			</dl>
	    </fieldset>
	    <?php
	    endforeach;
	    ?>
	
	<?php echo JHTML::_( 'form.token' ); ?>
	<input type="hidden" name="option" value="com_tracks" />
	<input type="hidden" name="controller" value="projectsetting" />
  <input type="hidden" name="cid[]" value="<?php echo $this->object->id; ?>" />
	<input type="hidden" name="project_id" value="<?php echo $this->object->project_id; ?>" />
  <input type="hidden" name="xml" value="<?php echo $this->object->xml; ?>" />
	<input type="hidden" name="task" value="" />
</form>
</div>