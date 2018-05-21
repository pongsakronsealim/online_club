<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\jui\AutoComplete;
use yii\helpers\Url;
use yii\web\JsExpression;

$this->params['breadcrumbs'][] = ['label'=>'ก่อตั้งชมรม', 'url'=>'index.php?r=founded-club/create'];
$this->params['breadcrumbs'][] = ['label'=>'อ.ที่ปรึกษาชมรม', 'url'=>'index.php?r=consultants-club/create'];
$this->params['breadcrumbs'][] = 'คณะทำงานชมรม';
?>


    <?php Pjax::begin(['id' => 'f_member']) ?>
    <?php $form = ActiveForm::begin([
      'action' => 'index.php?r=member-club/create',
      'layout' => 'horizontal',
      'fieldConfig' => [
          'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
          'horizontalCssClasses' => [
              'label' => 'col-sm-3',
              'offset' => 'col-sm-offset-1',
              'wrapper' => 'col-sm-5',
              'error' => '',
              'hint' => '',
          ],
      ],
    ]); ?>

          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">คณะทำงานชมรม [ชื่อชมรม : <?php echo $name_club; ?>]</h3>

              <div class="box-tools pull-right">
                <?= Html::a('สิ้นสุดการก่อตั้งชมรม', ['founded-club/index'], ['class' => 'btn btn-success']) ?>
              </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <?php Pjax::begin(['id' => 'fCust']) ?>
								    <?php $url = \yii\helpers\Url::to(['cust-autocomplete']); ?>
                        <?=$form->field($model, 'std_id')->widget(\yii\jui\AutoComplete::classname(), [
        									'clientOptions' => [
        									'id'=> 'cust_id',
        									'name'=> 'cust_id',
        									'source'=> Url::to(['autocomplete/student-autocomplete']),
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
        									'placeholder' =>'กรอกชื่อ/นามสกุล'
        									]
        								])->label(true);?>
                    <?php Pjax::end(); ?>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">ชื่อ-นามสกุล</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" value="" id="name" name="name" size="120" readonly >
                      </div>
                    </div>
                      <?= $form->field($model, 'position')->dropDownList(
                                  $position,
                                  ['prompt'=>'---กรุณาเลือก---']);
                      ?>
                      <?php $status_club = ['1'=>'ผู้ดูแลชมรม', '2'=>'ผู้ใช้งานทั่วไป']; ?>
                      <?= $form->field($model, 'status_club')->dropDownList(
                          $status_club,
                          ['prompt'=>'---กรุณาเลือก---']);
                      ?>
                </div>
                <div class="col-md-8">
                  <div class="pull-right">
                    <?= Html::submitButton($model->isNewRecord ? ' เพิ่ม' : ' แก้ไข', ['class' => $model->isNewRecord ? 'btn bg-maroon btn-flat glyphicon glyphicon-plus' : 'btn bg-maroon btn-flat glyphicon glyphicon-floppy-disk']) ?>
                    <?= Html::resetButton(' ล้างค่า', ['class' => 'btn btn-flat bg-orange glyphicon glyphicon-refresh']) ?>
                    <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
                    <?= $form->field($model, 'club_id')->hiddenInput(['maxlength' => true])->label(false) ?>
                  </div>
                </div>
                <div class="col-md-12">
                    <?php echo $this->render('//frontend/member-club/index', [
                      'dataProvider' => $dataProvider
                    ]); ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
          </div>