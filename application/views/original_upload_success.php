
<h3>Your file was successfully uploaded!</h3>
<!--
<ul>
<?php foreach ($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; ?>
</ul>
-->
<h1><?php echo $title ?></h1>
<h2 id="lav">Learning Attitudes Criteria v7.7</h2>
<?php

echo form_open('upload/create');
//number of row
//echo count($row);
$keynum=count($row1);
echo form_hidden('keynum', $keynum);// use this as a counter

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
        }  elseif($list[2]=="F") {
            $namecolor="girl";
        }
        
    echo form_hidden('gender_'.$key, $list[2]);// hidden form for gender
    print_r ("<h2 class='".$namecolor."'>".$list[1]." ".$list[0]."</h2>\n");// this display first name
    echo form_hidden("studentname_".$key, $list[1]);//
    // Collaboration
    echo "<h3>".$this->lang->line("col")."</h3>";
    echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=90% style='font-size:10pt'>\n";
    echo "<tr><th width=\"20%\"><h3>Poor</h3></th><th width=\"20%\"><h3>Basic</h3></th><th width=\"20%\"><h3>Proficient</h3></th><th width=\"20%\"><h3>Advanced</h3></th><th width=\"20%\"><h3>None</h3></th></tr>\n";
    //echo "<tr>";
    for ($r=1; $r<5; $r++){//$r stands for row number. Collaboration needs 4 columns.
        echo "<tr>";
        for ($c=1; $c < 6; $c++) {// 5th column for none to unselect other 
            //Display all comments from language file
            $rowname="col".$r;
            $colstr="col".$r.$c;
            echo "<td valign=\"top\">";
            $contone=$this->lang->line($colstr);
            $conttwo=substr($contone, 3);//skip "%s "
            $contthree = ucfirst($conttwo);
            echo "<div class=\"comment\">$contthree</div>";
            $radio = array(
                'name'=>$rowname."_".$key,
                'value'=>$colstr,
                );
            echo "<br /><span class=\"center\">". form_radio($radio)."</span>";
            echo "</td>\n";
        }
        echo "</tr>\n";
    }
    echo "</table>";
    
    // Independence and initiative
    echo "<h3>".$this->lang->line("ind")."</h3>";
    echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=90% style='font-size:10pt'>\n";
    echo "<tr><th width=\"20%\"><h3>Poor</h3></th><th width=\"20%\"><h3>Basic</h3></th><th width=\"20%\"><h3>Proficient</h3></th><th width=\"20%\"><h3>Advanced</h3></th><th width=\"20%\"><h3>None</h3></th></tr>\n";
    for ($r=1; $r<5; $r++){//$r stands for row number. Independence needs 4 rows.
        echo "<tr>";
        for ($c=1; $c < 6; $c++) {
            $rowname="ind".$r;
            $colstr="ind".$r.$c;
            echo "<td valign=\"top\">";
            $contone=$this->lang->line($colstr);
            $conttwo=substr($contone, 3);//skip "%s "
            $contthree = ucfirst($conttwo);
            echo "<div class=\"comment\">$contthree</div>";
            //echo $this->lang->line($colstr);
            $radio = array(
                'name'=>$rowname."_".$key,
                'value'=>$colstr,
                );
            echo "<br /><span class=\"center\">". form_radio($radio)."</span>";
            echo "</td>\n";
        }
        echo "</tr>\n";
    }
    echo "</table>";
    
    
    // Organizational
    echo "<h3>".$this->lang->line("org")."</h3>";
    echo "<table border=1 bordercolor=black cellspacing=0 cellpadding=5 width=90% style='font-size:10pt'>\n";
    echo "<tr><th width=\"20%\"><h3>Poor</h3></th><th width=\"20%\"><h3>Basic</h3></th><th width=\"20%\"><h3>Proficient</h3></th><th width=\"20%\"><h3>Advanced</h3></th><th width=\"20%\"><h3>None</h3></th></tr>\n";
    for ($r=1; $r<4; $r++){//$r stands for row number Organizational needs only 3 rows
        echo "<tr>";
        for ($c=1; $c < 6; $c++) {// need 4 columns
            $rowname="org".$r;
            $colstr="org".$r.$c;
            echo "<td valign=\"top\">";
            $contone=$this->lang->line($colstr);
            $conttwo=substr($contone, 3);//skip "%s "
            $contthree = ucfirst($conttwo);
            echo "<div class=\"comment\">$contthree</div>";
            //echo $this->lang->line($colstr);
            $radio = array(
                'name'=>$rowname."_".$key,
                'value'=>$colstr,
                );
            echo "<br /><span class=\"center\">". form_radio($radio)."</span>";
            echo "</td>\n";
        }
        echo "</tr>\n";
    }
    echo "</table>";
    }// end of if(!empty($list[0]))
   /*
    else{
            $data['error'] ="Something wrong with your life, ooops file, I meant.";
            $this->load->view('container', $data);
        }
      */  
    }// end of if($key>1)
}// end of foreach($row1 as $key=>$value )
echo form_submit('submit', 'Submit', 'class="css3button"');
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
