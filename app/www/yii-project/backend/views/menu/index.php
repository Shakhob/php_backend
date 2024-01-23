<?php

use common\models\Menu;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
/** @var yii\web\View $this */
/** @var common\models\MenuSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Menu', ['create'], ['class' => 'btn btn-success']) ?>
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
            [
                'attribute' => 'parent_id',
                'contentOptions' => ['class' => ''],
                'content' => function ($data) {
                    return "{$data->parent?->name}" ? "{$data->parent?->name}" : "-";
                }
            ],
            'name',
            [
                'attribute' => 'url',
                'content' => function ($data) {
                    $href = Yii::$app->params['frontend'] . $data->url;
                    return "<a href='$href' target='_blank'>$data->url</a>";
                },
            ],
            'menu_order',
            [
                'attribute' => 'status',
                'content' => function ($data) {
                    return "{$data->status}" ? "Active" : "Inactive";
                },
                'filter' => [1 => "Active", 0 =>"Inactive" ],
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Menu $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>



</div>
