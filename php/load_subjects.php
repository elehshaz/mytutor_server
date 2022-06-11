<?php

if(!isset($_POST)){
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}
include_once("dbconnect.php");
$itempage_limit = 5;
$pageno = (int)$_POST['pageno'];
$page_first_result = ($pageno - 1) * $itempage_limit;

$sqlloadsubjects = "SELECT * FROM tbl_subjects";
$totalresult = $result->num_rows;
$pagenumber = ceil($totalresult/ $itempage_limit);
$sqlloadsubjects = $sqlloadsubjects . " LIMIT $firstpageresult , $itempage_limit";
$result = $conn ->query($sqlloadsubjects);

if($result -> num_rows > 0){
    $subjects["subjects"] = array();
    while($row = $result -> fetch_assoc()){
        $sblist = array();
        $sblist['subject_id']= $row['subject_id'];
        $sblist['subject_name']= $row['subject_name'];
        $sblist['subject_description']= $row['subject_description'];
        $sblist['subject_price']= $row['subject_price'];
        $sblist['tutor_id']= $row['tutor_id'];
        $sblist['subject_sessions']= $row['subject_sessions'];
        $sblist['subject_rating']= $row['subject_rating'];

        array_push($subjects["subjects"],$prlist);
    }
    $response = array('status' => 'success', 'pageno' => $subjects);
    sendJsonResponse($response);
}else{
    $response = array('status' => 'failed', 'pageno' => null);
    sendJsonResponse($response);
}

function sendJsonResponse($sentarray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
?>