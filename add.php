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
$Captcha   = explode(',',$settings['Captcha']);
if($Captcha[0]){
		session_start();
}

if(!$settings['VisitedAdd']){
    $MSG['Title'] = $settings['sitetitle'];
    $MSG['Content'] = '����� ��� ��� ����� ������ ������ ����';
    echo $tpl->display('header.htm');
    echo $tpl->display('msgbox.htm');
    echo $tpl->display('footer.htm');
    exit;
}

if ($_SERVER['REQUEST_METHOD']=='POST')
{
    $id = intval($_POST['forumid']);
    if(!$id){
        $MSG['Title'] = $settings['sitetitle'];
        $MSG['Content'] = '����� ������ ��� ����� �� ��� ��� ����� ���� ���� ������ ����� ������ ';
        echo $tpl->display('header.htm');
        echo $tpl->display('msgbox.htm');
        echo $tpl->display('footer.htm');
        exit;
    }
    $cinfo = $db->get_row("select Title,CatID from forums where id='$id'");
    if(!$cinfo['Title']){
        $MSG['Title'] = $settings['sitetitle'];
        $MSG['Content'] = '����� ������ ��� ����� �� ��� ��� ����� ���� ���� ������ ����� ������ ';
        echo $tpl->display('header.htm');
        echo $tpl->display('msgbox.htm');
        echo $tpl->display('footer.htm');
        exit;
    }
    $do = "";
    $Security  = $_REQUEST['security'];
    if($Captcha[0]){
        if($Security!=$_SESSION['security_code']){
    		$MsgTitle = '������';
            $do        = 'show';
            $Msg      = '��� ������ ��� ����';
        }
    }
    $lesstitle = htmlspecialchars($_POST['lesstitle']);
    $name      = htmlspecialchars($_POST['Writer']);
    $mail      = htmlspecialchars($_POST['mail']);
    $site      = htmlspecialchars($_POST['site']);
    $ico       = htmlspecialchars($_POST['ico']);
    $userip    = real_ip();
    if($settings['TextBox']){
        require_once('./includes/wysiwyg.php');
        $less = add_slashes(XSS_Remove(convert_wysiwyg_html_to_bbcode($_POST['WYSIWYG_HTML'])));
        $WYSIWYG_HTML = add_slashes(htmlspecialchars(trim($_POST['WYSIWYG_HTML'])));
    }else{
		$less = add_slashes(XSS_Remove($_POST['less']));
    }
    $less = str_replace("'","&quot;",$less);
    if(!$less){
		$MsgTitle = '������';
        $do        = 'show';
        $Msg      = '���� ���� ����� �����';
    }elseif($_POST["Preview"] AND $do != 'show'){
        require_once('./includes/replace.php');
        $lesshtml = Replace($less);
        $do       = 'show';
        $Msg      = $lesshtml;
        $MsgTitle = '������ [ '.$lesstitle.' ]';
    }else{
        if($settings['Attach']){
            if($_FILES['AttachFile']['name']){
                $MaxSize     = $settings['ASize'] * 1024;
                $Attach_size = $_FILES['AttachFile']['size'];
                $Attach      = $_FILES['AttachFile']['name'];
                if ($Attach_size > $MaxSize){
            		$MsgTitle = '������';
                    $do        = 'show';
                    $Msg      = '��� ����� ������ ���� �� ������� ��';
                }else{
                    $ext = strrchr($Attach,'.');
                    $istype = $db->get_var("select count(*) from attachtype where FEXT='$ext'");
                    if(!$istype){
                		$MsgTitle = '������';
                        $do        = 'show';
                        $Msg      = '��� ����� ������ ��� ����� ��';
                    }else{
                        $AData  = addslashes(fread(fopen($_FILES['AttachFile']['tmp_name'], "r"), $Attach_size));
                        $AQuery = $db->query("INSERT INTO attachments SET AName='$Attach', AData ='$AData', ALesson='0', ACat='$id',AEXT='$ext'");
                        if($AQuery) $AttachID = mysql_insert_id();
                    }
                }
            }
        }
    }
    if($do != 'show'){
        $Query = $db->query("INSERT INTO less SET  Hidden='".$settings['HiDaN']."', forumno ='$id', Writer = '$name', mail ='$mail', site ='$site', IP ='$userip',icon ='$ico', lesstitle ='$lesstitle', less ='$less',lessdate =CURDATE(), View='0'");
        if($Query){
            $LessonID = mysql_insert_id();
            if($settings['Attach'] AND $AQuery){
                $AQuery = $db->query("UPDATE attachments SET ALesson='$LessonID' WHERE AID='$AttachID'");
            }
            $MSG['Title'] = $settings['sitetitle'];
            if ($settings['HiDaN']==0){
                $MSG['Content'] =   '��� ����� ����� ����� ������� ���� ���� ��������';
                $AutoLink       =   ($settings['SrchLink'] ? 'lesson-'.$LessonID.'-1.html' :'show.php?L='.$LessonID);
            }else{
                $MSG['Content'] =   '���� ����� ����� ��� ������ ������ɡ� ������ ���� ��� ������ ��������';
                $AutoLink       =   './';
            }
            echo $tpl->display('header.htm');
            echo "<meta http-equiv='Refresh' content='3;URL=$AutoLink'>";
            echo $tpl->display('msgbox.htm');
            echo $tpl->display('footer.htm');
            exit;
        }else{
            $MSG['Title'] = $settings['sitetitle'];
            $MSG['Content'] = '���� ��� �� ����� �������� �� ���� ����� ��� �� ����� ������ ���� ���� �����';
            echo $tpl->display('header.htm');
            echo $tpl->display('msgbox.htm');
            echo $tpl->display('footer.htm');
            exit;
        }
    }
}else{
    $id = intval($_GET['id']);
    if(!$id){
        $MSG['Title'] = $settings['sitetitle'];
        $MSG['Content'] = '����� ������ ��� ����� �� ��� ��� ����� ���� ���� ������ ����� ������ ';
        echo $tpl->display('header.htm');
        echo $tpl->display('msgbox.htm');
        echo $tpl->display('footer.htm');
        exit;
    }
    $cinfo = $db->get_row("select Title,CatID from forums where id='$id'");
    if(!$cinfo['Title']){
        $MSG['Title'] = $settings['sitetitle'];
        $MSG['Content'] = '����� ������ ��� ����� �� ��� ��� ����� ���� ���� ������ ����� ������ ';
        echo $tpl->display('header.htm');
        echo $tpl->display('msgbox.htm');
        echo $tpl->display('footer.htm');
        exit;
    }
}
if($cinfo['CatID']){
    $parent = $db->get_row("select * from forums where id='".$cinfo['CatID']."'");
}

/***********************************Echo Page**********************************/
$PageTitle = '����� ���';
$Brwoser = CheckBrowser();
if($settings['TextBox']){
    $Box = $tpl->display('wysiwyg.htm');
}else{
    $Box = $tpl->display('nowysiwyg.htm');
}
echo $tpl->display('header.htm');
echo $tpl->display('add.htm');
echo $tpl->display('footer.htm');
?>