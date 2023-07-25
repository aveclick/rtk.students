<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Event $model */
$this->title = 'Добавить запись';
?>
<div class="post-create">
  <div class="post-create__container">
    <div class='breadcrumbs'>
      <a href='/'>Главная</a> / Панель управления / <a href='/manager/event'>Управление мероприятиями</a> / Добавить запись
    </div>
    <div class="post-create__title">
      <h2>Добавить запись</h2>
    </div>
    <?= $this->render('_form', [
      'model' => $model,
      'categories' => $categories,
      'directions' => $directions,
    ]) ?>
  </div>
</div>
