<?php
if(isset($_GET['name']))
{
    $input_file=$_GET['name'];
    $pr_dir= "./uploads/".$input_file;
    //method to display the file the way it is
    read_file('./uploads/'.$input_file.'/'.$input_file,$pr_dir,$src,$input_file);
}    

function read_file($input_file,$pr_dir,$src,$ip)
{	 
    $sec=0;
    $ques=0;
	if(!$input_file || !file_exists($input_file)) 
        echo "Error- File not selected or doesn't exist!<br>";
	$zip = zip_open($input_file);
	$zip1= zip_open($input_file);	
	if (!$zip || is_numeric($zip)) 
        echo "Error opening the file!";
    $i=0;
    $val="";
    $val1="";
	while ($zip_entry = zip_read($zip)) 
    {	
		if (zip_entry_open($zip, $zip_entry) == FALSE) //zip entry couldn't be opened
            continue;
		if (zip_entry_name($zip_entry) == "word/document.xml") //document.xml contains all the data as well as the metadata
        {
            //getting the contents of the document.xml
		    $texts = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
            $myfile = fopen("./uploads/document.xml", "w");
            $file = './uploads/document.xml';
            // Open the file to get existing content
            $current = file_get_contents($file);
            // Append the contents to the file
            $current .= $texts;
            // Write the contents back to the file
            file_put_contents($file, $current);
            $doc = new DOMDocument();
            $doc->load("./uploads/document.xml");
            //parsing the XML based on tags
            $paragraphs = $doc->getElementsByTagName( "p" );
            foreach( $paragraphs as $para )
            {
                $text = $para->getElementsByTagName( "r" );
                foreach($text as $div)
                {
                    if($div->getElementsByTagName( "t" )->length!=0)
                    {
                        $part = $div->getElementsByTagName( "t" );
                        $tmp=$part->item(0)->nodeValue;
                        if($tmp=="#Section#")
                            $sec++;
                        else
                        if($tmp=="#Question#")
                            $ques++;
                        $val= $val.$part->item(0)->nodeValue."";
                        
                    }
                }
            }        
        }
        zip_entry_close($zip_entry);
	}
	zip_close($zip);
	zip_close($zip1);
    fclose($myfile);
    $res=explode("#",$val);
    @ session_start();
    $_SESSION['sec']=$sec;
    $_SESSION['ques']=$ques;
    $_SESSION['ipf']=$ip;
    header("Location: ../question/question.php");
}

?>