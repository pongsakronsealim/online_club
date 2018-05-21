<?php
  use yii\helpers\Url;
  $session = new \yii\web\Session();
  $session->open();
?>
<header class="main-header">
  <?php if ( $session['user_type'] == "1" || $session['user_type'] == "2")  { ?>
    <a href="<?php echo Url::to(['activities/index']); ?>" class="logo">
      <span class="logo-mini">ชมรมออนไลน์</span>
      <span class="logo-lg">ชมรมออนไลน์</span>
    </a>
  <?php } else { ?>
    <a href="<?php echo Url::to(['founded-club/index']); ?>" class="logo">
      <span class="logo-mini">ชมรมออนไลน์</span>
      <span class="logo-lg">ชมรมออนไลน์</span>
    </a>
  <?php } ?>

  <nav class="navbar navbar-static-top">

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <? if($session['user_type'] == "1") { ?>
          <li>
              <?php $club_id = Yii::$app->utilityComponent->getClubID() ?>
              <a href="<?php echo Url::to(['founded-club/view','id'=>$club_id]); ?>">
                  <span class="hidden-xs">ข้อมูลชมรม</span>
              </a>
          </li>
          <li>
            <a href="<?php echo Url::to(['activities/index']); ?>">
                <span class="hidden-xs"> ข้อมูลกิจกรรม</span>
            </a>
        </li>
        <li>
            <a href="<?php echo Url::to(['check-name/create']); ?>">
                <span class="hidden-xs"> เช็คชื่อเข้าร่วมกิจกรรม</span>
            </a>
        </li>
        <li>
            <a href="<?php echo Url::to(['check-name/index']); ?>">
                <span class="hidden-xs"> ตรวจสอบการเข้าร่วมกิจกรรม</span>
            </a>
        </li>
        <? } else if($session['user_type'] == "2") { ?>
        <li>
            <?php $club_id = Yii::$app->utilityComponent->getClubID() ?>
            <a href="<?php echo Url::to(['founded-club/view','id'=>$club_id]); ?>">
                <span class="hidden-xs">ข้อมูลชมรม</span>
            </a>
        </li>
        <li>
            <a href="<?php echo Url::to(['activities/index']); ?>">
                <span class="hidden-xs">กิจกรรมของชมรม</span>
            </a>
        </li>
        <li>
            <a href="<?php echo Url::to(['join-activity/index']); ?>">
                <span class="hidden-xs">ตรวจสอบการเข้าร่วมกิจกรรม</span>
              </a>
        </li>
        <? } ?>
        <?php if ( !empty($session['username']) ) { ?>
          <li>
            <a href="#">
            <span aria-hidden="true"></span>
              <span class="hidden-xs">
                ผู้ใช้งาน : <?php echo yii::$app->utilityComponent->getStdName($session['username']) ?>
              </span>
            </a>

          </li>
          <li>
            <a href="<?php echo Url::to(['login/logout']) ?>"><span class="glyphicon glyphicon-off"></span> ออกจากระบบ</a>
          </li>
        <?php } else { ?>
          <li>
            <a href="<?php echo Url::to(['site/index']); ?>" >
                  <span class="hidden-xs">หน้าแรก </span>
            </a>
          </li>
          <li>
            <a href="<?php echo Url::to(['login/index']) ?>"><span class="glyphicon glyphicon-log-in"></span> เข้าสู่ระบบ</a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </nav>
</header>
