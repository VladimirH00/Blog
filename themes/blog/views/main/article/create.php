<?php
/* @var $this ArticleController */
/* @var $modelImage UploadImage*/
/* @var $model Article */

$this->breadcrumbs=array(
	'Статьи'=>array('/main/admin/article'),
	'Создание',
);

?>

<h1>Создание статьи</h1>

<?php $this->renderPartial('_form', array(
        'model'=>$model,
)); ?>