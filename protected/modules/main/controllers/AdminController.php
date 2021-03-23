<?php


class AdminController extends CController
{
    public $layout='//layouts/admin';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
        return array(

            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('category','article','index','delete'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete'),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $dataProviderCategory = new CActiveDataProvider('Category', array(
            'pagination'=>array(
                'pageSize'=>3,
            ),
        ));

        $this->render('category', array(
            'dataProviderCategory'=>$dataProviderCategory,
        ));
    }

    public function actionCategory()
    {
        $dataProviderCategory = new CActiveDataProvider('Category', array(
            'pagination'=>array(
                'pageSize'=>5,
            ),
        ));

        $this->render('category', array(
            'dataProviderCategory'=>$dataProviderCategory,
        ));
    }
    public function actionArticle()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'authorid = :authorid';
        $criteria->params = array(':authorid'=>Yii::app()->user->getId());
        $dataProviderArticles = new CActiveDataProvider('Article', array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>5,
            ),
        ));

        $this->render('article', array(
            'dataProviderArticles'=>$dataProviderArticles,
        ));
    }

}