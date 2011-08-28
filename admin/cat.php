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
if(!$Premission[3]){
    $MSG["TITLE"]   = "áæÍÉ ÇáÊÍßã";
    $MSG["Error"]   = "áÇ íæÌÏ áÏíß ÕáÇÍíÇÊ áÏÎæá åÐå ÇáÕÝÍÉ";
    $MSG["Referer"] = "login.php";
    echo $tpl->display("msgbox.tpl");
    exit;
}
$action = $_GET["action"];

switch ($action) {
case "add":
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        if($_POST["Title"]){
            $Title       = htmlspecialchars($_POST["Title"]);
            $CatImg      = $_POST["CatImg"];
            $COrder      = intval($_POST["COrder"]);
            $CatID       = intval($_POST["CatID"]);
            $Description = htmlspecialchars($_POST["Description"]);
            $Query = $db->query("INSERT INTO forums SET Title='".$Title."',CatImg='".$CatImg."',COrder='".$COrder."',CatID='".$CatID."',Description='".$Description."'");
            if($Query){
                $MSG["TITLE"] = "ÅÖÇÝÉ ÞÓã";
                $MSG["OK"]    = "Êã ÅÖÇÝÉ ÇáÞÓã ÈäÌÇÍ";
                $MSG["Referer"] = "cat.php";
            }else{
                $MSG["TITLE"] = "ÅÖÇÝÉ ÞÓã";
                $MSG["Error"] = "åäÇß ãÔßáÉ Ýí ÞÇÚÏÉ ÇáÈíÇäÇÊ áã íÊã ÅÖÇÝÉ ÇáÞÓã";
            }
        }else{
            $MSG["TITLE"] = "ÅÖÇÝÉ ÞÓã";
            $MSG["Error"] = "ÚÝæÇð æáßä áã Êßãá ßá ÇáÍÞæá";
        }
        echo $tpl->display("msgbox.tpl");
        exit;
    }
    $cats = $db->get_results("select * from forums where CatID='0' order by id");
    $ncat = $db->get_var("select count(*) from forums where CatID='0' order by id");
    echo $tpl->display("cat_add.tpl");
    break;
case "edit":
    $id = intval($_GET["id"]);
    if($id){
        if ($_SERVER["REQUEST_METHOD"]=="POST"){
        if($_POST["Title"]){
            $Title       = htmlspecialchars($_POST["Title"]);
            $CatImg      = $_POST["CatImg"];
            $COrder      = intval($_POST["COrder"]);
            $CatID       = intval($_POST["CatID"]);
            $Description = htmlspecialchars($_POST["Description"]);
            $Query = $db->query("UPDATE forums SET Title='".$Title."',CatImg='".$CatImg."',COrder='".$COrder."',CatID='".$CatID."',Description='".$Description."' where id=".$id);
            if($Query){
                $MSG["TITLE"] = "ÊÚÏíá ÞÓã";
                $MSG["OK"]    = "Êã ÊÚÏíá ÇáÞÓã ÈäÌÇÍ";
                $MSG["Referer"] = "cat.php";
            }else{
                $MSG["TITLE"] = "ÊÚÏíá ÞÓã";
                $MSG["Error"] = "åäÇß ãÔßáÉ Ýí ÞÇÚÏÉ ÇáÈíÇäÇÊ áã íÊã ÊÚÏíá ÇáÞÓã";
            }
        }else{
            $MSG["TITLE"] = "ÊÚÏíá ÞÓã";
            $MSG["Error"] = "ÚÝæÇð æáßä áã Êßãá ßá ÇáÍÞæá";
        }
            echo $tpl->display("msgbox.tpl");
            exit;
        }
        $cat  = $db->get_row('select * from forums where id='.$id);
        $cats = $db->get_results("select * from forums where CatID='0' order by id");
        $ncat = $db->get_var("select count(*) from forums where CatID='0' order by id");
        echo $tpl->display("cat_edit.tpl");
    }
    break;
case "delete":
    $id = intval($_GET["id"]);
    if($id){
        $Query = $db->query('delete from forums where id='.$id);
        if($Query){
            $Query = $db->query('delete from less where forumno='.$id);
            $Query = $db->query('delete from attachments where ACat='.$id);
            $Query = $db->query('delete from comment where CCat='.$id);
            $MSG["TITLE"] = "ÇáÇÞÓÇã";
            $MSG["OK"]    = "Êã ÍÐÝ ÇáÞÓã æÌãíÚ ÇáÏÑæÓ æÇáÇÞÓÇã ÇáãÊÝÑÚÉ ãäå";
        }else{
            $MSG["TITLE"] = "ÇáÇÞÓÇã";
            $MSG["Error"] = "åäÇß ãÔßáÉ Ýí ÞÇÚÏÉ ÇáÈíÇäÇÊ áã íÊã ÍÐÝ ÇáÞÓã";
        }
        echo $tpl->display("msgbox.tpl");
    }
    break;
case "updateorder":
        foreach ($_POST["order"] as $key => $value) {
            $value = intval($value);
            $Query = $db->query("UPDATE forums SET COrder='".$value."' WHERE id='".$key."'");
        }
        $MSG["TITLE"] = "ÇáÇÞÓÇã";
        $MSG["OK"]    = "Êã ÊÍÏíË ÊÑÊíÈ ÇáÇÞÓÇã ÈäÌÇÍ";
        echo $tpl->display("msgbox.tpl");
    break;
default :
    $cats = $db->get_results("select * from forums order by COrder");
    $ncat = $db->get_var("select count(*) from forums order by COrder");
    if($ncat){
        for ($i=0; $i<=count($cats)-1; $i++){
            $cats[$i]["NLess"] = intval($db->get_var("select count(*) from less where forumno=".$cats[$i]["id"]));
            $cats[$i]["Description"] = nl2br($cats[$i]["Description"]);
        }
    }
    echo $tpl->display("cat.tpl");
}

?>