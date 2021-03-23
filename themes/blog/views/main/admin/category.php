<?php /* @var $this Controller */ ?>

<?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'dataProvider' => $dataProviderCategory,
        'columns'=>array(
            'id',
            'category',
            ),
    ));

