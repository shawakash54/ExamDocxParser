<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../logos/shaw.png">

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
        <nav>
                <img src="../logos/shaw.png" alt="Shaw" style="width:150px;height:75px">  
          
        </nav>
      </div>
      <p></p>
        
      <div class="jumbotron" style="background-color: #002D55">
        <h3 style="color:white;">Exams Available<h3>
      </div>
      <div class="newpara">
        <form method="post">
            <input type="submit" name="add_exam" value="Add Exam" class="btn btn-lg btn-success pull-right" style="background-color: #85A5CC;"/>
            
          </form>
      </div>
      <div >
          <?php
                include '../includes/db_connect.php';
                $sql = "CREATE TABLE if not exists cms_question_details(
                        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                        exam_name VARCHAR(30),
                        section VARCHAR(30),
                        chapter VARCHAR(50),
                        questiontype INT(6),
                        alignment VARCHAR(50),
                        lod VARCHAR(50),
                        author VARCHAR(50),
                        question VARCHAR(400),
                        option1 VARCHAR(50),
                        option2 VARCHAR(50),
                        option3 VARCHAR(50),
                        option4 VARCHAR(50),
                        solution VARCHAR(50),
                        correctoption INT(6),
                        explanation VARCHAR(200)
                        )";

                $conn->query($sql);
                $sql="SELECT DISTINCT(exam_name) FROM cms_question_details";
                $res=$conn->query($sql);
                echo "<br>";
                echo '<table >
                        <thead>
                          <tr>
                            <th>Exam Name</th>
                            <th>Sections</th>
                            <th>Preview Exam</th>
                            <th>Delete Exam</th>
                          </tr>
                        </thead>
                        <tbody>';
                if($res->num_rows>0)
                {
                    while($ro=$res->fetch_assoc())
                    {
                        $sql = "SELECT section,COUNT(question) b FROM cms_question_details WHERE exam_name='".$ro['exam_name']."' GROUP BY section
";
                        $secc="<b>";
                        $res2=$conn->query($sql);
                        if($res2->num_rows>0)
                        {
                            while($ro2=$res2->fetch_assoc())
                            {
                                //var_dump($ro2);
                                $secc=$secc.$ro2['section']."&nbsp;:&nbsp;".$ro2['b']."<br>";
                            }
                        }
                        $secc.="</b>";
                        echo "<tr>";
                        echo "<td><b>".$ro['exam_name']."</b></td>";
                        echo "<td>".$secc."</td>";
                        echo '<td style="text-align:center"><form method="post">
                        <input type="hidden" name="exam_hi_name" value="'.$ro['exam_name'].'">
            <input type="submit" name="preview_exam" value="Preview" class="btn btn-lg btn-success" style="background-color: #8E001C;font-size:10px;"/>
          </form></td>';
                        echo '<td style="text-align:center"><form method="post">
                        <input type="hidden" name="exam_del_name" value="'.$ro['exam_name'].'">
            <input type="submit" name="delete_exam" value="Delete" class="btn btn-lg btn-success" style="background-color: #8E001C;font-size:10px;"/>
          </form></td>';
                        echo "</tr>";
                    }
                }
                echo "</tbody>
                    </table>";
          ?>
      </div>

      <footer class="footer">
        <p>&copy; 2017 Shaw</p>
      </footer>

    </div> <!-- /container -->
          
 <!-- Modal -->
<div class="modal fade" id="fileupload" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    File Upload:
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <form enctype="multipart/form-data" role="form" method="post">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Select the File:</label>
                      <input type="file" name="uploadedfile" class="form-control"
                      id="exampleInputEmail1" required/>
                  </div >
                <div style="text-align:center">
                  <button type="submit" name="cs_file_upload" class="btn btn-default" >Upload the File</button>
                </form>
                </div>
                
                
            </div>
        </div>
    </div>
</div>        
 
<!-- Modal -->
<div class="modal fade" id="fileconfirm" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Confirm File Upload:
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <form role="form" method="post">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Number of Sections : &nbsp;<?php @ session_start; echo $_SESSION['sec']; unset($_SESSION['sec']); ?></label>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Number of Questions : &nbsp;<?php var_dump($_SESSION);
echo $_SESSION['ques'];
unset($_SESSION['ques']); ?></label>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Do you want to upload the file?</label><hr>
                      <input type="radio" name="conf_file" value="1"><label for="exampleInputEmail1">&emsp;Yes</label><hr>
                      <input type="radio" name="conf_file" value="2"><label for="exampleInputEmail1">&emsp;No</label>
                  </div><hr>
                <div style="text-align:center">
                  <button type="submit" name="conf_file_sbt" class="btn btn-default" style="align:center">Submit</button>
                </div>
                
                
            </div>
        </div>
    </div>
</div>          
          
    
          
<!-- Modal -->
<div class="modal fade" id="examadd" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Exam Details:
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                
                <form role="form" method="post">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Enter Exam Name</label>
                      <input type="text" name="exam_name" id="exam_name" class="form-control" style="width:90%; display:inline;"
                      id="exampleInputEmail1" placeholder="Enter Exam name" required/>&emsp;<span id="exam_result" required></span>
                  </div>
                  
                <div style="text-align:center">
                  <button type="submit" name="exam_name_sbt" id="exam_name_sbt" class="btn btn-default" >Submit</button>
                </form>
                </div>
                </form>
                
                
            </div>
        </div>
    </div>
</div>
        
<div id="delfailed" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Exam Delete Status</h4>
                </div>
                <div class="modal-body">
                    <p>Error Deleting the Exam.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
          
<div id="delsuccess" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Exam Delete Status</h4>
                </div>
                <div class="modal-body">
                    <p>Exam has been deleted!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<div id="filestore" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">File Upload Status</h4>
                </div>
                <div class="modal-body">
                    <p>File has been successfully stored in database.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
          
    <script>
        $('#filestore').on('hidden.bs.modal', function (e) {
                window.location.href='question.php';
})
        $('#delsuccess').on('hidden.bs.modal', function (e) {
                window.location.href='question.php';
})
        $('#delfailed').on('hidden.bs.modal', function (e) {
                window.location.href='question.php';
})
    </script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../bootstrap-3.3.7/assets/js/ie10-viewport-bug-workaround.js"></script>

  </body>
</html>

<script type="text/javascript">
var usrnm='';
function fn_term_chk()
{
    check_username_ajax(usrnm);
}

function check_examname_ajax(exam_name)
{
    $.post('check_exam.php', {'exam_name':exam_name}, function(data) {
      $("#exam_result").html(data);
if(data.indexOf("not-available")>0)
{
    document.getElementById('exam_name_sbt').disabled=true;
}
else
{
    document.getElementById('exam_name_sbt').disabled=false;
}
   });
}
$(document).ready(function() {
    var x_timer;    
    $("#exam_name").keyup(function (e){
        clearTimeout(x_timer);
        var exam_name = $(this).val();
        x_timer = setTimeout(function(){
            usrnm=exam_name;
            check_examname_ajax(exam_name);
        }, 1);

    
    }); 

});
</script>

      
<?php
@ session_start();
    if(isset($_GET['del']))
    {
        $flag=$_GET['del'];
        if($flag==1)
            echo "<script type='text/javascript'>
                $(document).ready(function(){
                $('#delsuccess').modal('show');
                });
                </script>";
        else
            echo "<script type='text/javascript'>
                $(document).ready(function(){
                $('#delfailed').modal('show');
                });
                </script>";
    }
    if(isset($_POST['preview_exam']))
    {
        $_SESSION['exam_preview']=$_POST['exam_hi_name'];
        echo '<script> window.open("./preview_exam.php","_blank"); </script>';
        //redirect("preview_exam.php");
        //var_dump($_POST['exam_hi_name']);   
    }
    if(isset($_POST['delete_exam']))
    {
        $_SESSION['exam_del']=$_POST['exam_del_name'];
        redirect("exam_delete.php");
    }
    if(isset($_POST['exam_name_sbt']))
    {
        $exam_name=$_POST['exam_name'].".docx";
        $_SESSION['exam_name']=$exam_name;
        echo "<script type='text/javascript'>
                $(document).ready(function(){
                $('#fileupload').modal('show');
                });
                </script>";
    }
    if(isset($_POST['add_exam']))
    {
           echo "<script type='text/javascript'>
                $(document).ready(function(){
                $('#examadd').modal('show');
                });
                </script>";
    }
    if(isset($_GET['filestored']))
    {
        echo "<script type='text/javascript'>
                $(document).ready(function(){
                $('#filestore').modal('show');
                });
                </script>";
    }
    if(isset($_GET['filestatus']))
    {
        $filename=$_SESSION['ipf']; 
        $ur="../fileupload/filestore.php?name=".$filename;
        redirect($ur);
    }
    if(isset($_SESSION['sec']))
    {
        $sec=$_SESSION['sec'];
        $ques=$_SESSION['ques'];
        unset($_SESSION['sec']);
        unset($_SESSION['ques']);
        echo '<script>
        var title="Confirm File Upload";
        var body="Number of sections : '.$sec.'<hr> Number of Questions : '.$ques.'<br><hr><b>Please Confirm?<b>";
        
var confirm = alertify.confirm(body, function (e) {
    if (e) {
        window.location.href="question.php?filestatus=1";
    }
});
confirm.set({"title":title});
    
</script>';
    }
    if(isset($_POST['cs_file_upload']))
    {
        $exam_name=$_SESSION['exam_name'];
        $uploads_dir = '../uploads';
        //creating a directory if it doesn't exist
        if(!is_dir($uploads_dir))
            mkdir($uploads_dir, 0777);
        //Only allowed extension is .docx
        $allowedExts = "docx";
        $file_name=$_FILES["uploadedfile"]["name"];
        $uploads_dir = '../fileupload/uploads/'.$_SESSION['exam_name'];
        //creating a directory if it doesn't exist
        if(!is_dir($uploads_dir))
            mkdir($uploads_dir, 0777);
        $file_array = explode(".",$file_name);
        if(count($file_array) == 2)//so that the file type is exactly of format xyz.docx
        {
            echo "<br>";
            $ex = explode(".", $_FILES["uploadedfile"]["name"]);
            $extension = end($ex);
            echo "<br>";
            if(($_FILES["uploadedfile"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") &&                ($_FILES["uploadedfile"]["size"] < 20000000) && $extension==$allowedExts)
            {
                if($_FILES["uploadedfile"]["error"] > 0)//check if the file is error free
                {
                    //echo "Return Code: ".$_FILES["uploadedfile"]["error"]."<br>";
                    echo '<script>alertify.alert("File Upload Error","File is corrupted! Error Code: '.$_FILES["uploadedfile"]["error"].'");</script>';
                }
                else
                {
                    //temporary file name as stored in ./tmp/
                    $tmp_name=$_FILES["uploadedfile"]["tmp_name"];
                    //moving the file to a permanent location
                    move_uploaded_file($tmp_name, "$uploads_dir/$exam_name");
                    $ur="../fileupload/filecount.php?name=".$exam_name;
                    redirect($ur);
                }           
            }
            else
            {
                //echo "Suppored File type is &nbsp.docx <br>";
                //echo "Please upload a supported file type!<br>";
                echo '<script>alertify.alert("File Upload Error","File type not supported. Only suppprted FIle type is .docx");</script>';
            }
        }
        else
        {
            //for security purpose as the uploaded file can be of type .php.docx or any other
            //malicious file type which can be a danger to the server
            //echo "File Name: &nbsp&nbsp".$file_name."<br>";
            //cho "No periods allowed in filename, please try again.";   
            echo '<script>alertify.alert("File Upload Error","No periods allowed in Filename!");</script>';
        }
    }
    if(!isset($_SESSION['login_success']))
    {
        redirect("../login/login.php");
    }   
    function redirect($url)
    {
        if (!headers_sent())
        {    
            header('Location: '.$url);
            exit;
        }
        else
        {  
            echo '<script type="text/javascript">';
            echo 'window.location.href="'.$url.'";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
            echo '</noscript>'; 
            exit;
        }
    }
?>