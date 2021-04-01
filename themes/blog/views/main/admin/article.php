<?php
/**
 * @var $this Controller
 * @var $dataProviderArticles CActiveDataProvider
 *
 */ ?>

<div class="container-fluid">
    <div class="row">
        <?php
        //if ($dataProviderCategory->itemCount !=0) {

            $this->widget('bootstrap.widgets.TbGridView', array(
                'dataProvider' => $dataProviderArticles,
                'columns' => array(
                    'id',
                    array(
                        'name'=>'authorName',
                        'value'=>'$data->authorName',
                    ),
                    array(
                        'name'=>'categories',
                        'value'=>'$data->categoryName',
                    ),
                    'name',
                    array(
                        'class'=>'bootstrap.widgets.TbButtonColumn',
                        'viewButtonUrl'=>'Yii::app()->createUrl("/main/article/view", array("id" => $data->id))',
                        'deleteButtonUrl'=>'Yii::app()->createUrl("/main/article/delete", array("id" => $data->id))',
                        'updateButtonUrl'=>'Yii::app()->createUrl("/main/article/update", array("id" => $data->id))',
                    ),
                ),

            ));
        //}
        ?>
    </div>
    <div class="row">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'url'   => $this->createUrl('/main/article/create'),
            'label' => 'Добавить статью',
        ));?>
    </div>
</div>

