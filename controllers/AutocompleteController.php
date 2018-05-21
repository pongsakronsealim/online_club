<?php

namespace app\controllers;

use Yii;
use app\models\Teacher;
use app\models\Student;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class AutocompleteController extends Controller
{
    public function actionTeacherAutocomplete($term)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $sql = " SELECT  t.teacher_id, concat(ti.title_name, t.fname, ' ', t.lname) AS name, m.major_name, f.faculty_name
                 FROM teacher t
                 LEFT JOIN title ti ON t.title_id = ti.title_id
                 LEFT JOIN major m ON t.major_id = m.major_id
                 LEFT JOIN faculty f ON m.major_id = f.faculty_id
                 WHERE t.fname LIKE '%$term%'
                 OR t.lname LIKE '%$term%' ";
        $sql = Yii::$app->db->createCommand($sql);
        $result = $sql->queryAll();

        foreach ($result as $v) {
            $dt['value'] = $v['teacher_id'];
            $dt['teacher_id'] = $v['teacher_id'];
            $dt['name'] = $v['name'];
          //  $dt['label'] = $v['teacher_id']." ".$v['name'];
            $dt['label'] = $v['teacher_id']." ".$v['name']." ".$v['major_name']." ".$v['faculty_name'];
            $matches[] = $dt;
        }

        if ($result !=null) {
          return $matches;
        } else {
            return  $matches = ['ไม่พบข้อมูล'];
        }
    }

    public function actionStudentAutocomplete($term) {
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

      $sql = " SELECT s.stu_id, concat(ti.title_name, s.fname, ' ', s.lname) AS name, m.major_name, f.faculty_name
               FROM student s
               LEFT JOIN title ti ON s.title_id = ti.title_id
               LEFT JOIN major m ON s.major_id = m.major_id
               LEFT JOIN faculty f ON m.faculty_id = f.faculty_id
               WHERE s.fname LIKE '%$term%'
               OR s.lname LIKE '%$term%' ";
      $sql = Yii::$app->db->createCommand($sql);
      $result = $sql->queryAll();

      foreach ($result as $v) {
          $dt['value'] = $v['stu_id'];
          $dt['stu_id'] = $v['stu_id'];
          $dt['name'] = $v['name'];
        //  $dt['label'] = $v['teacher_id']." ".$v['name'];
          $dt['label'] = $v['stu_id']." ".$v['name']." ".$v['major_name']." ".$v['faculty_name'];
          $matches[] = $dt;
      }

      if ($result !=null) {
        return $matches;
      } else {
          return  $matches = ['ไม่พบข้อมูล'];
      }
    }
}

?>
