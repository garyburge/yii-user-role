<?php

class m130526_162344_add_roles extends CDbMigration
{

  protected $MySqlOptions = 'ENGINE=InnoDB CHARSET=utf8';
  private $_model;

	public function safeUp()
	{
    if (!Yii::app()->getModule('user')) {
      echo "\n\nAdd to console.php :\n"
      . "'modules'=>array(\n"
      . "...\n"
      . "    'user'=>array(\n"
      . "        ... # copy settings from main config\n"
      . "    ),\n"
      . "...\n"
      . "),\n"
      . "\n";
      return false;
    }
    Yii::import('user.models.User');

    // create auth tables
    switch ($this->dbType()) {
      case "mysql":
        // auth_item
        $this->createTable(Yii::app()->getModule('user')->tableAuthItem, array(
          "name"=>"varchar(64) NOT NULL",
          "type"=>"integer NOT NULL",
          "description"=>"text",
          "bizrule"=>"text",
          "data"=>"text",
          ), $this->MySqlOptions);
        $this->createIndex('name', Yii::app()->getModule('user')->tableAuthItem, 'name', true);

        // auth_item_child
        $this->createTable(Yii::app()->getModule('user')->tableAuthItemChild, array(
          'parent'=>'varchar(64) NOT NULL',
          'child'=>'varchar(64) NOT NULL',
          ), $this->MySqlOptions);
        $this->createIndex('parent_child', Yii::app()->getModule('user')->tableAuthItemChild, 'parent,child', true);
        $this->addForeignKey('parent', Yii::app()->getModule('user')->tableAuthItemChild, 'parent', Yii::app()->getModule('user')->tableAuthItem, 'name', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('child', Yii::app()->getModule('user')->tableAuthItemChild, 'child', Yii::app()->getModule('user')->tableAuthItem, 'name', 'CASCADE', 'RESTRICT');

        // auth_assignment
        $this->createTable(Yii::app()->getModule('user')->tableAuthAssignment, array(
          "itemname"=>"varchar(64) NOT NULL",
          "user_id"=>"integer(11) NOT NULL", //"varchar(64) NOT NULL",
          "bizrule"=>"text",
          "data"=>"text",
          ), $this->MySqlOptions);
        $this->createIndex('itemname', Yii::app()->getModule('user')->tableAuthAssignment, 'itemname', true);
        $this->createIndex('user_id', Yii::app()->getModule('user')->tableAuthAssignment, 'user_id', true);
        $this->addForeignKey('itemname', Yii::app()->getModule('user')->tableAuthAssignment, 'itemname', Yii::app()->getModule('user')->tableAuthItem, 'name', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('user_id', Yii::app()->getModule('user')->tableAuthAssignment, 'user_id', Yii::app()->getModule('user')->tableUsers, 'id', 'NO ACTION', 'NO ACTION');

        // relate user to auth_assignment
        //$this->addForeignKey('id', Yii::app()->getModule('user')->tableUsers, 'id', Yii::app()->getModule('user')->tableAuthAssignment, 'user_id', 'NO ACTION', 'NO ACTION');

        break;

      case "sqlite":
      default:
        // auth_item
        $this->createTable(Yii::app()->getModule('user')->tableAuthItem, array(
          "name"=>"varchar(64) NOT NULL",
          "type"=>"integer NOT NULL",
          "description"=>"text",
          "bizrule"=>"text",
          "data"=>"text",
          ), $this->MySqlOptions);
        $this->createIndex('name', Yii::app()->getModule('user')->tableAuthItem, 'name', true);

        // auth_item_child
        $this->createTable(Yii::app()->getModule('user')->tableAuthItemChild, array(
          'parent'=>'varchar(64) NOT NULL',
          'child'=>'varchar(64) NOT NULL',
          ), $this->MySqlOptions);
        $this->createIndex('parent_child', Yii::app()->getModule('user')->tableAuthItemChild, 'parent,child', true);

        // auth_assignment
        $this->createTable(Yii::app()->getModule('user')->tableAuthAssignment, array(
          "itemname"=>"varchar(64) NOT NULL",
          "user_id"=>"varchar(64) NOT NULL",
          "bizrule"=>"text",
          "data"=>"text",
          ), $this->MySqlOptions);

        break;
    }

  }

	public function safeDown()
	{
    $this->dropTable(Yii::app()->getModule('user')->tableAuthItem);
    $this->dropTable(Yii::app()->getModule('user')->tableAuthItemChild);
    $this->dropTable(Yii::app()->getModule('user')->tableAuthAssignment);
	}


  public function dbType()
  {
    list($type) = explode(':', Yii::app()->db->connectionString);
    echo "type db: " . $type . "\n";
    return $type;
  }

}