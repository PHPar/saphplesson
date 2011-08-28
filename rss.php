<?php
/*#####################################################################*|
|                          SaphpLesson4.0                               |
| --------------------------------------------------------------------- |
|  This Script Is Free To Use But don't Delete copyright                |
|  Programmed By : Saleh AlMatrafe                                      |
|  Mobile : +966505545229 | Skype phone : saphps                        |
|  http://www.saphplesson.org  |  saphplesson@live.com(mail only)       |
|*#####################################################################*/

require_once('./global.php');

if($settings['Show_RSS']){
    require_once('./includes/replace.php');
    header('Content-Type: text/xml');
    echo '<?xml version="1.0" encoding="windows-1256"?>'. "\r\n";
    echo '<rss version="2.0"'
    	.' xmlns:content="http://purl.org/rss/1.0/modules/content/"'
    	.' xmlns:wfw="http://wellformedweb.org/CommentAPI/"'
    	.' xmlns:dc="http://purl.org/dc/elements/1.1/"'
    	.' xmlns:atom="http://www.w3.org/2005/Atom"'
    	.' >'."\r\n";
    echo "<channel>\r\n";
    echo "\t<title>".$settings['sitetitle']."</title>\r\n";
    echo "\t<link>".$settings['SiteLink']."</link>\r\n";
    echo "\t<description>".$settings['Meta1']."</description>\r\n";
    echo "\t<generator>http://www.saphplesson.org</generator>\r\n";
    echo "\t<language>ar</language>\r\n";
    $lsns = $db->get_results("select * from less,forums where less.Hidden='0' and forums.id=less.forumno order by less.lessid DESC LIMIT ".$settings['RssCount']);
    $nlsn = count($lsns);
    if($nlsn){
        for ($i=0; $i<=$nlsn-1; $i++){
            $lsns[$i]['lesstitle'] = htmlspecialchars($lsns[$i]['lesstitle']);
            echo "\t<item>\r\n";
            echo "\t\t<title>".$lsns[$i]['lesstitle']."</title>\r\n";
            echo "\t\t<dc:creator>".$lsns[$i]['Writer']."</dc:creator>\r\n";
            echo "\t\t<pubDate>".$lsns[$i]['lessdate']."</pubDate>\r\n";
            echo "\t\t<category>".$lsns[$i]['Title']."</category>\r\n";
            echo "\t\t<link>".$settings['SiteLink']."/".($settings['SrchLink'] ? "lesson-".$lsns[$i]['lessid']."-1.html" : "show.php?L=".$lsns[$i]['lessid'])."</link>\r\n";
            echo "\t\t<comments>".$settings['SiteLink']."/".($settings['SrchLink'] ? "lesson-".$lsns[$i]['lessid']."-1.html" : "show.php?L=".$lsns[$i]['lessid'])."#comments</comments>\r\n";
            echo "\t\t<content:encoded><![CDATA[".replace($lsns[$i]['less'])."]]></content:encoded>\r\n";
            echo "\t</item>\r\n";
        }
    }
    echo "</channel>\r\n";
    echo "</rss>";
}
?>