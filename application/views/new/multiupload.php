<div id="multifirstpage">
        <h1><?php echo $title ?></h1>
      

        <?php echo form_open_multipart('uploadfiles/multiple_upload');?>

        <?php
        // for learning attitudes comment
        $data = array(
    'name'        => 'lacomment',
    'id'          => 'lacomment',
    'value'       => TRUE,
    'checked'     => TRUE,
    'style'       => 'margin:10px',
    );

echo form_checkbox($data);
echo "Generate Learning Attitudes Comments<br />\n";

// Would produce:

//<input type="checkbox" name="newsletter" id="newsletter" value="accept" checked="checked" style="margin:10px" />
        
    // for learning goals comment
    $data = array(
    'name'        => 'lagocomment',
    'id'          => 'lagocomment',
    'value'       => TRUE,
    'checked'     => TRUE,
    'style'       => 'margin:10px',
    );

echo form_checkbox($data);
echo "Generate Learning Goals Comment<br />\n";

    // for math learning goals comment
    $data = array(
    'name'        => 'mathgocomment',
    'id'          => 'mathgocomment',
    'value'       => TRUE,
    'checked'     => FALSE,
    'style'       => 'margin:10px',
    );

echo form_checkbox($data);
echo "Generate Math Learning Goals Comment<br />\n";

echo "<p>";
echo form_label('Student Roster File', 'userfile');
$attribute=array(
    'id'=>'userfile1', 
    'size'=>'50',
    'name'=>'userfile'
    );
echo form_upload($attribute);
echo "</p><br />";
echo "<p>";
echo form_label('Your Criteria', 'userfile1'); 
$attribute=array(
    'id'=>'userfile2', 
    'size'=>'50',
    'name'=>'userfile1'
    );
echo form_upload($attribute); 
echo "</p><br />";    
    
$submitbtn=array(
  'value'=>'Upload',
    'class'=>'css3button',
    
);
echo form_submit($submitbtn);    
?> 
        


        </form>
    </div>
        
 
    <div id="intro">
        <h2>How To Use</h2>
        <p>Login to your Powerschool. Go to Reports and double click Student Roster.
        Make it sure that the following boxes are ticked.             </p>

        <ul>
            <li>Output Type: Export(CSV)</li>
            <li>Sections: Selected Class</li>
            <li>Students: All Enrolled</li>
            <li>Student Info: Student Name</li>
            <li>Student Info: Gender</li>
            <li>Sort: Gradebook Preference</li>
        </ul>
        <p>
            Click Run Report and save the file with an unique file name.
        </p>
        <p>
            Come back to this website and upload your file. This will take you to the next page.
            Tick boxes and click submit at the bottom of the page.
            This will generate comments and all three grades for you. You just need to copy and paste
            them to the Powerschool.<br />
            Save your file by File > Save Page As in your browser.
        </p> 


    </div>


<?php

//echo $this->lang->line('colpo1');
/*

echo base_url()."<br />\n";
echo site_url();
 
$num = 5;
$location = 'tree';

$format = 'There are %d monkeys in the %s';
printf($format, $num, $location);

$format = 'The %s contains %d monkeys';
printf($format, $num, $location);

$format = 'The %2$s contains %1$d monkeys';
printf($format, $num, $location);

$format = 'The %2$s contains %1$d monkeys.
           That\'s a nice %2$s full of %1$d monkeys.';
printf($format, $num, $location);
 * 
 */
?>

