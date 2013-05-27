<?php

class RoleSelectForm extends CFormModel
{
  /**
   *
   * @var array selected roles for a user
   */
  public $selected = array();

  /**
   *
   * @var integer id of user for which roles are selected
   */
  public $user_id = 0;

  /**
   * @return void
   */
  public function __construct($user_id=0)
  {
    $this->user_id = $user_id;
  }

  /**
   * @return array list of validation rules
   */
  public function rules()
  {
    return array(
      //array('selected', 'required', 'on'=>'insert,update'),
      array('selected', 'safe'),
    );
  }

  /**
   * @return array list of value=>text pairs for all defined roles
   */
  /**
   * @return array all defined roles in form array('value'=>name, 'text'=>name)
   */
  public function getAllRoles()
  {
    $roles = array();

    // format sql
    $sql = "SELECT name FROM ".Yii::app()->getModule('user')->tableAuthItem." WHERE type = ".CAuthItem::TYPE_ROLE." ORDER BY name ASC";
    // execute it
    $rows = Yii::app()->db->createCommand($sql)->queryAll();

    // create value, text array for dropdown
    foreach($rows as $row) {
      $roles[] = array('value'=>$row['name'], 'text'=>$row['name']);
    }

    return $roles;
  }

  /**
   * @return array list of assigned roles
   */
  public function getAssigned()
  {
    // create empty array
    $this->selected = array();

    // if valid user
    if ($this->user_id > 0) {
      // format sql
      $sql = "SELECT itemname FROM ".Yii::app()->getModule('user')->tableAuthAssignment." WHERE user_id = :user_id ORDER BY itemname ";
      // execute it
      $rows = Yii::app()->db->createCommand($sql)->queryAll(true, array(':user_id'=>$this->user_id));
      // unwrap into array
      foreach($rows as $row) {
        $this->selected[] = $row['itemname'];
      }
    }

    return $this->selected;
  }

  /**
   * @return void
   *
   * remove all auth assignments for user
   */
  public function unassignAll()
  {
    if ($this->user_id > 0) {
      // format sql
      $sql = "DELETE FROM ".Yii::app()->getModule('user')->tableAuthAssignment." WHERE user_id = :user_id ";
      // execute it
      Yii::app()->db->createCommand($sql)->execute(array(':user_id'=>$this->user_id));
    }
  }

  /**
   * @return void
   *
   * assign user to one or more auth items
   */
  public function assignUser()
  {
    Yii::trace(__METHOD__." (".__LINE__."): this->selected=".print_r($this->selected, true), 'user');

    if (is_array($this->selected) && count($this->selected)) {
      Yii::trace(__METHOD__." (".__LINE__."): begin transaction...", 'user');
      // start a transaction
      $transaction = Yii::app()->db->beginTransaction();
      // attempt it
      try {
        // unassign all existing roles
        $this->unassignAll();
        // format sql
        $sql = "INSERT INTO ".Yii::app()->getModule('user')->tableAuthAssignment." SET itemname = :itemname, user_id = :user_id ";
        // prepare a command
        $cmd = Yii::app()->db->createCommand($sql);
        // for each selected role
        foreach($this->selected as $role) {
          // insert a row
          $cmd->execute(array(':itemname'=>$role, ':user_id'=>$this->user_id));
          Yii::trace(__METHOD__." (".__LINE__."): inserting role='".print_r($role, true)."' for user_id='".$this->user_id."'", 'user');
        }
        // commit the change
        $transaction->commit();
        Yii::trace(__METHOD__." (".__LINE__."): end transaction...", 'user');
      } catch (Exception $e) {
        $transaction->rollback();
        Yii::trace(__METHOD__." (".__LINE__."): rollback transaction...", 'user');
        throw $e;
      }
    }
  }

}
