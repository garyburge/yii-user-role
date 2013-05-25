<?php
  $this->breadcrumbs = array(
    UserModule::t('Users')=>array('admin'),
    $model->username,
  );

  $this->menu = array(
    array('label'=>UserModule::t('Create User'), 'url'=>array('create')),
    array('label'=>UserModule::t('Update User'), 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>UserModule::t('Delete User'), 'url'=>array('delete', 'id'=>$model->id), 'htmlOptions'=>array('confirm'=>UserModule::t('Are you sure to delete this item?'))),
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
    array('label'=>UserModule::t('Manage Profile Fields'), 'url'=>array('profileField/admin')),
    array('label'=>UserModule::t('List Users'), 'url'=>array('/user/user/index')),
  );
?>

<h1><?php echo UserModule::t('View User') . ' "' . $model->username . '"'; ?></h1>

<?php
  $attributes = array(
    'id',
    array(
      'name'=>'status',
      'value'=>User::itemAlias("UserStatus", $model->status),
    ),
    array(
      'name'=>'superuser',
      'value'=>User::itemAlias("AdminStatus", $model->status),
    ),
    'username',
    'email',
  );

  $profileFields = ProfileField::model()->forOwner()->sort()->findAll();
  if ($profileFields) {
    foreach ($profileFields as $field) {
      array_push($attributes, array(
        'label'=>UserModule::t($field->title),
        'name'=>$field->varname,
        'type'=>'raw',
        'value'=>(($field->widgetView($model->profile)) ? $field->widgetView($model->profile) : (($field->range) ? Profile::range($field->range, $model->profile->getAttribute($field->varname)) : $model->profile->getAttribute($field->varname))),
      ));
    }
  }

  array_push($attributes, array(
    'name'=>'create_at',
    'type'=>'date',
  ));
  array_push($attributes, array(
    'name'=>'lastvisit_at',
    'type'=>'datetime',
  ));

  $this->widget('bootstrap.widgets.TbDetailView', array(
    'type'=>'condensed striped',
    'data'=>$model,
    'attributes'=>$attributes,
  ));
?>

<?php
  $this->widget('bootstrap.widgets.TbButtonGroup', array(
    'buttons'=>$this->menu,
  ));
?>
