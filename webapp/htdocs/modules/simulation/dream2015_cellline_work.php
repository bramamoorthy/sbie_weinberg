<?php
/* --------------------------------

module/simulation/dream2015_cellline_work.php
dream2015 cell line을 가져오는 ajax 페이지.

*ajax 오류 점검 :
1. form action에 정확한 주소가 입력 되었는가?
2. 전송하는 데이터가 잘 들어가는가?
3. 해당 주소의 페이지가 정당한 json 형식을 가지는가?

-------------------------------- */

//__CL__ 정의 되지 않았다면 false 를 return.
if(!defined('__CL__')) exit();

// php 페이지 로딩 시간을 최대 5분(60*5)으로 연장. default는 30초.
ini_set('max_execution_time', 300);


$sql = "
SELECT CELL_LINE
FROM dream2015
GROUP BY CELL_LINE;
";
$result = $conn->query($sql);


$outp = "[";
while($row = $result->fetch_assoc()) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"CELL_LINE":"'  . $row["CELL_LINE"] . '"}'; 
}
$outp .="]";
	
echo $outp;
?>