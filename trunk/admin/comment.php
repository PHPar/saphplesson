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
if(!$Premission[5]){
    $MSG["TITLE"]   = "áæÍÉ ÇáÊÍßã";
    $MSG["Error"]   = "áÇ íæÌÏ áÏíß ÕáÇÍíÇÊ áÏÎæá åÐå ÇáÕÝÍÉ";
    $MSG["Referer"] = "login.php";
    echo $tpl->display("msgbox.tpl");
    exit;
}
$action = $_GET["action"];

switch ($action) {
case "lsn":
    $id = intval($_GET["id"]);
    if($id){
        $lsns = $db->get_results("SELECT COUNT(CID) As CTotal,lesstitle,lessdate,Writer,lessid FROM comment AS comment LEFT JOIN  less AS less ON (comment.CLsn = less.lessid) Where less.forumno=".$id." Group By less.lessid");
    }else{
        $lsns = $db->get_results("SELECT COUNT(CID) As CTotal,lesstitle,lessdate,Writer,lessid FROM comment AS comment LEFT JOIN  less AS less ON (comment.CLsn = less.lessid) Group By less.lessid");
    }
    $nlsn = count($lsns);
    if($nlsn){
        for ($i=0; $i<=$nlsn-1; $i++){
            $lsns[$i]["Date"] = Hijri($lsns[$i]["lessdate"],$settings["DateFormat"]);
        }
    }
    echo $tpl->display("comment_lsn.tpl");
    break;
case "cmnt":
    $id    = intval($_GET["id"]);
    if($id){
        $lsn   = $db->get_row('select lesstitle from less where lessid='.$id);
        $cmnts = $db->get_results("select * from comment where CLsn=".$id." order by CID");
        $ncmnt = $db->get_var("select count(*) from comment where CLsn=".$id);
        if($ncmnt){
            for ($i=0; $i<=$ncmnt-1; $i++){
                $cmnts[$i]["Date"] = Hijri($cmnts[$i]["CDate"],$settings["DateFormat"]);
                $cmnts[$i]["Cmnt"] = nl2br($cmnts[$i]["Cmnt"]);
            }
        }
        echo $tpl->display("comment.tpl");
    }else{
        $MSG["TITLE"]   = "ÇáÊÚáíÞÇÊ";
        $MSG["Error"]   = "ÚÐÑÇð æáßä áã ÊÞã ÈßÊÇÈÉ ÑÞã ÇáÏÑÓ";
        echo $tpl->display("msgbox.tpl");
    }
    break;
case "delete":
    if($_POST["c"]){
        foreach ($_POST["c"] as $key => $value) {
            $key = intval($key);
            $Query = $db->query("delete from comment where CID=".$key);
        }
        $MSG["TITLE"] = "ÇáÊÚáíÞÇÊ";
        $MSG["OK"]    = "Êã ÍÐÝ ÇáÊÚáíÞÇÊ ÇáãÍÏÏÉ ÈäÌÇÍ";
    }else{
        $MSG["TITLE"]   = "ÇáÊÚáíÞÇÊ";
        $MSG["Error"]   = "ÚÐÑÇð æáßä áã ÊÞã ÈÊÍÏíÏ ÊÚáíÞÇÊ áÍÐÝåÇ";
    }
    echo $tpl->display("msgbox.tpl");
    break;
case "bycat":
    $cats = $db->get_results("select * from forums order by COrder");
    $ncat = $db->get_var("select count(*) from forums order by COrder");
    if($ncat){
        for ($i=0; $i<=count($cats)-1; $i++){
            $lsns = $db->get_results("SELECT COUNT(CID) As CTotal,lesstitle,lessdate,Writer,lessid FROM comment AS comment LEFT JOIN  less AS less ON (comment.CLsn = less.lessid) Where less.forumno=".$cats[$i]["id"]." Group By less.lessid");
            $cats[$i]["NLess"] = count($lsns);
            $cats[$i]["Description"] = nl2br($cats[$i]["Description"]);
        }
    }
    echo $tpl->display("comment_cat.tpl");
    break;
case "byid":
    echo $tpl->display("comment_id.tpl");
    break;
default :
    header("location: comment.php?action=lsn");
}

?>