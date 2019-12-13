<!DOCTYPE html>
<html>

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
	<?php include "DB_Connect.php";
				$db=connect();
	?>
	<title>Grade</title>
	<link href="grade.css" type="text/css" rel="stylesheet" />
</head>

<body>
	<div class="sorting_semester">
        <form action="" method="POST">
	        <select name="semester">
	          <option value=11 <?php if($_POST['semester']==11) echo "selected=\"selected\""?>>1학년 1학기</option>
	          <option value=12 <?php if($_POST['semester']==12) echo "selected=\"selected\""?>>1학년 2학기</option>
	          <option value=21 <?php if($_POST['semester']==21) echo "selected=\"selected\""?>>2학년 1학기</option>
			  <option value=22 <?php if($_POST['semester']==22) echo "selected=\"selected\""?>>2학년 2학기</option>
			  <option value=31 <?php if($_POST['semester']==31) echo "selected=\"selected\""?>>3학년 1학기</option>
		      <option value=32 <?php if($_POST['semester']==32) echo "selected=\"selected\""?>>3학년 2학기</option>
			  <option value=41 <?php if($_POST['semester']==41) echo "selected=\"selected\""?>>4학년 1학기</option>
			  <option value=42 <?php if($_POST['semester']==42) echo "selected=\"selected\""?>>4학년 2학기</option>
	        </select>
	        <button type="submit">선택</button>
      	</form>
  </div>
	<?php
		$select = $_POST['semester'];
		$select_year = (int)($select / 10);
		$select_semester = (int)($select % 10);
		if(isset($_POST['semester']))
			$select = 11;
	    $view_sql = "select class_name,class_credit from class where class_year = '$select_year' and class_semester = '$select_semester'";
	    $view_stt=$db->prepare($view_sql);
	    $view_stt->execute();
	  ?>

	<div id="wrapper">
		<!-- <hr /> -->

		<form id="gradeform" action="grade.php" method="post">
			<div class="signIn">

				<div id="inputArea">

          <h2 class="big">학점계산기</h2>

					<div class="input_box">
						<label>
							<input class="input_text" type="text" name="name" placeholder="name">
						</label>
					</div>

          <div class="left_box">
            <h2 class="big">과목 선택</h2>
	            <div class="class">
	                <select class="sel" name="select_class">
						<?php foreach($view_stt as $a) { ?>
						<option value=<?= $a['class_name']; ?>><?= $a['class_name']; ?></option>
						<?php } ?>
					</select>
	            </div>
          </div>

		<div class="right_box">
            <h2 class="big">점수 선택</h2>
            <div class="classgrade">
                <select class="sel" name="select_grade">
                  <option value=4.5>A+</option>
                  <option value=4>A</option>
                  <option value=3.5>B+</option>
                  <option value=3>B</option>
                  <option value=2.5>C+</option>
                  <option value=2>C</option>
                  <option value=1.5>D+</option>
                  <option value=1>D</option>
				  <option value=0>F</option>
                </select>
        	</div>
    	 </div>


				<div class="btn">
					<button type="submit" id="gogobutton"> 계산하기 </button>
				</div>

			</div>
		</form>
	</div>
</body>

</html>
