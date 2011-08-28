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

/*******************************Get General Stats******************************/
$update = $db->query('UPDATE setting SET counter=counter+1 WHERE setid=1');
$online  = intval($db->get_var('select count(*) from online'));
$lsnnum  = intval($db->get_var("select count(*) from less where Hidden='0'"));
$lsnrnd  = $db->get_row("select * from less where Hidden='0' order by RAND(".date('H').") LIMIT 0,1");
$last10  = $db->get_results("select * from less where Hidden='0' order by lessid DESC LIMIT 10");
$islast  = count($last10);

/********************************Get Categories********************************/
$cats    = $db->get_results('select * from forums where CatID=0 order by COrder');
$ncat    = count($cats);
$x       = 0;
if($ncat){
    for ($i=0; $i<=$ncat-1; $i++){
        $cats[$i]['NLess'] = intval($db->get_var("SELECT count(*) FROM less AS less LEFT JOIN  forums AS forums ON (forums.CatID = ".$cats[$i]["id"].") WHERE ((less.forumno=".$cats[$i]["id"]." OR less.forumno = forums.id) AND less.Hidden='0')"));
        $cats[$i]['Description'] = nl2br($cats[$i]['Description']);
        $x = ($x==5 ? 1 : $x+1);
        $cats[$i]['x'] = $x;
    }
}

/***********************************Echo Page**********************************/
$PageTitle = "ÇáÕÝÍÉ ÇáÑÆíÓíÉ";
$Current   = "index";
echo $tpl->display('header.htm');
echo $tpl->display('main.htm');
echo $tpl->display('footer.htm');
?>