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
    
    for($col=1;$col<5;$col++){
        
        $colnum="col".$col."_".$c;// this will find col1_2, col2_2, col3_2, col4_2
        $colnum= $this->input->post($colnum);
        $subgrade="";// find the sum from the last digit
        $subgrade = substr($colnum,-1);//last digit is a mark.
        //$subgrade += $subgrade ;
        if($subgrade<5 AND !empty ($subgrade)){// 5 has no comment so exclude
            array_push($totalcolarray, $subgrade);//all subgrade will be in the array
            $totalcol += $subgrade;//total of all subgrade
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
    
    
    //$mycriteriacomment = '';
        $mycriteriacomment="";
        $numofcol=$this->input->post('numofcol');
        $numofrow=$this->input->post('numofrow');            
       // y is row amnd x is col    

        for( $r=0; $r<$numofrow; $r++) {
            // for( $c=0; $c<$numofcol; $c++) {
            $mycriteria_name="mycriteria".$r."_".$c;
            $criteria=$this->input->post($mycriteria_name);
            
                if(!empty($criteria)){
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
        echo "<h2 class='".$namecolor."'>Comment for ".$studentname."</h2>\n";
        if(!empty ($ibgradecomment) OR !empty ($lacomment) OR
                !empty ($lagoalcomment) OR !empty ($mathgoalcomment)
                OR !empty($mycriteriacomment) OR !empty($mycommentarea) )
            {
                echo "<div class=\"multistudentbox\">";
            }
        // start IB grade comment
        if(!empty ($ibgradecomment))
        {    
            //IB Grade comment
            $totalcomment=$ibgradecomment;
            $stringlen=strlen($totalcomment);
            $ibgradecomment =$totalcomment;
            if($simplemode==FALSE)
            {
                $ibgradecomment = sprintf($ibgradecomment, $studentname, $pronoun, $pronoun, $pronoun);
            }
            else
            {
                $thestudent="The student";
                $ibgradecomment = sprintf($ibgradecomment, $thestudent, $pronoun, $pronoun, $pronoun);
            }         
        }
        // end of IB Grade comment
        
        //start learning attitude comment
        if(!empty ($lacomment))
        {
            
            if($simplemode==FALSE)
            {
            $lacomment = sprintf($lacomment, $studentname, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun);
            }
            else
            {
                // delete %s from comment and make it uppercase
                $lacomment=str_replace("%s ", "", $lacomment);
                // make the first letter of sentence to uppercase even after a period
                $lacomment=preg_replace('/([.!?])\s*(\w)/e', "strtoupper('\\1 \\2')", ucfirst(strtolower($indcomment)));
                        
               //$indcomment= $lacomment;
            }
        }// end of if(!empty ($lacomment))
        // end of leargning attitude comment
        
        // start of Learning goal comment
        if(!empty ($lagoalcomment))
        {
            if($simplemode==FALSE)
            {
            $lagoalcomment = sprintf($lagoalcomment, $studentname, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun);
            }
            else
            {
                // delete %s from comment and make it uppercase
                $lagoalcomment=str_replace("%s ", "", $lagoalcomment);
                // make the first letter of sentence to uppercase even after a period
                $lagoalcomment=preg_replace('/([.!?])\s*(\w)/e', "strtoupper('\\1 \\2')", ucfirst(strtolower($lagoalcomment)));    
               //$indcomment= $lacomment;
            }
        }

        // start of Math comment
        if(!empty ($mathgoalcomment))
        {
            if($simplemode==FALSE){
                $mathgoalcomment = sprintf($mathgoalcomment, $studentname, $pronoun,$pronoun,$pronoun,$pronoun,$pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun);
            }else{
            // delete %s from comment and make it uppercase
            $mathgoalcomment=str_replace("%s ", "", $mathgoalcomment);
            // make the first letter of sentence to uppercase even after a period
            $mathgoalcomment=preg_replace('/([.!?])\s*(\w)/e', "strtoupper('\\1 \\2')", ucfirst(strtolower($mathgoalcomment)));       
           //$indcomment= $lacomment;
            }     
        }// end of if(!empty ($lagoalcomment) OR !empty ($mathgoalcomment))
    
        //Output all the comments
        if(!empty ($ibgradecomment))
            {
                print ($ibgradecomment);
                echo "\n<br />";
            } 
        if(!empty ($lacomment))
        {
            print ($lacomment);
            echo "\n<br />";
        }
        if(!empty ($lagoalcomment))
        {
            print ($lagoalcomment);
            echo "\n<br />";
        }
        If(!empty ($mathgoalcomment))
        {
            print ($mathgoalcomment);
            echo "\n<br />";
        }
        if(!empty($mycriteriacomment))
        {
            print ($mycriteriacomment);
            echo "\n<br />";
        }
        If(!empty($mycommentarea)) 
        {
            print ($mycommentarea);
            echo "\n<br /><br />";        
        }        
                
        $totalcomment= $ibgradecomment.$lacomment.$lagoalcomment.$mathgoalcomment.$mycriteriacomment.$mycommentarea;
        $totallen=strlen($totalcomment);
        echo "Total character: $totallen letters";

    }// end of if(!empty ($studentname))
    
        

        if(!empty ($ibgradecomment) OR !empty ($lacomment) OR
                !empty ($lagoalcomment) OR !empty ($mathgoalcomment)
                OR !empty($mycriteriacomment) OR !empty($mycommentarea) )
            {
                 echo "</div>\n";// end of <div class=\"multistudentbox\">
            }
       
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
