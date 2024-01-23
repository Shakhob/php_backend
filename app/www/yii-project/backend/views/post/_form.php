<?php

use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Post $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="post-form">


    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                    <?php echo $form->field($model, 'title')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>


                    <?= $form->field($model, 'preview_text')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

                    <?= $form->field($model, 'body')->widget(CKEditor::className(), [
                        'options' => ['rows' => 6],
                        'preset' => 'basic'
                    ]) ?>
                    <?

                    $galleryImages = $model->getGallery();
                    //                            echo "<pre>"; print_r($model->galleryImages); echo "</pre>";
                    //                            DIE;
                    ?>

                    <?

                    echo FileInput::widget([
                        'model' => $model,
                        'attribute' => 'galleryImages[]',
                        'options' => ['multiple' => true,'accept' => 'image/*']
                    ]);
                    ?>
                    <div class="row" style="gap: 15px">

                        <?php foreach ($galleryImages as $galleryImage): ?>
                            <div class="col-xl-2">
                                <img src="<?=$galleryImage["image"]?>" alt="" style="max-width: 150px; height: 100%">
                                <div class="remove_img">
                                    <a href="<?=\yii\helpers\Url::to(['post/delete-image','id'=>$galleryImage['key']])?>" ><i class="fas fa-trash"></i></a>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">

                    <?= $form->field($model, 'order')->textInput(['type'=>'number', 'autocomplete' => 'off']) ?>

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
    <?php ActiveForm::end(); ?>

</div>
