<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->title = 'Update Student: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->stu_id, 'url' => ['view', 'id' => $model->stu_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
