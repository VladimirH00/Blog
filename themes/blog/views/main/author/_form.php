<?php
/* @var $this AuthorController */
/* @var $model Author */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'author-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
)); ?>

	<p class="note">Поля со <span class="required">*</span> обязательны к заполнению.</p>

	<?php echo $form->errorSummary($model); ?>


		<?php echo $form->labelEx($model,'surname'); ?>
		<?php echo $form->textField($model,'surname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'surname'); ?>



		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>



		<?php echo $form->labelEx($model,'patronymic'); ?>
		<?php echo $form->textField($model,'patronymic',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'patronymic'); ?>



		<?php echo $form->labelEx($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'login'); ?>



		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'password'); ?>

        <?php echo $form->labelEx($model,'passwordRepeat'); ?>
        <?php echo $form->passwordField($model,'passwordRepeat',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'passwordRepeat'); ?>


        <div>
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'Зарегистрироваться',
                    'buttonType'=>'submit',
            ));  ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->