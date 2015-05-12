<div id="multifirstpage">
    <h1><?php echo $title ?></h1>
<?php echo form_open_multipart('multipleupload/do_upload');?>

<?php
echo "<div class=\"layer1\">";
// header Type
echo "<p class=\"heading\">Type</p>";
echo "<div class=\"content\">";

    // all in one mode
    $data = array(
    'name'        => 'allinone',
    'id'          => 'allinone',
    'value'       => TRUE,
    'checked'     => FALSE,
    'style'       => 'margin:10px',
    );

echo form_checkbox($data);
echo "<p>".anchor('multipleupload/howto#allinone', 'All in One')."<br /></p>\n";


    // for simple mode
    $data = array(
    'name'        => 'simplemode',
    'id'          => 'simplemode',
    'value'       => TRUE,
    'checked'     => FALSE,
    'style'       => 'margin:10px',
    );

echo form_checkbox($data);
echo "<p>".anchor('multipleupload/howto#simplemode', 'Simple Mode')."<br /></p>\n";

    // for IB general grade descriptors
    $data = array(
    'name'        => 'showibgrade',
    'id'          => 'showibgrade',
    'value'       => TRUE,
    'checked'     => FALSE,
    'style'       => 'margin:10px',
    );

echo "</div>";// end of type

// start comment block
echo "<p class=\"heading\">Comments</p>";
echo "<div class=\"content\">";

echo form_checkbox($data);
echo "<p>IB General Grade Comments</p><br />\n";

        // for learning attitudes comment
        $data = array(
    'name'        => 'lacomment',
    'id'          => 'lacomment',
    'value'       => TRUE,
    'checked'     => FALSE,
    'style'       => 'margin:10px',
    );

echo form_checkbox($data);
echo "<p>Generate Learning Attitudes Comments</p><br />\n";

// Would produce:

//<input type="checkbox" name="newsletter" id="newsletter" value="accept" checked="checked" style="margin:10px" />
        
    // for learning goals comment
    $data = array(
    'name'        => 'lagocomment',
    'id'          => 'lagocomment',
    'value'       => TRUE,
    'checked'     => FALSE,
    'style'       => 'margin:10px',
    );

echo form_checkbox($data);
echo "<p>Generate Learning Goals Comment</p><br />\n";

    // for math learning goals comment
    $data = array(
    'name'        => 'mathgocomment',
    'id'          => 'mathgocomment',
    'value'       => TRUE,
    'checked'     => FALSE,
    'style'       => 'margin:10px',
    );

echo form_checkbox($data);
echo "<p>Generate Math Learning Goals Comment</p><br />\n";

// My comment text area
    $data = array(
    'name'        => 'mycommentarea',
    'id'          => 'mycommentarea',
    'value'       => TRUE,
    'checked'     => FALSE,
    'style'       => 'margin:10px',
    );

echo form_checkbox($data);
echo "<p>".anchor('multipleupload/howto#mycommentarea', 'My Comment Area')."<br /></p>\n";
echo "</div>";// end of Comment block


//Files
echo "<p class=\"heading\">Files</p>";
echo "<div class=\"content\">";
echo "<p class=\"files\">";// start student roster file
echo form_label('*Student Roster File', 'userfile');
$attribute=array(
    'id'=>'userfile1', 
    'size'=>'50',
    'name'=>'userfile'
    );
echo form_upload($attribute);
echo "</p><br />\n";
// end of student roster file
// label for student roster file
$attributes = array(
    'class' => 'mylabel',
    'style' => 'color: #333;',
);
echo "<div class=\"small\"><p>You must upload this file. Please read <u>";
echo anchor('multipleupload/howto', 'How to Use');
echo "</u> page for more details. <br />Try it with <u><a href=\"". base_url()."sample/StudentRostersample.csv\" target=\"_blank\">a sample csv file.</a></u>";
echo "</p></div>";
// start your criteria file
echo "<p class=\"files\">";
echo form_label('Your Criteria', 'userfile1', $attributes); 
$attribute=array(
    'id'=>'userfile2', 
    'size'=>'50',
    'name'=>'userfile1'
    );
echo form_upload($attribute); 
echo "</p><br />\n";    
echo "<div class=\"small\"><p>If you wish using your own criteria or comments, please upload it here. Read more <u>";
echo anchor('multipleupload/howto#comcsv', 'How to Use');
echo "</u><br />";
echo "Try it with <a href=\"". base_url()."sample/shinmathrubicon.csv\" target=\"_blank\"><u>a sample csv file.</u></a></p></div>";
echo "</div>";// end of Comment block
echo "</div>";// end of accordion


$submitbtn=array(
  'value'=>'Upload',
    'class'=>'css3button',
    
);
echo "<div id=\"submit\">";
echo form_submit($submitbtn);    
echo "</div>";
?> 
        </form>
    </div>
        
<?php
//$this->load->view("./howto.php");
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

