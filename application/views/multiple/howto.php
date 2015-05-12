 <div id="howtocont">
        <h2>Create student roster csv file through PowerTeacher</h2>
        <p>Login to your PowerTeacher. Go to Reports and double click Student Roster.
        Make it sure that the following boxes are ticked. If you are not using PowerTeacher, 
        <a href="#owncsv">here is how to make your own csv file.</a></p>

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

        <h2><a name="mycommentarea">My Comment Area</a></h2>
        <p>
            If you tick the My Comment Area, it will add a text area for each student so that you 
            can add your own comment.
        </p>    

        <h2><a name="allinone">All In One</a></h2>
        <p>
            If you tick the All in One mode, it will put all your comments in one comments. Otherwise the Comgen will
            generate comments by categories.
        </p>    
        <h2><a name="simplemode">Simple Mode</a></h2>
        <p>
            In normal mode Comgen adds student names and pronouns in a created comment, but simple mode
            outputs without these.
        </p>
        <br />
        <p>
            <b>Normal mode:</b> George works toward group ... He accepts personal 
            responsibility ... He almost always meets ...
        </p>
         <br />
        <p>
            <b>Simple mode:</b>  Works toward group ... Accepts personal responsibility ... 
            Almost always meets ...
        </p>
        
        <h2><a name="owncsv">How to make a student roster csv file for this comment generator</a></h2>
        <p>If you are not using Powerschool, use Microsoft Excel or Google Spreadsheet and create a file as you see in the following image.</p><br />
        <p><a href="<?php echo base_url()."sample/StudentRostersample.csv";?>" target="_blank">Download Student Roster Sample CSV file.</a></p>
        <img src="<?php echo base_url(); ?>images/excelsample.png" alt="csv sample image"/>
        <p>The first line is the name of your course, and second line is the titles. 
            You need these two lines. Then you start student names with a format of 
            Lastname,Firstname. You need to save as a csv file.</p>
        <pre>
        <code>
            Section:6(A) Math 6,
            Student Name,Gender
            Bush, George,M
            Curie, Marie,F
            Gandhi, Indra,F
            Goodall, Jane,F
            Earhart, Amelia,F
            Pitt, Brad,M
            Obama, Barack,M
        </code>
        </pre>
        
        
        <h2><a name="comcsv">How to make your comment/criteria csv to upload (from v1.2)</a></h2>
        <p>This allows you to create your own report comments and internal assessment comment as well.<br />
        If you want to use your own criteria to generate comments, you need to create a csv file. You can select
        only one criterion from each row, please position the same kind of comments in the same row. As you can see 
        the length of the row does not need to be the same.</p>
        <br />
        
        <h4>Use | (pipe) to separate</h4>
        <p>Please use | (called pipe) to separate your criteria.  
        </p> 
        
        <h4>Write in one line for the same group</h4>
        <p>If you want to display in a same row, then please write it in one line separated by | (pipe).</p>
        
        <h4>Add | to skip a cell</h4>
        <p>If you need to skip a cell, then use |. If you need to skip two cells, then use || without any 
        space between a pipe '|'.</p>
        <p>See more details in this sample. <a href="<?php echo base_url() ;?>sample/Samplecsvfile1.csv" target="_blank">Sample csv file.</a></p>

        <h4>Add %s if you want to add pronoun</h4>         
        <p>If your comment has more than one sentence and would like to add pronoun such as 'He' or 'She', 
            then please add %s instead of these pronouns. In normal mode these will change to 
            proper pronouns.
        </p>
        
        <h4>Starts With A Verb Or A Modal</h4>        
        <p>
            If you prefer a normal mode, the please start your comments with a verb 
            or modal such as can, should or must.
        </p>
        
        <h4>Don't use MS Word</h4>
        <p>
            Use TextEdit if you are using a Mac. Save your file with ".csv". If you are 
        using Windows, then use Notepad++ or KomodoEdit.
        </p>
        
        <h4>Sample csv files</h4>
        <p> Please open this file with TextEdit. This sample explains and demonstrates how to use pipes, |, 
            in a csv file.<br />
        <a href="<?php echo base_url()."sample/Samplecsvfile1.csv";?>" target="_blank">
            Sample1 csv</a><br /></p>
          <p>  This file will create this table.</p>

            <img src="<?php echo base_url()."images/samplecsv1.png";?>" alt="sample csv"  /> 

       
        <h2>Save your comments</h2>
        <p>
            After generating your comments, please save it by, File -> Save As, in your browser.
        </p>
        <h2>Copy and Paste it to your Report</h2>
        <p>
            Copy and paste it your report and add more or change it if it's necessary.
        </p>

        <h2>Q & A</h2>
        <p><b>Do you keep uploaded files?</b></p>    
        <p>No. After uploading your file, this app delete the file. I don't want to fill up our server with
        files.</p>
        <br />
        <p><b>Do you keep generated data in a database?</b></p>
        <p>No. This does not use any database. So saving your generated comments is highly recommended.</p>
        <br />
        <p><b>Where are these comments come from?</b></p>
        <p>IB General Grade Comments are from MYP Coordinator’s handbook 2011–2012. Learning Attitude comments are made by CA admin and staff. Math comments are from IB
        MPY Mathematics handbook.</p>
        <br />
        <p><b>What's will be in the next version?</b></p> 
        <p>Ajax function to see total number of characters without reloading a page.</p>
        <p>Selection button to add Name and pronoun or plain comment from your criteria/comment.</p>
    </div>