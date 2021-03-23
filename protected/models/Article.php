<?php

/**
 * This is the model class for table "tbl_article".
 *
 * The followings are the available columns in table 'tbl_article':
 * @property integer $id
 * @property integer $authorid
 * @property array $categories
 * @property string $name
 * @property string $image
 * @property string $anotation
 * @property string $text
 *
 * The followings are the available model relations:
 * @property AssignmentAuthorArticle[] $assignmentAuthorArticles
 * @property AssignmentCategoryArticle[] $assignmentCategoryArticles
 * @property Category[] $categoriesAll
 */
class Article extends CActiveRecord
{

    public $imgFile;
    public $categories = array();
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_article';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('authorid, categories, image, name, imgFile, anotation, text', 'required'),
			array('categories','type','type'=>'array'),
			array('categories','default','value'=>array()),
			array('authorid', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('anotation', 'length', 'max'=>100),
            array('imgFile','file', 'types'=>'jpg, gif, png'),
			array('text', 'length', 'max'=>1000),
            array('text', 'length', 'min'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, authorid, categories, name, image, anotation, text', 'safe', 'on'=>'search'),
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
            'categoriesAll'=>array(self::MANY_MANY, 'Category',
                'tbl_assignment_category_article(articleid, categoryid)'),
			'assignmentAuthorArticles' => array(self::HAS_MANY, 'AssignmentAuthorArticle', 'articleid'),
			'assignmentCategoryArticles' => array(self::HAS_MANY, 'AssignmentCategoryArticle', 'articleid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'categories'=>'Категории',
			'authorid' => 'Автор',
			'name' => 'Название',
			'imgFile' => 'Картинка',
			'anotation' => 'Аннотация',
			'text' => 'Текст',
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
		$criteria->compare('authorid',$this->authorid);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('anotation',$this->anotation,true);
		$criteria->compare('text',$this->text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Article the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getAuthorName()
    {
        $model = Author::model()->find('id=:id', array(':id'=>$this->authorid));
	    $fio =  $model['surname'] . ' ' . $model['name'] . ' ' . $model['patronymic'];
	    return $fio;
    }
    public function getCategories()
    {
        $criteria = new CDbCriteria;
        $criteria->select = 'id, category'; // выбрать поля которые нужно вывести

        $arrayModel = Category::model()->findAll($criteria);

        $listCategories = array();
        foreach ($arrayModel as $item=>$value){
           $listCategories[$value['id']] = $value['category'];
        }

	    return $listCategories;
    }

    public function upload($imgFile)
    {
        $imgFile->saveAs(Yii::app()->getBasePath().'/../upload/'  .$this->getLastArticle()['id']. $imgFile->getName());
        return true;
    }

	public function getCategoryName()
    {
        $model = AssignmentCategoryArticle::model()->findAll('articleid=:articleid',
            array(':articleid'=>$this->id)
        );

        if (empty($model)){
            return 'Нет категорий';
        }
        $categories = array();
        foreach ($model as $value){
            $categories[] = $value['categoryid'];
        }
        $criteria = new CDbCriteria();
        $criteria->addInCondition('id', $categories);
        $model = Category::model()->findAll($criteria);
        $categories ='';
        for ($i = 0; $i < count($model); $i++) {
            $categories .= $i+1 ==count($model)? $model[$i]['category'] : $model[$i]['category'] . ', ';
        }

        return $categories;
    }
    public function getLastArticle()
    {
        $criteria = new CDbCriteria();
        $criteria->limit =1;
        $criteria->order=' `id` DESC';
        $model = Article::model()->find($criteria);
        return isset($model) ? $model : NULL;
    }

    public function getImageName()
    {
        return $this->image;
    }

    public function getImageUrl()
    {
        return '/../../upload/' . $this->image;
    }

}
