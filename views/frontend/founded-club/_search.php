<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FoundedClubSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="founded-club-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'club_id') ?>

    <?= $form->field($model, 'club_name') ?>

    <?= $form->field($model, 'founded_club_type') ?>

    <?= $form->field($model, 'type_id') ?>

    <?= $form->field($model, 'formality') ?>

    <?php // echo $form->field($model, 'objective') ?>

    <?php // echo $form->field($model, 'place') ?>

    <?php // echo $form->field($model, 'how_the') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
