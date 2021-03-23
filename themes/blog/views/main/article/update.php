<?php
/* @var $this ArticleController */
/* @var $model Article */

$this->breadcrumbs=array(
    'Статьи'=>array('/main/admin/article'),
	'Редактирование',
);

?>
<h1>Редактирование статьи <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'isUpdate'=>$isUpdate)); ?>

