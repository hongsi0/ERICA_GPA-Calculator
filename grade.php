<?php
  include "DB_Connect.php";
  $db=connect();
  $year = $_GET['year'];
  $semester = $_GET['semester'];
  $studentname = $_POST['name'];

  $check_sql = "select name from students where name = '$studentname' and class_year = '$year' and class_semester = '$semester'";
  $check_stt = $db->prepare($check_sql);
  $check_stt -> execute();
  $check = $check_stt->fetch(PDO::FETCH_ASSOC);

  $count_sql = "select count(*),sum(class_credit) from class where class_year = '$year' and class_semester = '$semester'";
  $count_stt = $db->prepare($count_sql);
  $count_stt -> execute();
  $result = $count_stt->fetch(PDO::FETCH_ASSOC);

  $total = 0.0;

  for ($i=1;$i<=$result['count(*)'];$i++){
    $temp = 'select_class'.$i;
    $temp1 = 'select_grade'.$i;
    $name = $_POST[$temp];
    $score = $_POST[$temp1];
    $credit_sql = "select class_credit from class where class_name = '$name'";
    $credit_stt = $db->prepare($credit_sql);
    $credit_stt -> execute();
    $result1 = $credit_stt->fetch(PDO::FETCH_ASSOC);
    $total += ($result1['class_credit'] * $score / $result['sum(class_credit)']);
  }

  $total = round($total,2);

  if(!isset($check['name'])){
    $sql = "insert into students (name,class_year,class_semester,total_grade) values ('$studentname',$year,$semester,$total)";
    $stt = $db->prepare($sql);
    $stt -> execute();
  }
  else {
    $update_sql = "update students set total_grade = $total where name = '$studentname' and class_year = $year and class_semester = $semester";
    $update_stt = $db->prepare($update_sql);
    $update_stt -> execute();
  }

  echo
	"<script>
			location.href='test.php';
	</script>";
?>
