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
if(!$Premission[0]){
    $MSG["TITLE"]   = "áæÍÉ ÇáÊÍßã";
    $MSG["Error"]   = "áÇ íæÌÏ áÏíß ÕáÇÍíÇÊ áÏÎæá åÐå ÇáÕÝÍÉ";
    $MSG["Referer"] = "login.php";
    echo $tpl->display("msgbox.tpl");
    exit;
}
$action = $_GET["action"];

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $fields = array("sitetitle","adminmail","SiteLink","SiteStyle","DateFormat",
    "SiteStatus","StatusText","PageNO","VisitedAdd","HiDaN","TextBox","SaveWord",
    "SavePDF","Comment","CmntNO","Attach","ASize","SrchLink","Sitemap","NoFollow",
    "SEO1","SEO2","Meta1","Meta2","Show_RSS","RssCount","Captcha");

    $Captcha = "";

    for ($i=0; $i<=4; $i++)  {
        if($_POST["Captcha"][$i]){
            $Captcha .= (strlen($Captcha) ? ",1" : "1");
        }else{
            $Captcha .= (strlen($Captcha) ? ",0" : "0");
        }
    }

    $update = "";

    foreach ($fields as $value) {
        if($value=="Captcha"){
            $update .= ($update ? ",Captcha='".$Captcha."'" : "Captcha='".$Captcha."'");
        }else{
            $update .= ($update ? ",".$value."='".$_POST[$value]."'" : $value."='".$_POST[$value]."'");
        }
    }

    $Query = $db->query("UPDATE setting SET ".$update." WHERE setid=1");

    if($Query){
        $MSG["TITLE"] = "ÅÚÏÇÏÇÊ ÇáÓßÑÈÊ";
        $MSG["OK"]    = "Êã ÍÝÙ ÇáÅÚÏÇÏÇÊ ÈäÌÇÍ";
    }else{
        $MSG["TITLE"] = "ÅÚÏÇÏÇÊ ÇáÓßÑÈÊ";
        $MSG["Error"] = "åäÇß ãÔßáÉ Ýí ÞÇÚÏÉ ÇáÈíÇäÇÊ áã íÊã ÍÝÙ ÇáÅÚÏÇÏÇÊ ÇáÌÏíÏÉ";
    }
    echo $tpl->display("msgbox.tpl");
    exit;
}
$styles = get_styles("../style");
$stylen = count($styles);
$captcha = explode(",",$settings["Captcha"]);
echo $tpl->display("settings.tpl");
?>