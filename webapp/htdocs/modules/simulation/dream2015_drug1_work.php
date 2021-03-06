<?php
/* --------------------------------

module/simulation/dream2015_drug1_work.php
dream2015 drug1을 가져오는 ajax 페이지

*ajax 오류 점검 :
1. form action에 정확한 주소가 입력 되었는가?
2. 전송하는 데이터가 잘 들어가는가?
3. 해당 주소의 페이지가 정당한 json 형식을 가지는가?

-------------------------------- */

//__CL__ 정의 되지 않았다면 false 를 return.
if(!defined('__CL__')) exit();

// php 페이지 로딩 시간을 최대 5분(60*5)으로 연장. default는 30초.
ini_set('max_execution_time', 300);

$cellline = $_GET["cellline"];


$sql = "
SELECT dr.src_targets, dm.COMPOUND_A
FROM drugs AS dr INNER JOIN 
(SELECT COMPOUND_A
FROM dream2015
WHERE CELL_LINE = '$cellline'
GROUP BY COMPOUND_A) AS dm
ON dr.src_id = dm.COMPOUND_A
ORDER BY dm.COMPOUND_A ASC
";
$result = $conn->query($sql);


$outp = "[";
while($row = $result->fetch_assoc()) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"COMPOUND_A":"'  . $row["COMPOUND_A"] . '", "TARGET":"'  . $row["src_targets"] . '"}'; 
}
$outp .="]";
	
echo $outp;
?>