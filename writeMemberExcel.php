<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/Classes/PHPExcel.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/Classes/PHPExcel/IOFactory.php";
header( 'Content-type: application/vnd.ms-excel' ); 
header( 'Content-Disposition: inline; filename="listall_'.date('Ymd').'.xls"' );
header( 'Content-Description: sitePHPbasic Generated Data' );

    $field["name"] = "이름";
    $field["gender"] = "성별";
    $field["student_id"] = "학번";
    $field["colleage"] = "단과대";
    $field["major"] = "전공";
    $field["phone"] = "전화번호";
    $field["location"] = "활동지역";
    $field["class"] = "기수";
    $field["rank"] = "등급";
    $field["entry"] = "활동 여부";

echo "
    <table>
    <tr>
        <td>이름</td>
        <td>성별</td>
        <td>학번</td>
        <td>단과대</td>
        <td>전공</td>
        <td>전화번호</td>
        <td>활동지역</td>
        <td>기수</td>
        <td>등급</td>
        <td>활동여부</td>
    </tr>
    ";
include $_SERVER["DOCUMENT_ROOT"]."/function/userInfo.php";
include $_SERVER["DOCUMENT_ROOT"]."/include/mysqli.inc";
if($result = $mysqli->query("SELECT * FROM user order by entry DESC, rank asc, name asc")){
    while($data = $result->fetch_array(MYSQLI_ASSOC)){
        echo "<tr>";
        echo "<td>".$data["name"]."</td>";
        echo "<td>".User::GenderInttoStr($data["gender"])."</td>";
        echo "<td>".$data["student_id"]."</td>";
        echo "<td>".$data["colleage"]."</td>";
        echo "<td>".$data["major"]."</td>";
        echo "<td>".User::AppendPhoneHypen($data["phone"])."</td>";
        echo "<td>".$data["location"]."</td>";
        echo "<td>".User::AppendClass($data["class"])."</td>";
        echo "<td>".User::RankInttoStr($data["rank"])."</td>";
        echo "<td>".User::EntryInttoStr($data["entry"])."</td>";
        echo "</tr>";
    }
}


echo "</table>";

?>