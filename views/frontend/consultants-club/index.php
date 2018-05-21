<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consultants-club-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'shows']) ?>
    <div class="col-md-12">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
              'label'=>'อ.ที่ปรึกษาชมรม',
              'value'=>function($data){
                $name = yii::$app->utilityComponent->getConsultantsName($data['teacher_id']);
                return $name;
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
                        'data-id'     => $dataProvider->consultants_id,
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
        window.location = 'index.php?r=consultants-club/delete&id='+id;
        //alert(id);
    });
});

</script>
