<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LostItem $model */
/** @var yii\widgets\ActiveForm $form */
?>
<?php
$params = ['prompt' => 'Выберите категорию'];
$categories = array(
  '0' => 'Потеряно',
  '1' => 'Найдено',
);
?>
<div class="post-create__form">
  <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
  <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => "Название"]) ?>
  <?= $form->field($model, 'text')->textarea(['rows' => 6, 'placeholder' => "Описание"]) ?>
  <?= $form->field($model, 'presence_indicator')->dropDownList($categories, $params) ?>
  <?= $form->field($model, 'image')->fileInput() ?>
  <?= $form->field($model, 'rules')->checkbox(array('value'=>1, 'uncheckValue'=>0)) ?>
  <div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn']) ?>
  </div>
  <?php ActiveForm::end(); ?>
</div>
