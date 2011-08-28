<?php
/*#####################################################################*|
|                          SaphpLesson4.0                               |
| --------------------------------------------------------------------- |
|  This Script Is Free To Use But don't Delete copyright                |
|  Programmed By : Saleh AlMatrafe                                      |
|  Mobile : +966505545229 | Skype phone : saphps                        |
|  http://www.saphplesson.org  |  saphplesson@live.com(mail only)       |
|*#####################################################################*/

/**************************Include Classes and Config**************************/
require_once('./includes/config.php');
require_once('./includes/easytemplate.php');
require_once('./includes/mysql.php');
require_once('./includes/functions.php');

/********************************Handle Classes********************************/
$db  = new db($SQL_USER,$SQL_PWD,$SQL_DB,$SQL_HOST);

/******************************Get Script Settings*****************************/
$settings = $db->get_row("select * from setting where setid='1'");
$MSG['Referer'] = $_SERVER['HTTP_REFERER']; //Get Default Referer
$tpl = new EasyTemplate('./style/'.$settings['SiteStyle'],'./cache');

if($settings['SiteStatus']){
    $MSG['Title'] = $settings['sitetitle'];
    $MSG['Content'] = $settings['StatusText'];
    echo $tpl->display('header.htm');
    echo $tpl->display('msgbox.htm');
    echo $tpl->display('footer.htm');
    exit;
}

/*****************************Update online Table******************************/
$userip = real_ip();
if(!validateIpAddress($userip))
{
    $userip = '172.0.0.1';
}
$time   = time();
$isonline    = $db->get_var("select count(*) from online where IP='$userip'");
if($isonline){
    $db->query("update online set Time='$time' where ip='$userip'");
}else{
    $db->query("insert into online SET IP='$userip', Time ='$time'");
}
$userexpired = $time - 300;
$db->query("delete from online where Time < '$userexpired'");
?>