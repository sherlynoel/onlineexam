<?php
include 'database/config.php';

$sql = "SELECT * FROM tbl_topic WHERE exam_id = 'EX-980752'";

$result = $conn->query($sql);

if($result){
	$num = mysqli_num_rows($result);
	$topics = array();
	$top_que = array();
	$i = 0;
	while($row = mysqli_fetch_assoc($result)){
		$topics[$i] =  $row['topic'];
		$top_que[$i] = $row['num_q'];
		$i++;
	}
}
$sq = "";
$char = 'a';
for($i = 0; $i < $num - 1; $i++){
	$sq .= "SELECT * FROM (SELECT * FROM tbl_questions WHERE topic = '$topics[$i]' AND exam_id = 'EX-980752' LIMIT $top_que[$i] ) $char UNION ";
	$char++;
}

$sq .= "SELECT * FROM (SELECT * FROM tbl_questions WHERE topic = '$topics[$i]' AND exam_id = 'EX-980752' LIMIT $top_que[$i] ) $char ";


//$sql = "SELECT * FROM (SELECT * FROM  (SELECT * FROM ($sq) $char WHERE positive_mark = 1 ORDER BY RAND() LIMIT 15) z UNION SELECT * FROM (SELECT * FROM ($sq) $char WHERE positive_mark = 2 ORDER BY RAND() LIMIT 10) x UNION SELECT * FROM (SELECT * FROM ($sq) $char WHERE positive_mark = 5 ORDER BY RAND() LIMIT 3) y) z ORDER BY RAND()";
$sql = "SELECT * FROM ($sq) $char ORDER BY RAND()";
echo $sql;
if($conn->query($sql)){
	echo "working";
}

?>