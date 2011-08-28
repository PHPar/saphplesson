<?php
/*#####################################################################*|
|                          SaphpLesson4.0                               |
| --------------------------------------------------------------------- |
|  This Script Is Free To Use But don't Delete copyright                |
|  Programmed By : Saleh AlMatrafe                                      |
|  Mobile : +966505545229 | Skype phone : saphps                        |
|  http://www.saphplesson.org  |  saphplesson@live.com(mail only)       |
|*#####################################################################*/

session_start();

/**************************Include Classes and Config**************************/
require_once('../includes/config.php');
require_once('../includes/easytemplate.php');
require_once('../includes/mysql.php');
require_once('../includes/functions.php');

/********************************Handle Classes********************************/
$tpl = new EasyTemplate('templates','../cache');
$db  = new db($SQL_USER,$SQL_PWD,$SQL_DB,$SQL_HOST);

/**************************check install folder exist**************************/
if(file_exists("../install/install.php") == true or file_exists("../install/upgrade.php") == true){
    $MSG["TITLE"] = "”я—»  «бѕ—ж” «бЏ—»н";
    $MSG["Error"] = "нћ» Ќ–Ё гћбѕ install жћгнЏ гЌ жн« е Ќ м   гяд гд ѕќжб бжЌ… «б Ќяг";
    echo $tpl->display("msgbox.tpl");
    exit;
}
/******************************Get Script Settings*****************************/
$settings = $db->get_row("select * from setting where setid='1'");
$MSG["Referer"] = $_SERVER["HTTP_REFERER"]; //Get Default Referer
/*******************************Check If Log In********************************/
$SaphpUser  = CleanVar($_SESSION["SaphpUserName"]);
$SaphpPass  = CleanVar($_SESSION["SaphpPassword"]);
$IsLogin    = $db->get_var("select count(*) from modretor Where
                                                ModName='".$SaphpUser."' and
                                                ModPassword='".$SaphpPass."'");
if (!$IsLogin AND !$loginpage){
    echo $tpl->display("login.tpl");
    exit;
}
$Premission = $db->get_var("select Validities from modretor Where
                                                ModName='".$SaphpUser."' and
                                                ModPassword='".$SaphpPass."'");
$Premission = explode(",",$Premission);
?>