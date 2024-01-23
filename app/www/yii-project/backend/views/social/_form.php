<?php

use common\components\StaticFunctions;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Social $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="social-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

                    <?= $form->field($model, 'link')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <label class="d-flex align-items-center flex-column mb-3 w-100">
                        <?php $image = StaticFunctions::getImage($model->image,'social',$model->id) ?>
                        <div class="preview-image">
                            <img src="<?=$image?>" alt="" style="max-width: 100%;">
                        </div>
                        <?= $form->field($model, 'image')->fileInput(['hidden'=>true, 'class'=>'preview'])->label(false)?>
                        <div class="btn btn-primary w-100">Загрузить изображение</div>
                    </label>
                    <?= $form->field($model, 'sort')->textInput(['autocomplete' => 'off']) ?>

                    <?= $form->field($model, 'status')->checkbox([
                        'data-bootstrap-switch' => true,
                        'data-off-color' => 'danger',
                        'data-on-color' => 'success'
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
