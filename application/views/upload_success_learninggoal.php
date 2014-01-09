
<h3>Your file was successfully uploaded!</h3>
<!--
<ul>
<?php foreach ($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; ?>
</ul>
-->
<h1><?php echo $title ?></h1>
<?php
//echo $filedetails['classname'];
// Start the table definition of your choice
//echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=100% style='font-size:10pt'>";
//echo "<tr><td><h3>Family Name</h3></td><td><h3>First Name</h3></td><td><h3>Gender</h3></td></tr>\n";
//echo $filedetails['details'];
//$num = count($row);
//$studentnum=$num-2;
//echo $studentnum;
//echo "<h1>Learning Goal Comment Generator</h1>";
echo form_open('upload/create_goal');
//number of row
//echo count($row);
$keynum=count($row1);
echo form_hidden('keynum', $keynum);// use this as a counter

foreach($row1 as $key=>$value ){
    //echo $key."<br />";
    if($key>1){// this will skip [0] => Section:2(A) Math 6,
    //[1] => Student Name,Gender
    $list = explode(",",$value);
    $list = str_replace(" ", "", $list);
    $list = str_replace("\"", "", $list);
    if(!empty($list[0])){
    //echo "Name: ".$list[1];^^H
    //echo "Genger: ".$list[2];
    
    //echo $key.$list;
    // array (familyname, firstname, gender)
    //echo "<pre>";
    if($list[2]=="M"){
        $namecolor="boy";
    }  else {
        $namecolor="girl";
    }
    echo form_hidden('gender_'.$key, $list[2]);// hidden form for gender
    print_r ("<h2 class='".$namecolor."'>".$list[1]." ".$list[0]."</h2>\n");// this display first name
    //echo "</pre>";
    //echo $this->lang->line('col');
    echo form_hidden("studentname_".$key, $list[1]);//
    // Collaboration
    echo "<h3>".$this->lang->line("col")."</h3>";
    echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=90% style='font-size:10pt'>\n";
    //echo "<tr><th width=\"20%\"><h3>Poor</h3></th><th width=\"20%\"><h3>Basic</h3></th><th width=\"20%\"><h3>Proficient</h3></th><th width=\"20%\"><h3>Advanced</h3></th><th width=\"20%\"><h3>None</h3></th></tr>\n";
    //echo "<tr>";
    for ($r=1; $r<5; $r++){//$r stands for row number. Collaboration needs 4 columns.
        echo "<tr>";
        for ($c=1; $c < 4; $c++) {
            $rowname="col".$r;
            $colstr="colgo".$r.$c;
            echo "<td width=\"50%\" valign=\"top\">";
            $contone=$this->lang->line($colstr);
            //$conttwo=substr($contone, 3);//skip "%s "
            $conttwo=str_replace("%s ", "", $contone);
            $contthree=preg_replace('/([.!?])\s*(\w)/e', "strtoupper('\\1 \\2')", ucfirst(strtolower($conttwo)));
            
            //$contthree = ucfirst($conttwo);
            echo "<div class=\"comment\">$contthree</div>";
            //echo $contthree;
            $radio = array(
                'name'=>$rowname."_".$key,
                'value'=>$colstr,
                );
            echo "<br /><span class=\"center\">". form_radio($radio)."</span>";
            
            //echo form_radio($radio);
            echo "</td>\n";
        }
        echo "</tr>\n";
    }
    
    
    //echo "</tr>\n";
    echo "</table>";
    
    // Independence and initiative
        echo "<h3>".$this->lang->line("ind")."</h3>";
    echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=90% style='font-size:10pt'>\n";
    //echo "<tr><th width=\"20%\"><h3>Poor</h3></th><th width=\"20%\"><h3>Basic</h3></th><th width=\"20%\"><h3>Proficient</h3></th><th width=\"20%\"><h3>Advanced</h3></th><th width=\"20%\"><h3>None</h3></th></tr>\n";
    //echo "<tr>";
    for ($r=1; $r<5; $r++){//$r stands for row number. Independence needs 4 rows.
        echo "<tr>";
        for ($c=1; $c < 4; $c++) {
            $rowname="ind".$r;
            $colstr="indgo".$r.$c;
            echo "<td width=\"50%\" valign=\"top\">";
            $contone=$this->lang->line($colstr);
            //$conttwo=substr($contone, 3);//skip "%s "
            $conttwo=str_replace("%s ", "", $contone);
            //$contthree = ucfirst($conttwo);
            $contthree=preg_replace('/([.!?])\s*(\w)/e', "strtoupper('\\1 \\2')", ucfirst(strtolower($conttwo)));
            
            echo "<div class=\"comment\">$contthree</div>";            
//echo $contthree;
            //echo $this->lang->line($colstr);
            $radio = array(
                'name'=>$rowname."_".$key,
                'value'=>$colstr,
                );
            echo "<br /><span class=\"center\">". form_radio($radio)."</span>";
            
            //echo form_radio($radio);
            echo "</td>\n";
        }
        echo "</tr>\n";
    }
    
    
    //echo "</tr>\n";
    echo "</table>";
    
    
    // Organizational
        echo "<h3>".$this->lang->line("org")."</h3>";
    echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=90% style='font-size:10pt'>\n";
    //echo "<tr><th width=\"20%\"><h3>Poor</h3></th><th width=\"20%\"><h3>Basic</h3></th><th width=\"20%\"><h3>Proficient</h3></th><th width=\"20%\"><h3>Advanced</h3></th><th width=\"20%\"><h3>None</h3></th></tr>\n";
    //echo "<tr>";
    for ($r=1; $r<4; $r++){//$r stands for row number Organizational needs only 3 rows
        echo "<tr>";
        for ($c=1; $c < 3; $c++) {// need 4 columns
            $rowname="org".$r;
            $colstr="orggo".$r.$c;
            echo "<td width=\"50%\" valign=\"top\">";
            $contone=$this->lang->line($colstr);
            //$conttwo=substr($contone, 3);//skip "%s "
            $conttwo=str_replace("%s ", "", $contone);
            //$contthree = ucfirst($conttwo);
            
            $contthree=preg_replace('/([.!?])\s*(\w)/e', "strtoupper('\\1 \\2')", ucfirst(strtolower($conttwo)));
            echo "<div class=\"comment\">$contthree</div>";
            //echo $contthree;
            //echo $this->lang->line($colstr);
            $radio = array(
                'name'=>$rowname."_".$key,
                'value'=>$colstr,
                );
            echo "<br /><span class=\"center\">". form_radio($radio)."</span>";
            
            //echo form_radio($radio);
            echo "</td>\n";
        }
        echo "</tr>\n";
    }
    
    
    //echo "</tr>\n";
    echo "</table>";
    }
    }// end of if($key>1)
    //echo $this->lang->line('colpo1');
    
}// end of foreach($row1 as $key=>$value )
echo form_submit('submit', 'Submit', 'class="css3button"');
echo form_close();
//echo $row[2];



/*
echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=100% style='font-size:10pt'>";
echo "<tr><td><h3>Family Name</h3></td><td><h3>First Name</h3></td><td><h3>Gender</h3></td></tr>\n";
echo $filedetails['details'];
echo $this->lang->line('colpo1');


echo "</table>";
//echo $upload_data['file_name'];
 * 
 
echo "<pre>row1";
print_r($row1);
echo "</pre>";
echo "<pre>row";
print_r($row);
echo "</pre>";
*/
?>


