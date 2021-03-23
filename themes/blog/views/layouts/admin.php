<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="rus">
    <!-- BootStrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" />
    <?php Yii::app()->bootstrap->register(); ?>
    <!-- blueprint CSS framework
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
    -->	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->
    <!--
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
-->
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items' => array(
                array('label'=>'Все статьи', 'url'=>array('/main/article')),
                array('label'=>'Войти', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Выйти ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
            ),
            'htmlOptions'=>array('class'=>'pull-right'),
        ),
    ),
    'fixed'=>false,
    'fluid'=>true,
)); ?>
<div class="container-fluid" id="page">


    <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
            'homeLink'=>CHtml::link('Статьи',array(
                '/main/Article',
            )),
            'links'=>$this->breadcrumbs,
            'htmlOptions'=>array('class'=>'well'),
        )); ?><!-- breadcrumbs -->
    <?php endif?>
        <div class="row">
            <div class="span4">
                <div class="column">
                    <div class="buttons">
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'label' => 'Категории',
                        'url'   =>  $this->createUrl('/main/admin/category'),
                    )); ?>
                    </div>
                    <div class="buttons">
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'label' => 'Статьи',
                        'url'   =>  $this->createUrl('/main/admin/article'),
                    )); ?>
                    </div>
                </div>
            </div>
            <div class="container">
                <?php if(isset($this->breadcrumbs)):?>
                    <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                        'homeLink'=>CHtml::link('Статьи',array(
                            '/main/Article',
                        )),
                        'links'=>$this->breadcrumbs,
                        'htmlOptions'=>array('class'=>'well'),
                    )); ?><!-- breadcrumbs -->
                <?php endif?>
                <?php echo $content; ?>
            </div>
        </div>
    <div class="clear"></div>


</div><!-- page -->

</body>
</html>
