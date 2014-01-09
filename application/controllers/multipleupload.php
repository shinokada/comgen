<?php

class Multipleupload extends CI_Controller {

    private $title;
    private $version;
    private $appname;

    
    function __construct()
    {
            parent::__construct();
            $this->load->helper(array('form', 'url'));
            $this->load->helper('form');
            $this->lang->load('learningattitude', 'english');
            $this->load->helper('pullcomment');
            $this->config->load('comgen');
            $this->title=$this->config->item('fullappname');
            $this->appname=$this->config->item('appname');
    }
    
    
    function index()
    {
       // $data['error']="";
        $data['page']="multiple/multiupload_form";
        $data['title']=$this->title ." ".$this->appname;//$this->config->item('item name');
        $this->load->view('multiple/container', $data);
         
     }
    
   
 /*
 * multiple uploads
 * 
 */       
    function do_upload(){
        // Specify configuration for File 1
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'text/plain|text/csv|csv|text|text/x-csv';
        $config['max_size']	= '100000';
        $this->load->library('upload', $config);
        // Initialize config for File 1
        $this->upload->initialize($config);
        if($this->input->post('simplemode'))
        {
            $data['simplemode']=$this->input->post('simplemode');
        }
        if($this->input->post('showibgrade'))
        {
            $data['showibgrade']=$this->input->post('showibgrade');
        }
        if($this->input->post('lacomment'))
        {
            $data['lacomment']=$this->input->post('lacomment');
        }
        if($this->input->post('lagocomment'))
        {
            $data['lagocomment']=$this->input->post('lagocomment');
        }
        if($this->input->post('mathgocomment'))
        {
            $data['mathgocomment']=$this->input->post('mathgocomment');
        }
        // for mycomment do it in if (!empty($_FILES['userfile1']['name']))
        
        
        if ( ! $this->upload->do_upload('userfile'))
        {
            $data['error'] = $this->upload->display_errors()."<p>Upload Student Roster File</p>";
            //$error = array('error' => $this->upload->display_errors());
            $data['page']="multiple/multiupload_form";
            
            $data['title']=$this->title ." ".$this->appname;
            $this->load->view('multiple/container', $data);
        }
        elseif (!$this->input->post('showibgrade') AND ! $this->input->post('lacomment') AND ! $this->input->post('lagocomment')
                AND ! $this->input->post('mathgocomment') AND !$_FILES['userfile1']['name']) 
        {
            // not selecting any comment or own criteria file
            // you need to delete uploaded file even though it is an error due to not selecting comment
            $filedata = array('upload_data' => $this->upload->data('userfile'));
            $filename=$filedata['upload_data']['file_name'];
            $fullfilename=base_url()."uploads/".$filename;//need to be different name since $filename is 
            //used in $uploaddir
            $uploaddir=FCPATH."uploads/".$filename;
            unlink($uploaddir);
            
            $data['error'] = "<p>Please select one of comments or upload your own criteria.</p>";
            //$error = array('error' => $this->upload->display_errors());
            $data['page']="multiple/multiupload_form";
            
            $data['title']=$this->title ." ".$this->appname;
            $this->load->view('multiple/container', $data);
        } 
        else 
        {   
            $filedata = array('upload_data' => $this->upload->data('userfile'));
            $filename=$filedata['upload_data']['file_name'];
            $fullfilename=base_url()."uploads/".$filename;//need to be different name since $filename is 
            //used in $uploaddir
            $data['row1']=$this->viewstudent1($fullfilename);
            $data['mycriteria1']=$fullfilename;
            // delete file
            $uploaddir=FCPATH."uploads/".$filename;
            unlink($uploaddir);   
            // Do we have a second file?
            if (!empty($_FILES['userfile1']['name']))
            {
                $data['mycomment']=1;
                $data['filename']=$_FILES['userfile1']['name'];
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
                    $filedata = array('upload_data' => $this->upload->data('userfile1'));
                    $filename=$filedata['upload_data']['file_name'];
                    $fullfilename=base_url()."uploads/".$filename;//need to be different name since $filename is 
                    // delete file
                    $uploaddir=FCPATH."uploads/".$filename;
                    
                    $mycriteriaarray=$this->viewstudent1($fullfilename);
                    //$mycriteriaarray=$this->viewstudent1($fullfilename);
                    //$mycriteriaarray=$this->viewcsv($fullfilename);
                    //$mycriteriastring=$this->viewstudent($fullfilename);
                    //$data['viewcsv']=$this->viewcsv($fullfilename);
                    $data['mycriteriaarray']=$mycriteriaarray;
                    //$data['mycriteriastring']=$mycriteriastring;
                    //used in $uploaddir
                    //$data['mycriteria2']=$fullfilename;
                    unlink($uploaddir); 
                    
                    $data['numofrow']=count($mycriteriaarray);//find total number or array
                    //find out max column number
                    $maxColumns = max(array_map(function($row){
                    return count(explode('|', $row));
                    }, $mycriteriaarray));
                    $data['numofcol']=$maxColumns;  
                    //$data = $this->upload->data();
                }
                else
                {
                    $data['error'] = $this->upload->display_errors();
                    //$error = array('error' => $this->upload->display_errors());
                    $data['page']="multiple/multiupload_form";
                    
                    $data['title']=$this->title ." ".$this->appname;
                    $this->load->view('multiple/container', $data);
                }
            }// end of if (!empty($_FILES['userfile1']['name']))   
        
            $data['title']=$this->appname;
            $data['page']="multiple/upload_success";
            $this->load->view('multiple/container', $data);  
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
            while ( fgetcsv($handle, 1000, ",") !== FALSE) {
                // change CF, CR etc to \n. Mac and Win are different 
                $filestring=str_replace(array("\r\n", "\r"), "\n", file_get_contents($filename));// this will create string             
                
                $data=explode("\n", $filestring);//change to array from string
                $data=array_filter($data);
                return $data;
            }
            fclose($handle);
        } 

    }    
    
    
    function viewstudent1a($filename)
    {        
        if (($handle = fopen($filename, "r")) !== FALSE) {
            while (fgetcsv($handle, 1000, ',','"') !== FALSE) {
                // change CF, CR etc to \n. Mac and Win are different 
                $filestring=str_replace(array("\r\n", "\r"), "\n", file_get_contents($filename));             
$data=$filestring;                
//$data=explode("\n", $filestring);//change to array from string
                //$data= fgetcsv($handle, 1000, ',','"');
                return $data;
            }
            fclose($handle);
        } 

    } 
    
    /*

     * @param   string
     * @return  string
     */
    function viewstudent($filename)
    {        
        if (($handle = fopen($filename, "r")) !== FALSE) {
            while ( fgetcsv($handle, 1000, "\n") !== FALSE) {
                // change CF, CR etc to \n. Mac and Win are different 
                $filestring=str_replace(array("\r\n", "\r"), "\n", file_get_contents($filename));
                $data= $filestring;              
// $data=explode("\n", $filestring);//change to array from string
                return $data;
            }
            fclose($handle);
        } 

    }
    
    /*
     * This will show an array 
     */
        
    
    function viewcsv($filename)
    {        
        if (($handle = fopen($filename, "r")) !== FALSE) {
            //while ( fgetcsv($handle, 1000, ",") !== FALSE) {             
                $data=fgetcsv(
                        $handle,//input line 
                        1000, // length
                        '|', //delimiter
                        '"'//enclosure
                        );
                return $data;
            //}
            fclose($handle);
        } 

    }    
    

    
    function test(){
        $data['title']="Test";
        $data['page']="multiple/test";
        $this->load->view('multiple/container', $data);  
    }
    
    
    function create(){
        //col$rowname."_".$key, start from col1_2, 2_2, 3_2, 4_2
        // name="col3_2"
        //if ($this->input->post('keynum')){
        
        if ($this->input->post('showibgrade')==="1" OR $this->input->post('lacomment')==="1" OR $this->input->post('lagocomment')==="1" 
                OR $this->input->post('mathgocomment')==="1" OR $this->input->post('mycomment')==="1"){
            // pull total number from hidden form name keynum
            
            
            $keynum=$this->input->post('keynum');
            $data['keynum']=$keynum;
            
            $arrayname1=fields1($keynum);
            $data['arrayname1']=$arrayname1;
            $output=$arrayname1;
            
            $data['output']=$output;
            //$this->load->view('output',$data);
            $data['page']="multiple/output";
            
            $data['title']=$this->appname;
            $this->load->view('multiple/container', $data);
        }else{
            //$error = array('error' => $this->upload->display_errors());
            //$this->load->view('upload_form', $error);
            $data['error'] = "Something went wrong. Try it again or contact Shin.";
            $data['page']="multiple/multiupload_form";
            
            $data['title']=$this->title ." ".$this->appname;
            $this->load->view('multiple/container', $data);
        }
    }
    
    
    function howto(){
        $data['page']="multiple/howto";
        
        $data['title']="How to use ".$this->title;
        $this->load->view('multiple/container', $data);  
    }
    
    
    function about(){
        $data['page']="multiple/about";
        $data['title']="About ".$this->appname;
        $this->load->view('multiple/container', $data);  
    }
    
    function version(){
        $data['page']="multiple/version";
        $data['title']=$this->appname." Archived Versions";
        $this->load->view('multiple/container', $data);  
    }
    
    function share(){
        $data['page']="multiple/share";
        $data['title']="Share Your Comment File ";
        $this->load->view('multiple/container', $data);  
    }
    
}