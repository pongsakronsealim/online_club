<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use yii\jui\AutoComplete;
use yii\helpers\Url;
use yii\web\JsExpression;

$session = new \yii\web\Session();
$session->open();

$this->params['breadcrumbs'][] = ['label'=>'ก่อตั้งชมรม', 'url'=>'index.php?r=founded-club/create'];
$this->params['breadcrumbs'][] = 'อ.ที่ปรึกษาชมรม';
?>

    <?php Pjax::begin(['id' => 'f_form']) ?>
    <?php $form = ActiveForm::begin([
      'action' => 'index.php?r=consultants-club/create',
      'layout' => 'horizontal',
      'fieldConfig' => [
          'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
          'horizontalCssClasses' => [
              'label' => 'col-sm-3',
              'offset' => 'col-sm-offset-1',
              'wrapper' => 'col-sm-9',
              'error' => '',
              'hint' => '',
          ],
      ],
    ]); ?>

          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">อ.ที่ปรึกษาชมรม [ชื่อชมรม : <?php echo $name_club; ?>]</h3>

              <div class="box-tools pull-right">
                <?= Html::a('เพิ่มคณะทำงานชมรม', ['member-club/create'], ['class' => 'btn btn-success']) ?>
              </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                  <div class="col-md-3">
                    <?php Pjax::begin(['id' => 'fCust']) ?>
								<?php $url = \yii\helpers\Url::to(['cust-autocomplete']); ?>
								<?=$form->field($model, 'teacher_id',
									[
									'template' => '<div class="input-group">{input}<span class="input-group-btn">' .
									Html::Button('<i class="glyphicon glyphicon-search"></i>', ['class' => 'btn btn-primary',
									'onclick'=>"return searchCustomer()",
									'data-toggle'=> "modal",
									'data-target'=> "#modal_search_cust"]) .
									'</span>
									</div>',
									])->widget(\yii\jui\AutoComplete::classname(), [
									'clientOptions' => [
									'id'=> 'cust_id',
									'name'=> 'cust_id',
									'source'=> Url::to(['autocomplete/teacher-autocomplete']),
									'autoFill' => true,
									'minLength' => '1',
									'select' => new JsExpression("function( event, ui ) {
									console.log(ui);
									if(ui.item.value == 'ไม่พบข้อมูล' ){

									}
									$('#name').val(ui.item.name);
									}"),
									],
									'options' => [
									'class' => 'form-control',
									'placeholder' =>'กรอกชื่ออาจารย์/นามสกุล'
									]
								])->label(false);?>

								<?php Pjax::end() ?>
                  </div>
                  <div class="col-md-4">
                    <input type="text" class="form-control" value="" id="name" name="name" size="120" readonly >
                  </div>
                  <div class="col-md-4">
                    <?= Html::submitButton($model->isNewRecord ? ' เพิ่ม' : ' แก้ไข', ['class' => $model->isNewRecord ? 'btn bg-maroon btn-flat glyphicon glyphicon-plus' : 'btn bg-maroon btn-flat glyphicon glyphicon-floppy-disk']) ?>
                    <?= Html::resetButton(' ล้างค่า', ['class' => 'btn btn-flat bg-orange glyphicon glyphicon-refresh']) ?>
                  </div>
                  <?= $form->field($model, 'club_id')->hiddenInput(['maxlength' => true,'value'=>$session['club_id'] ])->label(false) ?>
                  <?= $form->field($model, 'consultants_id')->hiddenInput(['maxlength' => true])->label(false) ?>
                  <?php ActiveForm::end(); ?>
                  <?php Pjax::end(); ?>



                <div class="col-md-12">
                    <?php echo $this->render('index', [
                      'dataProvider' => $dataProvider
                    ]); ?>
                </div>
                </div>
            </div>
          </div>
