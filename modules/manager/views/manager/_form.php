<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ApplicationToCouncil $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="post-create__form">
  <?php $form = ActiveForm::begin(); ?>
  <?= $form->field($model, 'reason')->textInput(['maxlength' => true, 'placeholder' => "Примечание"]) ?>
  <div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn']) ?>
  </div>
  <?php ActiveForm::end(); ?>
</div>
