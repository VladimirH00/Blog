<?php


class ArticleUpdate extends Article
{
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('authorid, categories, name, anotation, text', 'required'),
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
            array('id, authorid, categories, name, anotation, text', 'safe', 'on'=>'search'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'categories'=>'Категории',
            'authorid' => 'Автор',
            'name' => 'Название',
            'imageNow'=>'Текущая картинка',
            'imgFile' => 'Изменить картинку',
            'anotation' => 'Аннотация',
            'text' => 'Текст',
        );
    }

    public function setAuthorId()
    {

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
}