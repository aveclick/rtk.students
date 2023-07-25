<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PostSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="posts-search">
  <div class="row">
    <div class="col-md-6">
      <div class="sort-section__title">Соритировать по:</div>
      <div class="row sort">
        <div class="sort-section__item"><?= $dataProvider->sort->link('created_at')?></div>
        <div class="sort-section__item"><?= $dataProvider->sort->link('date')?></div>
      </div>
      <div class='sort-section__btn'>
        <?= Html::a('Сбросить все', ['/event'], ['class' => 'btn'])?>
      </div>
    </div>
    <div class="col-md-6">
      <div class="filter-section__search">
        <?php $form = ActiveForm::begin([
          'action' => ['index'],
          'method' => 'get',
          'options' => [
            'data-pjax' => 1
          ],
        ]); ?>
        <?php
        $params = [
          'prompt' => 'Все категории'
        ];
        echo $form->field($model, 'category_id')->dropDownList($categories, $params)->label('Выберите категорию');
        ?>
        <div class='filter-section__btn'>
          <?= Html::submitButton('Найти', ['class' => 'btn'])?>
        </div>
        <?php ActiveForm::end()?>
      </div>
      <div class="filter-section__search">
        <?php $form = ActiveForm::begin([
          'action' => ['index'],
          'method' => 'get',
          'options' => [
            'data-pjax' => 1
          ],
        ]); ?>
        <?php
        $params = [
          'prompt' => 'Все направления'
        ];
        echo $form->field($model, 'direction_id')->dropDownList($directions, $params)->label('Выберите направление');
        ?>
        <div class='filter-section__btn'>
          <?= Html::submitButton('Найти', ['class' => 'btn'])?>
        </div>
        <?php ActiveForm::end()?>
      </div>
    </div>
  </div>
</div>
