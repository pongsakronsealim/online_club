<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

$this->params['breadcrumbs'][] = ['label'=>'ข้อมูลกิจกรรม', 'url'=>'index.php?r=activities/index'];
$this->params['breadcrumbs'][] = 'สร้างกิจกรรม';

?>
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">สร้างกิจกรรม</h3>

      <div class="box-tools pull-right">

      </div>
    </div>
    <div class="box-body">
        <div class="col-md-12">
          <?php $form = ActiveForm::begin([
            'action' => 'index.php?r=activities/create',
          ]); ?>
          <?= $form->field($model, 'activities_name')->textInput(['maxlength' => true]) ?>
          <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
          <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
      			'options' => ['placeholder' => ''],
      			'removeButton' => false,
      			'type' => DatePicker::TYPE_COMPONENT_APPEND,
      			'pluginOptions' => [
      				'autoclose'=>true,
      				'format' => 'yyyy/mm/dd',
      				'todayHighlight' => true
      			]
      		]); ?>
          <?= $form->field($model, 'club_id')->hiddenInput(['maxlength' => true])->label(false) ?>
          <?= $form->field($model, 'activities_id')->hiddenInput() ?>
          <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? ' บันทึก' : ' แก้ไข', ['class' => $model->isNewRecord ? 'btn bg-maroon btn-flat glyphicon glyphicon-floppy-disk' : 'btn bg-maroon btn-flat glyphicon glyphicon-floppy-disk']) ?>
            <?= Html::resetButton(' ล้างค่า', ['class' => 'btn btn-flat bg-orange glyphicon glyphicon-refresh']) ?>
          </div>

          <?php ActiveForm::end(); ?>
        </div>
    </div>
  </div>
</div>
<div class="activities-form">
