<?php

class m210307_172400_add_category_data extends CDbMigration
{
	public function up()
	{
	    $this->insert('tbl_category', array('category'=>'Программирование'));
        $this->insert('tbl_category', array('category'=>'Искусство'));
        $this->insert('tbl_category', array('category'=>'Новости'));
        $this->insert('tbl_category', array('category'=>'Наука'));
	}

	public function down()
	{
		$this->delete('tbl_category', 'category in ("Программирование", "Искусство", "Новости", "Наука")');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}