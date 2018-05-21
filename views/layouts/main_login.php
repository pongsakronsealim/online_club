<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\web\Session;
use yii\helpers\Url;
use yii\base\view;

AppAsset::register($this);

$session = new \yii\web\Session();
$session->open();
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= Html::csrfMetaTags() ?>
  <title>ระบบสารสนเทศด้านกิจกรรมชมรม มหาวิทยาลัยราชภัฏกาญจนบุรี</title>
  <link type="text/css" rel="stylesheet" href="../css/font-awesome.css">
  <style>
  body {
    background: #BDC3C7;
    background-image: url(<?php echo Yii::$app->request->baseUrl.'/web/images/backgrounds/1.jpg'; ?>);
    background-position:absolute;
    background-attachment: fixed;
    background-size: 100%;
  }
  </style>
  <?php $this->head() ?>
</head>
<body>
<div>
  <?= $content ?>
</div>
  <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
