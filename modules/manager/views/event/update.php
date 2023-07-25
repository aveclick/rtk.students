<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Event $model */
$this->title = $model->title;
?>
<div class="post-create">
  <div class="post-create__container">
    <div class='breadcrumbs'>
      <a href='/'>Главная</a> / Панель управления / <a href='/manager/event'>Управление мероприятиями</a> / <?= Html::encode($this->title) ?>
    </div>
    <div class="post-create__title">
      <h2>Редактировать запись</h2>
    </div>
    <?= $this->render('_form', [
      'model' => $model,
      'categories' => $categories,
    ]) ?>
  </div>
</div>
