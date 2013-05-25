<?php
  $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'profile-field-form',
    'focus'=>array($model, ($model->isNewRecord ? 'varname' : 'title')),
  ));
?>

	<p class="muted"><small><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></small></p>
	<?php echo $form->errorSummary($model); ?>

  <?php echo $form->textFieldRow($model, 'varname', ($model->isNewRecord ? array('maxlength'=>50) : array('maxlength'=>50, 'readonly'=>true, 'disabled'=>true, 'class'=>'uneditable-input'))); ?>
  <?php //echo CHtml::activeLabelEx($model,'varname'); ?>
  <?php //echo (($model->id)?CHtml::activeTextField($model,'varname',array('size'=>60,'maxlength'=>50,'readonly'=>true)):CHtml::activeTextField($model,'varname',array('size'=>60,'maxlength'=>50))); ?>
  <?php //echo CHtml::error($model,'varname'); ?>
	<p class="help-block"><?php echo UserModule::t("Allowed lowercase letters and digits."); ?></p>

  <?php echo $form->textFieldRow($model, 'title'); ?>
  <?php //echo CHtml::activeLabelEx($model,'title'); ?>
  <?php //echo CHtml::activeTextField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
  <?php //echo CHtml::error($model,'title'); ?>
  <p class="help-block"><?php echo UserModule::t('Field name on the language of "sourceLanguage".'); ?></p>

  <?php echo $model->isNewRecord ?
    $form->dropDownListRow($model, 'field_type', ProfileField::itemAlias('field_type'), array('maxlength'=>50, 'id'=>'field_type')) :
    $form->textFieldRow($model, 'field_type', array('maxlength'=>50, 'id'=>'field_type', 'readonly'=>true, 'disabled'=>true, 'class'=>'uneditable-input'));
  ?>
  <?php //echo CHtml::activeLabelEx($model,'field_type'); ?>
  <?php //echo (($model->id)?CHtml::activeTextField($model,'field_type',array('size'=>60,'maxlength'=>50,'readonly'=>true, 'disabled'=>true,'id'=>'field_type')):CHtml::activeDropDownList($model,'field_type',ProfileField::itemAlias('field_type'),array('id'=>'field_type'))); ?>
  <?php //echo CHtml::error($model,'field_type'); ?>
  <p class="help-block"><?php echo UserModule::t('Field type column in the database.'); ?></p>

  <?php echo $form->textFieldRow($model, 'field_size', ($model->isNewRecord ? array('class'=>'span2') : array('class'=>'span2', 'readonly'=>true, 'disabled'=>true))); ?>
  <?php //echo CHtml::activeLabelEx($model,'field_size'); ?>
  <?php //echo (($model->id)?CHtml::activeTextField($model,'field_size',array('readonly'=>true)):CHtml::activeTextField($model,'field_size')); ?>
  <?php //echo CHtml::error($model,'field_size'); ?>
  <p class="help-block"><?php echo UserModule::t('Field size column in the database.'); ?></p>

  <?php echo $form->textFieldRow($model, 'field_size_min', array('class'=>'span2')); ?>
  <?php //echo CHtml::activeLabelEx($model,'field_size_min'); ?>
  <?php //echo CHtml::activeTextField($model,'field_size_min'); ?>
  <?php //echo CHtml::error($model,'field_size_min'); ?>
  <p class="help-block"><?php echo UserModule::t('The minimum value of the field (form validator).'); ?></p>

  <?php echo $form->dropDownListRow($model, 'required', ProfileField::itemAlias('required')); ?>
  <?php //echo CHtml::activeLabelEx($model,'required'); ?>
  <?php //echo CHtml::activeDropDownList($model,'required',ProfileField::itemAlias('required')); ?>
  <?php //echo CHtml::error($model,'required'); ?>
  <p class="help-block"><?php echo UserModule::t('Required field (form validator).'); ?></p>

  <?php echo $form->textFieldRow($model, 'match', array('class'=>'span4', 'maxlength'=>255)); ?>
  <?php //echo CHtml::activeLabelEx($model,'match'); ?>
  <?php //echo CHtml::activeTextField($model,'match',array('size'=>60,'maxlength'=>255)); ?>
  <?php //echo CHtml::error($model,'match'); ?>
  <p class="help-block"><?php echo UserModule::t("Regular expression (example: '/^[A-Za-z0-9\s,]+$/u')."); ?></p>

  <?php echo $form->textFieldRow($model, 'range', array('class'=>'span6', 'maxlength'=>5000)); ?>
  <?php //echo CHtml::activeLabelEx($model,'range'); ?>
  <?php //echo CHtml::activeTextField($model,'range',array('size'=>60,'maxlength'=>5000)); ?>
  <?php //echo CHtml::error($model,'range'); ?>
  <p class="help-block"><?php echo UserModule::t('Predefined values (example: 1;2;3;4;5 or 1==One;2==Two;3==Three;4==Four;5==Five).'); ?></p>

  <?php echo $form->textFieldRow($model, 'error_message', array('class'=>'span6', 'maxlength'=>255)); ?>
  <?php //echo CHtml::activeLabelEx($model,'error_message'); ?>
  <?php //echo CHtml::activeTextField($model,'error_message',array('size'=>60,'maxlength'=>255)); ?>
  <?php //echo CHtml::error($model,'error_message'); ?>
  <p class="help-block"><?php echo UserModule::t('Error message when you validate the form.'); ?></p>

  <?php echo $form->textFieldRow($model, 'other_validator', array('class'=>'span6', 'maxlength'=>255)); ?>
  <?php //echo CHtml::activeLabelEx($model,'other_validator'); ?>
  <?php //echo CHtml::activeTextField($model,'other_validator',array('size'=>60,'maxlength'=>255)); ?>
  <?php //echo CHtml::error($model,'other_validator'); ?>
  <p class="help-block"><?php echo UserModule::t('JSON string (example: {example}).',array('{example}'=>CJavaScript::jsonEncode(array('file'=>array('types'=>'jpg, gif, png'))))); ?></p>

  <?php echo $form->textFieldRow($model, 'default', ($model->isNewRecord ? array('class'=>'span5', 'maxlength'=>255) : array('class'=>'span5', 'maxlength'=>255, 'readonly'=>true, 'disabled'=>true))); ?>
  <?php //echo CHtml::activeLabelEx($model,'default'); ?>
  <?php //echo (($model->id)?CHtml::activeTextField($model,'default',array('size'=>60,'maxlength'=>255,'readonly'=>true)):CHtml::activeTextField($model,'default',array('size'=>60,'maxlength'=>255))); ?>
  <?php //echo CHtml::error($model,'default'); ?>
  <p class="help-block"><?php echo UserModule::t('The value of the default field (database).'); ?></p>

  <?php list($widgetsList) = ProfileFieldController::getWidgets($model->field_type); ?>
  <?php echo $form->dropDownListRow($model, 'widget', $widgetsList, array('id'=>'widgetlist')); ?>
  <?php //echo CHtml::activeLabelEx($model,'widget'); ?>
  <?php //echo CHtml::activeDropDownList($model,'widget',$widgetsList,array('id'=>'widgetlist')); //echo CHtml::activeTextField($model,'widget',array('size'=>60,'maxlength'=>255)); ?>
  <?php //echo CHtml::error($model,'widget'); ?>
  <p class="help-block"><?php echo UserModule::t('Widget name.'); ?></p>

  <?php echo $form->textFieldRow($model, 'widgetparams', array('class'=>'span6', 'maxlength'=>5000, 'id'=>'widgetparams')); ?>
  <?php //echo CHtml::activeLabelEx($model,'widgetparams'); ?>
  <?php //echo CHtml::activeTextField($model,'widgetparams',array('size'=>60,'maxlength'=>5000,'id'=>'widgetparams')); ?>
  <?php //echo CHtml::error($model,'widgetparams'); ?>
  <p class="help-block"><?php echo UserModule::t('JSON string (example: {example}).',array('{example}'=>CJavaScript::jsonEncode(array('param1'=>array('val1','val2'),'param2'=>array('k1'=>'v1','k2'=>'v2'))))); ?></p>

  <?php echo $form->textFieldRow($model, 'position', array('class'=>'span2')); ?>
  <?php //echo CHtml::activeLabelEx($model,'position'); ?>
  <?php //echo CHtml::activeTextField($model,'position'); ?>
  <?php //echo CHtml::error($model,'position'); ?>
  <p class="help-block"><?php echo UserModule::t('Display order of fields.'); ?></p>

  <?php echo $form->textFieldRow($model, 'visible', ProfileField::itemAlias('visible')); ?>
  <?php //echo CHtml::activeLabelEx($model,'visible'); ?>
  <?php //echo CHtml::activeDropDownList($model,'visible',ProfileField::itemAlias('visible')); ?>
  <?php //echo CHtml::error($model,'visible'); ?>

  <div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')))); ?>
		<?php //echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
  </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<div id="dialog-form" title="<?php echo UserModule::t('Widget parametrs'); ?>">
	<form>
	<fieldset>
		<label for="name">Name</label>
		<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" />
		<label for="value">Value</label>
		<input type="text" name="value" id="value" value="" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>
