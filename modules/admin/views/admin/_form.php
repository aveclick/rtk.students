<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>
<?php
$params = ['prompt' => 'Выберите направление'];
?>
<div class="post-create__form">
  <?php $form = ActiveForm::begin(); ?>
  <?= $form->field($model, 'direction_id')->dropDownList($directions, $params)->label('Выберите направление') ?>
  <div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn']) ?>
  </div>
  <?php ActiveForm::end(); ?>
</div>
