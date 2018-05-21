<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

$session = new \yii\web\Session();
$session->open();

$this->title = 'ข้อมูลกิจกรรม';
$this->params['breadcrumbs'][] = $this->title;

if ( $session['user_type'] == "1" ) {
  $template = ' {update} {delete} ';
} else {
  $template = ' ';
}

?>
<div class="activities-index">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">แสดงข้อมูลกิจกรรม</h3>

      <div class="box-tools pull-right">
        <?php if ( $session['user_type'] == "1" ) { ?>
          <?= Html::a('สร้างกิจกรรม', ['create'], ['class' => 'btn btn-success']) ?>
        <?php } ?>
      </div>
    </div>
    <div class="box-body">
        <div class="col-md-12">
          <?= GridView::widget([
              'dataProvider' => $dataProvider,
              'columns' => [
                  ['class' => 'yii\grid\SerialColumn'],

                  //'activities_id',
                  [
                    'label'=>'ชื่อกิจกรรม',
                    'value'=>function($model){
                        return $model->activities_name;
                    }
                  ],
                  //'description:ntext',
                  [
                    'label'=>'วันที่จัดกิจกรรม',
                    'value'=>function($model){
                        return Yii::$app->utilityComponent->convertThaiFormatDate1($model->date);
                    }
                  ],
                  //'club_id',

                    ['class' => 'yii\grid\ActionColumn',
                        'template'=>$template,
                        'buttons'=>[
                            'update' => function ($url, $dataProvider, $key) {
                                return Html::a('<i class="fa fa-pencil"></i> ', ['update', 'id'=>$dataProvider->activities_id],
                                                ['class' => 'btn btn-success btn-xs']);
                            },
                            'delete' => function ($url, $dataProvider, $key) {
                                return Html::a('<i class="fa fa-times"></i>','#', [
                                    'class'       => 'btn btn-danger btn-xs  popup-modal',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal-delete',
                                    'data-id'     => $dataProvider->activities_id,
                                    'id'          => 'popupModal',
                                ]);
                            },
                        ]
                    ],
              ],
          ]); ?>
        </div>
    </div>
  </div>
</div>

<?php Modal::begin([
    'header' => '<h2 class="modal-title">ยืนยัน</h2>',
    'id'     => 'modal-delete',
]);
 echo "
		  <div class='modal-body'>
			<p>คุณต้องการลบข้อมูลใช่หรือไม่?</p>
		  </div>
		  <div class='modal-footer'>
			<button type='button' id='delete-confirm' name='delete-confirm' class='btn btn-danger'>ใช่</button>
			<button type='button' class='btn btn-default' data-dismiss='modal'>ยกเลิก</button>
		  </div>
		"; ?>
<?php Modal::end(); ?>

<script type="text/javascript">

$(document).ready(function() {
	$("#f_form").on('pjax:end', function() {
		$.pjax.reload({container:"#shows"});
    });
});

$(".popup-modal").click(function(e) {

    e.preventDefault();
    var that = $(this);
    var id = that.data("id");
    var name = that.data("name");
    $("#modal-delete").show();
    $("#delete-confirm").click(function(e) {
        e.preventDefault();
        window.location = 'index.php?r=activities/delete&id='+id;
        //alert(id);
    });
});

</script>
