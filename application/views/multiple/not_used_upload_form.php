<div id="newfirstpage">
    <h1><?php echo $title ?></h1>
      

<?php echo form_open_multipart('uploadfiles/do_upload');?>

<?php
    // for IB general grade descriptors
    $data = array(
    'name'        => 'gradedesc',
    'id'          => 'gradedesc',
    'value'       => TRUE,
    'checked'     => FALSE,
    'style'       => 'margin:10px',
    );

echo form_checkbox($data);
echo "IB General Grade Comments<br />\n";
        
        
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
        
        ?>
        
        <input type="file" name="userfile" size="50" class="input" />

        <br /><br />

        <input type="submit" value="upload" class="css3button"/>

        </form>
    </div>
        
 

<?php
$this->load->view("./howto.php");

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

