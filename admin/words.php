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
if(!$Premission[1]){
    $MSG["TITLE"]   = "בזֹֽ ַבÊֽßד";
    $MSG["Error"]   = "בַ םזּֿ בֿםß ױבַֽםַÊ בֿ־זב ו׀ו ַבױÝֹֽ";
    $MSG["Referer"] = "login.php";
    echo $tpl->display("msgbox.tpl");
    exit;
}
$action = $_GET["action"];

switch ($action) {
case "add":
    if($_POST["Word"] AND $_POST["Alt"]){
        $Query = $db->query("INSERT INTO words SET WFind='".$_POST["Word"]."',WReplace='".$_POST["Alt"]."'");
        if($Query){
            $MSG["TITLE"] = "ַבßבדַÊ ַבדדהזÚֹ";
            $MSG["OK"]    = "Êד ֵײַÝֹ ַבßבדֹ ָהַּֽ";
        }else{
            $MSG["TITLE"] = "ַבßבדַÊ ַבדדהזÚֹ";
            $MSG["Error"] = "והַß דװßבֹ Ýם ÞַÚֹֿ ַבָםַהַÊ בד םÊד ֵײַÝֹ ַבßבדֹ";
        }
    }else{
        $MSG["TITLE"] = "ַבßבדַÊ ַבדדהזÚֹ";
        $MSG["Error"] = "ÚÝזַנ זבßה בד Êßדב ßב ַבֽÞזב";
    }
    echo $tpl->display("msgbox.tpl");
    break;
case "edit":
    $id = intval($_GET["id"]);
    if($id){
        if ($_SERVER["REQUEST_METHOD"]=="POST"){
            if($_POST["Word"] AND $_POST["Alt"]){
                $Query = $db->query("UPDATE words SET WFind='".$_POST["Word"]."',WReplace='".$_POST["Alt"]."' WHERE WID=".$id);
                if($Query){
                    $MSG["TITLE"]   = "ַבßבדַÊ ַבדדהזÚֹ";
                    $MSG["OK"]      = "Êד ÊÚֿםב ַבßבדֹ ָהַּֽ";
                    $MSG["Referer"] = "words.php";
                }else{
                    $MSG["TITLE"] = "ַבßבדַÊ ַבדדהזÚֹ";
                    $MSG["Error"] = "והַß דװßבֹ Ýם ÞַÚֹֿ ַבָםַהַÊ בד םÊד ÊÚֿםב ַבßבדֹ";
                }
            }else{
                $MSG["TITLE"] = "ַבßבדַÊ ַבדדהזÚֹ";
                $MSG["Error"] = "ÚÝזַנ זבßה בד Êßדב ßב ַבֽÞזב";
            }
            echo $tpl->display("msgbox.tpl");
            exit;
        }
        $word = $db->get_row('select * from words where WID='.$id);
        echo $tpl->display("word_edit.tpl");
    }
    break;
case "delete":
    $id = intval($_GET["id"]);
    if($id){
        $Query = $db->query('delete from words where WID='.$id);

        if($Query){
            $MSG["TITLE"] = "ַבßבדַÊ ַבדדהזÚֹ";
            $MSG["OK"]    = "Êד ֽ׀Ý ַבßבדֹ ָהַּֽ";
        }else{
            $MSG["TITLE"] = "ַבßבדַÊ ַבדדהזÚֹ";
            $MSG["Error"] = "והַß דװßבֹ Ýם ÞַÚֹֿ ַבָםַהַÊ בד םÊד ֽ׀Ý ַבßבדֹ";
        }
        echo $tpl->display("msgbox.tpl");
    }
    break;
default :
    $words = $db->get_results("select * from words order by WID");
    $wnum  = $db->get_var("select count(*) from words order by WID");
    echo $tpl->display("words.tpl");
}

?>