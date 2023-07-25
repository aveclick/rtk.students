<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ApplicationToCouncil $model */
$this->title = 'Назначение';
?>
<div class="post-create">
  <div class="post-create__container">
    <div class='breadcrumbs'>
      <a href='/admin'>Панель управления</a> / Назначение
    </div>
    <div class="post-create__title">
      <h2>Назначение</h2>
    </div>

    <?= $this->render('_form', [
      'model' => $model,
      'directions' => $directions,
      ]) ?>
  </div>
</div>
