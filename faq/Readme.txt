/****************************************************************
* ODFaq v1.21b
* FAQ Maintenance Scripts
*****************************************************************
* By Rini Setiadarma
* E-mail : rini@oodie.com
* URL    : http://www.oodie.com
*
* Copyright Notice:
* Copyright (c) 2000 by Rini Setiadarma. All Rights Reserved.
*
* You may use and modify these scripts for you own use so long
* as you keep the whole copyright information intact. You
* may distribute this script but you may not receive money/other
* kind of payment from it. By using these scripts you agree to
* indemnify Rini Setiadarma from any liability that might arise
* from its use.
****************************************************************/

Please remember these before you use my scripts :
1. Please do not delete the copyright information
2. Don't sell these scripts in any way. I want them to be
   freeware
3. A link and credit to my site will be very appreciated
   if you use my ODFaq :-)
4. Please tell me if you make major modification to these
   scripts of if you find any bugs


=================
     NOTE
=================
To install ODFaq you need these files :
1. conf.inc.php
2. odfaq.inc.php
3. adminfaq.inc.php
4. adminfaq.php

And you need to have PHP3 or later installed in your server.

==================================
UPGRADING FROM ODFAQv1.0 and v1.1
==================================
If you previously used ODFaqv1.0 or v1.1, you need to
set conf.inc.php again. After that, upload all 4 files
and replace the old ones.

For upgrade history, please refer to ODFaq site :
  http://www.oodie.com/


If you are new to ODFaq, follow the installation instructions
below.

=============
INSTALLATION
=============
1. Open conf.inc.php in a text editor and change the following
   variables :
   a. $passwd
      This is the password to access admin functions. Change
      this variable to your choice of password. Default value
      is 'Admin'
      Ex. : $passwd = "MyPassword";

   b. $odfaq_dir
      This is the absolute path to directory where you will put
      conf.inc.php, odfaq.inc.php, adminfaq.inc.php, and
      adminfaq.php
      For example if I put all four files to '/home/www/username/odfaq/'
      then fill the variable value like this :
      $odfaq_dir = "/home/www/username/odfaq/";
      DON'T FORGET TO INCLUDE THE TRAILING SLASH (/)!

   c. $data_dir
      This is the relative path to the directory where you want to put
      all your FAQs data. This directory name will be appended
      after $odfaq_dir. If you want to put all the data in 'data/'
      directory, then fill the variable like this :
      $data_dir = "data/";
      DON'T FORGET TO INCLUDE THE TRAILING SLASH (/)!
      (This means that the absolute path to your data directory is
       '/home/www/username/odfaq/data/')

   d. $category_file
      This is the name of the file that will contain a list of all
      categories you have in your FAQs.
      Ex. : $category_file = "mycategories.dat";

   ----------------------------------------------------------------
   OK, the following variables will control you FAQs appeareance
   on your page. You might want to change it to match you page
   color & layout

   e. $usehtml
      If you set $usehtml to 1, all HTML tags (e.g. <BR>, <FONT>, <A>, etc)
      will be parsed.
      Setting this variable to 0 means that all '<', '>', and
      '&'  will be translated to '&lt;', '&gt;', and '&amp;'
      respectively
      Ex. : $usehtml = 1;

   f. $fface
      Change this variable to font names that you want to use to
      display your FAQs.
      Ex. : $fface = "Arial,Verdana,Helvetica,sans-serif";

   g. $fsize
      Change this variable to font size that you want to use to
      display your FAQs
      Ex. : $fsize = "2";

   h. $tbl_bg
      This variable will be used as background color for table cell
      for titles.
      Ex. : $tbl_bg = "#006699";

   i. $tbl_width
      Change this variable to the width of the table for your FAQs
      Ex. : $tbl_width = "500";

   j. $fcolor
      Change this variable to font color that you want to use for
      _titles_. For example if you set $tbl_bg="#000000" (black)
      you might want to set this variable to be white :
      $fcolor = "#ffffff";

2. Create a directory to put all four files. Just like the examples
   above, I assume your home directory to be '/home/www/username/'.
   In that case, create a directory named 'odfaq'

3. Upload all four files to 'odfaq' directory. Do not change any of
   the file names.

4. Create a new directory under 'odfaq' directory and name it according
   to what you have in $data_dir variable (in the example 'data/'). This
   directory should be readable & writeable, so chmod 'data/' directory
   to 777 (-rwxrwxrwx)

5. Now you should have :
   Directory : /home/www/username/odfaq
                         |
                         |-- conf.inc.php
                         |
                         |-- odfaq.inc.php
                         |
                         |-- adminfaq.inc.php
                         |
                         |-- adminfaq.php
                         |
                         |-- data/    ---> chmod 777

6. You're all done :-)
   Now call adminfaq.php file using your browser
   (ex. http://www.yourdomain.com/odfaq/adminfaq.php). You should
   see ODFaq Admin main page and a form to add category.

7. Good luck!

=================
HOW TO USE ODFAQ
=================
OK, I assume you already have at least 1 category with at least 1 entry
inside that category. For example's sake, let's say you have 2 categories
'General Questions' and 'Technical Questions' and  you have 3 sets of
question & answer in each cateogory. Now you want to put these FAQs on your page.

1. There are 2 functions to display questions and answer :
   a. InsertFaq("category_name");
      Calling this function will insert Q&As only for the category
      you put as input to this function. For example if you call
      InsertFaq("General Questions");
      you will have :

         -----------------------------------------------------
         General Questions
         -----------------------------------------------------
         Questions
       1. Question 1
       2. Question 2
       3. Question 3

         Answers
       1. Question 1
          Answer 1
       2. Question 2
          Answer 2
       3. Question 3
          Answer 3

      This way, you can have separate page for each category

   b. InsertAll();
      Calling this function will insert Q&As for all categories
      you have. For example if you call
      InsertAll();
      you will have :

         -----------------------------------------------------
         Questions
         -----------------------------------------------------
         General Questions
       1. Question 1
       2. Question 2
       3. Question 3

         Technical Questions
       1. Question 1
       2. Question 2
       3. Question 3

         -----------------------------------------------------
         Answers
         -----------------------------------------------------
         General Questions
       1. Question 1
          Answer 1
       2. Question 2
          Answer 2
       3. Question 3
          Answer 3

         Technical Questions
       1. Question 1
          Answer 1
       2. Question 2
          Answer 2
       3. Question 3
          Answer 3

2. You have to require 'odfaq.inc.php' and 'conf.inc.php' to be able
   to call those 2 functions

3. To call the functions, open your page in a text editor. Make sure you
   have .php extension for this file. Insert the following lines :

   <? require ("path/to/conf.inc.php");
      require ("path/to/odfaq.inc.php");
      InsertFaq("my_category");
   ?>

   OR

   <? require ("path/to/conf.inc.php");
      require ("path/to/odfaq.inc.php");
      InsertAll();
   ?>

   - Change 'path/to/odfaq.inc.php' to path to odfaq.inc.php
     You can use relative or absolute path here. But you have to
     remember that require() uses file system path, not web server
     path. That means require("/path/to/conf.inc.php") will
     look for conf.inc.php in /path/to/ directory and
     not in http://www.yourdomain.com/path/to/conf.inc.php
     If you are not sure, use relative path.

   - Change 'path/to/conf.inc.php' to path to conf.inc.php
     Same as above :-)

   - Change 'my_category' to category name that you want to insert
   