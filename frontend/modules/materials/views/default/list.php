<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\modules\materials\models\Material;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\materials\models\MaterialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Materials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-list">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Material', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
