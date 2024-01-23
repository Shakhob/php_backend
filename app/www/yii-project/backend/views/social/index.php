<?php

use common\components\StaticFunctions;
use common\models\Social;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\SocialSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Socials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Social', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= Html::beginForm(['delete-multiple'], 'post'); ?>
    <?= Html::submitButton('Удалить выбранные', ['class' => 'btn btn-danger delete-multiple']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['value' => $model->id];
                },
            ],
            'id',
            'name',
            [
                'attribute' => 'image',
                'content' => function ($data) {
                    $image = StaticFunctions::getImage($data->image,'social',$data->id);
                    return "<img src='$image' style='max-width: 150px'>";
                },
            ],
            [
                'attribute' => 'link',
                'content' => function ($data) {
                    return "<a href='$data->link' target='_blank'>$data->link</a>";
                },
            ],
            'sort',
            [
                'attribute' => 'status',
                'content' => function ($data) {
                    return "{$data->status}" ? "Active" : "Inactive";
                },
                'filter' => [1 => "Active", 0 =>"Inactive" ],
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Social $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>
    <?= Html::endForm(); ?>
</div>
