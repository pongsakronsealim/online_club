<?php
namespace app\controllers;
use yii;
use yii\web\Controller;
use yii\web\Session;
use app\models\User;
use app\models\MemberClub;

class LoginController extends Controller
{
    public $layout = 'main_login';

  public function actionIndex() {
    $account = new User();
    if (!empty($_POST)) {
      $account = User::find()
      ->where('username = :username AND password = :password', [
        ':username' => $_POST['User']['username'],
        ':password' => $_POST['User']['password']
        ])
      ->one();
      if (!empty($account)) {
        $session = new \yii\web\Session();
        $session->open();
        $session['account_id'] = $account->user_id;
        $session['username'] = $account->username;
        $session['status'] = $account->status;
        $session['user_type'] = $this->getUserType($account->username);

      //  Yii::$app->session->displayUserLogin($account->id,$account->name);

      //  $session['account_name'] = $account->name;
        if ( $session['user_type'] == "1" ) {
          return $this->redirect('index.php?r=activities/index');
        } elseif ( $session['user_type'] == "2" ) {
          return $this->redirect('index.php?r=activities/index');
        } else {
          return $this->redirect('index.php?r=founded-club/create');
        }

      } else {
        $account = new User();
        $account->username= $_POST['Login']['username'];
        $account->password = $_POST['Login']['password'];
        $session = new \yii\web\Session();
        $session->open();
        $session->setFlash('message_login', 'ชื่อผู้ใช้งานและรหัสผ่านไม่ถูกต้อง');
      }
    }
    return $this->render('index', ['account' => $account]);
  }

  private function getUserType($std_id) {
    $userType = yii::$app->utilityComponent->getSomeField("status_club","member_club"," WHERE std_id = $std_id ");
    return $userType;
  }

  public function actionLogout() {
    $session = new \yii\web\Session();
    $session->open();
    unset($session['account_id']);
    unset($session['username']);
    unset($session['account_name']);
    unset($session['message_login']);
    unset($session['user_type']);
    return $this->redirect('index.php?r=site/index');
  }
}
