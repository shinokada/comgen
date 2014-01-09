<?php

class Upload extends CI_Controller {

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
        $data['error']="";
        $data['page']="upload_form";
        $data['title']="Learning Attitudes Comment Generator";
        $data['title2']="Learning Goals Comment Generator";
        $this->load->view('container', $data);
    }

    function do_upload()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'text/plain|text/csv|csv|text|jpg|png|text/x-csv';
        $config['max_size']	= '100000';
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            $data['error'] = $this->upload->display_errors();
            $data['page']="upload_form";
            $data['title']="Learning Attitudes Comment Generator";
            $data['title2']="Learning Goals Comment Generator";
            $this->load->view('container', $data);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $filename=$data['upload_data']['file_name'];
            $fullfilename=base_url()."uploads/".$filename;
            $data['row1']=$this->viewstudent1($fullfilename);
            $data['title']="Learning Attitudes Comment Generator";
            // delete file
            $uploaddir=FCPATH."uploads/".$filename;
            unlink($uploaddir);
            $data['page']="upload_success";
            $this->load->view('container', $data);
        }
    }
    
    
    function do_upload_goal()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'text/plain|text/csv|csv|text|jpg|png|text/x-csv';
        $config['max_size']	= '100000';
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            $data['error'] = $this->upload->display_errors();
            //$error = array('error' => $this->upload->display_errors());
            $data['page']="upload_form";
            $data['title']="Learning Attitudes Comment Generator";
            $data['title2']="Learning Goals Comment Generator";
            $this->load->view('container', $data);
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
            $data['title']="Learning Goals Comment Generator";
            $data['page']="upload_success_learninggoal";
            $this->load->view('container', $data);
        }
    }

    
    

    /*
     * display as array of csv details
     */
    function viewstudent($filename)
    {
        if (($handle = fopen($filename, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, "\r")) !== FALSE) {
                return $data;
            }
            fclose($handle);
        } 

    }
    
    /*
     * @param	string
     * @return	array
     *  [0] => "Section:2(A) Math 6","","",""
        [1] => "Student Name","Gender"
        [2] => "Constantopoulos, Eli","M"
        [3] => "Hames, Caitlin","F"
     * ...
     */
    
    function viewstudent1($filename)
    {
        
        if (($handle = fopen($filename, "r")) !== FALSE) {
            while ( fgetcsv($handle, 1000, "\n") !== FALSE) {
                // change CF, CR etc to \n. Mac and Win are different 
                $filestring=str_replace(array("\r\n", "\r"), "\n", file_get_contents($filename));
                $data=explode("\n", $filestring);//change to array from string
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
     * @return string
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
     * @return array
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

    
   
    
    function create(){
        //col$rowname."_".$key, start from col1_2, 2_2, 3_2, 4_2
        // name="col3_2"
        if ($this->input->post('keynum')){
            // pull total number from hidden form name keynum
            $keynum=$this->input->post('keynum');
            $data['keynum']=$keynum;
            $arrayname1=$this->_fields1($keynum);
            $data['arrayname1']=$arrayname1;
            $output=$arrayname1;
            //$data['output']=$output;
            //$this->load->view('output',$data);
            $data['page']="output";
            $data['title']="Learning Attitudes Comment Generator";
            $this->load->view('container', $data);
        }else{
            //$error = array('error' => $this->upload->display_errors());
            //$this->load->view('upload_form', $error);
            $data['error'] = array('error' => $this->upload->display_errors());
            $data['page']="upload_form";
            $data['title']="Learning Attitudes Comment Generator";
            $data['title2']="Learning Goals Comment Generator";
            $this->load->view('container', $data);
        }
    }
    
    
       function create_goal(){
        if ($this->input->post('keynum')){
            // pull total number from hidden form name keynum
            $keynum=$this->input->post('keynum');
            $data['keynum']=$keynum;
            $arrayname1=$this->_fields1($keynum);
            $data['arrayname1']=$arrayname1;
            $output=$arrayname1;
            //$this->load->view('output',$data);
            $data['page']="output_learninggoal";
            $data['title']="Learning Goals Comment Generator";
            $this->load->view('container', $data);
        }else{
            $data['error'] = array('error' => $this->upload->display_errors());
            $data['page']="upload_form";
            $data['title']="Learning Attitudes Comment Generator";
            $data['title2']="Learning Goals Comment Generator";
            $this->load->view('container', $data);
        }


    }
}
?>
