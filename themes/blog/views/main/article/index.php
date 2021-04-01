<?php /* @var $this Controller */?>
<?php /* @var $categories Category[] */?>
<?php /* @var $dataProviderArticle CActiveDataProvider */?>

    <div class="row">
<?php foreach ($categories as $category) : ?>
        <div class="span3">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label' =>  $category['category'],
                'url'   =>  'index.php?r=main/article/index&category_id=' . $category['id'],
            )); ?>
        </div>
<?php endforeach; ?>
    </div>
<br>
<div class="row">
    <?= empty($dataProviderArticle->data)? "<h3 class='text-center'>Нет записей по данной категории!!</h3>": ""?>
    <?php foreach ($dataProviderArticle->data as $value): ?>
        <div class="span4">
            <?= $this->renderPartial('littleView',array('model'=>$value))?>
        </div>
    <?php endforeach;?>
</div>
<?php $this->widget('CLinkPager', array(
    'pages'=>$dataProviderArticle->pagination,
)); ?>