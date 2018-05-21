<?php

namespace app\controllers;

use Yii;
use app\models\MemberClub;
use app\models\MemberClubSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Procition;
use yii\helpers\ArrayHelper;

class MemberClubController extends Controller
{

    public $layout = "main_frontend";
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new MemberClubSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $session = new \yii\web\Session();
        $session->open();

        $model = new MemberClub();
        $searchModel = new MemberClubSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $session['club_id']);
        $name_club = yii::$app->utilityComponent->getSomeField("club_name", "founded_club", " WHERE club_id = '".$session['club_id']."' ");

       if (isset($_POST['MemberClub'])) {
      			if (!empty($_POST['MemberClub']['id'])) {
      				$id = $_POST['MemberClub']['id'];
      				$model = $this->findModel($id);
      			}

  			    $model->load($_POST);
            $model->std_id = $_POST['MemberClub']['std_id'];
            $model->position = $_POST['MemberClub']['position'];
            $model->club_id =  $session['club_id'];
            $model->status_club = $_POST['MemberClub']['status_club'];

      			if ($model->save()){
      				return $this->redirect(['create']);
      			} else {
      				Yii::$app->session->setFlash('error', 'Model could not be saved');
      			}
		      } else {
            return $this->render('//frontend/member-club/_form', [
                'model' => $model,
                'dataProvider' => $dataProvider,
                'position' => $this->getPosition(),
                'name_club' => $name_club,
            ]);
		      }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('//frontend/member-club/_form', [
            'model' => $model,
            'position' => $this->getPosition(),
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['create']);
    }

    protected function findModel($id)
    {
        if (($model = MemberClub::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function getPosition() {
      $position = Procition::find()
                    ->where(['<>','procition_id', '1'])
                    ->andWhere(['<>','procition_id', '0'])
                    ->orderBY('procition_id')->all();
      $arr_position = ArrayHelper::map($position, 'procition_id', 'procition_name');
      return $arr_position;
    }
}
