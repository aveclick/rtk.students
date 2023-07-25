<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ApplicationToCouncil $model */

$this->title = 'Create Application To Council';
$this->params['breadcrumbs'][] = ['label' => 'Application To Councils', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="application-to-council-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
