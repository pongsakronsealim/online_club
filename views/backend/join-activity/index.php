<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

$this->params['breadcrumbs'][] = 'ข้อมูลสรุปการเข้าร่วมกิจกรรมชมรม';
?>
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title">ข้อมูลสรุปการเข้าร่วมกิจกรรมชมรม</h3>

      </div>
      <div class="box-body">
      <h1><?= Html::encode($this->title) ?></h1>

      <?= GridView::widget([
          'dataProvider' => $dataProvider,
          'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '0'],
          'columns' => [
              ['class' => 'yii\grid\SerialColumn'],
              [
                'label'=>'ชื่อกิจกรรม',
                'value'=>function($data){
                  return $data['activities_name'];
                }
              ],
              [
                'label'=>'วันที่จัดกิจกรรม',
                'value'=>function($data){
                  return Yii::$app->utilityComponent->convertThaiFormatDate1($data['date']);
                }
              ],
              [
                'label'=>'สถานะการเข้าร่วมกิจกรรม',
                'value'=>function($data){
                  if ( $data['status'] == 1 ) {
                    return $status = "เข้าร่วม";
                  } else {
                    return $status = "ไม่เข้าร่วม";
                  }
                }
              ],
          ],
      ]); ?>
      </div>
    </div>
