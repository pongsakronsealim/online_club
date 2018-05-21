<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = "ข้อมูลการเข้าร่วมกิจกรรม";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">ข้อมูลการเข้าร่วมกิจกรรม</h3>
    <div class="box-tools pull-right">
      
    </div>
  </div>

  <div class="box-body">
    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                  'label'=>'ชื่อกิจกรรม',
                  'value'=>function($data){
                    return $data['activities_name'];
                  }
                ],

                [
                  'label'=>'จำนวนสมาชิกที่เข้าร่วมกิจกรรม(คน)',
                  'value'=>function($data){
                    return $data['num_member'];
                  }
                ],

                ['class' => 'yii\grid\ActionColumn',
                    'template'=>' {view}',
                    'buttons'=>[
                        'view' => function ($url, $dataProvider, $key) {
                            return Html::a('<i class="fa fa-eye"> ดูรายชื่อ</i> ', ['view', 'id'=>$dataProvider['activities_id'] ],
                                            ['class' => 'btn btn-primary btn-xs']);
                        },
                    ]
              ],
            ],
        ]); ?>
  </div>
</div>
