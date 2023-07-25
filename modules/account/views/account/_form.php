<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="post-create__form">
  <?php $form = ActiveForm::begin(); ?>
  <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'placeholder' => "Имя"]) ?>
  <?= $form->field($model, 'surname')->textInput(['placeholder' => "Фамилия"]) ?>
  <?= $form->field($model, 'login')->textInput(['placeholder' => "Логин"]) ?>
  <?= $form->field($model, 'email')->textInput(['placeholder' => "Эл. почта"]) ?>
  <div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn']) ?>
  </div>
  <?php ActiveForm::end(); ?>
</div>
