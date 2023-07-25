<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ApplicationToCouncil $model */
$this->title = 'Назначение';
?>
<div class="post-create">
  <div class="post-create__container">
    <div class='breadcrumbs'>
      <a href='/account'>Личный кабинет</a> / Редактировать профиль
    </div>
    <div class="post-create__title">
      <h2>Редактировать профиль</h2>
    </div>

    <?= $this->render('_form', [
      'model' => $model,
      'categories' => $categories,
      ]) ?>
  </div>
</div>
