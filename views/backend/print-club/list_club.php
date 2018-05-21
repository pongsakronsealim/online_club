<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

?>
<div class="container">
      <table border="0" width="100%">
        <tr>
          <td style="text-align:center;">
            <img src="../web/images/Kru.png" class="center" width="120" height="150">
          </td>
        </tr>
        <tr>
          <td style="text-align:center;">
            <h3><b>สรุปรายชื่อชมรม</b></h3>
          </td>
        </tr>
        <tr>
          <td style="text-align:center;">
            <h3><b>มหาวิทยาลัยราชภัฎกาญจนบุรี</b></h3>
          </td>
        </tr>
        <tr>
          <td style="text-align:center;">
            <h3><b>......................................</b></h3>
          </td>
        </tr>
      </table><br>
      <?= GridView::widget([
          'dataProvider' => $dataProvider,
          'options' => ['style' => 'font-size:20px;'],
          'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '0'],
          'columns' => [
              ['class' => 'yii\grid\SerialColumn'],
              [
                'label'=>'ชื่อชมรม',
                'value'=>function($data){
                  return $data['club_name'];
                },
                'contentOptions' => ['style' => 'font-size:20px;']
              ],
              [
                'label'=>'ประเภทชมรม',
                'value'=>function($data){
                  return $data['type_name'];
                },
                'contentOptions' => ['style' => 'font-size:20px;']
              ],
              [
                'label'=>'ชื่อผู้ก่อตั้ง',
                'value'=>function($data){
                  return $data['name'];
                },
                'contentOptions' => ['style' => 'font-size:20px;']
              ],
              [
                'label'=>'จำนวนสมาชิก(คน)',
                'value'=>function($data){
                  return $data['num_member'];
                },
                'contentOptions' => ['style' => 'font-size:20px;']
              ],
          ],
        ]); ?>
</div>
