<?php

/**
 * drop current tag weights
 */
function delete_all_weights() {
    $connection = mysql_connect("localhost", "root", "");

    mysql_select_db("tagcloudtest", $connection);

    $query = "delete from tagcloud_tags";
    $resultset = mysql_query($query, $connection);
    if(!$resultset) {
        die("there was a problem deleting the tags");
    }
}

/**
 * connect to the database, extract the fields and send them off to be counted
 */
function parse_all_content() {

    $connection = mysql_connect("localhost", "root", "");

    mysql_select_db("tagcloudtest", $connection);

    $query = "select * from tagcloud_content;";
    $resultset = mysql_query($query, $connection);

    while($row = mysql_fetch_assoc($resultset)){
        parse_content($row['post_content']);
    }
}

// given a single news article, strip the HTML, remove the stopwords then send the rest off to be counted
function parse_content($post_content) {
    $stripped = strip_tags($post_content);

    include("stopwords.php");

    foreach($stopwords as $word) {
        // \b is word boundary
        $stripped = preg_replace("/\b$word\b/i", "", strtolower($stripped));
    }

    //echo $stripped;
    count_words($stripped);
}

/**
 * Takes a string and counts how often each word in it appears
 */
function count_words($string) {
    /**
     * get the input string from the post and then tokenize it to get each word, save the words in an array
     * in case the word is repeated add '1' to the existing words counter
    */
        $count=0;
        $tok = strtok($string, " \t,;.\'\"!&-`\n\r\/"); //considering line-return,line-feed,white space,comma,ampersand,tab,etc... as word separator

        if(strlen($tok) > 0) {
            $tok = strtolower($tok);
        }

        $words = array();
        $words[$tok] = 1;
        // make sure to ignore single-character strings
        while ($tok !== false) {
            //echo "Word=$tok<br />";
            $tok = strtok(" \t,;.\'\"!&-`\n\r“");
            if(strlen($tok)>1) {
                $tok=strtolower($tok);
                if($words[$tok]>=1){
                    $words[$tok]=$words[$tok] + 1;
                } else {
                    $words[$tok]=1;
                }
            }
        }
        // print_r($words);
        add_to_database($words);
}

// loop over words adding them to the database where they are new and updating WEIGHT where they are not
function add_to_database($words) {
    $connection = mysql_connect("localhost", "root", "");

    mysql_select_db("tagcloudtest", $connection);

    foreach($words as $tag => $weight){
        $query = "INSERT INTO tagcloud_tags (tag, weight) VALUES ('".$tag."', ".$weight.") ON DUPLICATE KEY UPDATE weight = weight + $weight";
        if(!mysql_query($query, $connection)) {
            if(mysql_errno($connection) == 1062){ // if it's a duplicate, do an UPDATE instead
                update_entry($connection, $table, $keyword, $weight);
            }
        }

    }
}

delete_all_weights();
parse_all_content();
?>