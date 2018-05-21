<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ConsultantsClub */

$this->title = 'Update Consultants Club: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Consultants Clubs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->consultants_id, 'url' => ['view', 'id' => $model->consultants_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="consultants-club-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
