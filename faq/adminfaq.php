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

/*** requires ***/
require "conf.inc.php";
require "adminfaq.inc.php";
?>

<HTML>
<HEAD>
<TITLE>ODFaq Admin</TITLE>
<STYLE type=text/css>
<!--
BODY,TD { font-family : arial,helvetica,sans-serif;
          font-size   : 10pt;
        }
-->
</STYLE>
</HEAD>

<BODY bgcolor="#ffffff" text="#000000">
<CENTER>
<TABLE border=0 cellspacing=0 cellpadding=5>
<TR><TD align=center>
    <FONT size=+1><B>ODFaq Admin</B></FONT><BR>
    [ <A href="<? echo $PHP_SELF; ?>" alt="ODFaq Admin">Main</A> ]
    [ <A href="<? echo $PHP_SELF; ?>" alt="Refresh">Refresh</A> ]
    </TD>
</TR>
</TABLE>
<BR><BR>

<?
switch($action) {
       case "add_section" :
            $new_section = trim($new_section);
            if(AddSection($new_section,$mypass)) {
               PrintMsg("Category <B>'$new_section'</B> has been added");
            }
            clearstatcache();
            if(filesize($cat_file) != 0) {
               frmListSection();
               echo "<BR>\n";
            }
            frmAddSection();
            if(filesize($cat_file) != 0) {
               echo "<BR>\n";
               frmRenSection();
               echo "<BR>\n";
               frmDelSection($fp);
               echo "<BR>\n";
            }
            break;

       case "edit_section" :
            clearstatcache();
            if(filesize($datadir.$cat) != 0) {
               frmListEntry($cat);
               echo "<BR>\n";
            }
            frmAddEntry($cat);
            break;

       case "del_section" :
            if(DelSection($section_name,$mypass)) {
               PrintMsg("Category <B>'$section_name'</B> has been deleted");
            }
            clearstatcache();
            if(filesize($cat_file) != 0) {
               frmListSection();
               echo "<BR>\n";
            }
            frmAddSection();
            echo "<BR>\n";
            if(filesize($cat_file) != 0) {
               frmRenSection();
               echo "<BR>\n";
               frmDelSection($fp);
               echo "<BR>\n";
            }
            break;

       case "ren_section" :
            $new_section = trim($new_section);
            if(RenSection($old_section,$new_section,$mypass)) {
               PrintMsg("<B>'$old_section'</B> has been renamed to <B>'$new_section'</B>");
            }
            frmListSection();
            echo "<BR>\n";
            frmAddSection();
            echo "<BR>\n";
            frmRenSection();
            echo "<BR>\n";
            frmDelSection($fp);
            echo "<BR>\n";
            break;

       case "add_entry" :
            AddEntry($question,$answer,$section_name,$mypass);
            clearstatcache();
            if(filesize($datadir.$section_name) != 0) {
               frmListEntry($section_name);
               echo "<BR>\n";
            }
            frmAddEntry($section_name);
            echo "<BR>\n";
            break;

       case "mod_entry" :
            if(count($entry_name) == 0)
               PrintMsg("<B>Move error : Please select at least 1 entry to move/delete</B>");
            elseif(eregi("Delete",$sub_action)) {
               if(DelEntry($section_name,$entry_name,$mypass)) {
                  if (count($entry_name) == 1)
                      $text = "1 entry deleted";
                  else
                      $text = count($entry_name) . " entries deleted";
                  PrintMsg($text);
               }
            }
            elseif(eregi("move",$sub_action)) {
               if(MovEntry($section_name,$move_to,$entry_name,$mypass)) {
                  if (count($entry_name) == 1)
                      $text = "1 entry moved to <B>'$move_to'</B>";
                  else
                      $text = count($entry_name) . " entries moved to <B>'$move_to'</B>";
                  PrintMsg($text);
               }
            }
            clearstatcache();
            if(filesize($datadir.$section_name) != 0) {
               frmListEntry($section_name);
               echo "<BR>\n";
            }
            frmAddEntry($section_name);
            echo "<BR>\n";
            break;

       case "frm_editentry" :
            frmEditEntry($cat,$which);
            break;

       case "edit_entry" :
            clearstatcache();
            if(eregi("Edit",$sub_action)) {
               if(!EditEntry($section_name,$which,$question,$answer,$mypass)) {
                  frmEditEntry($section_name,$which);
               }
               else {
                  if(filesize($datadir.$section_name) != 0) {
                     frmListEntry($section_name);
                     echo "<BR>\n";
                  }
                  frmAddEntry($section_name);
                  echo "<BR>\n";
               }
            }
            else {
               if(filesize($datadir.$section_name) != 0) {
                  frmListEntry($section_name);
                  echo "<BR>\n";
               }
               frmAddEntry($section_name);
               echo "<BR>\n";
            }
            break;

       default :
            clearstatcache();
            if(!file_exists($cat_file)) {
               $fp = fopen($cat_file,"w") or die("Unable to create <B>'$cat_file'</B> file");
               fclose($fp);
            }
            if(filesize($cat_file) != 0) {
               frmListSection();
               echo "<BR>\n";
            }
            else PrintMsg("Currently you have 0 category");
            frmAddSection();
            clearstatcache();
            if(filesize($cat_file) != 0) {
               $fp = file($cat_file) or die("Unable to open \"$cat_file\"");
               if(count($fp) != 0) {
                  echo "<BR>\n";
                  frmRenSection();
                  echo "<BR>\n";
                  frmDelSection($fp);
                  echo "<BR>\n";
               }
            }
            break;
} /* end of switch */
?>

<HR width=520>
Powered by ODFaq <? echo $version; ?><BR>
Copyright &copy;2000 by <A href="mailto:support@oodie.com">Rini Setiadarma</A>
</CENTER>
</BODY>
</HTML>