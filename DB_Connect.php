<?php
function connect(){
	try{
		$pdo = new PDO("mysql:dbname=grade", "root", "");
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		return $pdo;
	}
	catch (PDOException $e){
		try{
			$pdo = new PDO("mysql:dbname=grade", "root", "root");
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			return $pdo;
		}
		catch (PDOException $e){
			echo "왜 연결이 안돼!!!!";
		}
	}
}
?>
