<?php
include '../includes/db_connect.php';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) 
    die("Connection failed: " . $conn->connect_error);

@ session_start();
$examarr=explode(".",$_SESSION['exam_name']);
$exam=$examarr[0];
$sz=sizeof($res);
$que;
$z=0;
for($k=0;$k<$sz;$k++)
{
    if($res[$k]=="Section")
    {
        echo "k= ".$k;
        $exp="";
        $k=$k+2;
        $sec=$res[$k];
        $k++;
        a:
        $m=$k+1;
        echo "<br>m= ".$m;
        $chp=$res[$m+3];
        $qtype=$res[$m+5];
        $align=$res[$m+7];
        $lod=$res[$m+9];
        $author=$res[$m+11];
        $question=$res[$m+13];
        $o1=$res[$m+15];
        $o2=$res[$m+17];
        $o3=$res[$m+19];
        $o4=$res[$m+21];
        $sol=$res[$m+23];
        $cor=$res[$m+25];
        if(isset($res[$m+26]))
        {
            if($res[$m+26]=="Question"||$res[$m+26]=="Section")
            {
                $flag=0;
                $exp="";
            }
            else
            {
                $flag=1;
                $exp=$res[$m+27];
            }
        }
        else
            $exp="";
        $sql = "INSERT INTO cms_question_details (exam_name,section, chapter, questiontype, alignment, lod, author, question, option1, option2, option3, option4, solution, correctoption, explanation)
VALUES ('".$exam."', '".$sec."', '".$chp."', '".$qtype."', '".$align."', '".$lod."', '".$author."', '".$question."', '".$o1."', '".$o2."', '".$o3."', '".$o4."', '".$sol."', '".$cor."', '".$exp."')";
        $conn->query($sql);
        if($exp!="")
        {
            if(isset($res[$m+28]))
            {
                echo "FALSE";
                echo $res[$m+28];
                $chk=$res[$m+28];
                //var_dump($chk);
                if($chk=="Section")
                {
                    if($flag==1)
                        $k=$m+27;
                    else
                        $k=$m+25;
                    echo "HERE k=".$k;
                    continue;
                }
                else
                {
                    if($flag==1)
                        $k=$m+27;
                    else
                        $k=$m+25;
                    echo "HERE k=".$k;
                    goto a;
                }
            }
            else
                break;
        }
        else
        {
            echo "TRUE";
            if(isset($res[$m+26]))
            {
                echo $res[$m+26];
                $chk=$res[$m+26];
                //var_dump($chk);
                if($chk=="Section")
                {
                    if($flag==1)
                        $k=$m+27;
                    else
                        $k=$m+25;
                    echo "HERE 2 k=".$k;
                    continue;
                }
                else
                {
                    if($flag==1)
                        $k=$m+27;
                    else
                        $k=$m+25;
                    echo "HERE 2 k=".$k;
                    goto a;
                }
            }
            else
                break;
        }
    }
}
?>