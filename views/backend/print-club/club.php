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
        <h2><b>แบบก่อตั้งชมรม</b></h2>
      </td>
    </tr>
    <tr>
      <td style="text-align:center;">
        <h3><b>มหาวิทยาลัยราชภัฏกาญจนบุรี</b></h3>
      </td>
    </tr>
    <tr>
      <td style="text-align:center;">
        <h3><b>......................................</b></h3>
      </td>
    </tr>
  </table><br>
  <table border="0" width="100%">
    <tr>
      <td style="font-size:20px;font-weight:bold;" width="17%">ชื่อชมรม : </td>
      <td style="font-size:20px;" width= "83%" colspan="2"><?php echo $model->club_name; ?></td>
    </tr>

    <tr>
      <td style="font-size:20px;font-weight:bold;">ประเภท : </td>
      <td style="font-size:20px;" colspan="2">
        <?php
          $founded_club_type = $model->founded_club_type;
          if ($founded_club_type == '1') {
            echo "ก่อตั้งใหม่(ไม่เคยมีชมรมนี้มาก่อน)";
          } else {
            echo "ขอเปิด(ชมรมเดิมที่เคยก่อตั้งแล้ว)";
          }
        ?>
      </td>
    </tr>

    <tr>
      <td style="font-size:20px;font-weight:bold;">ประเภทชมรม : </td>
      <td style="font-size:20px;" colspan="2"><?php echo Yii::$app->utilityComponent->getSomeField('type_name', 'type_club', 'WHERE type_id = "'.$model->type_id.'"'); ?></td>
    </tr>

    <tr>
      <td style="font-size:20px;font-weight:bold;" colspan="3">ผู้ก่อตั้งชมรม : </td>
    </tr>
    <tr>
      <td style="font-size:20px;font-weight:bold;"></td>
      <td style="font-size:20px;">
        <?php echo Yii::$app->utilityComponent->getSomeField('title_name', 'title', ' WHERE title_id = "'.$model_std->title_id.'" '); ?>
        <?php echo $model_std->fname;?> <?php echo $model_std->lname;?></td>
      <td style="font-size:20px;">  <?php echo Yii::$app->utilityComponent->getSomeField('major_name', 'major', ' WHERE major_id = "'.$model_std->major_id.'" '); ?> </td>
    </tr>
    <tr>
      <td style="font-size:20px;font-weight:bold;"></td>
      <td style="font-size:20px;"><?php echo Yii::$app->utilityComponent->getSomeField('faculty_name', 'faculty', ' WHERE faculty_id = "'.$model_std->faculty_id.'" '); ?></td>
      <td style="font-size:20px;">เบอร์โทรศัพท์ : <?php echo $model_std->phone ?></td>
    </tr>

    <tr>
      <td style="font-size:20px;font-weight:bold;" colspan="3">หลักการและเหตุผล : </td>
    </tr>
    <tr>
      <td style="font-size:20px;font-weight:bold;"></td>
      <td style="font-size:20px;" colspan="2"><?php echo $model->formality; ?></td>
    </tr>

    <tr>
      <td style="font-size:20px;font-weight:bold;" colspan="3">วัตถุประสงค์การตั้งชมรม : </td>
    </tr>
    <tr>
      <td style="font-size:20px;font-weight:bold;"></td>
      <td style="font-size:20px;" colspan="2"><?php echo $model->objective; ?></td>
    </tr>

    <tr>
      <td style="font-size:20px;font-weight:bold;" colspan="3">วิธีดำเนินงาน : </td>
    </tr>
    <tr>
      <td style="font-size:20px;font-weight:bold;"></td>
      <td style="font-size:20px;" colspan="2"><?php echo $model->how_the; ?></td>
    </tr>

    <tr>
      <td style="font-size:20px;font-weight:bold;">สถานที่ตั้งชมรม : </td>
      <td style="font-size:20px;" colspan="2"><?php echo $model->place; ?></td>
    </tr>

    <tr>
      <td style="font-size:20px;font-weight:bold;" colspan="3">ที่ปรึกษาชมรม : </td>
    </tr>
  </table>
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

      <table border="0" width="100%">
        <tr>
          <td style="text-align:center;">
            <img src="../web/images/Kru.png" class="center" width="120" height="150">
          </td>
        </tr>
        <tr>
          <td style="text-align:center;">
            <h3><b>สมาชิกชมรม : <?php echo $model->club_name; ?></b></h3>
          </td>
        </tr>
        <tr>
          <td style="text-align:center;">
            <h3><b>......................................</b></h3>
          </td>
        </tr>
      </table><br>
      <?= GridView::widget([
          'dataProvider' => $dataProvider_member,
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
              [
                'label'=>'ตำแหน่ง',
                'value'=>function($data){
                  return $data['procition_name'];
                },
                'contentOptions' => ['style' => 'font-size:20px;']
              ],
          ],
        ]); ?>
  <!--<table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th style="font-size:20px;">ชื่อ</th>
        <th style="font-size:20px;">สาขาวิชา</th>
        <th style="font-size:20px;">คณะ</th>
        <th style="font-size:20px;">เบอร์โทรศัพท์</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="font-size:20px;">1</td>
        <td style="font-size:20px;">John</td>
        <td style="font-size:20px;">Doe</td>
        <td style="font-size:20px;">john@example.com</td>
        <td style="font-size:20px;">john@example.com</td>
      </tr>
      <tr>
        <td style="font-size:20px;">2</td>
        <td style="font-size:20px;">Mary</td>
        <td style="font-size:20px;">Moe</td>
        <td style="font-size:20px;">mary@example.com</td>
        <td style="font-size:20px;">john@example.com</td>
      </tr>
      <tr>
        <td style="font-size:20px;">3</td>
        <td style="font-size:20px;">July</td>
        <td style="font-size:20px;">Dooley</td>
        <td style="font-size:20px;">july@example.com</td>
        <td style="font-size:20px;">john@example.com</td>
      </tr>
    </tbody>
  </table>-->
</div>
