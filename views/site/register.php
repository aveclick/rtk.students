<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
$this->title = 'Регистрация';
?>
<div class="register-page">
  <div class="post-create">
    <div class="post-create__container">
      <div class="post-create__title">
        <h2>Регистрация</h2>
      </div>
      <div class="post-create__form">
        <?php $form = ActiveForm::begin(['id' => 'register-form']); ?>
        <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'placeholder' => "Имя"]) ?>
        <?= $form->field($model, 'surname')->textInput(['placeholder' => "Фамилия"]) ?>
        <?= $form->field($model, 'login', ['enableAjaxValidation' => true])->textInput(['placeholder' => "Логин"]) ?>
        <?= $form->field($model, 'email', ['enableAjaxValidation' => true])->textInput(['placeholder' => "Эл. почта"]) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => "Пароль"]) ?>
        <?= $form->field($model, 'password_repeat')->passwordInput(['placeholder' => "Подтвердите пароль"]) ?>
        <?= $form->field($model, 'rules')->checkbox() ?>
        <div class="post-create__bottom">
          <div class="form-group">
            <?= Html::submitButton('Создать аккаунт', ['class' => 'btn', 'name' => 'register-button']) ?>
          </div>
          <div class="post-create__bottom bottom-link">Уже есть аккаунт? <a href="/site/login">Войти</a></div>
        </div>
        <?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</div>
