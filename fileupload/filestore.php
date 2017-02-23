<?php
if(isset($_GET['name']))
{
    $input_file=$_GET['name'];
    $pr_dir= "./uploads/".$input_file;
    read_file('./uploads/'.$input_file.'/'.$input_file,$pr_dir);
}    
function displayimage($filename,$index,$path)
{
    $zip = new ZipArchive;
    if (true === $zip->open($filename)) 
    {
        file_put_contents($path, $zip->getFromIndex($index));
    }
    $zip->close();
    
}

function read_file($input_file,$pr_dir)
{	 
	if(!$input_file || !file_exists($input_file)) 
        echo "Error- File not selected or doesn't exist!<br>";
	$zip = zip_open($input_file);
	$zip1= zip_open($input_file);	
	if (!$zip || is_numeric($zip)) 
        echo "Error opening the file!";
    $i=0;
    $ii=1;
    $val="";
    $val1="";
    $j=1;
    $ultind=1;
    $list_ct;
    while ($zip_entry1 = zip_read($zip1))
    {
        if (zip_entry_open($zip1, $zip_entry1) == FALSE) 
            continue;
        if(preg_match("([^\s]+(\.(?i)(jpg|jpeg|png|gif|bmp))$)",zip_entry_name($zip_entry1)))
        {
            $ar=explode(".",zip_entry_name($zip_entry1));
            $arr1=explode("/",$ar[0]);
            $patt = $pr_dir.'/img'.$i.".".$ar[1];
            $img_path[$ii++]=$patt;
            displayimage($input_file,$i,$patt);
        }
        $i++;
    }
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
                    if($div->getElementsByTagName( "drawing" )->length!=0)//tag for searching the picture
                    {
                        $val12=$div->getElementsByTagName("cNvPr");  
                        $ind[$j++] = $val12->item(0)->getAttribute('id');
                        $ind=array_unique($ind);
                        $j=sizeof($ind)+1;
                    }
                }
            }        
        }
        zip_entry_close($zip_entry);
	}
    zip_close($zip);
    $ind=array_unique($ind);
    $j--;
    while($j>0)
    {
        $img_finpath[$ind[$j]]= $img_path[$j];  
        --$j;
    }
    $zip = zip_open($input_file);
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
                $flag=0;
                if($para->getElementsByTagName( "numId" )->length!=0)
                {
                    $num_id=$para->getElementsByTagName( "numId" );
                    $idd = $num_id->item(0)->getAttribute('w:val');
                    //echo $idd;
                    if(isset($list_ct[$idd]))
                        $list_ct[$idd]++;
                    else
                        $list_ct[$idd]=1;
                    $flag=1;
                }
                $text = $para->getElementsByTagName( "r" );
                foreach($text as $div)
                {
                    if($div->getElementsByTagName( "t" )->length!=0)
                    {
                        $part = $div->getElementsByTagName( "t" );
                        if($flag==1)
                        {
                            $num= $list_ct[$idd];
                            $val= $val."<br> ".$num.". ".$part->item(0)->nodeValue;
                        }
                        else
                            $val= $val.$part->item(0)->nodeValue."";
                        
                    }
                    if($div->getElementsByTagName( "drawing" )->length!=0)//tag for searching the picture
                    {
                        
                        $val12=$div->getElementsByTagName("cNvPr");  
                        $ind = $val12->item(0)->getAttribute('id');
                        $pat=$img_finpath[$ind];
                        $val=$val."$$../fileupload/".$pat;
                    }
                }
            }        
        }
        zip_entry_close($zip_entry);
	}
	zip_close($zip);
	zip_close($zip1);
    fclose($myfile);
    unlink("./uploads/document.xml");
    $res=explode("#",$val);
    include 'storedb.php';
    header("Location: ../question/question.php?filestored=1");
}

?>