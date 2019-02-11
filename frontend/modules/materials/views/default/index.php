<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use \frontend\modules\materials\models\Material;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\materials\models\MaterialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Materials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <p>
            <a href="<?= Url::to(['list', 'type' => Material::TYPE_VIDEO]); ?>">Video</a>
        </p>
        <p>
            <a href="<?= Url::to(['list', 'type' => Material::TYPE_AUDIO]); ?>">Audio</a>
        </p>
    </div>
</div>
