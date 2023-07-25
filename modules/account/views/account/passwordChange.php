<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\ChangePasswordForm */

$this->title = 'Сменить пароль';
?>
<div class="post-create">
  <div class="post-create__container">
    <div class='breadcrumbs'>
      <a href='/account'>Личный кабинет</a> / Сменить пароль
    </div>
    <div class="post-create__title">
      <h2>Сменить пароль</h2>
    </div>
    <div class="post-create__form">
      <?php $form = ActiveForm::begin(); ?>
      <?= $form->field($model, 'currentPassword')->passwordInput(['placeholder' => "Текущий пароль"]) ?>
      <?= $form->field($model, 'newPassword')->passwordInput(['placeholder' => "Новый пароль"]) ?>
      <?= $form->field($model, 'newPasswordRepeat')->passwordInput(['placeholder' => "Подтвердите пароль"]) ?>
      <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn']) ?>
      </div>

      <?php ActiveForm::end(); ?>

    </div>
  </div>
</div>
