<?php
include '../includes/db_connect.php';

$examname = $_POST["exam_name"];  
$statement = mysqli_query($conn, "SELECT exam_name FROM cms_question_details WHERE exam_name = '$examname'");

if($row = mysqli_fetch_array($statement))
{
    die('<img src="../logos/not-available.png" />');
}
else
{
    die('<img src="../logos/available.png" />');
}

?>
