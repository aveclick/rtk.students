<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LostItem $model */

$this->title = 'Update Lost Item: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Lost Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lost-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
