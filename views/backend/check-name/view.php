<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->params['breadcrumbs'][] = ['label'=>'ข้อมูลการเข้าร่วมกิจกรรม', 'url'=>'index.php?r=check-name/index'];
$this->params['breadcrumbs'][] = 'ข้อมูลรายชื่อผู้เข้าร่วมกิจกรรม';
?>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">ข้อมูลรายชื่อผู้เข้าร่วมกิจกรรม[ชื่อ : <?php echo $name_activities; ?>]</h3>
    <div class="box-tools pull-right">
      <?= Html::a(' พิมพ์', ['print-club/activities','id'=>$_GET['id'] ], ['class' => 'btn btn-default glyphicon glyphicon-print', 'target'=>'bank']) ?>
    </div>
  </div>

  <div class="box-body">
    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                  'label'=>'ชื่อ',
                  'value'=>function($data){
                    return $data['name'];
                  }
                ],

                [
                  'label'=>'สาขาวิชา',
                  'value'=>function($data){
                    return $data['major_name'];
                  }
                ],

                [
                  'label'=>'คณะ',
                  'value'=>function($data){
                    return $data['faculty_name'];
                  }
                ],
            ],
        ]); ?>
  </div>
</div>
