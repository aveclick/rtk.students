<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ApplicationToCouncil $model */
$this->title = 'Отменить заявку';
?>
<div class="post-create">
  <div class="post-create__container">
    <div class='breadcrumbs'>
      <a href='/'>Главная</a> / Панель управления / <a href='/manager'>Управление заявками</a> / Отменить заявку
    </div>
    <div class="post-create__title">
      <h2>Отменить заявку</h2>
    </div>

    <?= $this->render('_form', [
      'model' => $model,
      ]) ?>
  </div>
</div>
