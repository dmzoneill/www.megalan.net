<?php 
define('IN_PHPBB', true); 
/********************************************************************************
 * Hack:     Recent Topics (second version)
 * Author:   Acid (acid_junky@web.de)
 ********************************************************************************
 * Description: This hack shows the last # topics on any page...
 ********************************************************************************
 * Installation: <?php include("path/recent.php");
 *               copy recent_body.tpl to /templates/xxx
 *               You have to edit the marked part
 ********************************************************************************/

$phpbb_root_path = 'phpbb/'; //path to below files
include($phpbb_root_path . 'extension.inc'); 
include($phpbb_root_path . 'common.'.$phpEx); 

$userdata = session_pagestart($user_ip, PAGE_INDEX); 
init_userprefs($userdata); 

// ############ Edit below ############
$root = "phpbb"; // board folder without ending mark
$limit = "10"; // how many topics?

$lang['Started'] = 'started at';
$lang['by'] = '<b>by</B>';
// ############ Edit above ############


	$template->set_filenames(array(
		'body' => 'recent_body.tpl')
	);

$sql = "SELECT t.*, u.username, u.user_id, u2.username as user2, u2.user_id as id2, p.post_username, p2.post_username AS post_username2, p2.post_time
        FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . POSTS_TABLE . " p2, " . USERS_TABLE . " u2
        LEFT JOIN " . FORUMS_TABLE . " f ON t.forum_id=f.forum_id 
        WHERE t.topic_poster = u.user_id AND p.post_id = t.topic_first_post_id AND p2.post_id = t.topic_last_post_id AND u2.user_id = p2.poster_id
        ORDER BY t.topic_last_post_id DESC 
        LIMIT $limit"; 
if ( !($result = $db->sql_query($sql)) ) 
{ 
   message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql); 
} 
while( $row = $db->sql_fetchrow($result) ) 
{ 
                $orig_word = array(); 
                $replacement_word = array(); 
                obtain_word_list($orig_word, $replacement_word);

                $topic_title = ( count($orig_word) ) ? preg_replace($orig_word, $replacement_word, $row['topic_title']) : $row['topic_title']; 
                $topic_type = $row['topic_type']; 
                if( $topic_type == POST_ANNOUNCE ) 
                { 
                        $topic_type = ' <b><font class=mainhead>Announcement</b></font>';
                } 
                else if( $topic_type == POST_STICKY ) 
                { 
                        $topic_type = ' <b><font class=mainhead>Sticky</b></font>';
                } 
                else 
                { 
                        $topic_type = ''; 
                } 
                if( $row['topic_vote'] ) 
                { 
                        $topic_type .= ' <b><font class=mainhead>Poll</b></font>'; 
                } 
                if( $row['topic_status'] == TOPIC_MOVED ) 
                { 
                        $topic_type = ' <b><font class=mainhead>Moved</b></font>';
                } 
                if( $row['topic_status'] == TOPIC_MOVED )
                { 
                        $topic_id = $row['topic_moved_id']; 
                } 
                else
                        $topic_id = $row['topic_id']; 
						
						
                $view_topic_url = append_sid("$root/viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id"); 
                $topic_author = ( $row['user_id'] != ANONYMOUS ) ? '' : ''; 
                $topic_author .= ( $row['user_id'] != ANONYMOUS ) ? $row['username'] : ( ( $row['post_username'] != '' ) ? $row['post_username'] : $lang['Guest'] ); 
                $topic_author .= ''; 
                $first_post_time = ''; 
                $last_post_time = ''; 
                $last_post_author = ''; 
				$last_post_url = ''; 


                $template->assign_block_vars('recent', array(
		'TOPIC_TYPE' => $topic_type,
		'U_TOPIC' => $view_topic_url,
		'TOPIC_TITLE' => $topic_title,
		'FIRST_POST' => $first_post_time,
		'FIRST_POSTER' => $topic_author,
		'LAST_POST' => $last_post_time,
		'LAST_POSTER' => $last_post_author,
		'U_LAST_POST' => $last_post_url,
                   'L_BY' => $lang['by'])
                );
				
				
} 
          

$template->pparse('body');
?>