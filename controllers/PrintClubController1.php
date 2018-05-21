<?php



namespace app\controllers;



use Yii;

use app\models\FoundedClub;

use app\models\Student;

use app\models\Activities;

use yii\web\Controller;

use yii\data\SqlDataProvider;

use kartik\mpdf\Pdf;





class PrintClubController extends Controller

{

    public function actionPrint()

    {

      $session = new \yii\web\Session();

      $session->open();



      $strClubID = yii::$app->utilityComponent->getClubID();

      $model = FoundedClub::findOne($strClubID);

      $model_std = Student::findOne($session['username']);



      $sql = " SELECT concat(ti.title_name, t.fname, ' ', t.lname) AS name, m.major_name, f.faculty_name, t.phone

               FROM consultants_club cc

               LEFT JOIN teacher t ON cc.teacher_id = t.teacher_id

               LEFT JOIN title ti ON t.title_id = ti.title_id

               LEFT JOIN major m ON m.major_id = t.major_id

               LEFT JOIN faculty f ON f.faculty_id = t.faculty_id

               WHERE cc.club_id = '".$strClubID."' ";

      $dataProvider = new SqlDataProvider([

       'sql'=>$sql

      ]);



      $sql_member = " SELECT concat(ti.title_name, s.fname, ' ', s.lname) AS name, s.nickname, m.major_name,

                             f.faculty_name, s.phone, p.procition_name

                      FROM member_club mc

                      LEFT JOIN student s ON mc.std_id = s.stu_id

                      LEFT JOIN title ti ON ti.title_id = s.title_id

                      LEFT JOIN major m ON m.major_id = s.major_id

                      LEFT JOIN faculty f ON f.faculty_id = s.faculty_id

                      LEFT JOIN procition p ON mc.position = p.procition_id

                      WHERE mc.club_id = '".$strClubID."' ";

      $dataProvider_member = new SqlDataProvider([

       'sql'=>$sql_member

      ]);



      $content = $this->renderPartial('//backend/print-club/club.php', [

        'model' => $model,

        'model_std' => $model_std,

        'dataProvider' => $dataProvider,

        'dataProvider_member' => $dataProvider_member,

      ]);



      return  $this->printPDF($content);

    }



    public function actionActivities($id)

    {

      $session = new \yii\web\Session();

      $session->open();



      $strClubID = yii::$app->utilityComponent->getClubID();

      $model = FoundedClub::findOne($strClubID);

      $model_ac = Activities::findOne($id);



      $sql = " SELECT concat(ti.title_name, s.fname, ' ', s.lname) AS name, m.major_name, f.faculty_name, s.phone

               FROM check_name cn

               LEFT JOIN student s ON cn.member_id = s.stu_id

               LEFT JOIN title ti ON ti.title_id = s.title_id

               LEFT JOIN major m ON m.major_id = s.major_id

               LEFT JOIN faculty f ON f.faculty_id = s.faculty_id

               WHERE cn.activities_id = '".$id."' ";

      $dataProvider = new SqlDataProvider([

       'sql'=>$sql

      ]);



      $content = $this->renderPartial('//backend/print-club/activities.php', [

        'model' => $model,

        'model_ac' => $model_ac,

        'dataProvider' => $dataProvider,

      ]);



      return  $this->printPDF($content);

    }



    public function actionClub()

    {

      $sql = " SELECT t1.club_name, t1.type_name, t2.name, t3.num_member

               FROM ( SELECT fc.club_id, fc.club_name, tc.type_name

                      FROM founded_club fc

                      LEFT JOIN type_club tc ON fc.type_id = tc.type_id ) AS t1

               LEFT JOIN ( SELECT mc.club_id, concat(t.title_name, s.fname, ' ', s.lname) AS name

                           FROM member_club mc

                           LEFT JOIN student s ON  mc.std_id = s.stu_id

                           LEFT JOIN title t ON t.title_id = s.title_id

                           WHERE mc.position = '1' ) AS t2 ON t1.club_id = t2.club_id

               LEFT JOIN ( SELECT mc.club_id, COUNT(mc.club_id) AS num_member

                           FROM member_club mc

                           WHERE mc.position = '0' GROUP BY mc.club_id ) AS t3 ON t1.club_id = t3.club_id ";

      $dataProvider = new SqlDataProvider([

       'sql'=>$sql

      ]);



      $content = $this->renderPartial('//backend/print-club/list_club.php', [

        'dataProvider' => $dataProvider,

      ]);



      return  $this->printPDF($content);

    }



    protected function findModel($id)

    {

        if (($model = VClub::findOne($id)) !== null) {

            return $model;

        }



        throw new NotFoundHttpException('The requested page does not exist.');

    }



    public function printPDF($content)

    {

        $pdf = new Pdf([

            'mode' => Pdf::MODE_UTF8,

            'format' => Pdf::FORMAT_A4,

            'orientation' => Pdf::ORIENT_PORTRAIT,

            'destination' => Pdf::DEST_BROWSER,

            'content' => $content,

            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.css',

            /*'cssInline' => '

                        .print {

                             background: url("../web/cert_templates/6.jpg") 100% 0 no-repeat;



                        }

                        .bd{border:1.5px solid; text-align: center;} .ar{text-align:right} .imgbd{border:1px solid}',*/

            /*'options' => ['title' => 'Preview Report Case: ',

                         //   'showWatermarkText'=>true,

                       ],*/

            'methods' => [

               /* 'SetHeader'=>[''],

                'SetFooter'=>['{PAGENO}'],

                'SetHeader'=>['<div class=col-md-12 >'

                .'<div class=col-md-6  style=margin-top:-30px>'

                .'</div><div class=col-md-6  style=margin-top:-15px><p></p></div>'],

                'SetFooter'=>['{PAGENO}'],

                'SetWatermarkText'=>['Draft'],

                'SetWatermarkImage'=>['../web/cert_templates/cert1.jpg',0.10, 'P', 'F' ], */

            ]

        ]);

        return $pdf->render();

    }

}

?>

