<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../logos/shaw.ico">

    <title>Course Details</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap-3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../bootstrap-3.3.7/docs/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="question.css" rel="stylesheet">
      
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../bootstrap-3.3.7/docs/assets/js/ie-emulation-modes-warning.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <script src = "../alertify/alertify.min.js"></script>
    <!-- include the style -->
    <link rel="stylesheet" href="../alertify/css/alertify.min.css" />
    <!-- include a theme -->
    <link rel="stylesheet" href="../alertify/css/themes/bootstrap.css" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      <style>
table {
    border-collapse: collapse;
    width: 100%;
    border: 1px solid black;
}

th, td {
    border: 1px solid black;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
tr:nth-child(odd){background-color: #f2f2f2}

th {
    background-color: #8E001C;
    color: white;
}
</style>
  </head>
    
  <body style="background-color:#E3A977">
    <div class="container">
      <div class="header clearfix">
        
      </div>
      <p></p>
        
      <div class="jumbotron" style="background-color: #002D40; text-align:left">
        <h3 style="color:white;">Exam Preview<h3>
      </div>
      <div class="newpara">
      </div>
      <div style="background-color: #E3C97F; text-align:left">
          <?php
include '../includes/db_connect.php';
@ session_start();
$exam_name=$_SESSION['exam_preview'];
$sql="SELECT DISTINCT(section) FROM cms_question_details WHERE exam_name='".$exam_name."'";
$res=$conn->query($sql);
$body="<label style='font-size:25px;display:block;text-align:left;background-color: #E3C97F;'><b>Exam Name: &emsp;".$exam_name."</b></label><label style='font-size:18px;display:block;text-align:left;background-color: #E3C97F;border: 2px solid #002D40;
    border-radius: 5px; padding-left:10px'>";
if($res->num_rows>0)
{
    while($ro=$res->fetch_assoc())
    {
        $section=$ro['section'];
        $body=$body."<br><b>Section: </b>&emsp;".$section;
        $sql="SELECT * FROM cms_question_details WHERE exam_name='".$exam_name."' AND section='".$ro['section']."'";
        $res2=$conn->query($sql);
        if($res2->num_rows>0)
        {
            while($ro2=$res2->fetch_assoc())
            {
                $chap=$ro2['chapter'];
                $body.="<br><b>Chapter: </b>&emsp;".$chap;
                $qtype=$ro2['questiontype'];
                $body.="<br><b>Question Type: </b>&emsp;".$qtype;
                $align=$ro2['alignment'];
                $body.="<br><b>Alignment: </b>&emsp;".$align;
                $lod=$ro2['lod'];
                $body.="<br><b>LOD: </b>&emsp;".$lod;
                $author=$ro2['author'];
                $body.="<br><b>Author: </b>&emsp;".$author;
                $qarr=explode("$$",$ro2['question']);
                $question=$qarr[0];
                $body.="<br><b>Question: </b>&emsp;".$question;
                $size=sizeof($qarr);
                $k=1;
                while($k<$size)
                {
                    $img="<img src='".$qarr[$k]."'>";
                    $body.="<br><br>".$img;
                    $k++;   
                }
                $o1=$ro2['option1'];
                $body.="<br><br><b>Option 1: </b>&emsp;".$o1;
                $o2=$ro2['option2'];
                $body.="<br><b>Option 2: </b>&emsp;".$o2;
                $o3=$ro2['option3'];
                $body.="<br><b>Option 3: </b>&emsp;".$o3;
                $o4=$ro2['option4'];
                $body.="<br><b>Option 4: </b>&emsp;".$o4;
                $sol=$ro2['solution'];
                $body.="<br><b>Solution: </b>&emsp;".$sol;
                $correct=$ro2['correctoption'];
                $body.="<br><b>Correct Option: </b>&emsp;".$correct;
                $expl=$ro2['explanation'];
                if($expl!="")
                {
                    $exparr=explode("$$",$expl);
                    $body.="<br><b>Explanation: </b>&emsp;".$exparr[0];
                    $size=sizeof($exparr);
                    $k=1;
                    while($k<$size)
                    {
                        $img="<img src='".$exparr[$k]."'>";
                        $body.="<br><br><br>".$img;
                        $k++;   
                    }
                }
                $body.="<br><br><br>";
            }
        }
    }
    $body.="</label>";
    echo $body;
    $_SESSION['es']=$body;
    //header("Location: question.php");
}
?>
      </div>

      <footer class="footer">
        <p>&copy; 2017 Shaw</p>
      </footer>

    </div> <!-- /container -->

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../bootstrap-3.3.7/assets/js/ie10-viewport-bug-workaround.js"></script>

  </body>
</html>

