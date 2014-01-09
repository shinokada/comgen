<html>
<head>
<title><?php echo $title ?></title>
<meta name="description" content="Comment generator for middle/highschool teachers." /> 
<meta name="keywords" content="comment generator, comments, grades, middleschool teacher, highschool teacher,
      IB, learning attitudes, learning goals, collaboration, Independence and initiative, organization " /> 
<meta name="google-site-verification" content="kAcY56DycpnI9GX2kdc2QVUp2K2pov6j9QrWGY_3Vic" />
<link rel='stylesheet' type='text/css' href="<?php echo base_url()."css/learning.css";?>" />
    <script type="text/javascript" src="<?php echo base_url()."js/floating-1.7.js";?>">  
    </script>  
    
</head>
<body>
    
    <div id="wrap">        
        <?php
        $this->load->view("multiple/menu.php");
   
            /*
            echo "<div id=\"oldmenu\">";
            echo anchor('upload', 'Older version'); 
            echo "</div>";
            */
            ?>
        
         
            <?php
            if(!empty ($error)){
                echo "<div id=\"error\">";
                echo $error;
                echo "</div>";
            }
        
    $this->load->view($page);
    $this->load->view("multiple/footer.php");
    
    ?>
    </div><!-- end of id="wrap" -->
 
    
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-28379982-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
    <?php
    /*
 echo   'Basepath: ' . BASEPATH . '<br />'
. 'Apppath: ' . APPPATH . '<br />'
. 'Ext: ' . EXT . '<br />' 
. 'Fcpath: ' . FCPATH .'<br />' 
. 'Self: ' . SELF .'<br />' .

 'site_url(): ' . site_url(). '<br />'.
 'current_url(): ' . current_url(). '<br />'.
 'uri_string(): ' . uri_string(). '<br />'.
 'index_page(): ' . index_page(). '<br />'.
 'realpath(__FILE__): ' . realpath(__FILE__). '<br />'.
 'realpath(dirname(__FILE__)): ' . realpath(dirname(__FILE__)). '<br />'.
 'realpath(dirname(__FILE__))/: '. realpath(dirname(__FILE__)).'/'.'<br />'.
 'str_replace("\\", "/", realpath(dirname(__FILE__))): '. str_replace("\\", "/", realpath(dirname(__FILE__))).'<br />'.
 'str_replace("/", "\\", BASEPATH): '. str_replace("/", "\\", BASEPATH).'<br />'.
 'getcwd(), current working directory: '. getcwd(). '<br />'.
 'PATH_SEPARATOR: ' . PATH_SEPARATOR. '<br />';
    
    */
    
    ?>
</body>
</html>    