<div id="footer">
    <ul>
        <li><?php echo anchor('multipleupload/version', 'Archived Version'); ?></li>
        <li><?php echo anchor('multipleupload/share', 'Share Your Comment File'); ?></li>
        <li><?php echo anchor('multipleupload/support', 'Support'); ?></li>
    </ul>
</div>

<div id="copyright">
    
    <?php
    echo "<p>ComGen version ".  $this->config->item('version');
    echo " Copyright: ".$this->config->item('copyright')." &copy; ". date("Y")."</p>";
    ?>
    
</div>
            <?php  ?>

