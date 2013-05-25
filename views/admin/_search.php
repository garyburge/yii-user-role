<div class="wide form">

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
  'action'=>Yii::app()->createUrl($this->route),
  'method'=>'get',
  'focus'=>array($model, 'id'),
)); ?>

  <?php echo $form->textFieldRow($model, 'id'); ?>
  <?php //echo $form->label($model,'id'); ?>
  <?php //echo $form->textField($model,'id'); ?>

  <?php echo $form->textFieldRow($model, 'username', array('maxlength'=>20)); ?>
  <?php //echo $form->label($model,'username'); ?>
  <?php //echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>

  <?php echo $form->textFieldRow($model, 'email', array('class'=>'span4', 'maxlength'=>128)); ?>
  <?php //echo $form->label($model,'email'); ?>
  <?php //echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>

  <?php echo $form->textFieldRow($model, 'activkey', array('class'=>'span5', 'maxlength'=>128)); ?>
  <?php //echo $form->label($model,'activkey'); ?>
  <?php //echo $form->textField($model,'activkey',array('size'=>60,'maxlength'=>128)); ?>

  <?php echo $form->textFieldRow($model, 'create_at'); ?>
  <?php //echo $form->label($model,'create_at'); ?>
  <?php //echo $form->textField($model,'create_at'); ?>

  <?php echo $form->textFieldRow($model, 'lastvisit_at'); ?>
  <?php //echo $form->label($model,'lastvisit_at'); ?>
  <?php //echo $form->textField($model,'lastvisit_at'); ?>

  <?php echo $form->dropDownListRow($model, 'superuser', $model->itemAlias('AdminStatus')); ?>
  <?php //echo $form->label($model,'superuser'); ?>
  <?php //echo $form->dropDownList($model,'superuser',$model->itemAlias('AdminStatus')); ?>

  <?php echo $form->dropDownListRow($model, 'status', $model->itemAlias('UserStatus')); ?>
  <?php //echo $form->label($model,'status'); ?>
  <?php //echo $form->dropDownList($model,'status',$model->itemAlias('UserStatus')); ?>

  <div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>UserModule::t('Search'))); ?>
    <?php //echo CHtml::submitButton(UserModule::t('Search')); ?>
  </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->