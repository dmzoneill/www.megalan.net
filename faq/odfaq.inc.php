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

function InsertFaq($section) {
         global $cat_file,$datadir;
         global $tbl_bg,$tbl_width,$fface,$fsize,$fcolor;

         clearstatcache();
         if(!file_exists($datadir.$section)) {
            print "<TABLE border=0 cellspacing=0 cellpadding=5>\n";
            print "<TR>\n<TD width=$tbl_width align=left valign=top>\n";
            print "<FONT face=$fface size=$fsize>\n";
            print "There is no <B>'$section'</B> category</FONT>\n";
            print "</TD>\n</TR>\n</TABLE>";
         }
         elseif(filesize($datadir.$section) == 0) {
            print "<TABLE border=0 cellspacing=0 cellpadding=5>\n";
            print "<TR>\n<TD width=$tbl_width bgcolor=\"$tbl_bg\" align=left valign=top>\n";
            print "<FONT face=$fface size=". ($fsize+1) ." color=\"$fcolor\"><B>" . $section . "</B></FONT>\n";
            print "</TD>\n</TR>\n";
            print "<TR>\n<TD width=$tbl_width align=left valign=top>\n";
            print "<FONT face=$fface size=$fsize>\n";
            print "There are no questions in this category</FONT>\n";
            print "</TD>\n</TR>\n</TABLE>";
         }
         else {
            InsertFaq2($section);
         }
} /* end of InsertFaq */


function InsertFaq2($section) {
         global $cat_file,$datadir,$usehtml;
         global $tbl_bg,$tbl_width,$fface,$fsize,$fcolor;

         $sections = @file($cat_file) or die("Fail to open category file");
         for($i=0; $i<count($sections); $i++) {
             $junk = split("\|\|",$sections[$i]);
             if($junk[0] == $section) $faqnum = $junk[1];
         }

         $faqs = @file($datadir.$section) or die("Could not open \"$section\" category");
         $j=0;
         for($i=0; $i<$faqnum; $i++) {
             $junk = split("\|\|",$faqs[$i]);
             $question[$j] = $junk[0];
             $answer[$j] = $junk[1];

             if($usehtml == 1) {
                $question[$j] = str_replace("<od_break>"," ",$question[$j]);
                $question[$j] = stripslashes($question[$j]);
                $answer[$j] = str_replace("<od_break>"," ",$answer[$j]);
                $answer[$j] = stripslashes($answer[$j]);
             }
             else {
                $question[$j] = eregi_replace("\&","\&amp;",$question[$j]);
                $question[$j] = str_replace("<od_break>","od_break",$question[$j]);
                $question[$j] = str_replace("<","\&lt;",$question[$j]);
                $question[$j] = str_replace(">","\&gt;",$question[$j]);
                $question[$j] = str_replace("od_break","<BR>",$question[$j]);
                $question[$j] = stripslashes($question[$j]);

                $answer[$j] = eregi_replace("\&","\&amp;",$answer[$j]);
                $answer[$j] = str_replace("<od_break>","od_break",$answer[$j]);
                $answer[$j] = str_replace("<","\&lt;",$answer[$j]);
                $answer[$j] = str_replace(">","\&gt;",$answer[$j]);
                $answer[$j] = str_replace("od_break","<BR>",$answer[$j]);
                $answer[$j] = stripslashes($answer[$j]);
             }

             $j++;
         }

         print "<TABLE border=0 cellspacing=0 cellpadding=5>\n";
         $ref = "<A name=\"$section\">";
         print "<TR>\n<TD width=$tbl_width bgcolor=\"$tbl_bg\" align=left valign=top>\n";
         print "<FONT face=\"$fface\" size=" . ($fsize+1) ." color=\"$fcolor\"><B>" . $ref . $section . "</A></B></FONT>\n";
         print "</TR>\n</TD>\n";
         print "<TR>\n<TD width=$tbl_width align=left valign=top>\n";
         print "<FONT face=\"$fface\" size=$fsize>\n";
         print "<B>Questions</B>\n";
         print "<OL type=\"1\">\n";
         for($i=0; $i<$faqnum; $i++) {
             $link = "<A href=\"#" . $section ."_id" . $i . "\">";
             print "<LI>". $link. $question[$i]. "</A>\n";
         }
         print "</OL>\n</FONT>\n";
         print "</TD>\n</TR>\n";
         print "</TABLE>\n\n";

         print "<BR>\n";
         print "<TABLE border=0 cellspacing=0 cellpadding=0>\n";
         print "<TR>\n<TD width=$tbl_width align=left valign=top>\n";
         print "<HR width=$tbl_width>\n";
         print "</TD>\n</TR>\n</TABLE>\n\n";

         print "<TABLE border=0 cellspacing=0 cellpadding=5>\n";
         print "<TR>\n<TD width=$tbl_width align=left valign=top>\n";
         print "<FONT face=$fface size=$fsize><B>Answers</B></FONT>\n";
         print "</TD>\n</TR>\n";
         print "<TR>\n<TD width=$tbl_width align=left valign=top>\n";
         print "<FONT face=$fface>\n";
         print "<OL type=\"1\">\n";
         for($i=0; $i<$faqnum; $i++) {
             $toplink = "<A href=\"#$section\">";
             $link = "<A name=\"" . $section . "_id" . $i . "\">";
             print "<FONT size=$fsize><LI><B>" . $link . $question[$i] . "</A></B><BR>\n";
             print $answer[$i] . "<BR>\n";
             print "</FONT><FONT size=1>";
             print $toplink . "[Back to top]</A></FONT>\n";
             print "<FONT size=$fsize>\n";
             print "<BR><BR>\n";
         }
         print "</OL>\n</FONT>";
         print "</TD>\n</TR>\n";
         print "</TABLE>\n";
} /* end of InsertFaq2 */


function InsertAll() {
     global $cat_file,$datadir,$usehtml;
     global $tbl_bg,$tbl_width,$fface,$fsize,$fcolor;

         clearstatcache();
         if((!file_exists($cat_file))||(filesize($cat_file) == 0)) {
            print "<TABLE border=0 cellspacing=0 cellpadding=5>\n";
            print "<TR>\n<TD width=$tbl_width align=left valign=top>\n";
            print "<FONT face=$fface size=$fsize>\n";
            print "There is no data</FONT>\n";
            print "</TD>\n</TR>\n</TABLE>";
            return 0;
         }

         $sections = @file($cat_file) or die("Fail to open category file");
         $numsections = count($sections);
         $empty = 1;
         for($i=0; $i<$numsections; $i++) {
             clearstatcache();
             $junk = split("\|\|",$sections[$i]);
             if(filesize($datadir.$junk[0]) != 0) $empty = 0;
         }
         if($empty == 1) {
            print "<TABLE border=0 cellspacing=0 cellpadding=5>\n";
            print "<TR>\n<TD width=$tbl_width align=left valign=top>\n";
            print "<FONT face=$fface size=$fsize>\n";
            print "There is no data</FONT>\n";
            print "</TD>\n</TR>\n</TABLE>";
            return 0;
         }


     print "<TABLE border=0 cellspacing=0 cellpadding=5>\n";
     print "<TR>\n<TD width=$tbl_width bgcolor=\"$tbl_bg\" align=left valign=top>\n";
     print "<FONT face=$fface size=". ($fsize+1). " color=\"$fcolor\"><B>Questions</B></FONT>\n";
     print "</TD>\n</TR>\n";
     for($i=0; $i<count($sections); $i++) {
             $junk = split("\|\|",$sections[$i]);
         $sectionname[$i] = $junk[0];
             $numentry[$i] = $junk[1];
             if(filesize($datadir.$sectionname[$i]) != 0) {
                $ref = "<A name=\"$sectionname[$i]\">";
                print "<TR>\n<TD width=$tbl_width align=left valign=top>\n";
        print "<FONT face=$fface size=$fsize><B>" . $ref . $sectionname[$i] . "</A></B></FONT>\n";
        print "</TD>\n</TR>\n";
        print "<TR>\n<TD width=$tbl_width align=left valign=top>\n";
        print "<FONT face=$fface size=$fsize>\n";
        print "<OL type=\"1\">\n";
        $faqs = file($datadir.$sectionname[$i]) or die("Fail to open FAQs file");
        for($j=0; $j<count($faqs); $j++) {
            $link = "<A href=\"#cat" . $i . "_" . $j . "\">";
            $junk = split("\|\|",$faqs[$j]);
            $question[$i][$j] = $junk[0];
            $answer[$i][$j] = $junk[1];
            if($usehtml == 1) {
               $question[$i][$j] = str_replace("<od_break>"," ",$question[$i][$j]);
               $question[$i][$j] = stripslashes($question[$i][$j]);
               $answer[$i][$j] = str_replace("<od_break>"," ",$answer[$i][$j]);
               $answer[$i][$j] = stripslashes($answer[$i][$j]);
            }
            else {
               $question[$i][$j] = eregi_replace("\&","\&amp;",$question[$i][$j]);
               $question[$i][$j] = str_replace("<od_break>","od_break",$question[$i][$j]);
               $question[$i][$j] = str_replace("<","\&lt;",$question[$i][$j]);
               $question[$i][$j] = str_replace(">","\&gt;",$question[$i][$j]);
               $question[$i][$j] = str_replace("od_break","<BR>",$question[$i][$j]);
               $question[$i][$j] = stripslashes($question[$i][$j]);

               $answer[$i][$j] = eregi_replace("\&","\&amp;",$answer[$i][$j]);
               $answer[$i][$j] = str_replace("<od_break>","od_break",$answer[$i][$j]);
               $answer[$i][$j] = str_replace("<","\&lt;",$answer[$i][$j]);
               $answer[$i][$j] = str_replace(">","\&gt;",$answer[$i][$j]);
               $answer[$i][$j] = str_replace("od_break","<BR>",$answer[$i][$j]);
               $answer[$i][$j] = stripslashes($answer[$i][$j]);
            }

            print "<LI>". $link. $question[$i][$j] . "</A>\n";
        }
        print "</OL>\n</FONT>";
        print "</TD>\n</TR>\n";
             }
     }
     print "</TABLE>\n\n";

     print "<BR><BR>\n\n";
     print "<TABLE border=0 cellspacing=0 cellpadding=5>\n";
     print "<TR>\n<TD width=$tbl_width bgcolor=\"$tbl_bg\" align=left valign=top>\n";
     print "<FONT face=$fface size=". ($fsize+1). " color=\"$fcolor\"><B>Answers</B></FONT>\n";
     print "</TD>\n</TR>\n";
     for($i=0; $i<$numsections; $i++) {
         if(filesize($datadir.$sectionname[$i]) != 0) {
        $toplink = "<A href=\"#$sectionname[$i]\">";
        print "<TR>\n<TD width=$tbl_width align=left valign=top>\n";
        print "<FONT face=$fface>\n";
        print "<FONT size=$fsize><B>" . $sectionname[$i] . "</B></FONT>\n";
        print "<OL type=\"1\">\n";
        for($j=0; $j<$numentry[$i]; $j++) {
            $link = "<A name=\"cat" . $i . "_" . $j . "\">";
            print "<FONT size=$fsize><LI><B>" . $link . $question[$i][$j] . "</A></B><BR>\n";
            print $answer[$i][$j] . "<BR>\n";
            print "</FONT><FONT size=1>";
            print $toplink . "[Back to top]</A></FONT>\n";
            print "<FONT size=$fsize>\n";
            print "<BR><BR>\n";
        }
        print "</OL>\n</FONT>";
        print "</TD>\n</TR>\n";
         }
     }
     print "</TABLE>\n\n";

} /* end of InsertAll */

?>                                      