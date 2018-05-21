<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use app\models\FoundedClub;
use app\models\FoundedClubSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\TypeClub;
use app\models\MemberClub;
use yii\helpers\ArrayHelper;
use yii\data\SqlDataProvider;
use yii\web\UploadedFile;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;

class FoundedClubController extends Controller
{
    public $layout = "main_frontend";
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                   // 'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new FoundedClubSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('//frontend/founded-club/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*public function actionView($id)
    {
      $sql = " SELECT fc.club_id, fc.club_name, fc.founded_club_type, tc.type_name,
                      fc.formality, fc.objective, fc.place, fc.how_the
               FROM founded_club fc
               LEFT JOIN type_club tc ON fc.type_id = tc.type_id
               WHERE club_id = '".$id."' ";
    $dataProvider = new SqlDataProvider([
     'sql'=>$sql
    ]);
    return $this->render('//frontend/founded-club/view', [
        'dataProvider' => $dataProvider,
    ]);
        /*return $this->render('//frontend/founded-club/view', [
            'model' => $this->findModel($id),
        ]);
    }*/
    public function actionMember($id)
    {
      $sql = " SELECT concat(t.title_name, ' ', s.fname, s.lname) AS name, s.nickname, m.major_name,
                      f.faculty_name, s.phone, p.procition_name
               FROM member_club mc
               LEFT JOIN student s ON mc.std_id = s.stu_id
               LEFT JOIN title t ON t.title_id = s.title_id
               LEFT JOIN major m ON m.major_id = s.major_id
               LEFT JOIN faculty f ON f.faculty_id = s.faculty_id
               LEFT JOIN procition p ON mc.position = p.procition_id
               WHERE mc.club_id = '".$id."' AND mc.position = '0' ";
      $dataProvider = new SqlDataProvider([
       'sql'=>$sql
      ]);
      return $this->render('//frontend/founded-club/view_member', [
          'model' => $this->findModel($id),
          'dataProvider' => $dataProvider,
      ]);
    }

    public function actionView($id)
    {
        $sql = " SELECT concat(ti.title_name, ' ', t.fname, t.lname) AS name, m.major_name, f.faculty_name, t.phone
                 FROM consultants_club cc
                 LEFT JOIN teacher t ON cc.teacher_id = t.teacher_id
                 LEFT JOIN title ti ON ti.title_id = t.title_id
                 LEFT JOIN major m ON m.major_id = t.major_id
                 LEFT JOIN faculty f ON f.faculty_id = t.faculty_id
                 WHERE cc.club_id = '".$id."' ";
       $dataProvider = new SqlDataProvider([
        'sql'=>$sql
       ]);

       $sql_member = " SELECT concat(t.title_name, ' ', s.fname, s.lname) AS name, s.nickname, s.phone, p.procition_name
                       FROM member_club mc
                       LEFT JOIN student s ON mc.std_id = s.stu_id
                       LEFT JOIN title t ON t.title_id = s.title_id
                       LEFT JOIN procition p ON mc.position = p.procition_id
                       WHERE mc.club_id = '".$id."' AND mc.position != '0' ";
        $dataProvider_member = new SqlDataProvider([
          'sql'=>$sql_member
        ]);
        return $this->render('//frontend/founded-club/view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
            'dataProvider_member' => $dataProvider_member,
        ]);
    }

    public function actionCreate()
    {
        $session = new \yii\web\Session();
        $session->open();


        $model = new FoundedClub();
        $model_member = new MemberClub();

        //unset($session['club_id']);
        if ( !empty( $session['username'] ) ) {
          if (isset($_POST['FoundedClub'])) {
            if (!empty($_POST['FoundedClub']['club_id'])) {
              $club_id = $_POST['FoundedClub']['club_id'];
              $model = FoundedClub::findOne($club_id);
            }
            $str_club_id = " ";
            if ( !empty($club_id) ) {
              $str_club_id = $club_id;
            } else {
              $str_club_id = yii::$app->utilityComponent->getGenClubID();
            }


            $model->load($_POST);
            $model->club_id = $str_club_id;
            $session['club_id'] = $str_club_id;

            Yii::$app->params['uploadsPath'] = Yii::getAlias('@app/web/uploads/clubs/');
			$path = Yii::$app->params['uploadsPath'];
			$strFile = UploadedFile::getInstances($model,'banner');
			$new_filename =[];
			foreach ($strFile as $file) {
				$file->saveAs($path .time()."_".$file->basename.".".$file->extension);
				$filename = time()."_".$file->basename.".".$file->extension;
				$new_filename[] = $filename;
            }
            
		    $fileImages = implode(',', $new_filename);
   
			if (!empty($fileImages)) {
				$model->banner = $fileImages; 
			} else{
				$model->banner =  $model->banner; 
            }
            
            if ($model->save()){
               $insert_member = $this->insertUpdateMemberClub($session['username'], $str_club_id);

              if ($insert_member == 1) {
                return $this->redirect(['consultants-club/create']); //ให้ redirect ไปหน้าอ.ที่ปรึกษาชมรม
              } else {
                Yii::$app->session->setFlash('error', 'Model could not be saved');
              }

            }else {
              Yii::$app->session->setFlash('error', 'Model could not be saved');
            }
          } else {
            return $this->render('//frontend/founded-club/_form', [
                'model' => $model,
                'type_club' => $this->getTypeClub(),
                'model_member' => $model_member,
            ]);
          }
        } else {
          return $this->redirect(['login/index']);
        }
    }

    protected function insertUpdateMemberClub($username, $str_club_id) {
        $model = new MemberClub();
        $model->std_id = $username;
        $model->club_id = $str_club_id;
        $model->position = '1';
        $model->status_club = '1';

        if ($model->save()) {
            return 1;
        } else {
            return 0;
        }
        /*if( !empty($username) ) { //update
            $model = $this->findModelMemberClub($username);
            $model->std_id = $model->std_id;
            $model->club_id = $model->club_id;
        } else {
            $model->password='123456';
        }
          $model->username = $username;
          $model->status = $status;

        if ($model->save()) {
            return 1;
        } else {
            return 0;
        } */
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->club_id]);
        }

        return $this->render('//frontend/founded-club/update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = FoundedClub::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelMemberClub($username)
    {
        if (($model = MemberClub::findOne($username)) !== null) { // select * from member_club where usernamr = $username
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getTypeClub()
    {
      $type_club = TypeClub::find()->orderBY('type_id')->all();
      $arr_type = ArrayHelper::map($type_club, 'type_id', 'type_name');
      return $arr_type;
    }

    public function actionRegisClub()
    {
      $session = new \yii\web\Session();
      $session->open();

      $model = new MemberClub();
    
      //$name_club = yii::$app->utilityComponent->getSomeField("club_name", "founded_club", " WHERE club_id = '".$session['club_id']."' ");

     if (isset($_POST['MemberClub'])) {
          if (!empty($_POST['MemberClub']['id'])) {
            $id = $_POST['MemberClub']['id'];
            $model = $this->findModel($id);
          }

          $model->load($_POST);
          $model->std_id = $_POST['MemberClub']['std_id'];
          $model->position = "0";
          $model->club_id =  $_POST['MemberClub']['club_id'];
          $model->status_club = "2";
          $std_name = yii::$app->utilityComponent->getStudentName($model->std_id);
          $club_name = yii::$app->utilityComponent->getSomeField("club_name", "founded_club", " WHERE club_id = '".$model->club_id."' ");
          $email =  yii::$app->utilityComponent->getSomeField("email", "student", " WHERE stu_id = '".$_POST['MemberClub']['std_id']."' ");
          if ($model->save()){
            //return $this->redirect(['founded-club/index']);
            $this->createQRCode($model->id);
            $this->sendEmail($model->id, $email, $std_name, $club_name);
            return $this->redirect(['finish-regis', 'id' => $model->id, 'club_id' => $model->club_id]);
          } else {
            Yii::$app->session->setFlash('error', 'Model could not be saved');
          }

        } else {
          return $this->render('//frontend/founded-club/regis', [
              'model' => $model,
          ]);
        }
    }

    private function createQRCode($regis_code) {
        // Create a basic QR code
        $qrCode = new QrCode($regis_code);
        $qrCode->setSize(120);

        // Set advanced options
        $qrCode->setWriterByName('png');
        $qrCode->setMargin(10);
        $qrCode->setEncoding('UTF-8');
        $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH);
        $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
        $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
      //  $qrCode->setLabel('Scan the code', 16, __DIR__.'/../assets/fonts/noto_sans.otf', LabelAlignment::CENTER);
      //  $qrCode->setLogoPath(__DIR__.'/../assets/images/symfony.png');
        $qrCode->setLogoWidth(50);
       // $qrCode->setRoundBlockSize();
        $qrCode->setValidateResult(false);

        // Directly output the QR code
        header('Content-Type: '.$qrCode->getContentType());
       // echo $qrCode->writeString();

        // Save it to a file
        
        Yii::$app->params['uploadsPath'] = Yii::getAlias('@app/web/qrcode/');
        $path = Yii::$app->params['uploadsPath'];
       // $file->saveAs($path.$regis_code.".png");
        $qrCode->writeFile($path.'/'.$regis_code.'.png');
        // Create a response object
       // $response = new QrCodeResponse($qrCode);
    }

    private function sendEmail($regis_code, $email, $name, $club_name) {
        Yii::$app->mailer
        ->compose('//mail/layouts/content',[
           'fullname'=>$name,
           'club_name' => $club_name,
           'name_of_president_club' => 'นายพงศกร ลิ้มวารีกร',
           'email_of_president_club' => 'pongsakron.57ls@kru.ac.th',
           'phone_of_president_club' => '090 447 3254'
         ])
        ->setFrom(["pongsakron.57ls@kru.ac.th" => "นายพงศกร ลิ้มวารีกร"])
        ->setTo($email)
        ->setSubject('ผลการลงทะเบียนเข้าร่วมชมรม')
        ->attach(Yii::getAlias('@webroot').'/qrcode/'. $regis_code.'.png')
        ->send();
    }

    public function actionFinishRegis($id, $club_id)
    {
        return $this->render('//frontend/founded-club/completed_regis', [
            'regis_code' => $id,
            'club_id' => $club_id
        ]);
    }
}
