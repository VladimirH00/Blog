<?php /* @var $this Controller */
/*
$pager = $this->beginWidget('bootstrap.widgets.TbPager', array(
    'displayFirstAndLast'=>true,
    'header'=>'Категории',
));
$pager->createPageButton('one',1,'btn',false,false);
$pager->createPageButtons();
$this->endWidget();
*/
/*
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
    'ajaxUpdate'=>false,
    'enablePagination'=>false,
    'pagerCssClass'=>'result-lest',
    'summaryText'=>'Всего найдено '.$pages->itemCount.' постов',
));

$this->widget('CLinkPager', array(
    'header'=>'',
    'firstPageLabel'=>'<<',
    'prevPageLabel'=>'<',
    'nextPageLabel'=>'>',
    'lastPageLabel'=>'>>',
    'pages'=>$pages,
));
*/
?>

<!-- Додумать ещё-->
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
<!-- Додумать ещё-->

<?php $this->widget('CLinkPager', array(
    'pages'=>$dataProviderCategory->pagination,
)); ?>