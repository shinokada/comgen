<div id="header">
    <h1><?php echo $title ?></h1>
    <h2>Learning Attitudes Criteria v7.7</h2>
    <h3>Your file was successfully uploaded!</h3>  
</div>

<?php
/*
var_dump($lacomment);
var_dump($lagocomment);
var_dump($mathgocomment);
*/

echo form_open('uploadfiles/create',array('id' => 'comform'));
//number of row
//echo count($row);
$keynum=count($row1);
echo form_hidden('keynum', $keynum);// use this as a counter
if(isset($lacomment)){
    echo form_hidden('lacomment', $lacomment);
}
if(isset($lagocomment)){
    echo form_hidden('lagocomment', $lagocomment);
}
if(isset($mathgoalcomment)){
    echo form_hidden('mathgocomment', $mathgocomment);
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
        }  else {
            $namecolor="girl";
        }
        echo form_hidden('gender_'.$key, $list[2]);// hidden form for gender
        // js
        echo "<script type=\"text/javascript\">  
                floatingMenu.add('floatdiv".$key."',  
                    {   
                        targetTop: 100,  
                        prohibitXMovement: true,  
                        snap: true  
                    });  
                </script> ";
        
        echo "<div  class=\"box\"  style=\"position:relative;\">";  
        echo "<div id=\"floatdiv".$key."\" class=\"box\" style=\"position:absolute; margin-left: -23%; width:300px; height:40px\">";  
        print_r ("<h2 class='".$namecolor."'>".$list[1]." ".$list[0]."</h2>\n");// this display full name
        
        echo "</div>";
        
        echo form_hidden("studentname_".$key, $list[1]);//
        
        if(isset($lacomment) AND $lacomment==="1"){
            // Learning Attitude: Collaboration
            echo "<h3>".$this->lang->line("col")."</h3>";
            echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=100% style='font-size:10pt'>\n";
            echo "<tr><th width=\"20%\"><h3>Poor</h3></th><th width=\"20%\"><h3>Basic</h3></th><th width=\"20%\"><h3>Proficient</h3></th><th width=\"20%\"><h3>Advanced</h3></th><th width=\"20%\"><h3>None</h3></th></tr>\n";
            //echo "<tr>";
            for ($r=1; $r<5; $r++){//$r stands for row number. Collaboration needs 4 columns.
                echo "<tr>";
                for ($c=1; $c < 6; $c++) {// 5th column for none to unselect other 
                    //Display all comments from language file
                    $rowname="col".$r;//used for input name with key
                    $colstr="col".$r.$c;// used for input value
                    echo "<td valign=\"top\">";
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
                    echo "<div class=\"comment\">".form_radio($radio)."$contthree</div>";
                    /*
                    echo form_radio($radio);
                    echo "<div class=\"comment\">$contthree</div>";
                    */
                    echo "</td>\n";
                }
                echo "</tr>\n";
            }
            echo "</table>";

            // Learning Attitude: Independence and initiative
            echo "<h3>".$this->lang->line("ind")."</h3>";
            echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=100% style='font-size:10pt'>\n";
            echo "<tr><th width=\"20%\"><h3>Poor</h3></th><th width=\"20%\"><h3>Basic</h3></th><th width=\"20%\"><h3>Proficient</h3></th><th width=\"20%\"><h3>Advanced</h3></th><th width=\"20%\"><h3>None</h3></th></tr>\n";
            for ($r=1; $r<5; $r++){//$r stands for row number. Independence needs 4 rows.
                echo "<tr>";
                for ($c=1; $c < 6; $c++) {
                    $rowname="ind".$r;//used for input name with key
                    $colstr="ind".$r.$c;// used for input value
                    echo "<td valign=\"top\">";
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
                    echo "<div class=\"comment\">".form_radio($radio)."$contthree</div>";
                    /*
                    echo form_radio($radio);
                    
                    echo "<div class=\"comment\">$contthree</div>";
                    */
                    //echo $this->lang->line($colstr);
                    echo "</td>\n";
                }
                echo "</tr>\n";
            }
            echo "</table>";


            // Learning Attitude: Organizational
            echo "<h3>".$this->lang->line("org")."</h3>";
            echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=100% style='font-size:10pt'>\n";
            echo "<tr><th width=\"20%\"><h3>Poor</h3></th><th width=\"20%\"><h3>Basic</h3></th><th width=\"20%\"><h3>Proficient</h3></th><th width=\"20%\"><h3>Advanced</h3></th><th width=\"20%\"><h3>None</h3></th></tr>\n";
            for ($r=1; $r<4; $r++){//$r stands for row number Organizational needs only 3 rows
                echo "<tr>";
                for ($c=1; $c < 6; $c++) {// need 4 columns
                    $rowname="org".$r;//used for input name with key
                    $colstr="org".$r.$c;// used for input value
                    echo "<td valign=\"top\">";
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
                    echo "<div class=\"comment\">".form_radio($radio)."$contthree</div>";
                    /*
                    echo form_radio($radio);
                    
                    echo "<div class=\"comment\">$contthree</div>";
                    */
                    //echo $this->lang->line($colstr);
                    echo "</td>\n";
                }
                echo "</tr>\n";
            }
            echo "</table>";
        }//end of if($lacomment===TRUE){
        
        if(isset($lagocomment) AND $lagocomment==="1"){
            // Learning goals start
            // Learning Goal: Collaboration
            echo "<h3>".$this->lang->line("colgo")."</h3>";
            echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=100% style='font-size:10pt'>\n";
            //echo "<tr><th width=\"20%\"><h3>Poor</h3></th><th width=\"20%\"><h3>Basic</h3></th><th width=\"20%\"><h3>Proficient</h3></th><th width=\"20%\"><h3>Advanced</h3></th><th width=\"20%\"><h3>None</h3></th></tr>\n";
            //echo "<tr>";
            for ($r=1; $r<5; $r++){//$r stands for row number. Collaboration needs 4 columns.
                echo "<tr>";
                for ($c=1; $c < 4; $c++) {
                    $rowname="colgo".$r;//used for input name with key
                    $colstr="colgo".$r.$c;// used for input value
                    echo "<td width=\"50%\" valign=\"top\">";
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
            echo "</table>";

            // // Learning Goal: Independence and initiative
            echo "<h3>".$this->lang->line("indgo")."</h3>";
            echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=100% style='font-size:10pt'>\n";
            //echo "<tr><th width=\"20%\"><h3>Poor</h3></th><th width=\"20%\"><h3>Basic</h3></th><th width=\"20%\"><h3>Proficient</h3></th><th width=\"20%\"><h3>Advanced</h3></th><th width=\"20%\"><h3>None</h3></th></tr>\n";
            //echo "<tr>";
            for ($r=1; $r<5; $r++){//$r stands for row number. Independence needs 4 rows.
                echo "<tr>";
                for ($c=1; $c < 4; $c++) {
                    $rowname="indgo".$r;//used for input name with key
                    $colstr="indgo".$r.$c;// used for input value
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
            echo "</table>";


            // // Learning Goal: Organizational goals
                echo "<h3>".$this->lang->line("orggo")."</h3>";
            echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=100% style='font-size:10pt'>\n";
            //echo "<tr><th width=\"20%\"><h3>Poor</h3></th><th width=\"20%\"><h3>Basic</h3></th><th width=\"20%\"><h3>Proficient</h3></th><th width=\"20%\"><h3>Advanced</h3></th><th width=\"20%\"><h3>None</h3></th></tr>\n";
            //echo "<tr>";
            for ($r=1; $r<4; $r++){//$r stands for row number Organizational needs only 3 rows
                echo "<tr>";
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
            echo "</table>";
        // end of learning goals
        }// end of if($lagocomment===TRUE)
        
        
        if(isset($mathgocomment) AND $mathgocomment==="1"){
        // Math goals
        echo "<h3>".$this->lang->line("mathgo")."</h3>";
        echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=100% style='font-size:10pt'>\n";
        //echo "<tr><th width=\"20%\"><h3>Poor</h3></th><th width=\"20%\"><h3>Basic</h3></th><th width=\"20%\"><h3>Proficient</h3></th><th width=\"20%\"><h3>Advanced</h3></th><th width=\"20%\"><h3>None</h3></th></tr>\n";
        //echo "<tr>";
        for ($r=1; $r<5; $r++){//$r stands for row number Organizational needs only 3 rows
            echo "<tr>";
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
        echo "</table>";
        }// end of if($mathgocomment===TRUE){
        echo form_submit('submit', 'Submit', 'class="css3button"');
        echo "</div>";//end of class box
        }// end of if(!empty($list[0]))
    }// end of if($key>1)
}// end of foreach($row1 as $key=>$value )
//echo form_submit('submit', 'Submit', 'class="css3button"');
echo form_close();
 /*
echo "<pre>row1";
print_r($row1);
echo "</pre>";

echo "<pre>row";
print_r($row);
echo "</pre>";
*/
?>
