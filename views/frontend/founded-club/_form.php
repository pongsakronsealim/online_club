<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;


$this->params['breadcrumbs'][] = ['label'=>'ก่อตั้งชมรม'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">ก่อตั้งชมรม</h3>

    <div class="box-tools pull-right">

    </div>
  </div>
  <div class="box-body">
      <div class="col-md-12">
        <?php $form = ActiveForm::begin(); ?>
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <?= $form->field($model, 'club_name')->textInput(['maxlength' => true]) ?>

          <?= $form->field($model, 'founded_club_type')->radioList([1 => 'ก่อตั้งใหม่(ไม่เคยมีชมรมนี้มาก่อน)', 0 => 'ขอเปิด(ชมรมเดิมที่เคยก่อตั้งแล้ว)'])->label('ประเภท'); ?>

          <?= $form->field($model, 'type_id')->dropDownList(
                      $type_club,
                      ['prompt'=>'---กรุณาเลือก---']);
          ?>

          <?= $form->field($model, 'formality')->textarea(['rows' => 6]) ?>

          <?= $form->field($model, 'objective')->textarea(['rows' => 6]) ?>

          <?= $form->field($model, 'how_the')->textarea(['rows' => 6]) ?>

          <?= $form->field($model, 'place')->textInput(['maxlength' => true]) ?>
          <?= $form->field($model, 'banner[]')->widget(FileInput::classname(),
            ['options'=>['multiple'=>true],
              'pluginOptions' => [
                'uploadUrl' => Url::to(['/site/file-upload']),
                'uploadExtraData' => [
                  'album_id' => 20,
                  'cat_id' => 'Nature'
                  ],
                'maxFileCount' => 1
              ]
            ]);	?>
          <div class="form-group">
            <div class="pull-right">
              <?= Html::submitButton($model->isNewRecord ? ' บันทึก' : ' แก้ไข', ['class' => $model->isNewRecord ? 'btn bg-maroon btn-flat glyphicon glyphicon-floppy-disk' : 'btn bg-maroon btn-flat glyphicon glyphicon-floppy-disk']) ?>
              <?= Html::resetButton(' ล้างค่า', ['class' => 'btn btn-flat bg-orange glyphicon glyphicon-refresh']) ?>
            </div>
          </div>
        </div>
        <?php ActiveForm::end(); ?>
      </div>
  </div>
  </>
