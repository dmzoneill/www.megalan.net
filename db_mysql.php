<?php

#######################################################################################################

/*
Copyright © 2001 Martin Galpin & Kris Bailey

This file is part of EvoBB.

evoBB is free software that you may download and use.  You may modify this
code as much as you like but you may not re-distribute it.  We wish for 
this software to be free but we do not wish to have it distributed by 
anyone other than the evobb team.  You may not sell evobb software but you
may sell the service of installing and/or configuring it.  If you do sell
the service of installing and/or configuring evobb software you must 
inform whomever is employing you for this service that evobb is free and
that they are not paying for evobb but for your service.

And as is with GNU licensed software this software (evoBB) does not come 
with any warranty whatsoever, without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. (sound framiliar?)
*/


#######################################################################################################

global $stream, $declared_class_db;
if (!$stream && $declared_class_db!="yes"){

class db {

    function graberrordesc() {
      $this->error=mysql_error();
      return $this->error;
    }

    function graberrornum() {
      $this->errornum=mysql_errno();
      return $this->errornum;
    }

############# start connect function
    function connect(){

    global $host, $username, $password, $db_name;

           $this->db = @mysql_connect($host,$username,$password);
           @mysql_select_db($db_name, $this->db);

    }
############# end connect function

############# start query function
    function do_query($query, $ret) {

      $this->result = @mysql_query($query, $this->db);

      if (!$this->result || !$ret) {
      echo "There was an error in the sql statement.<br>mysql said: ".$this->graberrordesc();
      return "bad";
      } else {

                if ($ret=="array"){

                $this->return = array();
                while ($row = @mysql_fetch_row($this->result)){
                $this->return[] = $row;
                }

                } elseif ($ret=="one"){

                $this->return = @mysql_result($this->result,0,0);

                } elseif ($ret=="row"){

                $this->return = @mysql_fetch_row($this->result);

                } else {

                $this->return = "bad";

                }

        return $this->return;

      }

    }
################ end query function


############# start close function
    function close(){
           @mysql_close($this->db);
    }

################ end close function

}

$declared_class_db = "yes";

}