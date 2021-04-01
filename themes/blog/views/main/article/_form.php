<?php
/* @var $this ArticleController */
/* @var $model Article */
/* @var $modelImage UploadImage*/
/* @var $form CActiveForm */
/* @var $isUpdate bool */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-form',
	'method'=>'post',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

	<p class="note">Поля со <span class="required">*</span> являются обязательными.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row checkbox">
        <?php echo $form->labelEx($model, 'categories'); ?>
        <?php echo $form->checkBoxList($model, 'categories', (new QueryCategory())->getCategories()); ?>
        <?php echo $form->error($model, 'categories'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'anotation'); ?>
		<?php echo $form->textArea($model,'anotation',array('rows'=>6,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'anotation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'text');
		?>
    </div>
    <?php if($isUpdate):?>
        <div class="row">
            Текущая картинка:
            <a href="<?=$model->getImageUrl()?>"><?=$model->getImageName() ?></a>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php echo $form->labelEx($model,'imgFile'); ?>
        <?php echo $form->fileField($model,'imgFile'); ?>
        <?php echo $form->error($model,'imgFile'); ?>
    </div>

	<div class="row buttons">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'  => 'submit',
                'label' => $model->isNewRecord ? 'Запостить' : 'Изменить',
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->