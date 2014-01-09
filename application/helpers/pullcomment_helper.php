<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    function pullcomment($colname){

        return "hi".$colname;
    }


    /*
     * @return string
     */

    function fields($keynum){
         $colname = '';
        for ($r=2; $r<$keynum; $r++){
            for($c=1; $c<5; $c++){
                $colname .= "col".$c."_".$r." ";
            }
        }
        return  $colname;
    }
    
    
        
    /*
     * @return array
     */
    function fields1($keynum){
        $colname = array();
        for ($r=2; $r<$keynum; $r++){
            for($c=1; $c<5; $c++){
                $colname[] = "col".$c."_".$r;
            }
        }
        return  $colname;

    }