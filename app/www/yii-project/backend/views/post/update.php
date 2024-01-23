<?php

use common\components\StaticFunctions;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Post $model */

$this->title = 'Update Post: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="post-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
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
                            <?php echo $form->field($model->translate('uz'), "[uz]title")->textInput(['autocomplete' => 'off'])->label("[uz]title");?>
                            <?php echo $form->field($model->translate('uz'), "[uz]preview_text")->textInput(['autocomplete' => 'off'])->label("[uz]upreview_textl");?>
                            <?= $form->field($model->translate('uz'), '[uz]body')->widget(CKEditor::className(), [
                                'options' => ['rows' => 6],
                                'preset' => 'basic'
                            ])->label("[uz]body") ?>
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
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <?php echo $form->field($model->translate('ru'), "[ru]title")->textInput(['autocomplete' => 'off'])->label("[ru]title");?>
                            <?php echo $form->field($model->translate('ru'), "[ru]preview_text")->textInput(['autocomplete' => 'off'])->label("[ru]preview_text");?>
                            <?= $form->field($model->translate('ru'), '[ru]body')->widget(CKEditor::className(), [
                                'options' => ['rows' => 6],
                                'preset' => 'basic'
                            ])->label("[ru]body") ?>
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
                            <?php echo $form->field($model->translate('en'), "[en]title")->textInput(['autocomplete' => 'off'])->label("[en]title");?>
                            <?php echo $form->field($model->translate('en'), "[en]preview_text")->textInput(['autocomplete' => 'off'])->label("[en]preview_text");?>
                            <?= $form->field($model->translate('en'), '[en]body')->widget(CKEditor::className(), [
                                'options' => ['rows' => 6],
                                'preset' => 'basic'
                            ])->label("[en]body") ?>
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
</div>
