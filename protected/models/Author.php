<?php

/**
 * This is the model class for table "tbl_author".
 *
 * The followings are the available columns in table 'tbl_author':
 * @property integer $id
 * @property string $surname
 * @property string $name
 * @property string $patronymic
 * @property string $login
 * @property string $password
 * @property string $datecreate
 * @property string $dateupdate
 *
 * The followings are the available model relations:
 * @property AssignmentAuthorArticle[] $assignmentAuthorArticles
 * @property AuthItem[] $tblAuthItems
 */
class Author extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_author';
	}

	public function beforeSave()
    {
        $this->password = (new PasswordHash())->getHash($this->password);
        return parent:: beforesave();
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('surname, name, login, password, datecreate, dateupdate', 'required'),
			array('surname, name, patronymic, login', 'length', 'max'=>50),
			array('password', 'length', 'max'=>255),
			array('login','unique'),
			array('login, password', 'length', 'min'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, surname, name, patronymic, login, password, datecreate, dateupdate', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'assignmentAuthorArticles' => array(self::HAS_MANY, 'AssignmentAuthorArticle', 'authorid'),
			'tblAuthItems' => array(self::MANY_MANY, 'AuthItem', 'tbl_auth_assignment(userid, itemname)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'surname' => 'Фамилия',
			'name' => 'Имя',
			'patronymic' => 'Отчество',
			'login' => 'Логин',
			'password' => 'Пароль',
			'datecreate' => 'Datecreate',
			'dateupdate' => 'Dateupdate',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('patronymic',$this->patronymic,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('datecreate',$this->datecreate,true);
		$criteria->compare('dateupdate',$this->dateupdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Author the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
