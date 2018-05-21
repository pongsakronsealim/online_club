<?php
use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div style="border: solid 1px rgb(236, 236, 236);border-radius: 5px;padding: 20px;">
    <?= $content ?>
</div>
<p style="text-align:right;margin-top:5px;"> สถาบันคุณวุฒิวิชาชีพ (องค์การมหาชน)  <small ><i>โทร 02 617 7970 </i></small></p>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>