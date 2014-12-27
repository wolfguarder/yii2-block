<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var wolfguard\block\models\Block $model
 */

$this->title = Yii::t('block', 'Create block');
$this->params['breadcrumbs'][] = ['label' => Yii::t('block', 'Blocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php echo $this->render('flash') ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
        <div class="alert alert-info">
            <?= Yii::t('block', 'Be careful in Code field. Pay attention to field hint.') ?>
        </div>
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => 255, 'autofocus' => true]) ?>

        <?= $form->field($model, 'code')->textInput(['maxlength' => 255])->hint(Yii::t('block', 'Only latin characters, numbers and symbols (.-_) allowed. Spaces not allowed.')) ?>

        <?= $form->field($model, 'value')->textarea() ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('block', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
