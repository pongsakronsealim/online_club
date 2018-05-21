<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Account;
use yii\web\Session;
$session = new Session();
$session->open();
?>

<div class="login-page1">
  <div class="form">
  <div>
      <img class="profile-img" src="images/Kru.png" width="150px" alt="">
  </div>
  <div style="color:white;"><h4>ระบบสารสนเทศด้านกิจกรรมชมรม</h4></div>
  <div style="color:white;"><h5>มหาวิทยาลัยราชภัฏกาญจนบุรี</h5></div>
  <br>
    <?php $f = ActiveForm::begin(); ?>
      <?= $f->field($account, 'username')->textInput(['placeholder'=>'ชื่อผู้ใช้งาน'])->label(false); ?>
      <?= $f->field($account, 'password')->passwordInput(['placeholder'=>'รหัสผ่าน'])->label(false); ?>
      <?= Html::submitButton('เข้าสู่ระบบ' , ['class' => 'button']) ?>
    <?php ActiveForm::end(); ?>
  </div>
</div>
