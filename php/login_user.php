<?php

if(!isset($_POST)){
    echo "failed";
}
include_once("dbconnect.php");

$sqllogin = "SELECT * FROM tbl_admin WHERE admin_email = '$email' AND admin_password = '$password'";
$result = $conn ->query($sqllogin);

if($result -> num_rows > 0){
    while($row = $result -> fetch_assoc()){
        $adminlist = array();
        $adminlist['admin_id']= $row['subject_id'];
        $adminlist['admin_name']= $row['subject_name'];
        $adminlist['admin_email']= $row['subject_description'];
        $adminlist['admin_password']= $row['subject_price'];
        $adminlist['admin_role']= $row['tutor_id'];
        $adminlist['admin_dateregister']= $row['subject_sessions'];
        echo json_encode($adminlist);
        return;
    }
}else{
    echo "failed";
}
?>