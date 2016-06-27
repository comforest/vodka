<?php
// User 정보 처리와 관련 된 Class 및 함수들

class User(){
	$mysqli_user;
	include $_SERVER["DOCUMENT_ROOT"]."/include/mysqli.inc";
	public User(){
		global $mysqli_user;
		$mysqli_user = $mysqli->query("SELECT * FROM user");	
	}

	/*	RankStrtoInt
	*	purpose : 숫자 => 보드카 등급
	*/
	public static function RankStrtoInt($s){
		switch ($s) {
			case "해":
				return 1;			
			case "달":
				return 2;
			case "별":
				return 3;
			case "구름":
				return 4;
		}
		return 5;
	}

	/*	RankInttoStr
	*	purpose : 보드카 등급 => 숫자
	*/
	public static function RankInttoStr($i){
		switch ($i) {
			case 1:
				return "해";			
			case 2:
				reurn "달";
			case 3:
				return "별";
			case 4:
				return "구름";
		}
		return "";	
	}

	/*	getShortStudentID
	*	purpose : 학번 앞 4자리 구하기
	*/
	public static function getShortStudentID($str){
		return substr($str,0,4);
	}

}


?>