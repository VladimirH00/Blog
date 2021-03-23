<?php
/* @var $this AuthorController */
/* @var $model Author */

$this->breadcrumbs=array(
	'Логин'=>'index.php?r=site/login',
	'Регистрация',
);

?>

<h1>Создание пользователя</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>