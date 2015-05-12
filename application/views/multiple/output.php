<div id="studentcom">
     <h1><?php echo $title ?></h1>
<?php
for($c=2;$c<$keynum;$c++)
{// $c is used to separate student by student. Student's array key.
    //echo $c;
    $studentname="studentname_".$c;
    $studentname= $this->input->post($studentname);//find out student name from post
    //echo $studentname;
    //gender
    $gender = "gender_".$c;
    $gender= $this->input->post($gender);// find out gender from post
    //echo $gender;
    if($gender=="M")
    {
        $pronoun=" He";
        $namecolor="boy";
    }
    else
    {
        $pronoun=" She";
        $namecolor="girl";
    }
    // find simplemode or not
    $simplemode=$this->input->post('simplemode');
    /*
   // print_r($subgrade);
    // find the last digit if value exist to added up later to find the grade
    $subgrade="";
    $subgrade .=substr($colstr,-1);
    $data['subgrade']=$subgrade;
    */
    
    // Get IB Grade comment
    $ibgradecomment ='';
    $ibgradename="ibgrade".$c;
    $ibgradecon=$this->input->post($ibgradename);//get value
    $ibgradecomment=$this->lang->line($ibgradecon);// get from config
    
    // Assemble Learning attitude comment
    
    $lacomment= '';
    $total=0;
    //$totalarray=array();
    $totalcolarray=array();// subgrade will be pushed in
    $totalcol="";
    
    for($col=1;$col<5;$col++)
    {   
        $colnum="col".$col."_".$c;// this will find col1_2, col2_2, col3_2, col4_2
        $colnum= $this->input->post($colnum);
        $subgrade="";// find the sum from the last digit
        $subgrade = substr($colnum,-1);//last digit is a mark.
        //$subgrade += $subgrade ;
        if($subgrade<5 AND !empty ($subgrade))
        {// 5 has no comment so exclude
            array_push($totalcolarray, $subgrade);//all subgrade will be in the array
            $totalcol += $subgrade;//total of all subgrade
        }
        if(!empty($colnum))
        {
            $lacomment.=$this->lang->line($colnum);//output all the comments
        }   
    }
    
    $totalindarray=array();
    $totalind="";
    for($col=1;$col<5;$col++)
    {
        $colnum="ind".$col."_".$c;// this will find col1_2, col2_2, col3_2, col4_2
        $colnum= $this->input->post($colnum);
        $subgrade="";// find the sum from the suffix
        $subgrade = substr($colnum,-1);
        
        if($subgrade<5 AND !empty ($subgrade)){
            array_push($totalindarray, $subgrade);
            $totalind += $subgrade;
        }
        
        if(!empty($colnum)){
            $lacomment.=$this->lang->line($colnum);
        }
    }
    
    $totalorgarray=array();
    $totalorg="";
    
    for($col=1;$col<4;$col++)
    {
        $colnumpost="org".$col."_".$c;
        $colnum="org".$col."_".$c;// this will find col1_2, col2_2, col3_2, col4_2
        $colnum= $this->input->post($colnum);
        $subgrade="";// find the sum from the suffix
        $subgrade = substr($colnum,-1);
        
        if($subgrade<5 AND !empty ($subgrade))
        {
            //$totalarray=$subgrade;
            array_push($totalorgarray, $subgrade);
            $totalorg += $subgrade;
        }

        if(!empty($colnum))
        {
            $lacomment.=$this->lang->line($colnum);
        }
    }
    //echo "Total is ";
    //echo $total;

    // Learning Goal comments
    
    $lagoalcomment = '';
    for($col=1;$col<5;$col++)
    {
        $colnum="colgo".$col."_".$c;// this will find col1_2, col2_2, col3_2, col4_2
        $colnum= $this->input->post($colnum);
        $lagoalcomment .=$this->lang->line($colnum);
    }
    
    for($col=1;$col<5;$col++)
    {
        $colnum="indgo".$col."_".$c;// this will find col1_2, col2_2, col3_2, col4_2
        $colnum= $this->input->post($colnum);
        $lagoalcomment .=$this->lang->line($colnum);
    }
    
    for($col=1;$col<4;$col++)
    {
        $colnum="orggo".$col."_".$c;// this will find col1_2, col2_2, col3_2, col4_2
        $colnum= $this->input->post($colnum);
        $lagoalcomment .=$this->lang->line($colnum);
    }
    
    // end of Learning goals comment
    
    // start Math goals comment
    $mathgoalcomment = '';
    for($col=1;$col<5;$col++)
    {
        $colnum="mathgo".$col."_".$c;// this will find col1_2, col2_2, col3_2, col4_2
        $colnum= $this->input->post($colnum);
        $mathgoalcomment .=$this->lang->line($colnum);
    } 
    // end of math goal comment
    
    
    //$mycriteriacomment = '';
    $mycriteriacomment="";
    $numofcol=$this->input->post('numofcol');
    $numofrow=$this->input->post('numofrow');            
   // y is row amnd x is col    

    for( $r=0; $r<$numofrow; $r++) 
    {
        // for( $c=0; $c<$numofcol; $c++) {
        $mycriteria_name="mycriteria".$r."_".$c;
        $criteria=$this->input->post($mycriteria_name);
        
        if(!empty($criteria))
        {
            if($simplemode==FALSE)
            {
               $mycriteriacomment .="%s ".strtolower($this->input->post($mycriteria_name));
            }
            else
            {
               $mycriteriacomment .=$this->input->post($mycriteria_name)." ";
            }
        }
    }
     // the following needs to be here otehrwise, Firstname .. He/She.. Firstname He/She
     //Being within for loop, the first sprintf will be $studentname 
     
     if ($simplemode==FALSE)
     {
        $mycriteriacomment = sprintf($mycriteriacomment, $studentname, $pronoun,$pronoun,$pronoun,$pronoun,$pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun); 
     }
     // this will capitalize the first letter of each sentence
     $mycriteriacomment = preg_replace_callback('/[.!?].*?\w/', create_function('$matches', 'return strtoupper($matches[0]);'),$mycriteriacomment);

    //mycommentarea
    $mycommentid="mycommentarea_$c";
    $mycommentarea=$this->input->post($mycommentid);


    if(!empty ($studentname))
    {
        
        if(!empty ($ibgradecomment) OR !empty ($lacomment) OR
                !empty ($lagoalcomment) OR !empty ($mathgoalcomment)
                OR !empty($mycriteriacomment) OR !empty($mycommentarea))
        {
            echo "<div class=\"multistudentbox\">";
        }
        
        //echo "<div class=\"multistudentbox\">";
        // start IB grade comment
        if(!empty ($ibgradecomment))
        {    
            // output IB Grade comment
            echo "<div class='indinew'>";
            echo "<h2 class='".$namecolor."'>IB Grade Comment for ".$studentname."</h2>\n";
            // find the number of character
            //var_dump($ibgradecomment) ;
            $totalcomment=$ibgradecomment;
            $stringlen=strlen($totalcomment);
            //$indcomment = sprintf($totalcomment, $studentname, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun);
            $indcomment =$totalcomment;
            $stringlimit='580';
            if($stringlen>$stringlimit)
            {
                $lengclass="toolong";
            }
            else
            {
                $lengclass="comblock";
            }
            // print comment 
            echo "<div class=$lengclass>";
            if($stringlen>$stringlimit)
            {
                echo "<h3>Warning: Your comment is too long</h3>";
            }
            echo "<p>";
            if($simplemode==FALSE)
            {
                $indcomment = sprintf($indcomment, $studentname, $pronoun, $pronoun, $pronoun);
                print $indcomment;
            }
            else
            {
                $thestudent="The student";
                $indcomment = sprintf($indcomment, $thestudent, $pronoun, $pronoun, $pronoun);
                print $indcomment;
            }
            echo "</p>";
            //printf($studentcomment, $studentname, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun);
            echo "</div>\n";// end of div class=$lengclass
        // echo $this->input->post(col);
            echo "<div class='statnew'>\n";
            echo "<h3>Statistics</h3>\n";   
            if(!empty ($stringlen))
            {         
                echo "<div class=$lengclass><p>Total number of characters is ";
                echo "<span>".$stringlen."</span>/".$stringlimit."\n<br />";
                echo "</p></div>";
            }
            echo "</div>\n";//end of stat
            echo "</div>\n";// end of class='indi'           
        }
        // end of IB Grade comment
        
        //start learning attitude comment
        if(!empty ($lacomment))
        {
            echo "<div class='indinew'>";
            echo "<h2 class='".$namecolor."'>Learning Attitudes Comment for ".$studentname."</h2>\n";
            // find the number of character
            $stringlen=strlen($lacomment);
            if($simplemode==FALSE)
            {
                $indcomment = sprintf($lacomment, $studentname, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun);
            }
            else
            {
                // delete %s from comment and make it uppercase
                $indcomment=str_replace("%s ", "", $lacomment);
                // make the first letter of sentence to uppercase even after a period
                $indcomment=preg_replace('/([.!?])\s*(\w)/e', "strtoupper('\\1 \\2')", ucfirst(strtolower($indcomment)));
                        
               //$indcomment= $lacomment;
            }
            if($stringlen>380)
            {
                $lengclass="toolong";
            } 
            else
            {
                $lengclass="comblock";
            }
            // print comment 
            echo "<div class=$lengclass>";
            if($stringlen>380)
            {
                echo "<h3>Warning: Your comment is too long</h3>";
            }
            echo "<p>";
            print $indcomment;
            echo "</p>";
            //printf($studentcomment, $studentname, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun);
            echo "</div>\n";// end of div class=$lengclass
            // echo $this->input->post(col);
            echo "<div class='statnew'>\n";
            echo "<h3>Statistics</h3>\n";
            if(!empty ($totalcolarray))
            {
                $numtotalcol=count($totalcolarray);//count total num in array
                echo "Collaboration grade is ";
                echo "<span>".round($totalcol/$numtotalcol, 0)."</span>/4\n<br />";
            }
                    
            if(!empty ($totalindarray))
            {
                $numtotalind=count($totalindarray);
                echo "Independence And Initiative grade is ";
                echo "<span>".round($totalind/$numtotalind, 0)."</span>/4\n<br />";
            }
            
            if(!empty ($totalorgarray))
            {
                $numtotalorg=count($totalorgarray);
                echo "Organization grade is ";
                echo "<span>".round($totalorg/$numtotalorg, 0)."</span>/4\n<br />";
            }
            if(!empty ($stringlen))
            {
                echo "<div class=$lengclass><p>Total number of characters is ";
                echo "<span>".$stringlen."</span>/380\n<br />";
                echo "</p></div>";
            }
            echo "</div>\n"; 
            echo "</div>\n";
        }// end of if(!empty ($lacomment))
        // end of leargning attitude comment
        
        // start of Learning goal comment and Math comment
        if(!empty ($lagoalcomment) OR !empty ($mathgoalcomment))
        {
            // output Learning goal comment
            echo "<div class='indinew'>";
            echo "<h2 class='".$namecolor."'>Learning Goals Comment for ".$studentname."</h2>\n";
            // find the number of character
            $totalcomment=$lagoalcomment.$mathgoalcomment;
            $stringlen=strlen($totalcomment);
            if($simplemode==FALSE)
            {
                $indcomment = sprintf($totalcomment, $studentname, $pronoun,$pronoun,$pronoun,$pronoun,$pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun);
            }
            else
            {
            // delete %s from comment and make it uppercase
            $indcomment=str_replace("%s ", "", $totalcomment);
            // make the first letter of sentence to uppercase even after a period
            $indcomment=preg_replace('/([.!?])\s*(\w)/e', "strtoupper('\\1 \\2')", ucfirst(strtolower($indcomment)));
                    
           //$indcomment= $lacomment;
            }
            if($stringlen>280)
            {
                $lengclass="toolong";
            }
            else
            {
                $lengclass="comblock";
            }
            // print comment 
            echo "<div class=$lengclass>";
            if($stringlen>280)
            {
                echo "<h3>Warning: Your comment is too long</h3>";
            }
            echo "<p>";
            print $indcomment;
            echo "</p>";
            //printf($studentcomment, $studentname, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun);
            echo "</div>\n";// end of div class=$lengclass
        // echo $this->input->post(col);
            echo "<div class='statnew'>\n";
            echo "<h3>Statistics</h3>\n";   
            if(!empty ($stringlen))
            {         
                echo "<div class=$lengclass><p>Total number of characters is ";
                echo "<span>".$stringlen."</span>/280\n<br />";
               echo "</p></div>";
            }
            echo "</div>\n";//end of stat
            echo "</div>\n";// end of class='indi'
        }// end of if(!empty ($lagoalcomment) OR !empty ($mathgoalcomment))
        // end of learning goal comment
        
        // start of mycriteria
        if(!empty ($mycriteriacomment))
        {    
            echo "<div class='indinew'>";
            echo "<h2 class='".$namecolor."'>Comment from Your Comment File for ".$studentname."</h2>\n";
            echo "<div class=\"comblock\"><p>";   
            echo $mycriteriacomment;
            echo "</p></div>\n";// end of <div class=\"comblock\">
            $stringlen=strlen($mycriteriacomment);
            echo "<div class='statnew'>\n";
            echo "<h3>Statistics</h3>\n";
            if(!empty ($stringlen))
            {         
                echo "<div><p>Total number of characters is ";
                echo "<span>".$stringlen."</span>\n<br />";
                echo "</p></div>";// end of div
            }
            echo "</div>";//end of <div class='statnew'>
            echo "</div>";// end of <div class='indinew'>    
        }//end of if(!empty ($mycriteriacomment))

        // start of mycommentarea
        if(!empty ($mycommentarea))
        {  
            echo "<div class='indinew'>";
            echo "<h2 class='".$namecolor."'>My Comment for ".$studentname."</h2>\n";
            echo "<div class=\"comblock\"><p>";   
            echo $mycommentarea;
            echo "</p></div>\n";// end of <div class=\"comblock\">
            $stringlen=strlen($mycommentarea);
            echo "<div class='statnew'>\n";
            echo "<h3>Statistics</h3>\n";
            if(!empty ($stringlen))
            {         
                echo "<div><p>Total number of characters is ";
                echo "<span>".$stringlen."</span>\n<br />";
                echo "</p></div>";// end of div
            }
            echo "</div>";//end of <div class='statnew'>
            echo "</div>";// end of <div class='indinew'>    
             
        }//end of if(!empty ($mycriteriacomment))

    }// end of if(!empty ($studentname))
    
    if(!empty ($ibgradecomment) OR !empty ($lacomment) OR
                !empty ($lagoalcomment) OR !empty ($mathgoalcomment)
                OR !empty($mycriteriacomment) OR !empty($mycommentarea))
    {
        echo "</div>\n";// end of <div class=\"multistudentbox\">
    }
           //     echo "</div>\n";// end of <div class=\"multistudentbox\">
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
//print_r ($arrayname1);
echo "</pre>";


echo "<pre>key: ";
var_dump ($simplemode);
echo "</pre>";
 * 
 */
?>
    </div><!-- end of id studentcom -->
