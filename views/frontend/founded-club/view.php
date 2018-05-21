<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

$session = new \yii\web\Session();
$session->open();

if ( empty( $session['username'] ) ) {
  $this->title = $model->club_id;
  $this->params['breadcrumbs'][] = ['label' => 'รายชื่อชมรม', 'url' => ['site/index']];
  $this->params['breadcrumbs'][] = 'รายละเอียดชมรม';
} else {
  $this->params['breadcrumbs'][] = 'ข้อมูลชมรม';
}

?>
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">ข้อมูลชมรม</h3>
    <div class="box-tools pull-right">
      <?php
        if ( $session['user_type'] == '1' ) {
        $club_id = Yii::$app->utilityComponent->getClubID();
      ?>
        <?= Html::a(' ดูข้อมูลสมาชิกชมรม', ['member','id'=>$club_id], ['class' => 'btn btn-primary glyphicon glyphicon-eye-open']) ?>
        <?= Html::a(' พิมพ์', ['print-club/print','id'=>$club_id], ['class' => 'btn btn-default glyphicon glyphicon-print', 'target'=>'bank']) ?>
      <?php } ?>
    </div>
  </div>

  <div class="box-body">
    <div class="col-md-12">
      <div class="col-md-3">
        <div class="pull-right">
          ชื่อชมรม :
        </div>
      </div>
      <div class="col-md-6">
        <?php echo $model->club_name; ?>
      </div>
    </div>

    <div class="col-md-12">
      <div class="col-md-3">
        <div class="pull-right">
          ประเภท :
        </div>
      </div>
      <div class="col-md-6">
        <?php
          $founded_club_type = $model->founded_club_type;
          if ($founded_club_type == '1') {
            echo "ก่อตั้งใหม่(ไม่เคยมีชมรมนี้มาก่อน)";
          } else {
            echo "ขอเปิด(ชมรมเดิมที่เคยก่อตั้งแล้ว)";
          }
        ?>
      </div>
    </div>

    <div class="col-md-12">
      <div class="col-md-3">
        <div class="pull-right">
          ประเภทชมรม :
        </div>
      </div>
      <div class="col-md-6">
        <?php echo Yii::$app->utilityComponent->getSomeField('type_name', 'type_club', 'WHERE type_id = "'.$model->type_id.'"'); ?>
      </div>
    </div>

    <div class="col-md-12">
      <div class="col-md-3">
        <div class="pull-right">
          หลักการและเหตุผล :
        </div>
      </div>
      <div class="col-md-6">
        <?php echo $model->formality; ?>
      </div>
    </div>

    <div class="col-md-12">
      <div class="col-md-3">
        <div class="pull-right">
          วัตถุประสงค์การตั้งชมรม :
        </div>
      </div>
      <div class="col-md-6">
        <?php echo $model->objective; ?>
      </div>
    </div>

    <div class="col-md-12">
      <div class="col-md-3">
        <div class="pull-right">
          วิธีดำเนินงาน :
        </div>
      </div>
      <div class="col-md-6">
        <?php echo $model->how_the; ?>
      </div>
    </div>

    <div class="col-md-12">
      <div class="col-md-3">
        <div class="pull-right">
          สถานที่ตั้งชมรม :
        </div>
      </div>
      <div class="col-md-6">
        <?php echo $model->place; ?>
      </div>
    </div>

  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">ที่ปรึกษาชมรม</h3>
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
                      'label'=>'เบอร์โทรศัพท์',
                      'value'=>function($data){
                        return $data['phone'];
                      }
                    ],
                ],
            ]); ?>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">คณะทำงานชมรม</h3>
        <div class="box-tools pull-right">

        </div>
      </div>

      <div class="box-body">
        <?= GridView::widget([
                'dataProvider' => $dataProvider_member,
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
                      'label'=>'ตำแหน่ง',
                      'value'=>function($data){
                        return $data['procition_name'];
                      }
                    ],

                    [
                      'label'=>'เบอร์โทรศัพท์',
                      'value'=>function($data){
                        return $data['phone'];
                      }
                    ],
                ],
            ]); ?>
      </div>
    </div>
  </div>
</div>
