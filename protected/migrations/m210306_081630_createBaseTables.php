<?php

class m210306_081630_createBaseTables extends CDbMigration
{
	public function up()
	{
	    echo 'создание таблиц tbl_category, tbl_article, tbl_assignment_category_article, 
	    tbl_assignment_author_article, tbl_author';

	    $this->createTable('tbl_category', array(
	        'id'        =>  'pk',
            'category'  =>  'varchar(50) NOT NULL',
            ),'ENGINE=InnoDB'
        );
	    $this->createTable('tbl_article', array(
            'id'            =>  'pk',
            'author_id'     =>  'int(10) NOT NULL',
            'category_id'   =>  'int(10) NOT NULL',
            'name'          =>  'varchar(50) NOT NULL',
            'image'         =>  'varchar(250) NOT NULL',
            'anotation'     =>  'varchar(100) NOT NULL',
            'text'          =>  'text NOT NULL',
            ), 'ENGINE=InnoDB'
        );
	    $this->createTable('tbl_assignment_category_article', array(
	        'id'            =>  'pk',
            'article_id'    =>  'int(10) NOT NULL',
            'category_id'   =>  'int(10) NOT NULL',
            ),'ENGINE=InnoDB'
        );
	    $this->createTable('tbl_author', array(
	        'id'            =>  'pk',
            'surname'       =>  'varchar(50) NOT NULL',
            'name'          =>  'varchar(50) NOT NULL',
            'patronymic'    =>  'varchar(50)',
            'login'         =>  'varchar(50) NOT NULL',
            'password'      =>  'varchar(255) NOT NULL',
            'date_create'   =>  'datetime NOT NULL',
            'date_update'   =>  'datetime NOT NULL',
            ), 'ENGINE=InnoDB'
        );
	    $this->createTable('tbl_assignment_author_article',array(
	        'id'            =>  'pk',
            'author_id'     =>  'int(10) NOT NULL',
            'article_id'    =>  'int(10) NOT NULL',
            ),'ENGINE=InnoDB'
        );

	    $this->addForeignKey('fk_assignment_category_article','tbl_assignment_category_article',
            'article_id', 'tbl_article', 'id', 'CASCADE','CASCADE'
        );
        $this->addForeignKey('fk_assignment_category_category','tbl_assignment_category_article',
            'category_id', 'tbl_category', 'id', 'CASCADE','CASCADE'
        );
        $this->addForeignKey('fk_assignment_author_article', 'tbl_assignment_author_article','article_id',
            'tbl_article', 'id', 'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('fk_assignment_author_author', 'tbl_assignment_author_article','author_id',
            'tbl_author', 'id', 'CASCADE', 'CASCADE'
        );
	}

	public function down()
	{
        echo 'Удаление таблиц tbl_category, tbl_article, tbl_assignment_category_article, 
	    tbl_assignment_author_article, tbl_author';
        $this->dropForeignKey('fk_assignment_category_article','tbl_assignment_category_article');
        $this->dropForeignKey('fk_assignment_category_category', 'tbl_assignment_category_article');
        $this->dropForeignKey('fk_assignment_author_author', 'tbl_assignment_author_article');
        $this->dropForeignKey('fk_assignment_author_article', 'tbl_assignment_author_article');
        $this->truncateTable('tbl_assignment_category_article');
        $this->truncateTable('tbl_assignment_author_article');
        $this->truncateTable('tbl_category');
        $this->truncateTable('tbl_article');
        $this->truncateTable('tbl_author');
        $this->dropTable('tbl_assignment_category_article');
        $this->dropTable('tbl_assignment_author_article');
        $this->dropTable('tbl_category');
        $this->dropTable('tbl_article');
        $this->dropTable('tbl_author');
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