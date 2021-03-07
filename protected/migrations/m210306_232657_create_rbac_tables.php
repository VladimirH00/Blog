<?php

class m210306_232657_create_rbac_tables extends CDbMigration
{
	public function up()
	{
	    echo 'Создание rbac таблиц\n';
	    $this->createTable('tbl_auth_item', array(
	            'name'=>'varchar(64) NOT NULL',
                'type'=>'integer NOT NULL',
                'description'=>'text',
                'bizrule'=>'text',
                'data'=>'text',
                'PRIMARY KEY (`name`)',
            ), 'ENGINE=InnoDB'
        );
	    $this->createTable('tbl_auth_item_child', array(
	            'parent'=>'varchar(64) NOT NULL',
                'child'=>'varchar(64) NOT NULL',
                'PRIMARY KEY (`parent`, `child`)',
            ), 'ENGINE=InnoDB'
        );
	    $this->addForeignKey('fk_auth_item_child_child', 'tbl_auth_item_child',
            'child', 'tbl_auth_item', 'name','CASCADE', 'CASCADE' );
	    $this->createTable('tbl_auth_assignment', array(
	            'itemname'=>'varchar(64) NOT NULL',
                'userid'=>'int(11) NOT NULL',
                'bizrule'=>'text',
                'data'=>'text',
                'PRIMARY KEY (`itemname`, `userid`)',
            ),'ENGINE=InnoDB'
        );
        $this->addForeignKey('fk_auth_assignment_itemname', 'tbl_auth_assignment',
            'itemname', 'tbl_auth_item', 'name', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_auth_assignment_userid', 'tbl_auth_assignment', 'userid',
            'tbl_author', 'id', 'CASCADE', 'CASCADE');
	}

	public function down()
	{
		echo "удаление rbac таблиц\n";
		$this->dropForeignKey('fk_auth_item_child_child','tbl_auth_item_child');
		$this->dropForeignKey('fk_auth_assignment_itemname', 'tbl_auth_assignment');
		$this->dropForeignKey('fk_auth_assignment_userid', 'tbl_auth_assignment');
		$this->truncateTable('tbl_auth_assignment');
		$this->truncateTable('tbl_auth_item_child');
		$this->truncateTable('tbl_auth_item');
        $this->dropTable('tbl_auth_assignment');
        $this->dropTable('tbl_auth_item_child');
        $this->dropTable('tbl_auth_item');

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