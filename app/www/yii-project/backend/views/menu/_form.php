<?php

use common\models\Menu;
use yii\bootstrap4\ActiveForm as bootstrap4ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Menu $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="menu-form">


    <?php $form = bootstrap4ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>


                    <?= $form->field($model, 'url')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>


                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <?php
                    $menu = Menu::find()->all();
                    $menu_items = ArrayHelper::map($menu,'id','name');
                    $menu_params = [
                        'prompt' => 'Select menu'
                    ];
                    echo $form->field($model, 'parent_id')->dropDownList($menu_items,$menu_params);
                    ?>

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
    <div class="form-group custom-btn">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php bootstrap4ActiveForm::end(); ?>

</div>