<?php

/**
 * @var yii\web\View $this
 */

?>

<?php if (Yii::$app->getSession()->hasFlash('block.success')): ?>
    <div class="alert alert-success">
        <p><?= Yii::$app->getSession()->getFlash('block.success') ?></p>
    </div>
<?php endif; ?>

<?php if (Yii::$app->getSession()->hasFlash('block.error')): ?>
    <div class="alert alert-danger">
        <p><?= Yii::$app->getSession()->getFlash('block.error') ?></p>
    </div>
<?php endif; ?>