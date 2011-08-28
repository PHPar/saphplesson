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
if(!$Premission[4]){
    $MSG['TITLE']   = 'áæÍÉ ÇáÊÍßã';
    $MSG['Error']   = 'áÇ íæÌÏ áÏíß ÕáÇÍíÇÊ áÏÎæá åĞå ÇáÕİÍÉ';
    $MSG['Referer'] = 'login.php';
    echo $tpl->display('msgbox.tpl');
    exit;
}
$action = $_GET['action'];

switch ($action) {
case 'add':
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        require_once('../includes/wysiwyg.php');
        if($settings['TextBox']){
            $lesson = add_slashes(XSS_Remove(convert_wysiwyg_html_to_bbcode(stripslashes($_POST['WYSIWYG_HTML']))));
        }else{
            $lesson = add_slashes(XSS_Remove($_POST['less']));
        }
        $lesson = str_replace("'","&quot;",$lesson);
        $userip = real_ip();
        $Writer = htmlspecialchars($_POST['Writer']);
        $lesstitle = htmlspecialchars($_POST['lesstitle']);
        $mail = $_POST['mail'];
        $site = $_POST['site'];
        $active = intval($_POST['active']);
        $forumno = intval($_POST['forumno']);
        $ico = intval($_POST['ico']);
        $Attach = $_FILES['Attach']['name'];
        $istype = 0;
        if($Attach){
            $ASize  = $_FILES['Attach']['size'];
            $MaxSize= $settings['ASize']*1024;
            if($ASize > $MaxSize){
                $MSG['TITLE'] = 'ÇáÏÑæÓ';
                $MSG['Error'] = 'ÍÌã Çáãáİ ÇáãÑİŞ ÇáĞí ŞãÊ ÈÅÖÇİÊå ÇßÈÑ ãä ÇáãÓãæÍ '.$settings['ASize'].' ßíáæÈÇíÊ';
                echo $tpl->display('msgbox.tpl');
                exit;
            }
            $ext    = strrchr($Attach,'.');
            $istype = $db->get_var("select count(*) from attachtype where FEXT='$ext'");
            if(!$istype){
                $MSG['TITLE'] = 'ÇáÏÑæÓ';
                $MSG['Error'] = 'äæÚ Çáãáİ ÇáãÑİŞ ÇáĞí ÇÖİÊå ÛíÑ ãÓãæÍ';
                echo $tpl->display('msgbox.tpl');
                exit;
            }
        }
        $Query = $db->query("INSERT INTO less SET Hidden='$active',forumno='$forumno',Writer='$Writer',mail='$mail',site='$site',IP='$userip',icon='$ico',lesstitle='$lesstitle',less='$lesson',lessdate=CURDATE(),View=0,Votes=0,Rate=0");
        if($Query){
            if($istype){
                $lsnid = mysql_insert_id();
                $AttachFile = $_FILES['Attach']['tmp_name'];
                $AData = addslashes(fread(fopen($AttachFile, 'r'), $ASize));
                $Query = $db->query("INSERT INTO attachments SET AName='$Attach', AData ='$AData', ALesson='$lsnid', ACat='$forumno',AEXT='$ext'");
            }
            $MSG['TITLE'] = 'ÇáÏÑæÓ';
            $MSG['OK']    = 'Êã ÅÖÇİÉ ÇáÏÑÓ ÈäÌÇÍ';
            $MSG['Referer'] = ($active ? 'lesson.php?action=active' : 'lesson.php');
        }else{
            $MSG['TITLE'] = 'ÇáÏÑæÓ';
            $MSG['Error'] = 'åäÇß ãÔßáÉ İí ŞÇÚÏÉ ÇáÈíÇäÇÊ áã íÊã ÅÖÇİÉ ÇáÏÑÓ';
        }
        echo $tpl->display('msgbox.tpl');
        exit;
    }
    $Brwoser = CheckBrowser();
    if($settings['TextBox']){
        $TextBox = $tpl->display('wysiwyg.tpl');
    }else{
        $TextBox = $tpl->display('nowysiwyg.tpl');
    }
    $cats = $db->get_results('select * from forums order by COrder');
    $ncat = $db->get_var('select count(*) from forums order by COrder');
    echo $tpl->display('lsn_add.tpl');
    break;
case 'edit':
    $id = intval($_GET['id']);
    if($id){
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            require_once('../includes/wysiwyg.php');
            if($settings['TextBox']){
                $lesson = add_slashes(XSS_Remove(convert_wysiwyg_html_to_bbcode(stripslashes($_POST['WYSIWYG_HTML']))));
            }else{
                $lesson = add_slashes(XSS_Remove($_POST['less']));
            }
            $lesson = str_replace("'","&quot;",$lesson);
            $userip = real_ip();
            $Writer = htmlspecialchars($_POST['Writer']);
            $lesstitle = htmlspecialchars($_POST['lesstitle']);
            $mail = $_POST['mail'];
            $site = $_POST['site'];
            $active = intval($_POST['active']);
            $forumno = intval($_POST['forumno']);
            $ico = intval($_POST['ico']);
            $Attach = $_FILES['Attach']['name'];
            $istype = 0;
            if($Attach){
                $ASize  = $_FILES['Attach']['size'];
                $MaxSize= $settings['ASize']*1024;
                if($ASize > $MaxSize){
                    $MSG['TITLE'] = 'ÇáÏÑæÓ';
                    $MSG['Error'] = 'ÍÌã Çáãáİ ÇáãÑİŞ ÇáĞí ŞãÊ ÈÅÖÇİÊå ÇßÈÑ ãä ÇáãÓãæÍ '.$settings['ASize'].' ßíáæÈÇíÊ';
                    echo $tpl->display('msgbox.tpl');
                    exit;
                }
                $ext    = strrchr($Attach,'.');
                $istype = $db->get_var("select count(*) from attachtype where FEXT='$ext'");
                if(!$istype){
                    $MSG['TITLE'] = 'ÇáÏÑæÓ';
                    $MSG['Error'] = 'äæÚ Çáãáİ ÇáãÑİŞ ÇáĞí ÇÖİÊå ÛíÑ ãÓãæÍ';
                    echo $tpl->display('msgbox.tpl');
                    exit;
                }
            }
            $Query = $db->query("UPDATE less SET Hidden='$active',forumno='$forumno',Writer='$Writer',mail='$mail',site='$site',IP='$userip',icon='$ico',lesstitle='$lesstitle',less='$lesson' WHERE lessid=".$id);
            if($Query){
                if($istype){
                    $AttachFile = $_FILES['Attach']['tmp_name'];
                    $AData = addslashes(fread(fopen($AttachFile, 'r'), $ASize));
                    if($_POST['doattach']=='update'){
                        $Query = $db->query("UPDATE attachments SET AName='$Attach', AData ='$AData', ACat='$forumno',AEXT='$ext' WHERE ALesson=".$id);
                    }else{
                        $Query = $db->query("INSERT INTO attachments SET AName='$Attach', AData ='$AData', ALesson='$id', ACat='$forumno',AEXT='$ext'");
                    }
                }
                $MSG['TITLE'] = 'ÇáÏÑæÓ';
                $MSG['OK']    = 'Êã ÊÚÏíá ÇáÏÑÓ ÈäÌÇÍ';
                $MSG['Referer'] = ($active ? 'lesson.php?action=active' : 'lesson.php');
            }else{
                $MSG['TITLE'] = 'ÇáÏÑæÓ';
                $MSG['Error'] = 'åäÇß ãÔßáÉ İí ŞÇÚÏÉ ÇáÈíÇäÇÊ áã íÊã ÊÚÏíá ÇáÏÑÓ';
            }
            echo $tpl->display('msgbox.tpl');
            exit;
        }
        $lsn  = $db->get_row('select * from less where lessid='.$id);
        $Brwoser = CheckBrowser();
        if($settings["TextBox"]){
            include("../includes/replace.php");
            $lsn["less"] = htmlspecialchars(WYSIWYGReplace($lsn["less"]));
            $TextBox = $tpl->display("wysiwyg.tpl");
        }else{
            $lsn["less"] = htmlspecialchars($lsn["less"]);
            $TextBox = $tpl->display("nowysiwyg.tpl");
        }
        $cats = $db->get_results("select * from forums order by COrder");
        $ncat = count($cats);
        $isattach  = $db->get_var("select count(*) from attachments where ALesson='$id'");
        echo $tpl->display("lsn_edit.tpl");
    }
    break;
case "delete":
    $id = intval($_GET["id"]);
    if($id){

        $Query = $db->query("delete from less where lessid=".$id);

        if($Query){
            $Query = $db->query("delete from comment where CLsn=".$id);
            $Query = $db->query("delete from attachments where ALesson=".$id);
            $MSG['TITLE'] = "ÇáÏÑæÓ";
            $MSG['OK']    = "Êã ÍĞİ ÇáÏÑÓ ÈäÌÇÍ";
        }else{
            $MSG['TITLE'] = "ÇáÏÑæÓ";
            $MSG["Error"] = "åäÇß ãÔßáÉ İí ŞÇÚÏÉ ÇáÈíÇäÇÊ áã íÊã ÍĞİ ÇáÏÑÓ";
        }
        echo $tpl->display("msgbox.tpl");
    }
    break;
case "event":
    if($_POST["Active"]){
        $event = "ÊİÚíá";
    }elseif($_POST["UnActive"]){
        $event = "ÊÚØíá";
    }elseif($_POST["Delete"]){
        $event = "ÍĞİ";
    }
    if($_POST["l"]){
        foreach ($_POST["l"] as $key => $value) {
            $key = intval($key);
            if($_POST["Active"]){
                $Query = $db->query("UPDATE less SET Hidden='0' WHERE lessid=".$key);
            }elseif($_POST["UnActive"]){
                $Query = $db->query("UPDATE less SET Hidden='1' WHERE lessid=".$key);
            }elseif($_POST["Delete"]){
                $Query = $db->query("delete from comment where CLsn=".$key);
                $Query = $db->query("delete from attachments where ALesson=".$key);
                $Query = $db->query("delete from less where lessid=".$key);
            }
        }
        $MSG['TITLE'] = "ÇáÏÑæÓ";
        $MSG['OK']    = "Êã $event ÇáÏÑæÓ ÇáãÍÏÏÉ ÈäÌÇÍ";
    }else{
        $MSG['TITLE']   = "ÇáÏÑæÓ";
        $MSG["Error"]   = 'ÚĞÑÇø æáßä áã ÊŞã ÈÊÍÏíÏ ÏÑæÓ á'.$event.'åÇ';
    }
    echo $tpl->display("msgbox.tpl");
    break;
case 'show':
    $id = intval($_GET['id']);
    if($id){
        $lsn  = $db->get_row('select * from less where lessid='.$id);
        $atch = $db->get_row('select * from attachments where ALesson='.$id);
        include('../includes/replace.php');
        $lsn['less'] = Replace($lsn['less']);
        $lsn['less'] = str_replace('images/icon','../images/icon',$lsn['less']);
        echo $tpl->display('lsn_show.tpl');
    }
    break;
case 'active':
    $page  = intval($_GET['page']);
    if(!$page) $page = 1;
    $from  =($page-1)*25;
    $lsns  = $db->get_results("select * from less where Hidden!='0' order by lessid DESC  LIMIT $from,25");
    $anum  = $db->get_var("select count(*) from less where Hidden!='0'");
    $nlsn  = count($lsns);
    $pnum  =(int) ((($anum-1)/25)+1);
    if($nlsn){
        for ($i=0; $i<=$nlsn-1; $i++){
            $lsns[$i]['Date']      = Hijri($lsns[$i]['lessdate'],$settings['DateFormat']);
            $lsns[$i]['lesstitle'] = htmlspecialchars($lsns[$i]['lesstitle']);
            $lsns[$i]['Writer'] = htmlspecialchars($lsns[$i]['Writer']);
        }
    }
    $pager = pager($pnum,$page,"lesson.php?action=active&page=%d");
    echo $tpl->display('lessons_active.tpl');
    break;
default :
    $page  = intval($_GET["page"]);
    if(!$page) $page = 1;
    $from  =($page-1)*25;
    $lsns  = $db->get_results("select * from less where Hidden='0' order by lessid DESC  LIMIT $from,25");
    $anum  = $db->get_var("select count(*) from less where Hidden='0'");
    $nlsn  = count($lsns);
    $pnum  =(int) ((($anum-1)/25)+1);
    if($nlsn){
        for ($i=0; $i<=$nlsn-1; $i++){
            $lsns[$i]["Date"]      = Hijri($lsns[$i]["lessdate"],$settings["DateFormat"]);
            $lsns[$i]["lesstitle"] = htmlspecialchars($lsns[$i]["lesstitle"]);
            $lsns[$i]["Writer"] = htmlspecialchars($lsns[$i]["Writer"]);
        }
    }
    $pager = pager($pnum,$page,"lesson.php?page=%d");
    echo $tpl->display("lessons.tpl");
}

?>