 
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
    $studentcomment = '';
    for($col=1;$col<5;$col++){
        $colnum="col".$col."_".$c;// this will find col1_2, col2_2, col3_2, col4_2
        $colnum= $this->input->post($colnum);
        $studentcomment .=$this->lang->line($colnum);
        //echo $content."<br />";
        
       // printf($content, $studentname);
        //echo $content;
       
    }
    
    for($col=1;$col<5;$col++){
        $colnum="ind".$col."_".$c;// this will find col1_2, col2_2, col3_2, col4_2
        $colnum= $this->input->post($colnum);
        $studentcomment .=$this->lang->line($colnum);
        //echo $content."<br />";
        
       // printf($content, $studentname);
        //echo $content;
       
    }
    
    for($col=1;$col<4;$col++){
        $colnum="org".$col."_".$c;// this will find col1_2, col2_2, col3_2, col4_2
        $colnum= $this->input->post($colnum);
        $studentcomment .=$this->lang->line($colnum);
        //echo $content."<br />";
        
       // printf($content, $studentname);
        //echo $content;
       
    }
      
    //printf($studentcomment, $studentname, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun);
   // echo $this->input->post(col);
    //echo "<br /><br />";
    
    if(!empty ($studentname)){
        
        echo "<div class='indi'>";
        echo "<h2 class='".$namecolor."'>Comments for ".$studentname."</h2>\n";
        // find the number of character
        $stringlen=strlen($studentcomment);
        $indcomment = sprintf($studentcomment, $studentname, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun);
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
