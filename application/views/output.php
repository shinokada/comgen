
<div id="studentcom">
     <h1><?php echo $title ?></h1>
<?php
for($c=2;$c<$keynum;$c++){// $c is used to separate student by student. Student's array key.
    //echo $c;
    $studentname="studentname_".$c;
    $studentname= $this->input->post($studentname);
    //echo $studentname;
    //gender
    $gender = "gender_".$c;
    $gender= $this->input->post($gender);
    //echo $gender;
    if($gender=="M"){
        $pronoun=" He";
        $namecolor="boy";
    }else{
        $pronoun=" She";
        $namecolor="girl";
    }
    /*
   // print_r($subgrade);
    // find the last digit if value exist to added up later to find the grade
    $subgrade="";
    $subgrade .=substr($colstr,-1);
    $data['subgrade']=$subgrade;
    */
    $studentcomment = '';
    $total=0;
    //$totalarray=array();
    $totalcolarray=array();
    $totalcol="";
    
    for($col=1;$col<5;$col++){
        
        $colnum="col".$col."_".$c;// this will find col1_2, col2_2, col3_2, col4_2
        $colnum= $this->input->post($colnum);
        //echo "colnum is ";
        //echo $colnum;
        //echo "<br />";
        $subgrade="";// find the sum from the last digit
        $subgrade = substr($colnum,-1);
        //$subgrade += $subgrade ;
        if($subgrade<5 AND !empty ($subgrade)){// 5 has no comment so exclude
            //echo "collaboration subgrade is ";
            //echo $subgrade."<br />";
            //$totalarray=$subgrade;
            array_push($totalcolarray, $subgrade);
            $totalcol += $subgrade;
            //echo "<br />";
            //echo "Total collaboration marks is ";
            //echo $total;
            //echo "<br />";
            //echo "Collaboration marks";
            //echo $subgrade."<br />";
        }
        
        if(!empty($colnum)){
            $studentcomment .=$this->lang->line($colnum);//output all the comments
        }
        
    }
    
    $totalindarray=array();
    $totalind="";
    for($col=1;$col<5;$col++){
        
        $colnum="ind".$col."_".$c;// this will find col1_2, col2_2, col3_2, col4_2
        $colnum= $this->input->post($colnum);
        $subgrade="";// find the sum from the suffix
        $subgrade = substr($colnum,-1);
        
        if($subgrade<5 AND !empty ($subgrade)){
            //echo "Independence And Initiative marks";
            //echo $subgrade."<br />";
            //$totalarray=$subgrade;
            array_push($totalindarray, $subgrade);
            $totalind += $subgrade;
        }
        if(!empty($colnum)){
            $studentcomment .=$this->lang->line($colnum);
        }
    }
    
    $totalorgarray=array();
    $totalorg="";
    
    for($col=1;$col<4;$col++){
        
        $colnumpost="org".$col."_".$c;
        $colnum="org".$col."_".$c;// this will find col1_2, col2_2, col3_2, col4_2
        $colnum= $this->input->post($colnum);
        $subgrade="";// find the sum from the suffix
        $subgrade = substr($colnum,-1);
        
        if($subgrade<5 AND !empty ($subgrade)){
            /*
            echo "Organization marks";
            echo $subgrade."<br />";
            echo "colnum is ".$colnum;
            echo "<br />";
            echo "colnumpost is ".$colnumpost;
            echo "<br />";
            */
            //$totalarray=$subgrade;
            array_push($totalorgarray, $subgrade);
            $totalorg += $subgrade;
        }
        if(!empty($colnum)){
            $studentcomment .=$this->lang->line($colnum);
        }
    }
    //echo "Total is ";
    //echo $total;

    
    
    if(!empty ($studentname)){
        echo "<div class='indi'>";
        echo "<h2 class='".$namecolor."'>Comments for ".$studentname."</h2>\n";
        // find the number of character
        $stringlen=strlen($studentcomment);
        $indcomment = sprintf($studentcomment, $studentname, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun);
        if($stringlen>380){
            $lengclass="toolong";
        } else{
            $lengclass="";
        }
        // print comment 
        echo "<div class=$lengclass>";
        if($stringlen>380){
            echo "<h3>Warning: Your comment is too long</h3>";
        }
        echo "<p>";
        print $indcomment;
        echo "</p>";
        //printf($studentcomment, $studentname, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun);
        echo "</div>\n";// end of div class=$lengclass
    // echo $this->input->post(col);
        echo "<div class='stat'>\n";
        echo "<h3>Statistics</h3>\n";
        if(!empty ($totalcolarray)){
            $numtotalcol=count($totalcolarray);
            /*
            echo "totalcolarry is ";
            print_r ($totalcolarray);
            echo "<br />";
            echo "numtotalcol is ";
            echo $numtotalcol;
            echo "<br />totalcol is ";
            echo $totalcol;
            echo "<br />";
            */
            echo "Collaboration grade is ";
            echo "<span>".round($totalcol/$numtotalcol, 0)."</span>/4\n<br ?>";
                }
        if(!empty ($totalindarray)){
            $numtotalind=count($totalindarray);
            /*
            echo "totalindarry is ";
            print_r ($totalindarray);
            echo "<br />";
            echo "numtotalind is ";
            echo $numtotalind;
            echo "<br />totalind is ";
            echo $totalind;
            echo "<br />";
            */
            echo "Independence And Initiative grade is ";
            echo "<span>".round($totalind/$numtotalind, 0)."</span>/4\n<br ?>";
           
        }
        
        if(!empty ($totalorgarray)){
            $numtotalorg=count($totalorgarray);
            /*
            echo "totalorgarry is ";
            print_r ($totalorgarray);
            echo "<br />";
            echo "numtotalorg is ";
            echo $numtotalorg;
            echo "<br />totalorg is ";
            echo $totalorg;
            echo "<br />";
            */
            echo "Organization grade is ";
            echo "<span>".round($totalorg/$numtotalorg, 0)."</span>/4\n<br ?>";
     
//echo "<br />Totalarray is ";
            //print_r($totalarray);
            /* OR $totalindarray OR $totalorgarray
            echo "\n<br />Number you ticked the boxes is ";
            $numtotal=count($totalarray);
            echo $numtotal;
            echo "<br />Learning Attitude Grade is ";
            echo "<span>".round($total/$numtotal)."</span>/4\n";
            */
        }
        if(!empty ($stringlen)){
            
            echo "<div class=$lengclass><p>Total number of characters is ";
            echo "<span>".$stringlen."</span>/380\n<br ?>";
           echo "</p></div>";
        }
        echo "</div>\n";//end of 
         
        echo "</div>\n";
    }

}

     
/*
echo "<pre>output: ";
print_r ($output);
echo "</pre>";

echo "column: ";
//echo $column;
echo "<br />";

echo "<pre>comments: ";
//print_r ($comments);
echo "</pre>";

echo "<pre>arrayname1: ";
print_r ($arrayname1);
echo "</pre>";

echo "<pre>key: ";
//echo $key;
echo "</pre>";
 * 
 */
?>
    </div>
