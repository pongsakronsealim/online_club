<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'ระบบสมัครอบรมออนไลน์';
?>

<div class="site-index">
    <? echo $this->render('baner'); ?>
</div>
    <div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title"><strong>รายชื่อชมรม [ จำนวน <span class="badge bg-green"><? echo $num_club; ?></span> ชมรม]</strong></h3>
        <div class="pull-right">
            <?= Html::a('ก่อตั้งชมรม', ['founded-club/create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a(' พิมพ์', ['print-club/club'], ['class' => 'btn btn-default glyphicon glyphicon-print', 'target'=>'bank']) ?>
        </div>
    </div>
    <div class="box-body">
    <div class="body-content">
    <div class="row">
      <? foreach($model as $v_club) : ?>
        <div class="col-md-3">
          <div class="thumbnail">
          <?php 
            $img = "";
            $str_img = $v_club->banner;
            if(!empty($str_img) ) {
                $img =  Yii::$app->request->baseUrl.'/uploads/clubs/'.$v_club->banner;
            } else {
                $img = Yii::$app->request->baseUrl.'/uploads/clubs/default.png';
            }
          ?>
            <img src="<?php echo $img  ?>">
              <div class="caption">
                <span>
                    <strong>
                    <? echo $v_club->club_name; ?>      
                    </strong>
                </span> <br>
                <span style="text-align:left">
                   <!--  ประเภทชมรม -->
                </span> 
                <p> 
                <br>
                    <a href="<? echo Url::to(['founded-club/view','id' => $v_club->club_id]); ?>"  class="btn btn-flat bg-olive"> ดูรายละเอียด </a>
                    <a href="<? echo Url::to(['founded-club/regis-club', 'club_id' => $v_club->club_id]); ?>"  class="btn btn-flat bg-orange"> สมัครเข้าร่วม </a>
         
                </p>
            </div>
          </div>
        </div>
        <? endforeach; ?>
      </div><!-- End row -->
    </div>

</div>
</div>
