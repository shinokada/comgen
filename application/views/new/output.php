<div id="studentcom">
     <h1><?php echo $title ?></h1>
<?php
for($c=2;$c<$keynum;$c++){// $c is used to separate student by student. Student's array key.
    //echo $c;
    $studentname="studentname_".$c;
    $studentname= $this->input->post($studentname);//find out student name from post
    //echo $studentname;
    //gender
    $gender = "gender_".$c;
    $gender= $this->input->post($gender);// find out gender from post
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
    
    //Learning attitude comment
    
    $lacomment= '';
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
            $lacomment.=$this->lang->line($colnum);//output all the comments
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
            $lacomment.=$this->lang->line($colnum);
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
            //$totalarray=$subgrade;
            array_push($totalorgarray, $subgrade);
            $totalorg += $subgrade;
        }
        if(!empty($colnum)){
            $lacomment.=$this->lang->line($colnum);
        }
    }
    //echo "Total is ";
    //echo $total;

    // Learning Goal comments
    
    $lagoalcomment = '';
    for($col=1;$col<5;$col++){
        $colnum="colgo".$col."_".$c;// this will find col1_2, col2_2, col3_2, col4_2
        $colnum= $this->input->post($colnum);
        $lagoalcomment .=$this->lang->line($colnum);
    }
    
    for($col=1;$col<5;$col++){
        $colnum="indgo".$col."_".$c;// this will find col1_2, col2_2, col3_2, col4_2
        $colnum= $this->input->post($colnum);
        $lagoalcomment .=$this->lang->line($colnum);
    }
    
    for($col=1;$col<4;$col++){
        $colnum="orggo".$col."_".$c;// this will find col1_2, col2_2, col3_2, col4_2
        $colnum= $this->input->post($colnum);
        $lagoalcomment .=$this->lang->line($colnum);
    }
    
    // end of Learning goals comment
    
    // start Math goals comment
    $mathgoalcomment = '';
    for($col=1;$col<5;$col++){
        $colnum="mathgo".$col."_".$c;// this will find col1_2, col2_2, col3_2, col4_2
        $colnum= $this->input->post($colnum);
        $mathgoalcomment .=$this->lang->line($colnum);
    }
    
    
    
    // end of math goal comment
    
    
    if(!empty ($studentname)){
        //start learning attitude comment
        if(!empty ($lacomment)){
        echo "<div class='indi'>";
        echo "<h2 class='".$namecolor."'>Learning Attitudes Comment for ".$studentname."</h2>\n";
        // find the number of character
        $stringlen=strlen($lacomment);
        $indcomment = sprintf($lacomment, $studentname, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun);
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
            echo "Collaboration grade is ";
            echo "<span>".round($totalcol/$numtotalcol, 0)."</span>/4\n<br ?>";
                }
        if(!empty ($totalindarray)){
            $numtotalind=count($totalindarray);
            echo "Independence And Initiative grade is ";
            echo "<span>".round($totalind/$numtotalind, 0)."</span>/4\n<br ?>";
           
        }
        
        if(!empty ($totalorgarray)){
            $numtotalorg=count($totalorgarray);
            echo "Organization grade is ";
            echo "<span>".round($totalorg/$numtotalorg, 0)."</span>/4\n<br ?>";
        }
        if(!empty ($stringlen)){
            
            echo "<div class=$lengclass><p>Total number of characters is ";
            echo "<span>".$stringlen."</span>/380\n<br ?>";
           echo "</p></div>";
        }
        echo "</div>\n";//end of 
         
        echo "</div>\n";
        // end of leargning attitude comment
        }
        
        if(!empty ($lagoalcomment) OR !empty ($mathgoalcomment)){
        // output Learning goal comment
        echo "<div class='indi'>";
        echo "<h2 class='".$namecolor."'>Learning Goals Comment for ".$studentname."</h2>\n";
        // find the number of character
        $totalcomment=$lagoalcomment.$mathgoalcomment;
        $stringlen=strlen($totalcomment);
        $indcomment = sprintf($totalcomment, $studentname, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun);
        if($stringlen>280){
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
        if(!empty ($stringlen)){         
            echo "<div class=$lengclass><p>Total number of characters is ";
            echo "<span>".$stringlen."</span>/280\n<br ?>";
           echo "</p></div>";
        }
        echo "</div>\n";//end of stat
         
        echo "</div>\n";
        // end of learning goal comment
        }// end of if(!empty ($lagoalcomment) OR !empty ($mathgoalcomment))
        
    }// end of if(!empty ($studentname))

}// end of for($c=2;$c<$keynum;$c++)

     
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
