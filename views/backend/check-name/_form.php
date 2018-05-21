<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;
?>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">เช็คชื่อเข้าร่วมกิจกรรม</h3>

    <div class="box-tools pull-right">

    </div>
  </div>
  <div class="box-body">
      <div class="col-md-12">
        <?php $form = ActiveForm::begin(
          [
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
          ]
        ); ?>

        <br><br>
        <?= $form->field($model, 'activities_id')->widget(Select2::classname(), [
								'data' => $activity_name,
								'options' => ['id'=>'ddl-acitivities','placeholder' => '----- เลือกกิจกรรม-----']
					]); ?>
      
          <div class="col-md-10">
                  <div class="pull-right">
                  <?= Html::button(Yii::t('app', ' บันทึก'), ['class' => 'btn bg-maroon btn-flat glyphicon glyphicon-floppy-disk',
                                    'id'=>'btn_save',
                                    'data-toggle' => "modal" ,
                                    "data-target" => "#modalConfirm"]) ?>
                   </div>
                   <?php echo $this->render('//backend/activities/join_act', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider
            ]); ?>
          </div>

        <?php ActiveForm::end(); ?>
        
      
      </div>
  </div>
</div>


<?php Modal::begin([
    'header' => '<h2 class="modal-title">ยืนยัน</h2>',
    'id'     => 'modalConfirm',
]);
 echo "
		  <div class='modal-body'>
			<p>คุณต้องการบันทึกข้อมูลการเข้าร่วมกิจกรรมใช่หรือไม่?</p>
		  </div>
		  <div class='modal-footer'>
        <button type='button' id='delete_confirm' name='delete_confirm' class='btn btn-danger'>ใช่</button>
        <button type='button' class='btn btn-default' data-dismiss='modal'>ยกเลิก</button>
		  </div>
		"; ?>
<?php Modal::end(); ?>


<script type="text/javascript">
$("#btn_save").click(function(e) {
e.preventDefault();
$("#modal-confirm").show();
$("#delete_confirm").click(function(e) {
    e.preventDefault();
    var std_id = $("#gridview-id").yiiGridView("getSelectedRows");
    var activities_id = $("#ddl-acitivities").val();
    if(std_id == "" || activities_id == "" ){
      alert("ยังไม่ได้เลือกข้อมูล");
    }else {
      alert(std_id);
        if(std_id.length > 0){
          $.post("index.php?r=check-name/check",{
            prm_std_id: std_id.join(),
            prm_activities_id: activities_id,
          },function(){

          })
          .done(function(data) { //callback
            alert(data);
          });
        }
    }
       // window.location = 'index.php?r=member-club/delete&id='+id;
        //alert(id);
    });
});
</script>
