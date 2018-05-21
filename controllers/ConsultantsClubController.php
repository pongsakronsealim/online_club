<?php

namespace app\controllers;

use Yii;
use app\models\ConsultantsClub;
use app\models\ConsultantsClubSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ConsultantsClubController extends Controller
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

  /*  public function actionIndex()
    {
        $searchModel = new ConsultantsClubSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/

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
      //  unset($session['club_id']);

        $model = new ConsultantsClub();
        $searchModel = new ConsultantsClubSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $session['club_id']);
        $name_club = yii::$app->utilityComponent->getSomeField("club_name", "founded_club", " WHERE club_id = '".$session['club_id']."' ");

       if (isset($_POST['ConsultantsClub'])) {
      			if (!empty($_POST['ConsultantsClub']['consultants_id'])) {
      				$id = $_POST['ConsultantsClub']['consultants_id'];
      				$model = $this->findModel($id);
      			}

  			    $model->load($_POST);
            $model->teacher_id = $_POST['ConsultantsClub']['teacher_id'];
            $model->club_id =  $session['club_id'];

      			if ($model->save()){
      				return $this->redirect(['create']);
      			} else {
      				Yii::$app->session->setFlash('error', 'Model could not be saved');
      			}
		      }else {
            return $this->render('//frontend/consultants-club/_form', [
                'model' => $model,
                'dataProvider' => $dataProvider,
                'name_club' => $name_club,
            ]);
          }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->consultants_id]);
        }

        return $this->render('//frontend/consultants-club/_form', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['create']);
    }

    protected function findModel($id)
    {
        if (($model = ConsultantsClub::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
