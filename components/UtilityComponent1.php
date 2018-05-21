<?php
namespace app\components;

use Yii;
use DateTime;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;
use app\models\FoundedClub;

class UtilityComponent extends Component
{
    public function getDateDiff($dateStart, $dateEnd)
    {
        $strDateStart =  new Datetime($dateStart);
        $strDateEnd =  new Datetime($dateEnd);
        return $strDateStart->diff($strDateEnd)->days;
    }

    public function getNumberFormat($number)
    {
       return Yii::$app->formatter->asInteger($number);
    }

    protected function getDateFormatForDB($date)
    {
        $date = new DateTime($date);
        $dateFormat = date_format($date,'Y-m-d');
        return $dateFormat;
    }

    public function getThaiFormatDate($date)
    {
        Yii::$app->formatter->locale = 'th_TH';
        return Yii::$app->formatter->asDate($date, 'medium');
    }

    public function getThaiFormatDateLong($date)
    {
        Yii::$app->formatter->locale = 'th_TH';
        return Yii::$app->formatter->asDate($date, 'long');
    }

    public function convertThaiFormatDate($date)
    {
        $dateExplode = explode('-',$date);
        return $dateExplode[2]." ".
               $this->getMonthThaiFormatAbbreviation($dateExplode[1])." ".
               $this->getYearThaiFormat($dateExplode[0]);
    }

    public function convertThaiFormatDate1($date)
    {
        $dateExplode = explode('-',$date);
        return $dateExplode[2]." ".
               $this->getMonthThaiFormat($dateExplode[1])." ".
               $this->getYearThaiFormat($dateExplode[0]);
    }

	public function getYearThaiFormat($strYearEng)
	{
		return $strYearEng+543;
    }

    protected function insertZero($inputValue, $digit)
    {
        $str = "" . $inputValue;
        while (strlen($str) < $digit){
            $str = "0" . $str;
        }
        return $str;
    }

    public function getMonthThaiFormatAbbreviation($strMonth)
	{
		$month = array("01"=>"ม.ค.",
                "02"=>"ก.พ.",
                "03"=>"มี.ค.",
                "04"=>"เม.ย.",
                "05"=>"พ.ค.",
                "06"=>"มิ.ย.",
                "07"=>"ก.ค.",
                "08"=>"ส.ค.",
                "09"=>"ก.ย.",
                "10"=>"ต.ค.",
                "11"=>"พ.ย.",
                "12"=>"ธ.ค." );
		return $month[$strMonth];
    }

    public function getMonthThaiFormat($strMonth)
	{
		$month = array("01"=>"มกราคม",
                "02"=>"กุมภาพันธ์",
                "03"=>"มีนาคม",
                "04"=>"เมษายน",
                "05"=>"พฤษภาคม",
                "06"=>"มิถุนายน",
                "07"=>"กรกฎาคม",
                "08"=>"สิงหาคม",
                "09"=>"กันยายน",
                "10"=>"ตุลาคม",
                "11"=>"พฤศจิกายน",
                "12"=>"ธันวาคม" );
		return $month[$strMonth];
    }

    public function checkLogin()
    {
        $session = new \yii\web\Session();
        $session->open();
        if (empty($session->get('account_id'))) {
           return '0';
        }
    }

    private function queryScalar($sql)
    {
        $sql = Yii::$app->db->createCommand($sql);
        $data = $sql->queryScalar();
        return $data;
    }

    public function getStdName($user_id)
    {
      $session = new \yii\web\Session();
      $session->open();

      $str_user_id = "";
      $user_type = $session['status'];
      if($user_type == '1') {
        $str_user_id = $session['username'];
      } else if($user_type == '2') {
          $str_user_id = $user_id;
      } else if ($user_type == '3') {
          $str_user_id = $user_id;
      }

        $sql = " SELECT concat (t.title_name, s.fname, ' ', s.lname) AS name
                 FROM student s
                 LEFT JOIN title t ON s.title_id = t.title_id
                 WHERE s.stu_id = '".$str_user_id."' ";
        return $this->queryScalar($sql);
    }

    /*public function getDataForUpdateLogin($code) {
      $sql_user_id = 'SELECT user_id FROM users WHERE code = "'.$code.'"';
      $result = $this->queryScalar($sql_user_id);

      $sql = 'SELECT id FROM login WHERE username = "'.$result.'"';
      return $this->queryScalar($sql);
    }*/

    public function getGenClubID() {
      $current_year = $this->getYearThaiFormat(date("Y"));
      $sql = FoundedClub::find()
      ->where(['substr(club_id,1,4)' => $current_year])
      ->orderBy('club_id')
      ->count();

      if($sql == 0) {
          $res_sn = 1;
      } else {
          $res_sn = $sql+1;
      }

      $sql = $this->insertZero($res_sn,4);
      $club_id = $current_year.$sql;
      return $club_id;
    }

    public function getClubID() {
      $session = new \yii\web\Session();
      $session->open();

      $sql = " SELECT club_id FROM member_club WHERE std_id = '".$session['username']."' ";
      return $this->queryScalar($sql);
    }

    public function getConsultantsName($teacher_id) {
      $sql = " SELECT concat( ti.title_name, t.fname, ' ', t.lname) AS name
               FROM consultants_club cc
               LEFT JOIN teacher t ON cc.teacher_id = t.teacher_id
               LEFT JOIN title ti ON t.title_id = ti.title_id
               WHERE t.teacher_id = '".$teacher_id."' ";
      return $this->queryScalar($sql);
    }

    public function getStudentName($stu_id) {
      $sql = " SELECT concat(ti.title_name, s.fname, ' ', s.lname, ' ',' ','สาขาวิชา', m.major_name) AS name
               FROM student s
               LEFT JOIN title ti ON s.title_id = ti.title_id
               LEFT JOIN major m ON m.major_id = s.major_id
               WHERE s.stu_id = '".$stu_id."' ";
      return $this->queryScalar($sql);
    }

    public function getPosition($position) {
      $sql = " SELECT procition_name FROM procition WHERE procition_id = '".$position."' ";
      return $this->queryScalar($sql);
    }

    public function getClub()
    {
      $sql = " SELECT fc.club_name, fc.founded_club_type, tc.type_name,
                      concat(ti.title_name, ' ', s.fname, s.lname) AS name, s.stu_id, m.major_name,
                      f.faculty_name, s.phone, fc.formality,
                      fc.objective, fc.how_the, fc.place
               FROM member_club mc
               LEFT JOIN student s ON mc.std_id = s.stu_id
               LEFT JOIN title ti ON ti.title_id = s.title_id
               LEFT JOIN major m ON m.major_id = s.major_id
               LEFT JOIN faculty f ON f.faculty_id = s.faculty_id
               LEFT JOIN founded_club fc ON mc.club_id = fc.club_id
               LEFT JOIN type_club tc ON tc.type_id = fc.type_id ";
      return $this->queryScalar($sql);
    }

    public function getSomeField($field, $tableName, $condition)
    {
      $sql = " SELECT $field FROM $tableName ";
      if ( !empty($condition) ) {
        $sql .= " $condition ";
      }
      return $this->queryScalar($sql);

    }

}

?>
