<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Авторизация',
);
?>

<h1>Авторизация</h1>

<p>Пожалуйста, заполните следующую форму, чтобы авторизоваться:</p>

<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
	'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>


    <div class="control-group">
	    <p class="note">Поля со <span class="required">*</span> являются обязательными.</p>
    </div>
    <div class="control-group">
		<?php echo $form->labelEx($model,'username', array('class'=>'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model,'username'); ?>
            <?php echo $form->error($model,'username'); ?>
        </div>
    </div>

    <div class="control-group">
		<?php echo $form->labelEx($model,'password', array('class'=>'control-label')); ?>
        <div class="controls">
            <?php echo $form->passwordField($model,'password'); ?>
            <?php echo $form->error($model,'password'); ?>
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            <label class="checkbox">
                <?php echo $form->checkBox($model,'rememberMe',array('class'=>'checkbox')); ?>
                <?php echo $form->label($model,'rememberMe'); ?>
            </label>
        </div>
		<?php echo $form->error($model,'rememberMe'); ?>
    </div>

    <div class="control-group">
        <div class="controls">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		    'label'         =>  'Логин',
            'buttonType'    =>  'submit',
        ))?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'Регистрация',
            'url'=>$this->createUrl('main/Author/register'),
        )); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->
