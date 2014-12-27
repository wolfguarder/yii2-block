<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var wolfguard\block\models\BlockSearch $searchModel
 */

$this->title = Yii::t('block', 'Manage blocks');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?> <?= Html::a(Yii::t('block', 'Create block'), ['create'], ['class' => 'btn btn-success']) ?></h1>

<?php echo $this->render('flash') ?>

<?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'layout' => "{items}\n{pager}",
    'columns' => [
        'name',
        'code',
        [
            'attribute' => 'created_at',
            'value' => function ($model, $key, $index, $widget) {
                return Yii::t('block', '{0, date, MMMM dd, YYYY HH:mm}', [$model->created_at]);
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
        ],
    ],
]); ?>
