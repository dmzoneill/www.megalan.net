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

function AddSection($section_name,$mypass) {
         global $datadir,$cat_file,$passwd;

         if(trim($mypass) == "") {
            PrintMsg("<B>Error : password is required</B>");
            return 0;
         }
         if(!CheckPass($mypass,$passwd)) {
            PrintMsg("<B>Error : Invalid password</B>");
            return 0;
         }
         if(ereg("[\!\@\#\$\%\^\*\<\>\?]",$section_name)) {
            $text = htmlentities("! @ # $ % ^ * < > ?");
            $text = "<I>Characters <B>" . $text . "</B> may not be used in category name</I>";
            $text = "<FONT size=-1>" . $text . "</FONT>";
            PrintMsg("<B>Add error : invalid section name</B><BR>$text");
            return 0;
         }
         if(ereg("[\\\/]+",$section_name)) {
            PrintMsg("<B>Add Error : Please do not use '\\' or '/' in category name</B>");
            return 0;
         }
         if(trim($section_name) == "") {
            PrintMsg("<B>Add error : please enter category name</B>");
            return 0;
         }
         if(ereg("^[[:space:]]+",$section_name)) {
            PrintMsg("<B>Add Error : Please do not use spaces in front of category name</B>");
            return 0;
         }
         
         $section_name = chop($section_name);

         /* locking procedure */
         $counter = 0;
         $success = 0;
         while($counter < 10) {
              clearstatcache();
              if(!file_exists($cat_file.".lock")) {
                   /* ok, can go */
                   if(!$plock = @fopen($cat_file. ".lock","w")) {
                        PrintMsg("<B>Unable to obtain lock. The file $cat_file file might be in used</B>");
                        return 0;
                   } 
                   fclose($plock);

                   if(filesize($cat_file) != 0) {
                        if(!$sections = @file($cat_file)) {
                             PrintMsg("<B>Unable to open \"$cat_file\" file.</B>");
                             @unlink($cat_file.".lock");
                             return 0;
                        }
                        for($i=0; $i<count($sections); $i++) {
                             $sections[$i] = chop($sections[$i]);
                             $list = split("\|\|",$sections[$i]);
                             if($section_name == $list[0]) {
                                  PrintMsg("<B>'$section_name'</B> category is already exist");
                                  @unlink($cat_file.".lock");
                                  return 0;
                             }
                        }
                   } 
                   else
                        $sections = array();

                   if(!$fp = @fopen($datadir.$section_name,"w")) {
                        @unlink($cat_file. ".lock");
                        PrintMsg("<B>Error : Unable to add \"$section_name\" file. Check data directory permission.</B>");
                        return 0;
                   }
                   fclose($fp);

                   if(!$fp = @fopen($cat_file,"w")) {
                        @unlink($datadir.$section_name);
                        @unlink($cat_file. ".lock");
                        PrintMsg("<B>Error : Unable to open \"$cat_file\" file. Check its file permission</B>");
                        return 0;
                   }

                   $text = $section_name . "||0";
                   $sections[count($sections)] = $text;
                   fputs($fp,implode("\n",$sections));
                   fclose($fp);

                   @unlink($cat_file. ".lock");
                   $success = 1;
                   return 1;    
              }
              else {
                   /* file is locked. Must wait */
                   sleep(1);
                   $counter++;
                   clearstatcache();
                   if(time() - filectime($cat_file. ".lock") > 180) {
                        @unlink($cat_file. ".lock");
                        $counter = 0;
                   }
              }
         } /* end while */

         if($success == 0) {
              PrintMsg("<B>Failed to obtain lock because $cat_file file might be in used. Please try again.</B>");
              return 0;
         }

} /* end of AddSection */


function DelSection($section_name,$mypass) {
         global $datadir,$cat_file,$passwd;

         if(trim($mypass) == "") {
            PrintMsg("<B>Error : password is required</B>");
            return 0;
         }
         if(!CheckPass($mypass,$passwd)) {
            PrintMsg("<B>Error : Invalid password</B>");
            return 0;
         }
         if($section_name == "od_default") {
            PrintMsg("<B>Error : Please select category to delete</B>");
            return 0;
         }

         /* locking procedure */
         $counter = 0;
         $success = 0;
         while($counter < 5) {
              clearstatcache();
              if(!file_exists($cat_file.".lock")) {
                   /* ok, can go */
                   if(!$plock = fopen($cat_file. ".lock","w")) {
                        PrintMsg("<B>Error : Unable to obtain lock. The file $cat_file might be in used</B>");
                        return 0;
                   } 
                   fclose($plock);

                   if(!$fp = @file($cat_file)) {
                        PrintMsg("<B>Error : Unable to open \"$cat_file\" file. Check data directory permission.</B>");
                        @unlink($cat_file. ".lock");
                        return 0;
                   }
                   $j = 0;
                   for($i=0; $i<count($fp); $i++) {
                        $fp[$i] = chop($fp[$i]);
                        $line = split("\|\|",$fp[$i]);
                        if($line[0] != $section_name) {
                             $newline[$j] = $fp[$i];
                             $j++;
                        }
                   }

                   if(count($fp) == count($newline)) {
                        PrintMsg("<B>Error : Unable to delete because category name is not found. Try to refresh your page.</B>");
                        @unlink($cat_file. ".lock");
                        return 0;
                   }

                   if(!$fp2 = @fopen($cat_file,"w")) {
                        PrintMsg("<B>Error : Unable to open \"$cat_file\" file. Check its file permission.</B>");
                        @unlink($cat_file. ".lock");
                        return 0;
                   }
                   if(@unlink($datadir.$section_name) == 0) {
                        fputs($fp2,implode("\n",$fp));
                        fclose($fp2);
                        PrintMsg("Error : Fail to delete <B>'$section_name'</B> file");
                        @unlink($cat_file. ".lock");
                        return 0;
                   }
                   else {
                       if(count($newline) != 0) fputs($fp2,implode("\n",$newline));
                       fclose($fp2);
                       @unlink($cat_file. ".lock");
                       $success = 1;
                       return 1;
                   }
              }
              else {
                   /* must wait */
                   sleep(1);
                   $counter++;
                   clearstatcache();
                   if(time() - filectime($cat_file. ".lock") > 180) {
                        @unlink($cat_file. ".lock");
                        $counter = 0;
                   }
              }
         } /* end while */

         if($success == 0) {
              PrintMsg("<B>Failed to obtain lock because $cat_file file might be in used. Please try again.</B>");
              return 0;
         }

} /* end of DelSection */


function RenSection($old_section,$new_section,$mypass) {
         global $datadir,$cat_file,$passwd;

         if(trim($mypass) == "") {
            PrintMsg("<B>Error : password is required</B>");
            return 0;
         }
         if(!CheckPass($mypass,$passwd)) {
            PrintMsg("<B>Error : Invalid password</B>");
            return 0;
         }
         if($old_section == "od_default") {
            PrintMsg("<B>Error : Please select category to rename</B>");
            return 0;
         }
         if(ereg("^[\!\@\#\$\%\^\*\<\>\?]",$new_section)) {
            $text = htmlentities("! @ # $ % ^ * < > ?");
            $text = "<I>Characters <B>" . $text . "</B> may not be used in category name</I>";
            $text = "<FONT size=-1>" . $text . "</FONT>";
            PrintMsg("<B>Add error : invalid section name</B><BR>$text");
            return 0;
         }
         if(ereg("[\\\/]+",$new_section)) {
            PrintMsg("<B>Add Error : Please do not use '\\' or '/' in category name</B>");
            return 0;
         }
         if(trim($new_section) == "") {
            PrintMsg("<B>Rename error : please enter new category name</B>");
            return 0;
         }
         if(ereg("^[[:space:]]+",$new_section)) {
            PrintMsg("<B>Rename error : please do not use spaces in front of category name</B>");
            return 0;
         }
       
         $new_section = chop($new_section);

         /* lock procedure */
         $counter = 0;
         $success = 0;
         while($counter < 10) {
             clearstatcache();
             if(!file_exists($cat_file . ".lock")) {
                 /* ok, can go */
                 if(!$plock = @fopen($cat_file.".lock","w")) {
                     PrintMsg("<B>Error : Unable to obtain lock. The $cat_file file might be in used.</B>");
                     return 0;
                 } 
                 fclose($plock);

                 if(!$fp = @file($cat_file)) {
                     PrintMsg("<B>Unable to open \"$cat_file\" file</B>");
                     @unlink($cat_file.".lock");
                     return 0;
                 }

                 for($i=0; $i<count($fp); $i++) {
                     $fp[$i] = chop($fp[$i]);
                     $line = split("\|\|",$fp[$i]);
                     if($line[0] == $new_section) {
                         PrintMsg("<B>Rename error : new name already exist</B>");
                         @unlink($cat_file.".lock");
                         return 0;
                     }
                 }

                 $j = 0;
                 for($i=0; $i<count($fp); $i++) {
                     $line = split("\|\|",$fp[$i]);
                     if($line[0] == $old_section) {
                         $text = $new_section ."||" . $line[1];
                         $newlist[$j] = $text;
                         $j++;
                     }
                     else {
                         $newlist[$j] = $fp[$i];
                         $j++;
                     }
                 }

                 if(!$fp2 = @fopen($cat_file,"w")) {
                     PrintMsg("<B>Error : Unable to open \"$cat_file\" file. Check its file permission.</B>");
                     @unlink($cat_file. ".lock");
                     return 0;
                 }

                 if(!rename($datadir.$old_section,$datadir.$new_section)) {
                     fputs($fp2,implode("\n",$fp));
                     fclose($fp2);
                     PrintMsg("Error : Fail to rename <B>'$old_section'</B> to <B>'$new_section'</B>");
                     @unlink($cat_file.".lock");
                     return 0;
                 }
                 else {
                    fputs($fp2,implode("\n",$newlist));
                    fclose($fp2);
                    @unlink($cat_file.".lock");
                    $success = 1;
                    return 1;
                 }
             }
             else {
                 /* locked, must wait */
                 sleep(1);
                 $counter++;
                 clearstatcache();
                 if(time() - filectime($cat_file. ".lock") > 180) {
                      @unlink($cat_file. ".lock");
                      $counter = 0;
                 }
             }

             if($success == 0) {
                 PrintMsg("<B>Failed to obtain lock because $cat_file file might be in used. Please try again.</B>");
                 return 0;
             }
         } /* end while */
} /* end of RenSection */


function AddEntry($question,$answer,$section_name,$mypass) {
         global $datadir,$cat_file,$passwd,$usehtml;

         if(trim($mypass) == "") {
            PrintMsg("<B>Error : password is required</B>");
            return 0;
         }
         if(!CheckPass($mypass,$passwd)) {
            PrintMsg("<B>Error : Invalid password</B>");
            return 0;
         }
         if(eregi("<[aA]",$question)) {
            PrintMsg("<B>Please do not use hyperlink in your question</B>");
            return 0;
         }
         if(trim($answer) && trim($question)) {
            if (is_writeable($datadir.$section_name) AND is_writeable($cat_file)) {

                /* locking procedure */
                $counter = 0;
                $success = 0;
                while($counter < 10) {
                    clearstatcache();
                    if(!file_exists($cat_file.".lock")) {
                        /* ok, can go */
                        if(!$plock = @fopen($cat_file.".lock","w")) {
                            PrintMsg("<B>Error : Unable to obtain lock. The $cat_file file might be in used.</B>");
                            return 0;
                        }
                        fclose($plock);

                        if(filesize($datadir.$section_name) != 0) {
                            if(!$data = @file($datadir.$section_name)) {
                                PrintMsg("<B>Unable to load \"$section_name\" file</B>");
                                @unlink($cat_file.".lock");
                                return 0;
                            }
                        }
                        else
                            $data = array();
                        for($i=0; $i<count($data); $i++) $data[$i] = chop($data[$i]);

                        /* add Q&A to respected file */
                        $question = str_replace("\n","<od_break>",$question);
                        $question = stripslashes($question);
                        $answer = str_replace("\n","<od_break>",$answer);
                        $answer = stripslashes($answer);

                        $text = $question . "||" . $answer;
                        $data[count($data)] = $text;

                        if(!$fp2 = @file($cat_file)) {
                            PrintMsg("<B>Error : Unable to open \"$cat_file\" file.</B>");
                            @unlink($cat_file.".lock");
                            return 0;
                        }
                   
                        if(!$fp1 = @fopen($datadir.$section_name,"w")) {
                            PrintMsg("<B>Error : Unable to open file \"$section_name\". Check its file permission.</B>");
                            @unlink($cat_file.".lock");
                            return 0;
                        }
                        if(!$fp3 = @fopen($cat_file,"w")) {
                            PrintMsg("<B>Error : Unable to open \"$cat_file\" file. Check its file permission.</B>");
                            @unlink($cat_file.".lock");
                            return 0;
                        }

                        /* add number of Q&A in $cat_file */
                        fputs($fp1,implode("\n",$data));
                        fclose($fp1);

                        for($i=0; $i<count($fp2); $i++) {
                            $fp2[$i] = chop($fp2[$i]);
                            $line = split("\|\|",$fp2[$i]);
                            if($line[0] == $section_name) {
                                $line[1] = $line[1] + 1;
                            }
                            $text = $line[0] . "||" . $line[1] . "\n";
                            fputs($fp3,$text);
                        }
                        fclose($fp3);
      
                        @unlink($cat_file.".lock");
                        $success = 1;
                        return 1;
                    }
                    else {
                        /* locked, must wait */
                        sleep(1);
                        $counter++;
                        clearstatcache();
                        if(time() - filectime($cat_file.".lock") > 180) {
                            @unlink($cat_file.".lock");
                            $counter = 0;
                        }
                    }
                } /* end while */
     
                if($success == 0) {
                    PrintMsg("<B>Failed to obtain lock because $cat_file file might be in used. Please try again.</B>");
                    return 0;
                }
            }
            else die("File <B>$section_name</B> does not exist or unable to open file");
        }

        else {
            PrintMsg("<B>Add entry error : all fields must be filled</B>");
            return 0;
        }
} /* end of Add Entry */


function DelEntry($section_name,$entry_name,$mypass) {
         global $datadir,$cat_file,$passwd;

         if(trim($mypass) == "") {
            PrintMsg("<B>Error : password is required</B>");
            return 0;
         }
         if(!CheckPass($mypass,$passwd)) {
            PrintMsg("<B>Error : Invalid password</B>");
            return 0;
         }


         /* lock procedure */
         $counter = 0;
         $success = 0;
         while($counter < 10) {
             clearstatcache();
             if(!file_exists($cat_file.".lock")) {
                 /* ok, can go */
                 if(!$plock = @fopen($cat_file. ".lock","w")) {
                     PrintMsg("<B>Error : Unable to obtain lock. The $cat_file file might be in used.</B>");
                     return 0;
                 }
                 fclose($plock);

                 if(!$oldlist = @file($datadir.$section_name)) {
                     PrintMsg("<B>Unable to open \"$section_name\" file</B>");
                     @unlink($cat_file.".lock");
                     return 0;
                 }
                 $k = 0;
                 for($i=0; $i<count($oldlist); $i++) {
                     $oldlist[$i] = chop($oldlist[$i]);
                     $match = 0;
                     for($j=0; $j<count($entry_name); $j++) {
                         if($i == $entry_name[$j]) {
                             $match = 1;
                             break;
                         }
                     }
                     if($match == 0) {
                         $newlist[$k] = $oldlist[$i];
                         $k++;
                     }
                 }

                 if(!$fp2 = @file($cat_file)) {
                     PrintMsg("<B>Error : Unable to open \"$cat_file\" file.</B>");
                     @unlink($cat_file.".lock");
                     return 0;
                 }
                 if(!$fp3 = @fopen($cat_file,"w")) {
                     PrintMsg("<B>Error : Unable to open \"$cat_file\" file. Check its file permission.</B>");
                     @unlink($cat_file.".lock");
                     return 0;
                 }
                 if(!$fp4 = @fopen($datadir.$section_name,"w")) {
                     PrintMsg("<B>Error : Unable to open \"$section_name\" file. Check its file permission.</B>");
                     @unlink($cat_file.".lock");
                     return 0;
                 }

                 for($i = 0; $i<count($fp2); $i++) {
                     $fp2[$i] = chop($fp2[$i]);
                     $line = split("\|\|",$fp2[$i]);
                     if($line[0] == $section_name) {
                         $line[1] = $line[1] - count($entry_name);
                     }
                     $text = $line[0] . "||" . $line[1] . "\n";
                     fputs($fp3,$text);
                 }
                 fclose($fp3);

                 if(count($newlist) != 0) {
                     fputs($fp4,implode("\n",$newlist));
                 }
                 fclose($fp4);

                 @unlink($cat_file.".lock");
                 $success = 1;
                 return 1;
             }
             else {
                 /* locked, must wait */
                 sleep(1);
                 $counter++;
                 clearstatcache();
                 if(time() - filectime($cat_file.".lock") > 180) {
                     @unlink($cat_file.".lock");
                     $counter = 0;
                 }
             } 
         } /* end while */

         if($success == 0) {
             PrintMsg("<B>Failed to obtain lock because $cat_file file might be in used. Please try again.</B>");
             return 0;
         }
} /* end of Del Entry */

function MovEntry($section_name,$move_to,$entry_name,$mypass) {
         global $datadir,$cat_file,$passwd;

         if(trim($mypass) == "") {
            PrintMsg("<B>Error : password is required</B>");
            return 0;
         }
         if(!CheckPass($mypass,$passwd)) {
            PrintMsg("<B>Error : Invalid password</B>");
            return 0;
         }
         if($move_to == "od_default") {
            PrintMsg("<B>Move error : Please select destination category</B>");
            return 0;
         }
         if($section_name == $move_to) {
            PrintMsg("<B>Move error : Cannot move to itself</B>");
            return 0;
         }
     

         /* locking procedure */
         $counter = 0;
         $success = 0;
         while($counter < 10) {
             clearstatcache();
             if(!file_exists($cat_file.".lock")) {
                 /* ok, can go */
                 if(!$plock = @fopen($cat_file. ".lock","w")) {
                     PrintMsg("<B>Error : Unable to obtain lock. The $cat_file file might be in used.</B>");
                     return 0;
                 }
                 fclose($plock);

                 if(!$fp = @file($datadir.$section_name)) {
                     PrintMsg("<B>Unable to open \"$section_name\" file</B>");
                     @unlink($cat_file.".lock");
                     return 0;
                 }
                 for($i=0; $i<count($fp); $i++) $fp[$i] = chop($fp[$i]);

                 /* add entries to array($newlist) */
                 if(filesize($datadir.$move_to) != 0)
                     $newlist = @file($datadir.$move_to);
                 else
                     $newlist = array();
                 for($i=0; $i<count($newlist); $i++) $newlist[$i] = chop($newlist[$i]);

                 $index = count($newlist);
                 for($i=0; $i<count($entry_name); $i++) {
                     $newlist[$index] = $fp[$entry_name[$i]];
                     $index++;
                 }

                 /* delete entries from old array($fp) and put in a new array($fpnew) */
                 $k = 0;
                 for($i=0; $i<count($fp); $i++) {
                     $match = 0;
                     for($j=0; $j<count($entry_name); $j++) {
                         if($i == $entry_name[$j]) {
                             $match = 1;
                             break;
                         }
                     }
                     if($match == 0) {
                         $fpnew[$k] = $fp[$i];
                         $k++;
                     }
                 }

                 if(!$fp2 = @file($cat_file)) {
                     PrintMsg("<B>Error : Unable to open \"$cat_file\" file</B>");
                     @unlink($cat_file.".lock");
                     return 0;
                 }

                 /* open all needed files */
                 if( (!$new = @fopen($datadir.$move_to,"w")) OR
                     (!$fp3 = @fopen($datadir.$section_name,"w")) OR
                     (!$fp4 = @fopen($cat_file,"w")) ) {
                     PrintMsg("<B>Error : Unable to open files needed for moving action</B>");
                     @unlink($cat_file.".lock");
                     return 0;
                 }

                 /* saving $newlist array back to $move_to file */
                 fputs($new,implode("\n",$newlist));
                 fclose($new);

                 /* saving $fpnew array back to $section_name file */
                 if(count($fpnew) != 0) {
                     fputs($fp3,implode("\n",$fpnew));
                 }
                 fclose($fp3);

                 for($i = 0; $i<count($fp2); $i++) {
                     $fp2[$i] = chop($fp2[$i]);
                     $line = split("\|\|",$fp2[$i]);
                     if($line[0] == $move_to) {
                         $line[1] = $line[1] + count($entry_name);
                         $text = $line[0] . "||" . $line[1] . "\n";
                     }
                     elseif($line[0] == $section_name) {
                         $line[1] = $line[1] - count($entry_name);
                         $text = $line[0] . "||" . $line[1] . "\n";
                     }
                     else
                         $text = $fp2[$i] . "\n";
                     fputs($fp4,$text);
                 }
                 fclose($fp4);

                 @unlink($cat_file.".lock");
                 $success = 1;
                 return 1;
             }
             else {
                 /* locked, must wait */
                 $counter++;
                 clearstatcache();
                 if(time() - filectime($cat_file.".lock") > 180) {
                     @unlink($cat_file.".lock");
                     $counter = 0;
                 }
                 sleep(1);
             }
         } /* end while */
     
         if($success == 0) {
             PrintMsg("<B>Failed to obtain lock because $cat_file file might be in used. Please try again.</B>");
             return 0;
         }
      
} /* end of Mov Entry */


function EditEntry($section_name,$which,$question,$answer,$mypass) {
         global $datadir,$PHP_SELF,$passwd,$cat_file;

         if(trim($mypass) == "") {
            PrintMsg("<B>Error : password is required</B>");
            return 0;
         }
         if(!CheckPass($mypass,$passwd)) {
            PrintMsg("<B>Error : Invalid password</B>");
            return 0;
         }
         if(eregi("<[aA]",$question)) {
            PrintMsg("<B>Please do not use hyperlink in your question</B>");
            return 0;
         }

         if(trim($answer) && trim($question)) {
                    $question = str_replace("\n","<od_break>",$question);
                    $question = stripslashes($question);
                    $answer = str_replace("\n","<od_break>",$answer);
                    $answer = stripslashes($answer);

                    /* locking procedure */
                    $counter = 0;
                    $success = 0;
                    while($counter < 10) {
                        clearstatcache();
                        if(!file_exists($cat_file . ".lock")) {
                            if(!$plock = @fopen($cat_file . ".lock","w")) {
                                PrintMsg("<B>Error : Unable to obtain lock. The $cat_file file might be in used.</B>");
                                return 0;
                            }
                            fclose($plock);

                            if(!$fp = @file($datadir.$section_name)) {
                                PrintMsg("Error : Unable to open <B>'$section_name'</B> file");
                                @unlink($cat_file. ".lock");
                                return 0;
                            }
                            for($i=0; $i<count($fp); $i++) $fp[$i] = chop($fp[$i]);

                            $text = $question . "||" . $answer;
                            $fp[$which] = $text;
                            if(!$fp1 = @fopen($datadir.$section_name,"w")) {
                                PrintMsg("<B>Error : Unable to open \"$section_name\" file. Check its file permission.</B>");
                                @unlink($cat_file.".lock");
                                return 0;
                            }
                            fputs($fp1,implode("\n",$fp));
                            fclose($fp1);

                            @unlink($cat_file.".lock");
                            $success = 1;
                            return 1;
                        }
                        else {
                            /* locked, must wait */
                            clearstatcache();
                            $counter++;
                            if(time() - filectime($cat_file.".lock") > 180) {
                                @unlink($cat_file.".lock");
                                $counter = 0;
                            }
                            sleep(1);
                        }
                    } /* end while */
                    
                    if($success == 0) {
                        PrintMsg("<B>Failed to obtain lock because $cat_file file might be in used. Please try again.</B>");
                        return 0;
                    }
         }
         else {
                    PrintMsg("<B>All fields must be filled</B>");
                    return 0;
         }
} /* end of EditEntry */

/*******************************************
           forms display function
 *******************************************/
function frmAddSection() {
         global $PHP_SELF;
?>
         <FORM action="<? echo $PHP_SELF; ?>" method=POST>
         <INPUT type=hidden name=action value="add_section">
         <TABLE border=0 cellspacing=0 cellpadding=5>
         <TR><TD align=left valign=middle colspan=2 bgcolor="#666699">
             <FONT color="#ffffff"><B>Add new category</B></FONT></TD>
         </TR>

         <TR><TD align=right valign=middle width=100>
             New category : </TD>
             <TD align=left valign=top width=400>
             <INPUT type=text name=new_section size=30></TD>
         </TR>

         <TR><TD align=right valign=middle width=100>
             Password : </TD>
             <TD align=left valign=top width=400>
             <INPUT type=password name=mypass size=10></TD>
         </TR>

         <TR><TD align=right valign=top width=100>&nbsp;
              </TD>
             <TD align=left valign=top width=400>
             <INPUT type=submit value="Add"></TD>
         </TR>
         </TABLE>
         </FORM>
<?
} /* end of frmAddSection */
?>


<?
function frmDelSection() {
         global $PHP_SELF,$cat_file;

         $fp = file($cat_file) or die("Unable to open \"$cat_file\" file");

			 $text = "";
			 ?>
         <FORM action="<? echo $PHP_SELF; ?>" method=POST>
         <INPUT type=hidden name=action value="del_section">
         <TABLE border=0 cellspacing=0 cellpadding=5>
         <TR><TD align=left valign=middle colspan=2 bgcolor="#666699">
             <FONT color="#ffffff"><B>Delete category</B></FONT></TD>
         </TR>

         <TR><TD align=right valign=middle width=100>
             Category : </TD>
             <TD align=left valign=top width=400>
             <SELECT name=section_name>
             <OPTION value=od_default selected>-- Select category --</option>\n
             <? for($i=0; $i<count($fp); $i++) {
                    $line = split("\|\|",$fp[$i]);
                    if(strlen($line[0]) > 30)
                       $text = substr($line[0],0,29) . " ...";
                    else $text = $line[0];
                    echo "<OPTION value=\"$line[0]\">$text\n</option>\n";
                }
             ?>
             </SELECT>
         </TR>

         <TR><TD align=right valign=middle width=100>
             Password : </TD>
             <TD align=left valign=top width=400>
             <INPUT type=password name=mypass size=10></TD>
         </TR>

         <TR><TD align=right valign=top width=100>&nbsp;
              </TD>
             <TD align=left valign=top width=400>
             <INPUT type=submit value="Delete">
             <INPUT type=hidden name=flag value=1></TD>
         </TR>
         </TABLE>
         </FORM>
<?
} /* end of frmDelSection */
?>


<?
function frmListSection() {
         global $cat_file,$PHP_SELF;

         $fp = file($cat_file) or die("Unable to open \"$cat_file\" file");
?>
         <TABLE border=0 cellspacing=3 cellpadding=5>
         <TR><TD align=left colspan=2 bgcolor="#666699" width=500>
             <B><FONT color="#ffffff">Current FAQ categories</FONT></B>
             </TD>
             </TR>
         <? for($i=0; $i<count($fp); $i++) {
                $line = split("\|\|",$fp[$i]);
                $rawurl = rawurlencode($line[0]); ?>
                <TR><TD align=left valign=middle width=420 bgcolor="#cccccc">
                    <UL><LI><A href="<? echo $PHP_SELF; ?>?action=edit_section&cat=<? echo $rawurl; ?>">
                    <? echo $line[0]; ?></A></UL></TD>
                    <TD align=left valign=middle width=80 bgcolor="#cccccc">
                    <? echo $line[1];
                       if($line[1] <= 1) echo " entry";
                       else echo " entries";
                    ?>
                    </TD>
                </TR>
         <? }    ?>
         </TABLE>
<?
} /* end of frmListSection */
?>


<?
function frmRenSection() {
         global $cat_file;
         global $PHP_SELF;

         $fp = file($cat_file) or die("Unable to open \"$cat_file\" file");

			 $text = "";
			 ?>
         <FORM action="<? echo "$PHP_SELF"; ?>" method=POST>
         <INPUT type=hidden name=action value="ren_section">
         <TABLE border=0 cellspacing=0 cellpadding=5>
         <TR><TD align=left colspan=2 bgcolor="#666699" width=500>
             <FONT color="#ffffff"><B>Rename category</B></FONT>
             </TD>
         </TR>
         <TR><TD align=right width=100>
             Rename :</TD>
             <TD align=left width=400>
             <SELECT name="old_section">
             <OPTION value=od_default selected>-- Select category --\n</option>\n
             <? for($i=0; $i<count($fp); $i++) {
                    $line = split("\|\|",$fp[$i]);
                    if(strlen($line[0]) > 30)
                       $text = substr($line[0],0,29) . " ...";
                    else $text = $line[0];
                    echo "<OPTION value=\"$line[0]\">$text\n</option>\n";
                }
             ?>
             </SELECT>
             to
             <INPUT type=text name="new_section" size=20>
             </TD>
         </TR>

         <TR><TD align=right valign=middle width=100>
             Password : </TD>
             <TD align=left valign=top width=400>
             <INPUT type=password name=mypass size=10></TD>
         </TR>

         <TR><TD align=right valign=top width=100>&nbsp;
              </TD>
             <TD align=left valign=top width=400>
             <INPUT type=submit value="Rename">
             </TD>
         </TR>
         </TABLE>
         </FORM>
<?
} /* end of frmRenSection */
?>


<?
function frmAddEntry($section_name) {
         global $cat_file;
         global $PHP_SELF;

?>
         <FORM action="<? echo $PHP_SELF; ?>" method=POST>
         <INPUT type=hidden name=action value="add_entry">
         <TABLE border=0 cellspacing=0 cellpadding=5>
         <TR><TD align=left valign=middle colspan=2 bgcolor="#666699">
             <FONT color="#ffffff"><B>Add new entry</B></FONT></TD>
         </TR>

         <TR><TD align=right valign=middle width=100>
             Category : </TD>
             <TD align=left valign=top width=400>
             <? echo "$section_name\n"; ?>
         </TR>

         <TR><TD align=right valign=middle width=100>
             Question : </TD>
             <TD align=left valign=top width=400>
             <INPUT type=text size=40 name=question></TD>
         </TR>

         <TR><TD align=right valign=top width=100>
             Answer : </TD>
             <TD align=left valign=top width=400>
             <TEXTAREA name=answer rows=8 cols=40 wrap=soft></TEXTAREA>
         </TR>

         <TR><TD align=right valign=middle width=100>
             Password : </TD>
             <TD align=left valign=top width=400>
             <INPUT type=password name=mypass size=10></TD>
         </TR>

         <TR><TD align=right valign=top width=100>&nbsp;
              </TD>
             <TD align=left valign=top width=400>
             <INPUT type=submit value="Add entry">
             <INPUT type=hidden name=flag value=1>
         </TR>
         </TABLE>
         <INPUT type=hidden name=section_name value="<? echo $section_name; ?>">
         </FORM>
<?
} /* end of frmAddEntry */
?>


<?
function frmListEntry($section_name) {
         global $datadir,$cat_file,$usehtml;
         global $PHP_SELF;

         $fp = file($datadir.$section_name) or die("Unable to open \"$section_name\" file");
?>
         <FORM action="<? echo $PHP_SELF; ?>" method=POST>
         <INPUT type=hidden name=action value="mod_entry">
         <TABLE border=0 cellspacing=3 cellpadding=5>
         <TR><TD align=left colspan=3 bgcolor="#666699" width=500>
             <FONT color="#ffffff">List of entries in '<B><? echo $section_name; ?></B>' category</FONT>
             </TD>
         </TR>
         <? for($i=0; $i<count($fp); $i++) {
                $line = split("\|\|",$fp[$i]);
                if($usehtml == 1) {
                   $question = str_replace("<od_break>"," ",$line[0]);
                   $question = stripslashes($question);
                   $answer = str_replace("<od_break>"," ",$line[1]);
                   $answer = stripslashes($answer);
                }
                else {
                   $question = $line[0];
                   $question = eregi_replace("\&","\&amp;",$question);
                   $question = str_replace("<od_break>","od_break",$question);
                   $question = str_replace("<","\&lt;",$question);
                   $question = str_replace(">","\&gt;",$question);
                   $question = str_replace("od_break","<BR>",$question);
                   $question = stripslashes($question);

                   $answer = $line[1];
                   $answer = eregi_replace("\&","\&amp;",$answer);
                   $answer = str_replace("<od_break>","od_break",$answer);
                   $answer = str_replace("<","\&lt;",$answer);
                   $answer = str_replace(">","\&gt;",$answer);
                   $answer = str_replace("od_break","<BR>",$answer);
                   $answer = stripslashes($answer);
                }
         ?>
                <TR><TD align=left valign=top width=25 bgcolor="#cccccc">
                    <INPUT type=checkbox name="entry_name[]" value="<? echo $i; ?>">
                    </TD>
                    <TD align=left valign=top width=445 bgcolor="#cccccc">
                    <B><? echo $question; ?></B><BR>
                       <? echo $answer; ?>
                    </TD>
                    <TD align=center valign=top width=30 bgcolor="#cccccc">
                    <? $raw = rawurlencode($section_name); ?>
                    <A href="<? echo "$PHP_SELF?action=frm_editentry&cat=$raw&which=$i"; ?>">
                    Edit</A></TD>
                </TR>
         <? } ?>

         <TR><TD align=left width=25 bgcolor="#cccccc">&nbsp;</TD>
             <TD align=left colspan=2 width=475 bgcolor="#cccccc">
             Password : <INPUT type=password name=mypass size=10></TD>
         </TR>

         <TR><TD align=left width=25 bgcolor="#cccccc">&nbsp;</TD>
             <TD align=left colspan=2 width=475 bgcolor="#cccccc">
             <INPUT type=submit name=sub_action value="Move to">
             <? $fp2 = file($cat_file) or die("Unable to open \"$cat_file\" file"); 
			 $text = "";
			 ?>
             <SELECT name=move_to>
             <OPTION value="od_default" selected>-- Select category --\n</option>\n
             <? for($i=0; $i<count($fp2); $i++) {
                    $line = split("\|\|",$fp2[$i]);
                    if(strlen($line[0]) > 30)
                       $text = substr($line[0],0,29) . " ...";
                    else $text = $line[0];
                    print "<OPTION value=\"$line[0]\">$text\n</option>\n";
                } ?>
             </SELECT>
             </TD>
                 </TR>
         <TR><TD align=left width=25 bgcolor="#cccccc">&nbsp;</TD>
             <TD align=left colspan=2 width=475 bgcolor="#cccccc">
             <INPUT type=submit name=sub_action value=" Delete "><BR>
             </TD>
         </TR>
         </TABLE>
         <INPUT type=hidden name=section_name value="<? echo $section_name; ?>">
         </FORM>
<?
} /* end of frmListEntry */
?>


<?
function frmEditEntry($section_name,$which) {
         global $datadir,$PHP_SELF,$usehtml;

         $fp = file($datadir.$section_name) or die("Unable to open \"$section_name\" file");
         $line = split("\|\|",$fp[$which]);
         $tempq = eregi_replace("<od_break>","\n",$line[0]);
         $tempq = stripslashes($tempq);
         $tempa = eregi_replace("<od_break>","\n",$line[1]);
         $tempa = stripslashes($tempa);
?>
         <FORM action="<? echo $PHP_SELF; ?>" method=POST>
         <INPUT type=hidden name=action value="edit_entry">
         <TABLE border=0 cellspacing=3 cellpadding=5>
         <TR><TD align=left colspan=2 bgcolor="#666699" width=500>
             <FONT color="#ffffff"><B>Edit Entry</B></FONT></TD>
         </TR>
         <TR><TD align=right valign=middle width=100>
             Question : </TD>
             <TD align=left valign=top width=400>
             <INPUT type=text size=40 name=question value="<? echo $tempq; ?>"></TD>
         </TR>

         <TR><TD align=right valign=top width=100>
             Answer : </TD>
             <TD align=left valign=top width=400>
             <TEXTAREA name=answer rows=8 cols=40 wrap=soft><? echo $tempa; ?></TEXTAREA>
         </TR>

         <TR><TD align=right valign=middle width=100>
             Password : </TD>
             <TD align=left valign=top width=400>
             <INPUT type=password name=mypass size=10></TD>
         </TR>

         <TR><TD align=right valign=top width=100>&nbsp;
              </TD>
             <TD align=left valign=top width=400>
             <INPUT type=submit name=sub_action value="Edit entry">
             <INPUT type=submit name=sub_action value="Cancel">
         </TR>
         </TABLE>
         <INPUT type=hidden name=section_name value="<? echo $section_name; ?>">
         <INPUT type=hidden name=which value="<? echo $which; ?>">
         </FORM>
<?
} /* end of frmEditEntry */
?>


<?
function CheckPass($pass1,$pass2) {

         if($pass1 == $pass2) return 1;
         else return 0;
} /* end of CheckPass */
?>


<?
function PrintMsg($msg) {
?>
         <TABLE border=0 cellspacing=0 cellpadding=5>
         <TR><TD width=510 align=left bgcolor="#cccccc">
             <? echo $msg; ?>
             </TD>
         </TR>
         </TABLE>
         <BR>
<?
} /* end PrintMsg */
?>