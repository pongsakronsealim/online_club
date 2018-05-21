<?php

namespace app\controllers;

use Yii;
use app\models\CheckName;
use app\models\CheckNameSearch;
use app\models\MemberClub;
use app\models\MemberClubSearch;
use app\models\Activities;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\SqlDataProvider;

class CheckNameController extends Controller
{
    public $layout = "main_frontend";
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'Check' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
      $strClubID = yii::$app->utilityComponent->getClubID();
      $sql = " SELECT a.activities_id, a.activities_name, COUNT(cn.member_id) AS num_member
               FROM activities a
               LEFT JOIN check_name cn ON a.activities_id = cn.activities_id
               WHERE a.club_id = '".$strClubID."' GROUP BY a.activities_id ";
      $dataProvider = new SqlDataProvider([
        'sql'=>$sql
      ]);
      return $this->render('//backend/check-name/index', [
          'dataProvider' => $dataProvider,
      ]);
        /*$searchModel = new CheckNameSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('//backend/check-name/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/

    }

    public function actionView($id)
    {
      $sql = " SELECT concat(t.title_name, ' ', s.fname, s.lname) AS name, m.major_name, f.faculty_name, a.activities_name
               FROM check_name cn
               LEFT JOIN student s ON cn.member_id = s.stu_id
               LEFT JOIN title t ON t.title_id = s.title_id
               LEFT JOIN major m ON m.major_id = s.major_id
               LEFT JOIN faculty f ON f.faculty_id = s.faculty_id
               LEFT JOIN activities a ON cn.activities_id = a.activities_id
               WHERE cn.activities_id = '".$id."' ";
    $dataProvider = new SqlDataProvider([
      'sql'=>$sql
    ]);
    $name_activities = yii::$app->utilityComponent->getSomeField("activities_name", "activities", " WHERE activities_id = '".$id."' ");
    return $this->render('//backend/check-name/view', [
        'dataProvider' => $dataProvider,
        'name_activities' => $name_activities,
    ]);
        /*return $this->render('view', [
            'model' => $this->findModel($id),
        ]);*/
    }

    public function actionCreate()
    {
        $model = new CheckName();

        $strClubID = yii::$app->utilityComponent->getClubID();
        $searchModel = new MemberClubSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $strClubID);



        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->check_id]);
        }

        return $this->render('//backend/check-name/_form', [
            'model' => $model,
            'activity_name' => $this->getAcitivities(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCheck()
    {
        $model = new CheckName();
        $id_cases = explode(',', Yii::$app->request->post('prm_std_id') );//typecasting
        $activity_id = Yii::$app->request->post('prm_activities_id');
        $num_ar = count($id_cases);
        foreach($id_cases as $v){
            $model = new CheckName();
            $model->activities_id = $activity_id;
            $model->status = "1";
            $model->member_id = $v;
            $model->isNewRecord = true;
            if($model->save()){
                //echo 'y';
            }else{
                //echo 'n';
            }
        }

       // Yii::$app->session->setFlash('success', 'บันทึกการเช็คชื่อเข้าร่วมกิจกรรมเรียบร้อยแล้ว');
        return $this->redirect(['check-name/index']);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->check_id]);
        }

        return $this->render('update', [
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
        if (($model = CheckName::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getAcitivities()
    {
        $strClubID = yii::$app->utilityComponent->getClubID();
        $activities = Activities::find()
                        ->andWhere('DATEDIFF(NOW(),date)<1')
                        ->andWhere(['club_id'=>$strClubID])
                        ->orderBy('activities_id')->all();
        $arr_activities = ArrayHelper::map($activities, 'activities_id', 'activities_name');
        return $arr_activities;
    }
}
