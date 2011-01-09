<?php

    $connection = mysql_connect("localhost", "root", "");
    $table="tagcloudtest";
    $words=array();
    mysql_select_db($table,$connection);
    $query="SELECT tag, weight FROM tagcloud_tags where weight > 10;";

    if($resultset=mysql_query($query, $connection)){
        while($row=mysql_fetch_assoc($resultset)){
            $words[$row['tag']] = $row['weight'];
        }
    }
// Incresing this number will make the words bigger; Decreasing will do reverse
$factor = 0.5;

// Smallest font size possible
$starting_font_size = 12;

// Tag Separator
$tag_separator = '&nbsp; &nbsp; &nbsp;';
$max_count = array_sum($words);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
    <head>
        <title> tag cloud generator </title>
    </head>
<body>
<center>
<div align='center' class='tags_div'>
<?php
foreach($words as $tag => $weight ) {
    $x = round(($weight)) * $factor;

    $font_size = $starting_font_size + $x.'px';

    echo "<span style='font-size: ".$font_size."; color: #676F9D;'>".$tag."</span>".$tag_separator;
}
?>
</div></center>
</body>
</html>
