<?php


class ArticleController extends Controller
{
    private $COUNT_ARTICLE_ON_PAGE =6;

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
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update','delete'),
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
        $criteria = new CDbCriteria();

        if (isset($_GET['category'])){
            $criteria = new CDbCriteria();
            $criteria->join ='left join `tbl_assignment_category_article` as `t2` on `t`.`id` = `t2`.`articleid`
                                left join `tbl_category` as t3 on t2.categoryid = t3.id';
            $criteria->condition = 'category = :category';
            $criteria->params = array(
                ':category'   => $_GET['category']
            );
        }
        $model = Article::model()->findAll($criteria);
        $dataProviderCategory = new CActiveDataProvider('Category');
        $dataProviderArticle = new CActiveDataProvider('Article', array(
            'criteria'      =>  $criteria,
            'pagination'    =>  array(
                'pageSize'=>$this->COUNT_ARTICLE_ON_PAGE,
            ),
        ));
        $this->render('index', array(
            'dataProviderCategory'=>$dataProviderCategory,
            'dataProviderArticle'=>$dataProviderArticle,
        ));
    }

    public function actionCreate()
    {
        $model = new Article;

        if (isset($_POST['Article'])) {
            $attributes = $_POST['Article'];
            $imgFile = CUploadedFile::getInstance($model, 'imgFile');
            $attributes['authorid'] = Yii::app()->user->getId();
            $attributes['image'] = isset($imgFile) ? ($model->getLastArticle()['id'] . $imgFile->getName()) : 'error';
            $model->attributes = $attributes;
            $model->imgFile = $imgFile;
            $transaction = Yii::app()->db->beginTransaction();
            if ($model->validate()) {
                $model->upload($imgFile);
                $compressedImage = new CompressedImage();
                $compressedImage->resize_photo(Yii::app()->getBasePath() . '/../upload/', $model->image, $_FILES['Article']['size'], $_FILES['Article']['type']['imgFile']);
                $model->save();
                if (!AssignmentCategoryArticle::model()->addData($model)) {
                    unlink(Yii::app()->getBasePath() . '/../upload/' . $model->image);
                    $transaction->rollback();
                    throw new CHttpException('404', 'Не удалось создать запись');
                }
                $transaction->commit();
                $this->redirect($this->createUrl('/main/admin/article'));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'isUpdate'=>false,
        ));
    }

    public function actionUpdate()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $model = ArticleUpdate::model()->find('id=:id and authorid=:authorid', array(
                ':id'=>$id,
                ':authorid'=>Yii::app()->user->getId(),
                ));
            $model->categories = AssignmentCategoryArticle::model()->getData($_GET['id']);
            if (isset($_POST['ArticleUpdate'])) {
                $attributes = $_POST['ArticleUpdate'];
                $imgFile = CUploadedFile::getInstance($model, 'imgFile');
                $attributes['authorid'] = Yii::app()->user->getId();
                $attributes['image'] = isset($imgFile) ? $imgFile->getName() : $model->getImageName();
                $model->attributes = $attributes;
                $model->imgFile = $imgFile;
                $transaction = Yii::app()->db->beginTransaction();
                if ($model->update()) {
                    if (isset($model->imgFile)) {
                        $model->upload($imgFile);
                        $compressedImage = new CompressedImage();
                        $compressedImage->resize_photo(Yii::app()->getBasePath() . '/../upload/', $model->image, $_FILES['Article']['size'], $_FILES['Article']['type']['imgFile']);
                    }
                    if (!AssignmentCategoryArticle::model()->addData($model)) {
                        if (isset($model->imgFile)) {
                            unlink(Yii::app()->getBasePath() . '/../upload/' . $model->image);
                        }
                        $transaction->rollback();
                        throw new CHttpException('404', 'Не удалось создать запись');
                    }
                    $transaction->commit();
                    //Yii::app()->set
                    $this->redirect($this->createUrl('/main/article/update&id=' . $_GET['id']));
                }else{
                    throw new CHttpException('404', 'Не удалось изменить запись');
                }
            }
            if (isset($model)) {
                $this->render('update', array(
                    'model' => $model,
                    'isUpdate' =>true,
                ));
            } else {
                throw new CHttpException('404');
            }
        } else {
            throw new CHttpException('404');
        }
    }

    public function actionDelete()
    {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $model = Article::model()->find('id = :id and authorid = :authorid', array(
                ':id' => $id,
                ':authorid' => Yii::app()->user->getId(),
            ));
            if (isset($model)) {
                unlink(Yii::app()->getBasePath() . '/../upload/' . $model->image);
                if (is_file(Yii::app()->getBasePath() . '/../upload/compressedImage' . $model->image)) {
                    unlink(Yii::app()->getBasePath() . '/../upload/' . $model->image);
                }
                $model->delete();
            } else {
                throw new CHttpException('404');
            }
        } else {
            throw new CHttpException('404');
        }
    }

    public function actionViewAdmin()
    {
        if (isset($_GET['id'])) {

            $model = Article::model()->find('id=:id', array(':id' => $_GET['id']));
            if (isset($model)) {

                $this->render('_view', array(
                    'model'         => $model,
                    'breadcrumbs'   => array(
                        'Статьи'=>array('/main/admin/article'),
                        'Просмотр',
                    ),
                ));
            } else {
                throw new CHttpException('404', 'Статья не найдена');
            }
        } else {
            throw new CHttpException('404', 'Статья не найдена');
        }
    }

    public function actionView()
    {
        if (isset($_GET['id'])) {

            $model = Article::model()->find('id=:id', array(':id' => $_GET['id']));
            if (isset($model)) {

                $this->render('_view', array(
                    'model'         => $model,
                    'breadcrumbs'   => array(
                        'Статьи'=>array('/main/article/index'),
                        'Просмотр',
                        ),
                ));
            } else {
                throw new CHttpException('404', 'Статья не найдена');
            }
        } else {
            throw new CHttpException('404', 'Статья не найдена');
        }
    }



}