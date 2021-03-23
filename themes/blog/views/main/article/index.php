<?php /* @var $this Controller */?>
<?php /* @var $dataProviderCategory CActiveDataProvider */?>
<?php /* @var $dataProviderArticle CActiveDataProvider */?>

    <div class="row">
<?php foreach ($dataProviderCategory->data as $category) : ?>
        <div class="span3">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label' =>  $category['category'],
                'url'   =>  'index.php?r=main/article/index&category=' . $category['category'],
            )); ?>
        </div>
<?php endforeach; ?>
    </div>
<br>
<div class="row">
    <?php foreach ($dataProviderArticle->data as $value): ?>
        <div class="span4">
            <?= $this->renderPartial('littleView',array('model'=>$value))?>
        </div>
    <?php endforeach;?>
</div>
<?php $this->widget('CLinkPager', array(
    'pages'=>$dataProviderArticle->pagination,
)); ?>