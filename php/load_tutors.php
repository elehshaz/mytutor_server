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

$sqlloadtutors = "SELECT * FROM tbl_tutors";
$totalresult = $result->num_rows;
$pagenumber = ceil($totalresult/ $itempage_limit);
$sqlloadtutors = $sqlloadtutors . " LIMIT $firstpageresult , $itempage_limit";

$result = $conn ->query($sqlloadtutors);
if($result -> num_rows > 0){
   
    $tutors["tutors"] = array();
    while($row = $result -> fetch_assoc()){
        $prlist = array();
        $prlist['tutor_id']= $row['tutor_id'];
        $prlist['tutor_email']= $row['tutor_email'];
        $prlist['tutor_phone']= $row['tutor_phone'];
        $prlist['tutor_name']= $row['tutor_name'];
        $prlist['tutor_password']= $row['tutor_password'];
        $prlist['tutor_description']= $row['tutor_description'];
        $prlist['tutor_datereg']= $row['tutor_datereg'];

        array_push($tutors["tutors"],$prlist);
    }
    $response = array('status' => 'success', 'pageno' => $tutors);
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