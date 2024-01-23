<?php

use common\models\Menu;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Menu $model */

$this->title = Yii::t('app', 'Update Menu: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="menu-update">

    <h1><?php //echo Html::encode($this->title) ?></h1>

    <?php
    //echo $this->render('_form', [
    // 'model' => $model,
    // ]);
    ?>
    <?php $form = ActiveForm::begin(); ?>



    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Uz</button>
            <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Ru</button>
            <button class="nav-link" id="nav-contact-tab" data-toggle="tab" data-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">En</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <?php echo $form->field($model->translate('uz'), "[uz]name")->textInput(['autocomplete' => 'off'])->label("[uz]name");?>
                            <?php echo $form->field($model->translate('uz'), "[uz]url")->textInput(['autocomplete' => 'off'])->label("[uz]url");?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">

                            <?php
                            $menu = Menu::find()->all();
                            $menu_items = ArrayHelper::map($menu,'id','name');
                            $currentItemId = $model->id;
                            ArrayHelper::remove($menu_items, $currentItemId);
                            $menu_params = [
                                'prompt' => 'select menu'
                            ];
                            echo $form->field($model, 'parent_id')->dropDownList($menu_items,$menu_params);
                            ?>
                            <?php //echo $form->field($model, 'parent_id')->textInput() ?>

                            <?php //echo $form->field($model, 'position')->textInput() ?>


                            <?= $form->field($model, 'menu_order')->textInput(['type'=>'number', 'autocomplete' => 'off']) ?>
                            <?= $form->field($model, 'status')->checkbox([
                                'data-bootstrap-switch' => true,
                                'data-off-color' => 'danger',
                                'data-on-color' => 'success'
                            ]) ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <?php echo $form->field($model->translate('ru'), "[ru]name")->textInput(['autocomplete' => 'off'])->label("[ru]name");?>
                            <?php echo $form->field($model->translate('ru'), "[ru]url")->textInput(['autocomplete' => 'off'])->label("[ru]url");?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <?php echo $form->field($model->translate('en'), "[en]name")->textInput(['autocomplete' => 'off'])->label("[en]name");?>
                            <?php echo $form->field($model->translate('en'), "[en]url")->textInput(['autocomplete' => 'off'])->label("[en]url");?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="form-group custom-btn">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>



