<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
/** @var yii\web\View $this */
/** @var app\models\Post $model */
/** @var yii\widgets\ActiveForm $form */
?>
<?php
$params = ['prompt' => 'Выберите категорию'];
?>
<div class="post-create__form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => 'Заголовок']) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(),[
      'editorOptions' => [
        'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
        'inline' => false, //по умолчанию false
      ],
    ]); ?>

    <?= $form->field($model, 'category_id')->dropDownList($categories, $params)->label('Выберите категорию') ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
