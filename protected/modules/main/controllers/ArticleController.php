<?php


class ArticleController extends Controller
{

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

    public function actionIndex($category_id = null)
    {
        $categories = Category::model()->findAll();
        $this->render('index', array(
            'categories'=>$categories,
            'dataProviderArticle'=>(new QueryArticle())->searchDataProviderArticleIndex($category_id),
        ));
    }

    public function actionCreate()
    {
        $model = new Article;
        if (isset($_POST['Article'])) {
            $model->attributes = $_POST['Article'];
            $model->imgFile = CUploadedFile::getInstance($model, 'imgFile');
            $model->image = isset($model->imgFile) ? ((new QueryArticle())->getLastArticle()['id'] . $model->imgFile->getName()) : 'error';
            if ($model->validate()) {
                $model->save();
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
            $model = ArticleUpdate::model()->findByAttributes(array('id'=>$id, 'authorid'=>Yii::app()->user->getId()));
            $model->categories = AssignmentCategoryArticle::model()->getData($_GET['id']);
            if (isset($_POST['ArticleUpdate'])) {
                $model->attributes = $_POST['ArticleUpdate'];
                $model->imgFile = CUploadedFile::getInstance($model, 'imgFile');
                $model->image = isset($model->imgFile) ? (new QueryArticle())->getLastArticle()['id'] . $model->imgFile->getName() : $model->getImageName();
                if ($model->update()) {
                    $this->redirect($this->createUrl('/main/article/update&id=' . $_GET['id']));
                }
            }
            if (isset($model)) {
                $this->render('update', array(
                    'model' => $model,
                    'isUpdate' =>true,
                ));
            } else {
                throw new CHttpException('404', "Выбранная статья не найдена");
            }
        } else {
            throw new CHttpException('404', "Статья не найдена");
        }
    }

    public function actionDelete()
    {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $model = Article::model()->findByAttributes(array('id'=>$id, 'authorid'=>Yii::app()->user->getId()));
            if (isset($model)) {
                $model->delete();
            } else {
                throw new CHttpException('404', 'Статью не удалось удалить');
            }
        } else {
            throw new CHttpException('404','Статья не найдена');
        }
    }

    public function actionViewAdmin()
    {
        if (isset($_GET['id'])) {

            $model = Article::model()->findByAttributes(array('id'=>$_GET['id']));
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

            $model = Article::model()->findByAttributes(array('id'=>$_GET['id']));
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