<?php

namespace app\controllers;

use Yii;
use app\models\Activities;
use app\models\ActivitiesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ActivitiesController extends Controller
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
        $strClubID = yii::$app->utilityComponent->getClubID();
        $searchModel = new ActivitiesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $strClubID);

        return $this->render('//backend/activities/index', [
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
        $model = new Activities();
        $strClubID = yii::$app->utilityComponent->getClubID();

        if (isset($_POST['Activities'])) {
       			if (!empty($_POST['Activities']['activities_id'])) {
       				$id = $_POST['Activities']['activities_id'];
       				$model = $this->findModel($id);
       			}

   			    $model->load($_POST);
             $model->activities_name = $_POST['Activities']['activities_name'];
             $model->description = $_POST['Activities']['description'];
             $model->date = $_POST['Activities']['date'];
             $model->club_id = $strClubID;

       			if ($model->save()){
       				return $this->redirect(['index']);
       			} else {
       				Yii::$app->session->setFlash('error', 'Model could not be saved');
       			}
 		      } else {
            return $this->render('//backend/activities/_form', [
                'model' => $model,
            ]);
 		      }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        return $this->render('//backend/activities/_form', [
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
        if (($model = Activities::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
