# Comgen 

## Create student roster csv file through PowerTeacher

Login to your PowerTeacher. Go to Reports and double click Student Roster. Make it sure that the following boxes are ticked. If you are not using PowerTeacher, here is how to make your own csv file.
- Output Type: Export(CSV)
- Sections: Selected Class
- Students: All Enrolled
- Student Info: Student Name
- Student Info: Gender
- Sort: Gradebook Preference

Click Run Report and save the file with an unique file name.
Come back to this website and upload your file. This will take you to the next page. Tick boxes and click submit at the bottom of the page. This will generate comments and all three grades for you. You just need to copy and paste them to the Powerschool.
Save your file by File > Save Page As in your browser.

## My Comment Area

If you tick the My Comment Area, it will add a text area for each student so that you can add your own comment.

## All In One

If you tick the All in One mode, it will put all your comments in one comments. Otherwise the Comgen will generate comments by categories.
Simple Mode

In normal mode Comgen adds student names and pronouns in a created comment, but simple mode outputs without these.

**Normal mode:** George works toward group ... He accepts personal responsibility ... He almost always meets ...

**Simple mode:** Works toward group ... Accepts personal responsibility ... Almost always meets ...

## How to make a student roster csv file for this comment generator

If you are not using Powerschool, use Microsoft Excel or Google Spreadsheet and create a file as you see in the following image.

Download Student Roster Sample CSV file.
[csv sample](http://comgen.canacad.ac.jp/sample/Samplecsvfile1.csv)
![sample image](http://comgen.canacad.ac.jp/images/excelsample.png)

The first line is the name of your course, and second line is the titles. You need these two lines. Then you start student names with a format of Lastname,Firstname. You need to save as a csv file.
        
            Section:6(A) Math 6,
            Student Name,Gender
            Bush, George,M
            Curie, Marie,F
            Gandhi, Indra,F
            Goodall, Jane,F
            Earhart, Amelia,F
            Pitt, Brad,M
            Obama, Barack,M
        
        
## How to make your comment/criteria csv to upload (from v1.2)

This allows you to create your own report comments and internal assessment comment as well.
If you want to use your own criteria to generate comments, you need to create a csv file. You can select only one criterion from each row, please position the same kind of comments in the same row. As you can see the length of the row does not need to be the same.

**Use | (pipe) to separate**

Please use | (called pipe) to separate your criteria.

**Write in one line for the same group**

If you want to display in a same row, then please write it in one line separated by | (pipe).

**Add | to skip a cell**

If you need to skip a cell, then use |. If you need to skip two cells, then use || without any space between a pipe '|'.
See more details in this sample. [Sample csv file](http://comgen.canacad.ac.jp/sample/StudentRostersample.csv).

**Add %s if you want to add pronoun**

If your comment has more than one sentence and would like to add pronoun such as 'He' or 'She', then please add %s instead of these pronouns. In normal mode these will change to proper pronouns.

**Starts With A Verb Or A Modal**

If you prefer a normal mode, the please start your comments with a verb or modal such as can, should or must.

**Don't use MS Word**

Use TextEdit if you are using a Mac. Save your file with ".csv". If you are using Windows, then use Notepad++ or KomodoEdit.

**Sample csv files**

Please open this file with TextEdit. This sample explains and demonstrates how to use pipes, |, in a csv file.
[Sample1 csv](http://comgen.canacad.ac.jp/sample/StudentRostersample.csv)
This file will create this table.
![sample csv]http://comgen.canacad.ac.jp/images/samplecsv1.png)

## Save your comments

After generating your comments, please save it by, File -> Save As, in your browser.

## Copy and Paste it to your Report

Copy and paste it your report and add more or change it if it's necessary.

## Q & A

### Do you keep uploaded files?
No. After uploading your file, this app delete the file. I don't want to fill up our server with files.

### Do you keep generated data in a database?
No. This does not use any database. So saving your generated comments is highly recommended.

### Where are these comments come from?
IB General Grade Comments are from MYP Coordinator’s handbook 2011–2012. Learning Attitude comments are made by CA admin and staff. Math comments are from IB MPY Mathematics handbook.

### What's will be in the next version?
Ajax function to see total number of characters without reloading a page.
Selection button to add Name and pronoun or plain comment from your criteria/comment.
Archived Version Share Your Comment File Support


ComGen version 1.2.1 Copyright: Shinichi Okada © 2014

