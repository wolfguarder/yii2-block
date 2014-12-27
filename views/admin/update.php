<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var wolfguard\block\models\Block $model
 */

$this->title = Yii::t('block', 'Update block');
$this->params['breadcrumbs'][] = ['label' => Yii::t('block', 'Blocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($model->name) ?></h1>

<?php echo $this->render('flash') ?>

<div class="panel panel-info">
    <div class="panel-heading"><?= Yii::t('block', 'Information') ?></div>
    <div class="panel-body">
        <?= Yii::t('block', 'Created at {0, date, MMMM dd, YYYY HH:mm}', [$model->created_at]) ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

        <?= $form->field($model, 'code')->textInput(['maxlength' => 255])->hint(Yii::t('block', 'Don\'t change this value, if you not sure for what it is for.')) ?>

        <?= $form->field($model, 'value')->textarea() ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('block', 'Save'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
