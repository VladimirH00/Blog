<?php

class m210307_180701_alter_tbl_author_unique_login extends CDbMigration
{
	public function up()
	{
	    $this->alterColumn('tbl_author', 'login', 'varchar(50) NOT NULL unique');
	}

	public function down()
	{
		$this->alterColumn('tbl_author','login', 'varchar(50) NOT NULL');
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