<html>
<head>
<title>Upload Form</title>
<link rel='stylesheet' type='text/css' href="<?php echo base_url()."css/learning.css";?>" />
</head>
<body>
    <div id="wrap">
        <div id="lg_firstpage">
    <h1>Learning Goal Comment Generator</h1>
<?php echo $error;?>

<?php echo form_open_multipart('learninggoal/do_upload');?>

<input type="file" name="userfile" size="60" class="input" />

<br /><br />

<input type="submit" value="upload" class="button" />

</form>
</div>
</div>
</body>
</html>

<?php

echo $this->lang->line('colpo1');
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

