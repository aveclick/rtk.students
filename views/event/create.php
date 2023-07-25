<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Post $model */
$this->title = 'Добавить запись';
?>
<div class="post-create">
  <div class="post-create__container">
    <div class='breadcrumbs'>
      <a href='/event'>Мероприятия</a> / Добавить запись
    </div>
    <div class="post-create__title">
      <h2>ДОБАВИТЬ ЗАПИСЬ</h2>
    </div>
    <?= $this->render('_form', [
      'model' => $model,
      'categories' => $categories,
      'directions' => $directions,
    ]) ?>
  </div>
</div>
