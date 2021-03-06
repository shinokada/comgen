<?php

class Learninggoal extends CI_Controller {

    function __construct()
    {
            parent::__construct();
            $this->load->helper(array('form', 'url'));
            $this->load->helper('form');
            $this->lang->load('learningattitude', 'english');
            $this->load->helper('pullcomment');
    }

    function index()
    {
            $this->load->view('upload_form_learninggoal', array('error' => ' ' ));
    }

    function do_upload()
    {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'text/plain|text/csv|csv|text|jpg|png|text/x-csv';
            $config['max_size']	= '100000';


            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload())
            {
                    $error = array('error' => $this->upload->display_errors());

                    $this->load->view('upload_form', $error);
            }
            else
            {
                    $data = array('upload_data' => $this->upload->data());
                    $filename=$data['upload_data']['file_name'];
                    $filename=base_url()."uploads/".$filename;
                    //$data['filedetails']=$this->viewlog($filename);
                    $data['row']=$this->viewstudent($filename);
                    
                    $data['row1']=$this->viewstudent1($filename);
                    //$row1=$this->viewstudent($row1);
                    //$data['row1']=$row1;
                    $this->load->view('upload_success_learninggoal', $data);
            }
    }

    /*
     * display as array of csv details
     */
    function viewstudent($filename)
    {
        if (($handle = fopen($filename, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, "\r")) !== FALSE) {
                //$student['classname']=$data[0];
                //$num = count($data);
                //$studentnum=$num-2;
                //$student['details']= "<p> There are $studentnum students in your class. <br /></p>\n";
                //$row++;
                /*
                for ($c=2; $c < $num; $c++) {
                    //$student['details'] .= "<tr><td>";
                    //$replaced = str_replace(",", "", $data[$c]);
                    //$student['details'] .= $replaced;
                    //$student['details'] .= "</td></tr>\n";
                    //echo $data[$c] . "<br />\n";
                }
                */
                return $data;
            }
            fclose($handle);
        } 

    }
    
    
    function viewstudent1($filename)
    {
        
        if (($handle = fopen($filename, "r")) !== FALSE) {
                        

            while ( fgetcsv($handle, 1000, "\n") !== FALSE) {
            
                $filestring=str_replace(array("\r\n", "\r"), "\n", file_get_contents($filename));
                $data=explode("\n", $filestring);
                return $data;
            }
            fclose($handle);
        } 

    }

    function viewlog($filename)
    {
        //$row = 1;
        if (($handle = fopen($filename, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, "\r")) !== FALSE) {
                $student['classname']=$data[0];
                $num = count($data);
                $studentnum=$num-2;
                $student['details']= "<p> There are $studentnum students in your class. <br /></p>\n";
                //$row++;
                for ($c=2; $c < $num; $c++) {
                    $student['details'] .= "<tr><td>";
                    $replaced = str_replace(",", "</td><td>", $data[$c]);
                    $student['details'] .= $replaced;
                    $student['details'] .= "</td></tr>\n";

                    //echo $data[$c] . "<br />\n";
                }
                return $student;
            }
            fclose($handle);
        } 
    }
    /*
     * return string
     */

    function _fields($keynum){
         $colname = '';
        for ($r=2; $r<$keynum; $r++){
            for($c=1; $c<5; $c++){
                $colname .= "col".$c."_".$r." ";
            }
        }
        return  $colname;
    }
    /*
     * return array
     */
    function _fields1($keynum){
        $colname = array();
        for ($r=2; $r<$keynum; $r++){
            for($c=1; $c<5; $c++){
                $colname[] = "col".$c."_".$r;
            }
        }
        return  $colname;

    }

    function _getcomment($comnum){
        
    }
    
   
    
    function create(){
        //col$rowname."_".$key, start from col1_2, 2_2, 3_2, 4_2
        // name="col3_2"
        if ($this->input->post('keynum')){
            // pull total number from hidden form name keynum
            $keynum=$this->input->post('keynum');
            $data['keynum']=$keynum;
            /*
            $arrayname=$this->_fields($keynum);
            $data['arrayname']=$arrayname;
            $output=explode(" ", $arrayname, -1);// by adding -1, it will eliminate one empty array
            $data['output']=$output;
            */
            
            $arrayname1=$this->_fields1($keynum);
            $data['arrayname1']=$arrayname1;
            $output=$arrayname1;
            
            
            
            
            /* you can't use foreach in controller*/
         
            
            //for ($r=1; $r<$keynum; $r++){
                //echo "hi".$r;
                 //$data['hi']="hi".$r;
                 //$data["output"]=$this->_fields();
                // $data=$this->input->post($colname);
                /*
                for($c=2; $c<5; $c++){
                $colname="col".$c."_";
                //$data=$this->input->post($colname);
                $data['colname']=$colname;
                }
                */
                
            //}
            
            
            //$data['keynum']=$keynum;
            /*
            for ($r=2; $r<$keynum; $r++){
                for($c=1; $c<5; $c++){
                    $colname="col".$c."_".$r;
                    //$data['col']=$colname;
                    echo $colname;
                    //echo $this->input->post($colname);
                    //return $data;
                }
            }
            */
            //$data['output']=$output;
            $this->load->view('output_learninggoal',$data);
            
        }else{
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('upload_form', $error);
        }


    }
}
?>
