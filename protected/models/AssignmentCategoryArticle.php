<?php

/**
 * This is the model class for table "tbl_assignment_category_article".
 *
 * The followings are the available columns in table 'tbl_assignment_category_article':
 * @property integer $id
 * @property integer $articleid
 * @property integer $categoryid
 *
 * The followings are the available model relations:
 * @property Article $article
 * @property Category $category
 */
class AssignmentCategoryArticle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_assignment_category_article';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('articleid, categoryid', 'required'),
			array('articleid, categoryid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, articleid, categoryid', 'safe', 'on'=>'search'),
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
			'article' => array(self::BELONGS_TO, 'Article', 'articleid'),
			'category' => array(self::BELONGS_TO, 'Category', 'categoryid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'articleid' => 'Articleid',
			'categoryid' => 'Categoryid',
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
		$criteria->compare('articleid',$this->articleid);
		$criteria->compare('categoryid',$this->categoryid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AssignmentCategoryArticle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function addData($modelArticle)
    {
        $model = AssignmentCategoryArticle::model()->findAllByAttributes(array('articleid' => $modelArticle['id']));
        if (isset($model)){
            foreach ($model as $value){
                $value->delete();
            }
        }
        foreach ($modelArticle['categories'] as $item=>$value){
            $model = new AssignmentCategoryArticle();
            $model->categoryid = $value;
            $model->articleid = $modelArticle['id'];
            if (!$model->save()){
                return false;
            }
        }
        return true;
    }

    public function getData($idArticle)
    {
        $model = AssignmentCategoryArticle::model()->findAllByAttributes(array('articleid'=>$idArticle));
        $arr = array();
       foreach ($model as $value){
           $arr[] = $value->category->id;
       }
        return $arr;
    }

}
