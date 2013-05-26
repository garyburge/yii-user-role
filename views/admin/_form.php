<?php
  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'user-form',
    'focus'=>array($model, 'username'),
    'enableAjaxValidation'=>true,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),
  ));
?>

	<p class="muted"><small><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></small></p>
	<?php echo $form->errorSummary(array($model, $profile)); ?>

  <?php echo $form->textFieldRow($model, 'username'); ?>
  <?php //echo $form->labelEx($model,'username'); ?>
  <?php //echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
  <?php //echo $form->error($model,'username'); ?>

  <?php echo $form->passwordFieldRow($model, 'password'); ?>
  <?php //echo $form->labelEx($model,'password'); ?>
  <?php //echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
  <?php //echo $form->error($model,'password'); ?>

  <?php echo $form->textFieldRow($model, 'email', array('class'=>'span5', 'maxlength'=>128)); ?>
  <?php //echo $form->labelEx($model,'email'); ?>
  <?php //echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
  <?php //echo $form->error($model,'email'); ?>

  <?php
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
        echo $form->labelEx($profile,$field->varname);
        if ($widgetEdit = $field->widgetEdit($profile)) {
          echo $widgetEdit;
        } elseif ($field->range) {
          echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
        } elseif ($field->field_type=="TEXT") {
          echo CHtml::activeTextArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
        } else {
          echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
        }
        echo $form->error($profile,$field->varname);
			}
		}
  ?>

  <?php echo $form->dropDownListRow($model, 'status', User::itemAlias('UserStatus')); ?>
  <?php //echo $form->labelEx($model,'status'); ?>
  <?php //echo $form->dropDownList($model,'status',User::itemAlias('UserStatus')); ?>
  <?php //echo $form->error($model,'status'); ?>

  <?php echo $form->dropDownListRow($model, 'superuser', User::itemAlias('AdminStatus')); ?>
  <?php //echo $form->labelEx($model,'superuser'); ?>
  <?php //echo $form->dropDownList($model,'superuser',User::itemAlias('AdminStatus')); ?>
  <?php //echo $form->error($model,'superuser'); ?>

  <div class="control-group buttons">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>UserModule::t("Save"))); ?>
	</div>

<?php $this->endWidget(); ?>
