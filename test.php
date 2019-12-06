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
	<?php
	  $view_sql = "select class_name,class_grade from class";
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
