  

    <div id="firstpage">
        <h1><?php echo $title ?></h1>
      

        <?php echo form_open_multipart('upload/do_upload');?>

        <input type="file" name="userfile" size="50" class="input" />

        <br /><br />

        <input type="submit" value="upload" class="css3button"/>

        </form>
    </div>
        
    <div id="lg_firstpage">
    <h1><?php echo $title2 ?></h1>
   
    <?php echo form_open_multipart('upload/do_upload_goal');?>

    <input type="file" name="userfile" size="50" class="input" />

    <br /><br />

    <input type="submit" value="upload" class="css3button" />

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

