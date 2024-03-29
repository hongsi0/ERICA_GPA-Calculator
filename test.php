<!DOCTYPE html>
<html>

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
	<?php include "DB_Connect.php";
				$db=connect();
	?>
	<title>GPA Cal</title>
	<link href="grade.css" type="text/css" rel="stylesheet" />
</head>

<body>
	<h1>GPA CALCULATOR FOR ERICA SOFTWARE</h1>
	<div id="sorting_semester">
		<form id="$select_semester" action="" method="POST">
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
		$select = 11;
		if(isset($_POST['semester'])){
			$select = $_POST['semester'];
		}
		$select_year = (int)($select / 10);
		$select_semester = (int)($select % 10);
		?>
	<div id="wrapper">
		<?php
		$count_sql = "select count(*) from class where class_year = '$select_year' and class_semester = '$select_semester'";
		$count_stt = $db->prepare($count_sql);
		$count_stt -> execute();
		$result = $count_stt->fetch(PDO::FETCH_ASSOC);
		?>
		<!-- <hr /> -->
		<form id="gradeform" action="grade.
		php?year=<?=$select_year?>&semester=<?=$select_semester?>" method="post">
			<fieldset id="left">
				<legend class="big"><?=$select_year?>학년 <?=$select_semester?>학기 학점 계산기</legend>
					<div class="input_box">
						<label>
							<input class="input_text" type="text" name="name" placeholder="name">
						</label>
					</div>

					<div class="left_box">
            <h2 class="big">과목</h2>
						<?php
						$view_sql = "select class_name from class where class_year = '$select_year' and class_semester = '$select_semester'";
						$view_stt=$db->prepare($view_sql);
						$view_stt->execute();
						$i = 1;
						foreach ($view_stt as $view) { ?>
							<div class="class">
								<input type="text" name="select_class<?=$i?>" value="<?=$view['class_name']?>" />
							</div>
							<?php $i++ ?>
						<?php } ?>
          </div>

					<div class="right_box">
            <h2 class="big">점수 선택</h2>
            <div class="classgrade">
							<?php for($i=1;$i<=$result['count(*)'];$i++) {?>
								<div class="grade">
									<select class="sel" name="select_grade<?=$i?>">
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
							<?php } ?>
	        	</div>
		    	 </div>


				<div class="btn">
					<button type="submit" id="gogobutton"> 계산하기 </button>
				</div>
			</fieldset>
		</form>

		<fieldset id="right">
			<legend class="big">학점 계산 결과</legend>
			<?php
				$check_sql = "select * from students";
				$check_stt = $db->prepare($check_sql);
				$check_stt->execute();
				foreach($check_stt as $check) { ?>
					<p><?=$check['name']?>님의 <?=$check['class_year']?>학년 <?=$check['class_semester']?>학기 평점은 <span style="font-weight:bold"><?=$check['total_grade']?></span> 입니다.</p>
				<?php } ?>
		</fieldset>
	</div>
</body>

</html>
