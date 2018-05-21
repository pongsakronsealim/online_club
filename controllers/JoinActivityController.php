<?php

namespace app\controllers;

use Yii;
use app\models\Activities;
use app\models\ActivitiesSearch;
use app\models\CheckName;
use app\models\CheckNameSearch;
use app\models\Student;
use app\models\StudentSearch;
use yii\web\Controller;
use yii\data\SqlDataProvider;


class JoinActivityController extends Controller
{
    public $layout = "main_frontend";

    public function actionIndex() {
      $session = new \yii\web\Session();
      $session->open();

      $sql = " SELECT a.activities_name, s.fname, s.lname, a.date, cn.status
               FROM check_name cn
               LEFT JOIN activities a ON cn.activities_id = a.activities_id
               LEFT JOIN  student s ON cn.member_id = s.stu_id
               WHERE cn.member_id = '".$session['username']."' ";
      $dataProvider = new SqlDataProvider([
        'sql'=>$sql
      ]);

      return $this->render('//backend/join-activity/index.php', [
        'dataProvider' => $dataProvider,
      ]);
    }
}
?>
