<?php
  use yii\helpers\Url;

  $session = new \yii\web\Session();
  $session->open();
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
    <?php if ($session['status'] == 3) { ?>
      <li><a href="#"><i class="fa fa-search"></i> <span>ข้อมูลการลา</span></a></li>
      <li class="header">จัดการข้อมูล</li>
      <li><a href="<?php echo Url::to(['users/index']) ?>"><i class="fa fa-user-plus"></i> <span>จัดการข้อมูลผู้เข้าใช้</span></a></li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>จัดการข้อมูลการลา</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo Url::to(['fiscal-year/create']) ?>"><i class="fa fa-circle-o"></i> ปีงบประมาณ</a></li>
          <li><a href="<?php echo Url::to(['type-leave/create']) ?>"><i class="fa fa-circle-o"></i> ประเภทการลา</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-pie-chart"></i>
          <span>จัดการข้อมูลทั่วไป</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo Url::to(['initail/create']) ?>"><i class="fa fa-circle-o"></i> คำนำหน้าชื่อ</a></li>
          <li><a href="<?php echo Url::to(['type-personnal/create']) ?>"><i class="fa fa-circle-o"></i> ประเภทพนักงาน</a></li>
          <li><a href="<?php echo Url::to(['position/create']) ?>"><i class="fa fa-circle-o"></i> ตำแหน่ง</a></li>
          <li><a href="<?php echo Url::to(['departmant/create']) ?>"><i class="fa fa-circle-o"></i> หน่วยงาน</a></li>
        </ul>
      </li>
    <?php } elseif ($session['status'] == 1) { ?>
      <li class="header">งานส่วนบุคคล</li>
      <li><a href="<?php echo Url::to(['leave-hisory/index']) ?>"><i class="fa fa-search"></i> <span>ตรวจสอบวันลา</span></a></li>
      <li><a href="<?php echo Url::to(['take-leave/index']) ?>"><i class="fa fa-save"></i> <span>บันทึกข้อมูลการลา</span></a></li>
    <?php } elseif ($session['status'] == 2) { ?>
      <?php //$position = yii::$app->utilityComponent->getPosition();
          //if ($position == '2') {
      ?>
      <li class="header">หน่วยงาน</li>
    <?php// } elseif ($position == '3') { ?>
      <li class="header">การเจ้าหน้าที่</li>
    <?php// } elseif ($position == '4') { ?>
      <li class="header">รองผู้อำนวยการ</li>
    <?php// } ?>
      <li><a href="#"><i class="fa fa-search"></i> <span>ข้อมูลการลา</span></a></li>
      <li>
        <a href="<?php echo Url::to(['approve/index']) ?>"><i class="fa fa-calendar-check-o"></i>
          <span>อนุมัติการลา </span>
          <span class="pull-right-container">
            <small class="label pull-right bg-yellow">
              <?php //echo yii::$app->utilityComponent->getNumLeave(); ?>
            </small>
          </span>
        </a>
      </li>
    <?php } ?>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
