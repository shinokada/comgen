<div id="header">
    <h1><?php echo $title ?></h1>
    <?php
    if(isset($lacomment)){
    echo "<h2>Learning Attitudes Criteria v7.7</h2> ";
}
?>
    
</div><!-- end of id header -->

<?php
/*
echo "<pre>num of col: ";
var_dump($numofcol);
echo "</pre>";
echo "<pre>num of row: ";
var_dump($numofrow);
echo "</pre>";
echo "<pre>";
var_dump($mycriteriaarray);
echo "</pre>";
echo "<pre>mycriteriastring: ";
var_dump($mycriteriastring);
echo "</pre>";
*/

echo form_open('multipleupload/create',array('id' => 'comform'));
//number of row
//echo count($row);
$keynum=count($row1);
echo form_hidden('keynum', $keynum);// use this as a counter
if(isset($simplemode)){
    echo form_hidden('simplemode', $simplemode);
}
if(isset($showibgrade)){
    echo form_hidden('showibgrade', $showibgrade);
}
if(isset($lacomment)){
    echo form_hidden('lacomment', $lacomment);
}
if(isset($lagocomment)){
    echo form_hidden('lagocomment', $lagocomment);
}
if(isset($mathgocomment)){
    echo form_hidden('mathgocomment', $mathgocomment);
}
if(isset($mycomment)){
    echo form_hidden('mycomment', $mycomment);
}

foreach($row1 as $key=>$value ){
    //echo $key."<br />";
    if($key>1){// this will skip [0] => Section:2(A) Math 6,
    //[1] => Student Name,Gender
    $list = trim($value);
    $list = explode(",",$value);// string to array
    //$list = str_replace(" ", "", $list); // take out space
    $list = str_replace("\"", "", $list); // take out "
    if(!empty($list[0])){// if a family name exists, since Powerschool produce empty arrays
        if($list[2]=="M"){// find out gender
            $namecolor="boy";
            $pronoun=" He";
        }  else {
            $namecolor="girl";
            $pronoun=" She";
        }
               
        echo form_hidden('gender_'.$key, $list[2]);// hidden form for gender
        // js
        echo "<script type=\"text/javascript\">  
                floatingMenu.add('floatdiv".$key."',  
                    {   
                        targetTop: 170,  
                        prohibitXMovement: true,  
                        snap: true  
                    });  
                </script> \n";
        
        echo "<div  class=\"box\"  style=\"position:relative;\">\n";  
        echo "<div id=\"floatdiv".$key."\" class=\"box\" style=\"position:absolute; margin-left: -23%; height:40px\">\n";  
        print_r ("<h2 class='".$namecolor."'>".$list[1]." ".$list[0]."</h2>\n");// this display full name
        
        echo "</div>\n<!-- end of id floatdiv.key -->";
        
        echo form_hidden("studentname_".$key, $list[1]);//
        
        // IB General grade descriptors
        if(isset($showibgrade) AND $showibgrade==="1"){
            echo "<h3>".$this->lang->line("ibgrade")."</h3>";
            echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=100% style='font-size:10pt'>\n";
            echo "<tr><th width=\"14%\"><h3>Grade 1</h3></th>\n<th width=\"14%\"><h3>Grade 2</h3></th>\n<th width=\"14%\"><h3>Grade 3</h3></th>\n<th width=\"14%\"><h3>Grade 4</h3></th>\n<th width=\"14%\"><h3>Grade 5</h3></th>\n<th width=\"14%\"><h3>Grade 6</h3></th>\n<th width=\"14%\"><h3>Grade 7</h3></th></tr>\n";
            echo "<tr>\n";
            for ($r=1; $r<8; $r++){
                echo "<td valign=\"top\">\n";
                $grade="grade".$r;
                $radio = array(
                        'name'=>"ibgrade".$key,
                        'value'=>$grade,
                        'class'=>'radiobtn',
                        );
                //echo $this->lang->line($grade);
                echo "<div class=\"comment\">".form_radio($radio).$this->lang->line($grade)."</div>\n";

                echo "</td>\n";
            }
            echo "</tr>\n";
            echo "</table>\n";        
        }
        
        
        if(isset($lacomment) AND $lacomment==="1"){
            // Learning Attitude: Collaboration
            echo "<h3>".$this->lang->line("col")."</h3>";
            echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=100% style='font-size:10pt'>\n";
            echo "<tr><th width=\"20%\"><h3>Poor</h3></th><th width=\"20%\"><h3>Basic</h3></th><th width=\"20%\"><h3>Proficient</h3></th><th width=\"20%\"><h3>Advanced</h3></th><th width=\"20%\"><h3>None</h3></th></tr>\n";
            //echo "<tr>";
            for ($r=1; $r<5; $r++){//$r stands for row number. Collaboration needs 4 columns.
                echo "<tr>\n";
                for ($c=1; $c < 6; $c++) {// 5th column for none to unselect other 
                    //Display all comments from language file
                    $rowname="col".$r;//used for input name with key
                    $colstr="col".$r.$c;// used for input value
                    echo "<td valign=\"top\">\n";
                    $contone=$this->lang->line($colstr);
                    //$conttwo=substr($contone, 3);//skip "%s "
                    // replace "%s "
                    $conttwo=str_replace("%s ", "", $contone);
                    // make the first letter of sentence to uppercase even after a period
                    $contthree=preg_replace('/([.!?])\s*(\w)/e', "strtoupper('\\1 \\2')", ucfirst(strtolower($conttwo)));
                    $radio = array(
                        'name'=>$rowname."_".$key,
                        'value'=>$colstr,
                        'class'=>'radiobtn',
                        );
                    echo "<div class=\"comment\">".form_radio($radio)."$contthree</div>\n";
                    /*
                    echo form_radio($radio);
                    echo "<div class=\"comment\">$contthree</div>";
                    */
                    echo "</td>\n";
                }
                echo "</tr>\n";
            }
            echo "</table>\n";

            // Learning Attitude: Independence and initiative
            echo "<h3>".$this->lang->line("ind")."</h3>";
            echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=100% style='font-size:10pt'>\n";
            echo "<tr><th width=\"20%\"><h3>Poor</h3></th><th width=\"20%\"><h3>Basic</h3></th><th width=\"20%\"><h3>Proficient</h3></th><th width=\"20%\"><h3>Advanced</h3></th><th width=\"20%\"><h3>None</h3></th></tr>\n";
            for ($r=1; $r<5; $r++){//$r stands for row number. Independence needs 4 rows.
                echo "<tr>\n";
                for ($c=1; $c < 6; $c++) {
                    $rowname="ind".$r;//used for input name with key
                    $colstr="ind".$r.$c;// used for input value
                    echo "<td valign=\"top\">\n";
                    $contone=$this->lang->line($colstr);
                    //$conttwo=substr($contone, 3);//skip "%s "
                    $conttwo=str_replace("%s ", "", $contone);
                    // make the first letter of sentence to uppercase even after a period
                    $contthree=preg_replace('/([.!?])\s*(\w)/e', "strtoupper('\\1 \\2')", ucfirst(strtolower($conttwo)));
                    $radio = array(
                        'name'=>$rowname."_".$key,
                        'value'=>$colstr,
                        'class'=>'radiobtn',
                        );
                    echo "<div class=\"comment\">".form_radio($radio)."$contthree</div>\n";
                    /*
                    echo form_radio($radio);
                    
                    echo "<div class=\"comment\">$contthree</div>";
                    */
                    //echo $this->lang->line($colstr);
                    echo "</td>\n";
                }
                echo "</tr>\n";
            }
            echo "</table>\n";


            // Learning Attitude: Organizational
            echo "<h3>".$this->lang->line("org")."</h3>";
            echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=100% style='font-size:10pt'>\n";
            echo "<tr><th width=\"20%\"><h3>Poor</h3></th><th width=\"20%\"><h3>Basic</h3></th><th width=\"20%\"><h3>Proficient</h3></th><th width=\"20%\"><h3>Advanced</h3></th><th width=\"20%\"><h3>None</h3></th></tr>\n";
            for ($r=1; $r<4; $r++){//$r stands for row number Organizational needs only 3 rows
                echo "<tr>\n";
                for ($c=1; $c < 6; $c++) {// need 4 columns
                    $rowname="org".$r;//used for input name with key
                    $colstr="org".$r.$c;// used for input value
                    echo "<td valign=\"top\">\n";
                    $contone=$this->lang->line($colstr);
                    //$conttwo=substr($contone, 3);//skip "%s "
                    $conttwo=str_replace("%s ", "", $contone);
                    // make the first letter of sentence to uppercase even after a period
                    $contthree=preg_replace('/([.!?])\s*(\w)/e', "strtoupper('\\1 \\2')", ucfirst(strtolower($conttwo)));
                    $radio = array(
                        'name'=>$rowname."_".$key,
                        'value'=>$colstr,
                        'class'=>'radiobtn',
                        );
                    echo "<div class=\"comment\">".form_radio($radio)."$contthree</div>\n";
                    /*
                    echo form_radio($radio);
                    
                    echo "<div class=\"comment\">$contthree</div>";
                    */
                    //echo $this->lang->line($colstr);
                    echo "</td>\n";
                }
                echo "</tr>\n";
            }
            echo "</table>\n";
        }//end of if($lacomment===TRUE){
        
        if(isset($lagocomment) AND $lagocomment==="1"){
            // Learning goals start
            // Learning Goal: Collaboration
            echo "<h3>".$this->lang->line("colgo")."</h3>";
            echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=100% style='font-size:10pt'>\n";
            //echo "<tr><th width=\"20%\"><h3>Poor</h3></th><th width=\"20%\"><h3>Basic</h3></th><th width=\"20%\"><h3>Proficient</h3></th><th width=\"20%\"><h3>Advanced</h3></th><th width=\"20%\"><h3>None</h3></th></tr>\n";
            //echo "<tr>";
            for ($r=1; $r<5; $r++){//$r stands for row number. Collaboration needs 4 columns.
                echo "<tr>\n";
                for ($c=1; $c < 4; $c++) {
                    $rowname="colgo".$r;//used for input name with key
                    $colstr="colgo".$r.$c;// used for input value
                    echo "<td width=\"50%\" valign=\"top\">\n";
                    $contone=$this->lang->line($colstr);
                    //$conttwo=substr($contone, 3);//skip "%s "
                    $conttwo=str_replace("%s ", "", $contone);
                    $contthree=preg_replace('/([.!?])\s*(\w)/e', "strtoupper('\\1 \\2')", ucfirst(strtolower($conttwo)));

                    //$contthree = ucfirst($conttwo);
                    $radio = array(
                        'name'=>$rowname."_".$key,
                        'value'=>$colstr,
                        'class'=>'radiobtn',
                        );
                    echo "<div class=\"comment\">".form_radio($radio)."$contthree</div>";
                    /*
                    echo form_radio($radio);
                    echo "<div class=\"comment\">$contthree</div>";
                    
                     * //echo $contthree;
                     */
                    //echo form_radio($radio);
                    echo "</td>\n";
                }
                echo "</tr>\n";
            }


            //echo "</tr>\n";
            echo "</table>\n";

            // // Learning Goal: Independence and initiative
            echo "<h3>".$this->lang->line("indgo")."</h3>";
            echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=100% style='font-size:10pt'>\n";
            //echo "<tr><th width=\"20%\"><h3>Poor</h3></th><th width=\"20%\"><h3>Basic</h3></th><th width=\"20%\"><h3>Proficient</h3></th><th width=\"20%\"><h3>Advanced</h3></th><th width=\"20%\"><h3>None</h3></th></tr>\n";
            //echo "<tr>";
            for ($r=1; $r<5; $r++){//$r stands for row number. Independence needs 4 rows.
                echo "<tr>\n";
                for ($c=1; $c < 4; $c++) {
                    $rowname="indgo".$r;//used for input name with key
                    $colstr="indgo".$r.$c;// used for input value
                    echo "<td width=\"50%\" valign=\"top\">\n";
                    $contone=$this->lang->line($colstr);
                    //$conttwo=substr($contone, 3);//skip "%s "
                    $conttwo=str_replace("%s ", "", $contone);
                    //$contthree = ucfirst($conttwo);
                    $contthree=preg_replace('/([.!?])\s*(\w)/e', "strtoupper('\\1 \\2')", ucfirst(strtolower($conttwo)));
                    $radio = array(
                        'name'=>$rowname."_".$key,
                        'value'=>$colstr,
                        'class'=>'radiobtn',
                        );
                    echo "<div class=\"comment\">".form_radio($radio)."$contthree</div>\n";
                    /*
                    echo form_radio($radio);
                    echo "<div class=\"comment\">$contthree</div>";   
                    */
                    //echo $contthree;
                    //echo $this->lang->line($colstr);
                    
                    //echo form_radio($radio);
                    echo "</td>\n";
                }
                echo "</tr>\n";
            }


            //echo "</tr>\n";
            echo "</table>\n";


            // Learning Goal: Organizational goals
                echo "<h3>".$this->lang->line("orggo")."</h3>";
            echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=100% style='font-size:10pt'>\n";
            //echo "<tr><th width=\"20%\"><h3>Poor</h3></th><th width=\"20%\"><h3>Basic</h3></th><th width=\"20%\"><h3>Proficient</h3></th><th width=\"20%\"><h3>Advanced</h3></th><th width=\"20%\"><h3>None</h3></th></tr>\n";
            //echo "<tr>";
            for ($r=1; $r<4; $r++){//$r stands for row number Organizational needs only 3 rows
                echo "<tr>\n";
                for ($c=1; $c < 3; $c++) {// need 4 columns
                    $rowname="orggo".$r;//used for input name with key
                    $colstr="orggo".$r.$c;// used for input value
                    echo "<td width=\"50%\" valign=\"top\">";
                    $contone=$this->lang->line($colstr);
                    //$conttwo=substr($contone, 3);//skip "%s "
                    $conttwo=str_replace("%s ", "", $contone);
                    //$contthree = ucfirst($conttwo);

                    $contthree=preg_replace('/([.!?])\s*(\w)/e', "strtoupper('\\1 \\2')", ucfirst(strtolower($conttwo)));
                    $radio = array(
                        'name'=>$rowname."_".$key,
                        'value'=>$colstr,
                        'class'=>'radiobtn',
                        );
                    echo "<div class=\"comment\">".form_radio($radio)."$contthree</div>";
                    /*
                    echo form_radio($radio);
                    echo "<div class=\"comment\">$contthree</div>";
                    */
                    //echo $contthree;
                    //echo $this->lang->line($colstr);
                    
                    //echo form_radio($radio);
                    echo "</td>\n";
                }
                echo "</tr>\n";
            }


            //echo "</tr>\n";
            echo "</table>\n";
        // end of learning goals
        }// end of if($lagocomment===TRUE)
        
        
        if(isset($mathgocomment) AND $mathgocomment==="1"){
        // Math goals
        echo "<h3>".$this->lang->line("mathgo")."</h3>";
        echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=100% style='font-size:10pt'>\n";
        //echo "<tr><th width=\"20%\"><h3>Poor</h3></th><th width=\"20%\"><h3>Basic</h3></th><th width=\"20%\"><h3>Proficient</h3></th><th width=\"20%\"><h3>Advanced</h3></th><th width=\"20%\"><h3>None</h3></th></tr>\n";
        //echo "<tr>";
        for ($r=1; $r<5; $r++){//$r stands for row number Organizational needs only 3 rows
            echo "<tr>\n";
            for ($c=1; $c < 6; $c++) {// need 4 columns
                $rowname="mathgo".$r;//used for input name with key
                $colstr="mathgo".$r.$c;// used for input value
                echo "<td valign=\"top\">";
                $contone=$this->lang->line($colstr);
                //$conttwo=substr($contone, 3);//skip "%s "
                $conttwo=str_replace("%s ", "", $contone);
                //$contthree = ucfirst($conttwo);

                $contthree=preg_replace('/([.!?])\s*(\w)/e', "strtoupper('\\1 \\2')", ucfirst(strtolower($conttwo)));
                $radio = array(
                    'name'=>$rowname."_".$key,
                    'value'=>$colstr,
                    'class'=>'radiobtn',
                    );
                echo "<div class=\"comment\">".form_radio($radio)."$contthree</div>\n";
                /*
                echo form_radio($radio);

                echo "<div class=\"comment\">$contthree</div>";
                */
                //echo $contthree;
                //echo $this->lang->line($colstr);
                
                //echo form_radio($radio);
                echo "</td>\n";
            }
            echo "</tr>\n";
        }
        //echo "</tr>\n";
        echo "</table>\n";
        }// end of if($mathgocomment===TRUE){
        
        
        //var_dump($mycriteria1);
        if(isset($mycomment) AND !empty($mycomment)){
            echo "<h3>".$this->lang->line("mycriteria")."</h3>";
            //$my_array='';
        echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=100% style='font-size:10pt'>\n";  
        echo form_hidden('numofrow', $numofrow);
        echo form_hidden('numofcol', $numofcol);
        
        // new using viewcsv()
        /*
         foreach($viewcsv as $value){
        echo "<tr><td>";
            echo $value;
            echo "</td></tr>";
        }
        */
        
        $my_array = $mycriteriaarray;
        array_walk($my_array,function(&$a) {$a = explode("|",$a);});
        // y is row amnd x is col
        for( $r=0; $r<$numofrow; $r++) {
            echo "<tr>";
            for( $c=0; $c<$numofcol+1; $c++) {
                if(!empty ($my_array[$r][$c])){
                    $singlecont='';
                    $singlecont=trim($my_array[$r][$c]);
                    //$studentname=$list[1];
                    
                    // Change %s in csv to a pronoun
                    $singlecont = sprintf($singlecont, $pronoun,$pronoun,$pronoun,$pronoun,$pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun, $pronoun);
         
                    $radio = array(
                            'name'=>"mycriteria".$r."_".$key,
                            'value'=>trim($my_array[$r][$c]),
                            'class'=>'radiobtn',
                            );
                    echo "<td valign=\"top\"><div class=\"comment\">".form_radio($radio).$singlecont."</div></td>\n";
                }  elseif($c==$numofcol) {
                    echo "<td valign=\"top\">&nbsp;";
                    $radio = array(
                            'name'=>"mycriteria".$r."_".$key,
                            'value'=>"",
                            'class'=>'radiobtn',
                            );
                    echo form_radio($radio);
                    echo "</td>\n";
                }else{
                    echo "<td valign=\"top\">&nbsp;</td>\n";
                }
            }
            echo "</tr>";
            
        }//end of for( $r=0; $r<$numofrow; $r++)
        
        
        echo "</table>\n";
        }// end of if(isset($mycomment) AND !empty($mycomment))
        
        
        echo form_submit('submit', 'Submit', 'class="css3button"');
        echo "\n</div>\n<!-- end of class box -->";//end of class box
        }// end of if(!empty($list[0]))
    }// end of if($key>1)
}// end of foreach($row1 as $key=>$value )
//echo form_submit('submit', 'Submit', 'class="css3button"');
echo form_close();
 
echo "<div id=\"dump\">";
/*
echo "<pre>mycriteriaarray";
//var_dump($mycriteriaarray);
echo "</pre>";

echo "<pre>mycriteriastring";
//var_dump($mycriteriastring);
echo "</pre>";

echo "<pre>mathgocomment";
//var_dump($mathgocomment);
echo "</pre>";
*/

echo "</div>";
?>
