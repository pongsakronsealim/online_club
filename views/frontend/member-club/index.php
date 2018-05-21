<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-club-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'shows_member_club']) ?>
    <div class="col-md-12">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
            [
              'label'=>'สถานะ',
              'value'=>function($model){
                if ($model->status_club == 1) {
                  $status_club = "ผู้ดูแลชมรม";
                } else {
                  $status_club = "ผู้ใช้งานทั่วไป";
                }
                return $status_club;
              }
            ],

            ['class' => 'yii\grid\ActionColumn',
            'template'=>'{delete}',
            'buttons'=>[
                'delete' => function ($url, $dataProvider, $key) {
                    return Html::a('<i class="fa fa-times"></i>','#', [
                        'class'       => 'btn btn-danger btn-xs  popup-modal',
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-delete',
                        'data-id'     => $dataProvider->id,
                        'id'          => 'popupModal',
                    ]);
                },
            ]
          ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
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
