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

if($settings['Sitemap']){
    header('Content-Type: text/xml');
    echo '<?xml version="1.0" encoding="windows-1256"?>'. "\r\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">',"\r\n";
    echo "\t<url>\r\n";
    echo "\t\t<changefreq>weekly</changefreq>\r\n";
    echo "\t\t<priority>1.0</priority>\r\n";
    echo "\t\t<loc>".$settings['SiteLink']."</loc>\r\n";
    echo "\t</url>\r\n";
    $cats = $db->get_results("select id from forums order by id DESC");
    $ncat = count($cats);
    if($ncat){
        for ($i=0; $i<=$ncat-1; $i++){
            echo "\t<url>\r\n";
            echo "\t\t<changefreq>weekly</changefreq>\r\n";
            echo "\t\t<priority>0.9</priority>\r\n";
            echo "\t\t<loc>".$settings['SiteLink']."/".($settings['SrchLink'] ? "cat-".$cats[$i]['id']."-1.html" : "showcat.php?id=".$lsns[$i]['id'])."</loc>\r\n";
            echo "\t</url>\r\n";
        }
    }
    $lsns = $db->get_results("select lessdate,lessid from less where Hidden='0' order by lessid DESC");
    $nlsn = count($lsns);
    if($nlsn){
        for ($i=0; $i<=$nlsn-1; $i++){
            echo "\t<url>\r\n";
            echo "\t\t<changefreq>weekly</changefreq>\r\n";
            echo "\t\t<priority>0.8</priority>\r\n";
            echo "\t\t<lastmod>".$lsns[$i]['lessdate']."</lastmod>\r\n";
            echo "\t\t<loc>".$settings['SiteLink']."/".($settings['SrchLink'] ? "lesson-".$lsns[$i]['lessid']."-1.html" : "show.php?L=".$lsns[$i]['lessid'])."</loc>\r\n";
            echo "\t</url>\r\n";
        }
    }
    echo "</urlset>";
}
?>