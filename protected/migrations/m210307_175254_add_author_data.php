<?php

class m210307_175254_add_author_data extends CDbMigration
{
	public function up()
	{
        $this->insert('tbl_author', array(
            'surname'       =>  'Петров',
            'name'          =>  'Петр',
            'login'         =>  'userOne',
            'password'      =>  md5('12345'),
            'datecreate'    =>  date('Y-m-d H:i:s'),
            'dateupdate'    =>  date('Y-m-d H:i:s'),
        ));
        $this->insert('tbl_author', array(
            'surname'       =>  'Сидоров',
            'name'          =>  'Марк',
            'login'         =>  'userTwo',
            'password'      =>  md5('12345'),
            'datecreate'    =>  date('Y-m-d H:i:s'),
            'dateupdate'    =>  date('Y-m-d H:i:s'),
        ));
        $this->insert('tbl_author', array(
            'surname'       =>  'Иванов',
            'name'          =>  'Иван',
            'login'         =>  'userThree',
            'password'      =>  md5('12345'),
            'datecreate'    =>  date('Y-m-d H:i:s'),
            'dateupdate'    =>  date('Y-m-d H:i:s'),
        ));
        $this->insert('tbl_author', array(
            'surname'       =>  'Русский',
            'name'          =>  'Петр',
            'patronymic'    =>  'Петрович',
            'login'         =>  'userFour',
            'password'      =>  md5('12345'),
            'datecreate'    =>  date('Y-m-d H:i:s'),
            'dateupdate'    =>  date('Y-m-d H:i:s'),
        ));
        $this->insert('tbl_author', array(
            'surname'       =>  'Волков',
            'name'          =>  'Александр',
            'patronymic'    =>  'Артемович',
            'login'         =>  'userFive',
            'password'      =>  md5('12345'),
            'datecreate'    =>  date('Y-m-d H:i:s'),
            'dateupdate'    =>  date('Y-m-d H:i:s'),
        ));
	}

	public function down()
	{
        $this->delete('tbl_author', 'login in ("userOne", "userTwo", "userThree", "userFour", "userFive")');
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