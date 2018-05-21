<?
use yii\helpers\Url;
$this->title = "ลงทะเบียนเข้าร่วมชมรม ";
?>
<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title"> 
        <span><i class="fa fa-users"></i></span>
        <strong><? echo $this->title; ?> [ชื่อชมรม : <?php echo yii::$app->utilityComponent->getSomeField("club_name", "founded_club", " WHERE club_id = '".$club_id."' "); ?>]</strong></h3>
        <div class="pull-right">
            <div class="btn-group">
            </div>
        </div>
    </div>
    <div class="box-body">
   
    <br>
    <div class="col-md-12" style ="align:center">
        <div class="col-md-3">
        </div>
		<div class="col-md-6">
			<div class="box box-solid bg-teal-gradient">
				<div class="box-header">
				  <i class="glyphicon glyphicon-check"></i>
				  <h3 class="box-title" style="text-left">ผลการลงทะเบียน</h3>
					<hr>
				</div>
				<div class="box-body border-radius-none">
				  <div class="chart" id="line-chart" style="height: 150px;">
					<div class="col-md-4">
							<img src="<?php echo Yii::$app->request->baseUrl.'/qrcode/'.$regis_code.'.png'; ?>" alt="">
					</div>
					<div class="col-md-8">
					<span class="text-center">
						<h3><strong>ลงทะเบียนเรียบร้อยแล้ว</strong></h3>
                        <br>
                        <strong>
                        <p>
                        เป็นสมาชิกลำดับที่ : <?php echo yii::$app->utilityComponent->countData("club_name", "founded_club", " WHERE club_id = '".$club_id."' "); ?>
          
                        </p>
                        </strong>
             		</span>  
					</div>
				
				  </div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer no-border">
				  <div class="row">
					<div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
					</div>
					<div class="col-xs-4 text-center" style=" solid #f4f4f4">
                        <a href="<?php  echo Url::to(['/site/index']); ?>" class="btn bg-navy margin glyphicon glyphicon-home"> กลับหน้าหลัก</a>
					</div>
				  </div>
				</div>
			  </div>
		</div>
		<div class="col-md-3">
        </div>
      </div>
    </div>
</div>