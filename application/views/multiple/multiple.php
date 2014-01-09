<?php echo form_open_multipart('uploadfiles/multiple');  ?>
<p>
    <?php echo form_label('File 1', 'userfile') ?>
    <?php echo form_upload('userfile') ?>
</p>
<p>
    <?php echo form_label('File 2', 'userfile1') ?>
    <?php echo form_upload('userfile1') ?>
</p>
<p><?php echo form_submit('submit', 'Upload them files!') ?></p>
<?php form_close() ?>

<?php
if(isset($upload_data1)){
    echo "<pre>data1: ";
    print_r ($upload_data1);
    echo "</pre>";
}
if(isset($upload_data2)){
    echo "<pre>data2: ";
    print_r ($upload_data2);
    echo "</pre>";
}

?>