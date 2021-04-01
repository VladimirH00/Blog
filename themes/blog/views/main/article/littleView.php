<?php /* @var $model Article */
      /* @var $this Controller */
?>
<?php
    $path = '/../../upload/compressedImages/';
    $path .= is_file($path . $model->image) ? $model->image : '../'.$model->image;
?>
<pre>
    <a href="<?=$this->createUrl('/main/article/view', array('id'=>$model->id))?>" style="text-decoration: none;">
        <table>
            <tr>
                <td rowspan="2" style="width: 140px; height: 140px;">  <img src="<?=$path?>" class="img-circle" style="width: 140px; height: 140px;"></td>
                <td><h3><?=$model->name ?></h3></td>
            </tr>
            <tr>
                <td><p style="width: 40%"><?=$model->anotation ?></p></td>
            </tr>
        </table>
    </a>
</pre>
<?php ?>
