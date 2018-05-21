<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

$session = new \yii\web\Session();
$session->open();

$club_id = Yii::$app->utilityComponent->getClubID();
$this->title = $model->club_id;
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลชมรม', 'url' => ['view','id'=>$club_id]];
$this->params['breadcrumbs'][] = 'สมาชิกชมรม';

?>
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">สมาชิกชมรม</h3>
    <div class="box-tools pull-right">

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
                  'label'=>'ชื่อเล่น',
                  'value'=>function($data){
                    return $data['nickname'];
                  }
                ],

                [
                  'label'=>'สาขา',
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

                [
                  'label'=>'เบอร์โทรศัพท์',
                  'value'=>function($data){
                    return $data['phone'];
                  }
                ],

                [
                  'label'=>'ตำแหน่ง',
                  'value'=>function($data){
                    return $data['procition_name'];
                  }
                ],
            ],
        ]); ?>
  </div>
</div>
