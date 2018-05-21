<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

$this->title = "เช็คชื่อเข้าร่วมกิจกรรม";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-club-index">
<div class="col-md-12">

    <?php Pjax::begin(['id' => 'shows_member_club']) ?>
    <div class="">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'options' => [
            'id' => 'gridview-id'
        ],
        'rowOptions' => function ($model, $key, $index, $grid) { //สามารถกำหนด data-key ใหม่ (ปกติจะใช้ PK)
            return ['data' => ['key' => $model->std_id]];
        },
      'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'class' => 'yii\grid\CheckboxColumn',
            'header' => Html::checkBox('selection_all', false, [
                'class' => 'select-on-check-all',
                'label' => 'เลือกทั้งหมด'
                
            ]),
        ],
        [
            'label'=>'รหัสนักศึกษา',
            'value'=>function($model){
                return $model->std_id;
            }
          ],
          [
            'label'=>'ชื่อ-นามสกุล',
            'value'=>function($data){
              $name = yii::$app->utilityComponent->getStudentName($data['std_id']);
              return $name;
            }
          ],
          [
            'label'=>'ตำแหน่ง',
            'value'=>function($data){
              $position = yii::$app->utilityComponent->getPosition($data['position']);
              return $position;
            }
          ],
         /* ['class' => 'yii\grid\ActionColumn',
          'template'=>'{delete}',
          'buttons'=>[
              'delete' => function ($url, $dataProvider, $key) {
                  return Html::a('<i class="glyphicon glyphicon-check"></i>','#', [
                      'class'       => 'btn btn-success btn-xs ',
                      'data-toggle' => 'modal',
                      'data-target' => '#modal-delete',
                      'data-id'     => $dataProvider->id,
                      'id'          => 'popupModal',
                  ]);
              },
          ]
          ],*/
      ],
  ]); ?>
   
    <?php Pjax::end(); ?>
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
	$("#f_member").on('pjax:end', function() {
		$.pjax.reload({container:"#shows_member_club"});
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
        window.location = 'index.php?r=member-club/delete&id='+id;
        //alert(id);
    });
});

</script>
