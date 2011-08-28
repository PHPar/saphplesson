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
if(!$Premission[6]){
    $MSG["TITLE"]   = "áæÍÉ ÇáÊÍßã";
    $MSG["Error"]   = "áÇ íæÌÏ áÏíß ÕáÇÍíÇÊ áÏÎæá åÐå ÇáÕÝÍÉ";
    $MSG["Referer"] = "login.php";
    echo $tpl->display("msgbox.tpl");
    exit;
}
$action = $_GET["action"];

switch ($action) {
case "add":
    if($_POST["FEXT"] AND $_POST["FType"] AND $_POST["FImage"]){
        $Query = $db->query("INSERT INTO attachtype SET FEXT='".$_POST["FEXT"]."',FType='".$_POST["FType"]."',FImage='".$_POST["FImage"]."'");
        if($Query){
            $MSG["TITLE"] = "ÇäæÇÚ ÇáãáÝÇÊ ÇáãÑÝÞÉ";
            $MSG["OK"]    = "Êã ÅÖÇÝÉ ÇáÇãÊÏÇÏ ÈäÌÇÍ";
        }else{
            $MSG["TITLE"] = "ÇäæÇÚ ÇáãáÝÇÊ ÇáãÑÝÞÉ";
            $MSG["Error"] = "åäÇß ãÔßáÉ Ýí ÞÇÚÏÉ ÇáÈíÇäÇÊ áã íÊã ÅÖÇÝÉ ÇáÇãÊÏÇÏ";
        }
    }else{
        $MSG["TITLE"] = "ÇäæÇÚ ÇáãáÝÇÊ ÇáãÑÝÞÉ";
        $MSG["Error"] = "ÚÝæÇð æáßä áã Êßãá ßá ÇáÍÞæá";
    }
    echo $tpl->display("msgbox.tpl");
    break;
case "editext":
    $id = $_GET["id"];
    if($id){
        if ($_SERVER["REQUEST_METHOD"]=="POST"){
            if($_POST["FEXT"] AND $_POST["FType"] AND $_POST["FImage"]){
                $Query = $db->query("UPDATE attachtype SET FEXT='".$_POST["FEXT"]."',FType='".$_POST["FType"]."',FImage='".$_POST["FImage"]."' WHERE FEXT='".$id."'");
                if($Query){
                    $MSG["TITLE"]   = "ÇäæÇÚ ÇáãáÝÇÊ ÇáãÑÝÞÉ";
                    $MSG["OK"]      = "Êã ÊÚÏíá ÇáÇãÊÏÇÏ ÈäÌÇÍ";
                    $MSG["Referer"] = "attach.php";
                }else{
                    $MSG["TITLE"] = "ÇäæÇÚ ÇáãáÝÇÊ ÇáãÑÝÞÉ";
                    $MSG["Error"] = "åäÇß ãÔßáÉ Ýí ÞÇÚÏÉ ÇáÈíÇäÇÊ áã íÊã ÊÚÏíá ÇáÇãÊÏÇÏ";
                }
            }else{
                $MSG["TITLE"] = "ÇäæÇÚ ÇáãáÝÇÊ ÇáãÑÝÞÉ";
                $MSG["Error"] = "ÚÝæÇð æáßä áã Êßãá ßá ÇáÍÞæá";
            }
            echo $tpl->display("msgbox.tpl");
            exit;
        }
        $ext = $db->get_row("select * from attachtype where FEXT='".$id."'");
        echo $tpl->display("ext_edit.tpl");
    }
    break;
case "delext":
    $id = $_GET["id"];
    if($id){
        $Query = $db->query('delete from attachtype where FEXT="'.$id.'"');

        if($Query){
            $MSG["TITLE"] = "ÇäæÇÚ ÇáãáÝÇÊ ÇáãÑÝÞÉ";
            $MSG["OK"]    = "Êã ÍÐÝ ÇáÇãÊÏÇÏ ÈäÌÇÍ";
        }else{
            $MSG["TITLE"] = "ÇäæÇÚ ÇáãáÝÇÊ ÇáãÑÝÞÉ";
            $MSG["Error"] = "åäÇß ãÔßáÉ Ýí ÞÇÚÏÉ ÇáÈíÇäÇÊ áã íÊã ÍÐÝ ÇáÇãÊÏÇÏ";
        }
        echo $tpl->display("msgbox.tpl");
    }
    break;
case "files":
    $files = $db->get_results("select less.lessid,less.lesstitle,less.lessdate,attachments.AID,attachments.AName,attachments.ACounter from attachments,less where attachments.AID<>'1' AND less.lessid = attachments.ALesson order by attachments.AID");
    $nfile = count($files);
    if($nfile){
        for ($i=0; $i<=$nfile-1; $i++){
            $files[$i]["Date"] = Hijri($files[$i]["lessdate"],$settings["DateFormat"]);
        }
    }
    echo $tpl->display("attach.tpl");
    break;
case "delete":
    $id = intval($_GET["id"]);
    if($id){
        $Query = $db->query('delete from attachments where AID='.$id);

        if($Query){
            $MSG["TITLE"] = "ÇáãáÝÇÊ ÇáãÑÝÞÉ";
            $MSG["OK"]    = "Êã ÍÐÝ ÇáãáÝ ÈäÌÇÍ";
        }else{
            $MSG["TITLE"] = "ÇáãáÝÇÊ ÇáãÑÝÞÉ";
            $MSG["Error"] = "åäÇß ãÔßáÉ Ýí ÞÇÚÏÉ ÇáÈíÇäÇÊ áã íÊã ÍÐÝ ÇáãáÝ";
        }
        echo $tpl->display("msgbox.tpl");
    }
    break;
case "download":
    $id = intval($_GET["id"]);
    if($id){
        $file = $db->get_row("select * from attachments where AID='".$id."'");
        if(!$file){
            $file = $db->get_row("select * from attachments where AID='1'");
            header("Content-disposition: inline; filename=ãáÝ ãÑÝÞ ÎÇØÆ.gif");
        }else{
            header("Content-disposition: inline; filename=".$file["AName"]);
        }
        header('Content-Type: application/octetstream');
        $filesize = strlen($file["AData"]);
        header("Content-Length: ".$filesize);
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $file["AData"];
    }
    break;
default :
    $atype  = $db->get_results("select * from attachtype order by FEXT");
    $atnum  = $db->get_var("select count(*) from attachtype order by FEXT");
    echo $tpl->display("attach_type.tpl");
}

?>