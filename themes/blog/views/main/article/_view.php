<?php
/* @var $this Controller */
/* @var $model Article */
?>

<?php
$this->breadcrumbs=$breadcrumbs
?>


<div class="row">
    <h1>
        Категории:
        <?php echo $model->getCategoryName()?>
    </h1>
</div>
<div class="container">
    <h2>
        Название статьи: <?php echo $model->name ?>
    </h2>
</div>
<div class="row">
    <img src="<?php echo ('/../../upload/' . $model->image) ?>" alt="<?php echo $model->name ?>">
</div>
<div class="row">
    <p class="lead">
        <?php echo $model->text?>
    </p>
</div>