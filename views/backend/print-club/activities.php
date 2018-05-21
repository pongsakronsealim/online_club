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
            <h3><b>รายชื่อผู้เข้าร่วมกิจกรรม : <?php echo $model_ac->activities_name; ?></b></h3>
          </td>
        </tr>
        <tr>
          <td style="text-align:center;">
            <h3><b>ชมรม : <?php echo $model->club_name; ?></b></h3>
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
                'label'=>'ชื่อ',
                'value'=>function($data){
                  return $data['name'];
                },
                'contentOptions' => ['style' => 'font-size:20px;']
              ],
              [
                'label'=>'สาขาวิชา',
                'value'=>function($data){
                  return $data['major_name'];
                },
                'contentOptions' => ['style' => 'font-size:20px;']
              ],
              [
                'label'=>'คณะ',
                'value'=>function($data){
                  return $data['faculty_name'];
                },
                'contentOptions' => ['style' => 'font-size:20px;']
              ],
              [
                'label'=>'เบอร์โทรศัพท์',
                'value'=>function($data){
                  return $data['phone'];
                },
                'contentOptions' => ['style' => 'font-size:20px;']
              ],
          ],
        ]); ?>
</div>
