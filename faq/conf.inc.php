<?
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

/* Global Variables
   Please read README.txt for variables settings
*/
    $passwd    = "sisson1";                      /* password for admin area */
    $odfaq_dir = "/home/www/web70/web/faq/";            /* e.g. /home/www/username/odfaq/ */
    $data_dir  = "data/";
    $category_file = "categories.dat";         /* this file will contain list
                                                  of FAQ categories name */
    $usehtml   = 1;                            /* 1 = use HTML; 0 = don't use HTML */

    $fface     = "arial,helvetica,sans-serif"; /* font settings for displaying FAQ */
    $fsize     = "1";

    $tbl_bg    = "#006699";                    /* color of FAQ title background */
    $tbl_width = "500";                        /* width of FAQ table */
    $fcolor    = "#ffffff";                    /* font color for FAQ title */


    /****************************
     DO NOT CHANGE ANYTHING BELOW
     ****************************/
    $version = "";
    $datadir = $odfaq_dir . $data_dir;
    $cat_file = $datadir . $category_file;
?>