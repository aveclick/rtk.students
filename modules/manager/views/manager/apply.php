<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ApplicationToCouncil $model */
$this->title = 'Подтвердить заявку';
?>
<div class="post-create">
  <div class="post-create__container">
    <div class='breadcrumbs'>
      <a href='/'>Главная</a> / Панель управления / <a href='/manager'>Управление заявками</a> / Подтвердить заявку
    </div>
    <div class="post-create__title">
      <h2>Подтвердить заявку</h2>
    </div>

    <?= $this->render('_form', [
      'model' => $model,
      ]) ?>
  </div>
</div>
