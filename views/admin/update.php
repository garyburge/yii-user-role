<?php
  $this->breadcrumbs = array(
    (UserModule::t('Users')) => array('admin'),
    (UserModule::t('Update')),
  );
?>

<h1><?php echo UserModule::t('Update User') . " " . $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model, 'profile' => $profile)); ?>