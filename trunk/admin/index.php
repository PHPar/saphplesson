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

$action = $_GET["action"];

switch ($action) {
    case 'menu':
        echo $tpl->display("menu.tpl");
    break;
    /*------------------------------------------------------------------------*/
    case 'Welcome':
        $num = array();
        $num['lsn']    = intval($db->get_var('select count(*) from less'));
        $num['active'] = intval($db->get_var('select count(*) from less where Hidden="0"'));
        $num['uctive'] = intval($db->get_var('select count(*) from less where Hidden=1'));
        $num['cats']   = intval($db->get_var('select count(*) from forums'));
        $num['admins'] = intval($db->get_var('select count(*) from modretor'));
        $num['cmnts']  = intval($db->get_var('select count(*) from comment'));
        $num['online'] = intval($db->get_var('select count(*) from online'));
        $num['attach'] = intval($db->get_var('select count(*) from attachments'));
        if($Premission[8]){
        $notepad = $db->get_var("select ModNote from modretor Where
                                                ModName='".$SaphpUser."' and
                                                ModPassword='".$SaphpPass."'");
        }
        echo $tpl->display("welcome.tpl");
    break;
    /*------------------------------------------------------------------------*/
    case 'phpinfo':
        if(!$Premission[7]){
          $MSG["TITLE"]   = "·ÊÕ… «· Õﬂ„";
          $MSG["Error"]   = "·« ÌÊÃœ ·œÌﬂ ’·«ÕÌ«  ·œŒÊ· Â–Â «·’›Õ…";
          $MSG["Referer"] = "login.php";
          echo $tpl->display("msgbox.tpl");
          exit;
        }
        phpinfo();
        echo '<div style="text-align: center;" dir="rtl">'.
             '”ﬂ—»  «·œ—Ê” «·⁄—»Ì 4.0'.
             '<br />'.
             '<a href="http://www.saphplesson.org">http://www.saphplesson.org</a>'.
             '</div>';
    break;
    /*------------------------------------------------------------------------*/
    case 'updatenote':
        if($_POST['Notepad'] AND $Premission[8]){
		    $Notepad = htmlspecialchars($_POST['Notepad']);
            $notepad = $db->get_var("update modretor SET ModNote='".$Notepad."' Where
                                                    ModName='".$SaphpUser."' and
                                                    ModPassword='".$SaphpPass."'");
        }
        header("location: index.php?action=Welcome");
    break;
    /*------------------------------------------------------------------------*/
    default:
        echo $tpl->display("adminindex.tpl");
    break;
}
?>