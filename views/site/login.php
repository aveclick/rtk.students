<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
$this->title = 'Авторизация';
?>
<div class="login-page">
  <div class="post-create">
    <div class="post-create__container">
      <div class="post-create__title">
        <h2>Авторизация</h2>
      </div>
      <div class="post-create__form">
        <?php $form = ActiveForm::begin([
          'id' => 'login-form',
          'layout' => 'horizontal',
          'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
          ],
        ]); ?>
        <?= $form->field($model, 'login')->textInput(['autofocus' => true, 'placeholder' => "Логин"]) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => "Пароль"]) ?>
        <div class="post-create__bottom">
          <div class="form-group">
            <?= Html::submitButton('Войти', ['class' => 'btn', 'name' => 'btn']) ?>
          </div>
          <div class="post-create__bottom bottom-link">У вас нет аккаунта? <a href="/site/register">Зарегестрироваться</a></div>
        </div>
        <?php ActiveForm::end(); ?>
      </div>
    </div>
  </div>
</div>
