<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ApplicationToCouncil $model */
$this->title = 'Оставить заявку';
?>
<div class="application-to-council-create">
  <div class="post-create">
    <div class="post-create__container">
      <div class='breadcrumbs'>
        <a href='/'>Главная</a> / Оставить заявку
      </div>
      <div class="post-create__title">
        <h2>Оставить заявку</h2>
      </div>

      <?= $this->render('_form', [
        'model' => $model,
        'directions' => $directions,
      ]) ?>
    </div>
  </div>
</div>
