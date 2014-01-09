<?php

class Uploadfiles extends CI_Controller {

    private $title;
    
    function __construct()
    {
            parent::__construct();
            $this->load->helper(array('form', 'url'));
            $this->load->helper('form');
            $this->lang->load('learningattitude', 'english');
            $this->load->helper('pullcomment');
            $this->title="Comment Generator v1.1";
            
    }

    function index()
    {
        $data['error']="";
        $data['page']="new/upload_form";
        $data['title']=$this->title;
        
        $this->load->view('new/container', $data);
    }

    function do_upload()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'text/plain|text/csv|csv|text|jpg|png|text/x-csv';
        $config['max_size']	= '100000';
        $this->load->library('upload', $config);
        if($this->input->post('lacomment')){
            $data['lacomment']=$this->input->post('lacomment');
        }
        if($this->input->post('lagocomment')){
            $data['lagocomment']=$this->input->post('lagocomment');
        }
        if($this->input->post('mathgocomment')){
            $data['mathgocomment']=$this->input->post('mathgocomment');
        }
        

        if ( ! $this->upload->do_upload())
        {
            $data['error'] = $this->upload->display_errors();
            //$error = array('error' => $this->upload->display_errors());
            $data['page']="new/upload_form";
            $data['title']=$this->title;
            $this->load->view('new/container', $data);
        }
        else
        {    
            $filedata = array('upload_data' => $this->upload->data());
            $filename=$filedata['upload_data']['file_name'];
            $fullfilename=base_url()."uploads/".$filename;//need to be different name since $filename is 
            //used in $uploaddir
            $data['row1']=$this->viewstudent1($fullfilename);
            // delete file
            $uploaddir=FCPATH."uploads/".$filename;
            unlink($uploaddir);
            $data['title']=$this->title;
            $data['page']="new/upload_success";
            $this->load->view('new/container', $data);
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


    
    function create(){
        //col$rowname."_".$key, start from col1_2, 2_2, 3_2, 4_2
        // name="col3_2"
        //if ($this->input->post('keynum')){
        
        if ($this->input->post('lacomment')==="1" OR $this->input->post('lagocomment')==="1" OR $this->input->post('mathgocomment')==="1"){
            // pull total number from hidden form name keynum
            $keynum=$this->input->post('keynum');
            $data['keynum']=$keynum;
            
            $arrayname1=$this->_fields1($keynum);
            $data['arrayname1']=$arrayname1;
            $output=$arrayname1;
            //$data['output']=$output;
            //$this->load->view('output',$data);
            $data['page']="new/output";
            $data['title']=$this->title;
            $this->load->view('new/container', $data);
        }else{
            //$error = array('error' => $this->upload->display_errors());
            //$this->load->view('upload_form', $error);
            $data['error'] = "Something went wrong. Try it again or contact Shin.";
            $data['page']="new/upload_form";
            $data['title']=$this->title;
            $this->load->view('new/container', $data);
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
 * multiple uploads
 * 
 */       
    function multiple_upload(){
         // Has the form been posted?
    if (isset($_POST['submit']))
    {
        if($this->input->post('lacomment')){
            $data['lacomment']=$this->input->post('lacomment');
        }
        if($this->input->post('lagocomment')){
            $data['lagocomment']=$this->input->post('lagocomment');
        }
        if($this->input->post('mathgocomment')){
            $data['mathgocomment']=$this->input->post('mathgocomment');
        }
        // Load the library - no config specified here
        $this->load->library('upload'); 
         
        if (!empty($_FILES['userfile']['name']))
        {
        // Specify configuration for File 1
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'text/plain|text/csv|csv|text|text/x-csv';
        $config['max_size']	= '100000';

        // Initialize config for File 1
        $this->upload->initialize($config);

        // Upload file 1
        if ($this->upload->do_upload('userfile'))
        {
            //$data['upload_data1'] = $this->upload->data();
            $filedata = array('upload_data' => $this->upload->data());
            $filename=$filedata['upload_data']['file_name'];
            $fullfilename=base_url()."uploads/".$filename;//need to be different name since $filename is 
            // delete file
            $uploaddir=FCPATH."uploads/".$filename;
            unlink($uploaddir);
            $data['row1']=$this->viewstudent1($fullfilename);
            //$data = $this->upload->data();
        }
        else
        {
            $data['error'] = $this->upload->display_errors();
            //$error = array('error' => $this->upload->display_errors());
            $data['page']="new/multiupload";
            $data['title']=$this->title;
            $this->load->view('new/container', $data);
        }

        }


       // Do we have a second file?
        if (!empty($_FILES['userfile1']['name']))
        {
        // Config for File 2 - can be completely different to file 1's config
        // or if you want to stick with config for file 1, do nothing!
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'text/plain|text/csv|csv|text|text/x-csv';
        $config['max_size']	= '100000';

        // Initialize the new config
        $this->upload->initialize($config);

        // Upload the second file
        if ($this->upload->do_upload('userfile1'))
        {
            //$data['upload_data2'] = $this->upload->data();
            $filedata = array('upload_data' => $this->upload->data());
            $filename=$filedata['upload_data']['file_name'];
            $fullfilename=base_url()."uploads/".$filename;//need to be different name since $filename is 
            // delete file
            $uploaddir=FCPATH."uploads/".$filename;
            unlink($uploaddir);            
            //used in $uploaddir
            $data['mycriteria']=$this->viewstudent1($fullfilename);
            //$data = $this->upload->data();
        }
        else
        {
            $data['error'] = $this->upload->display_errors();
            //$error = array('error' => $this->upload->display_errors());
            $data['page']="new/multiupload";
            $data['title']=$this->title;
            $this->load->view('new/container', $data);
        }

        }

        $data['title']=$this->title;
        $data['page']="new/upload_success";
        $this->load->view('new/container', $data);   
        
    }// end of if (isset($_POST['submit']))
    else
    {
        $data['error']="";
        $data['page']="new/multiupload";
        $data['title']=$this->title;
        $this->load->view('new/container', $data);
    }    
        
    }
    
    
   
    
    
    
    /*
     * Testing upload mulplefiles
     * 
     */
    
    
    function multiple(){
         // Has the form been posted?
    if (isset($_POST['submit']))
    {
        // Load the library - no config specified here
        $this->load->library('upload');
 
        // Check if there was a file uploaded - there are other ways to
        // check this such as checking the 'error' for the file - if error
        // is 0, you are good to code
        if (!empty($_FILES['userfile']['name']))
        {
            // Specify configuration for File 1
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '100';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';      
 
            // Initialize config for File 1
            $this->upload->initialize($config);
 
            // Upload file 1
            if ($this->upload->do_upload('userfile'))
            {
                $data['upload_data1'] = $this->upload->data();
                //$data = $this->upload->data();
            }
            else
            {
                echo $this->upload->display_errors();
            }
 
        }
 
        // Do we have a second file?
        if (!empty($_FILES['userfile1']['name']))
        {
            // Config for File 2 - can be completely different to file 1's config
            // or if you want to stick with config for file 1, do nothing!
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '100';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
 
            // Initialize the new config
            $this->upload->initialize($config);
 
            // Upload the second file
            if ($this->upload->do_upload('userfile1'))
            {
                $data['upload_data2'] = $this->upload->data();
                
                //$data = $this->upload->data();
            }
            else
            {
                echo $this->upload->display_errors();
            }
 
        }
        $this->load->view("new/multiple",$data);
        
    }
    else
    {
        $this->load->view("new/multiple");
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
