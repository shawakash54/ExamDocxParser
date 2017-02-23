<?php
@ session_start();
$file_del=$_SESSION['exam_del'];
echo $file_del;
include '../includes/db_connect.php';
$sql="DELETE FROM cms_question_details
        WHERE exam_name='".$file_del."'";
if($conn->query($sql))
    $flag=1;
else
    $flag=0;
header("Location: question.php?del=".$flag);
?>