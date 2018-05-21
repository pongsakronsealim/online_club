<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

$this->title = 'ข้อมูลชมรม';
$this->params['breadcrumbs'][] = $this->title;
?>
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">รายชื่อชมรม</h3>

      <div class="box-tools pull-right">
        <?= Html::a('ก่อตั้งชมรม', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(' พิมพ์', ['print-club/club'], ['class' => 'btn btn-default glyphicon glyphicon-print', 'target'=>'bank']) ?>
      </div>
    </div>
    <div class="box-body">
      <?= GridView::widget([
          'dataProvider' => $dataProvider,
          //'filterModel' => $searchModel,
          'columns' => [
              ['class' => 'yii\grid\SerialColumn'],

              [
                'label'=>'ชื่อชมรม',
                'value'=>function($model){
                  return $model->club_name;
                }
              ],
              [
                'label'=>'ประเภทชมรม',
                'value'=>function($dataProvider){
                  $type_club = $dataProvider->typeClub->type_name;
                  return $type_club;
                }
              ],
              //'objective:ntext',
              //'place',
              //'how_the:ntext',

              ['class' => 'yii\grid\ActionColumn',
                  'template'=>' {update} {view}',
                  'buttons'=>[
                      'update' => function ($url, $dataProvider, $key) {
                          return Html::a('<i class="fa fa-user-plus"> สมัครเข้าร่วม</i> ', ['founded-club/regis-club', 'club_id'=>$dataProvider->club_id],
                                          ['class' => 'btn btn-success btn-xs']);
                      },
                      'view' => function ($url, $dataProvider, $key) {
                          return Html::a('<i class="fa fa-eye"> ดูรายละเอียด</i> ', ['view', 'id'=>$dataProvider->club_id],
                                          ['class' => 'btn btn-primary btn-xs']);
                      },
                  ]
            ],
          ],
      ]); ?>
    </div>
  </div>
