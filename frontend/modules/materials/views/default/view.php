<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use frontend\modules\materials\models\Material;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\modules\materials\models\Material */
/* @var $recommendations \frontend\modules\materials\models\Material */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Materials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="material-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'file_name',
            'title',
            'description',
            'type',
            'mime_type',
        ],
    ]) ?>

    <h2>Recommendations</h2>

    <?= GridView::widget([
        'dataProvider' => $recommendations,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'file_name',
            'title',
//            'description',
            'type',
            'mime_type',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model) {
                        switch ($model->type) {
                            case Material::TYPE_AUDIO:
                                $url = Url::to(['audio', 'id' => $model->id]);
                                break;
                            case Material::TYPE_VIDEO:
                                $url = Url::to(['video', 'id' => $model->id]);
                                break;
                        }
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('app', 'lead-view'),
                        ]);
                    },

                ]
            ],
        ],
    ]); ?>

</div>
