<?php

use yii\helpers\Html;
use wolfguard\block\widgets\BlockAsset;

/**
 * @var yii\web\View $this
 * @var wolfguard\block\models\Block $model
 */
?>
<?php BlockAsset::register($this);?>

<?php if (Yii::$app->user->isGuest): ?>

    <?= $model->value ?>

<?php else: ?>
    <div class="inline-block-admin">
        <?= Html::a(Yii::t('block', 'Edit'), ['/block/admin/update', 'id' => $model->id, 'mode' => 'back'], [
            'class' => 'btn btn-success',
            'onclick' => 'blockAddReturnUrl(this);'
        ]) ?>
        <?= $model->value ?>
    </div>
<?php endif ?>