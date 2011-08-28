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
$action = $_GET["action"];

switch ($action) {
case "stat":
      $online  = intval($db->get_var('select count(*) from online'));
      $lsnnum  = intval($db->get_var("select count(*) from less where Hidden='0'"));
      $atcnum  = intval($db->get_var("select count(*) from attachments"));
      $catnum  = intval($db->get_var("select count(*) from forums"));
      $votes5  = $db->get_results("select * from less,forums where less.Hidden='0' and forums.id=less.forumno order by less.Votes DESC LIMIT 5");
      $visit5  = $db->get_results("select * from less,forums where less.Hidden='0' and forums.id=less.forumno order by less.View DESC LIMIT 5");
      $isvotes = count($votes5);
      $isvisit = count($visit5);
      if($isvotes){
          for ($i=0; $i<=$isvotes-1; $i++){
              $votes5[$i]['Rating']   = CalcRate($votes5[$i]['Votes'],$votes5[$i]['Rate']);
              $votes5[$i]['Writer']   = htmlspecialchars($votes5[$i]['Writer']);
              $votes5[$i]['mail']     = htmlspecialchars($votes5[$i]['mail']);
              $votes5[$i]['lessdate'] = Hijri($votes5[$i]['lessdate'],$settings['DateFormat']);
          }
      }
      if($isvisit){
          for ($i=0; $i<=$isvisit-1; $i++){
              $visit5[$i]['Rating']   = CalcRate($visit5[$i]['Votes'],$visit5[$i]['Rate']);
              $visit5[$i]['Writer']   = htmlspecialchars($visit5[$i]['Writer']);
              $visit5[$i]['mail']     = htmlspecialchars($visit5[$i]['mail']);
              $visit5[$i]['lessdate'] = Hijri($visit5[$i]['lessdate'],$settings['DateFormat']);
          }
      }
      $PageTitle = '��������';
      $Current   = 'stats';
      echo $tpl->display('header.htm');
      echo $tpl->display('stats.htm');
      echo $tpl->display('footer.htm');
    break;
case "tell":
    if($Captcha[3]){
    		session_start();
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        $MailFrind = $_POST['MailFrind'];
        $NameYou   = $_POST['NameYou'];
        $MailYou   = $_POST['MailYou'];
        $NameFrind = $_POST['NameFrind'];
        $Message   = $_POST['MSG'];
        if($Captcha[3]){
            $security = $_POST['security'];
            if($security!=$_SESSION['security_code']){
                $MSG['Content'] = "��� ������ ��� ����";
                $MSG['Title'] = "���� �����";
                echo $tpl->display('header.htm');
                echo $tpl->display("msgbox.htm");
                echo $tpl->display('footer.htm');
                exit;
            }
        }
        $FROM = "From: \t$MailYou\n";
        $SUBJECT = "\t ����� �� �� $NameYou\n";
        $MSGCall .= " ������ $NameFrind ��� ����� �� �� $NameYou �� �������:\n";
        $MSGCall .= "$Message\n";
        $CallFrind = @mail($MailFrind, $SUBJECT, $MSGCall, $FROM);
        if($CallFrind){
            $MSG['Content'] = '�� ����� ������� ��� ����� ����� ��';
        }else{
            $MSG['Content'] = '����� ���� ����� �� ��� ����� �������';
        }
        $MSG['Title'] = '���� �����';
        $PageTitle = '���� �����';
        $Current   = 'tell';
        echo $tpl->display('header.htm');
        echo $tpl->display("msgbox.htm");
        echo $tpl->display('footer.htm');
        exit;
    }
    $PageTitle = '���� �����';
    $Current   = 'tell';
    echo $tpl->display('header.htm');
    echo $tpl->display('tell.htm');
    echo $tpl->display('footer.htm');
    break;
case "contact":
    if($Captcha[4]){
    		session_start();
    }
        $PageTitle = '����� ���';
        $Current   = 'contact';
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            if($Captcha[4]){
                $security = $_POST['security'];
                if($security!=$_SESSION['security_code']){
                    $MSG['Content'] = "��� ������ ��� ����";
                    $MSG['Title'] = "���� ���";
                    echo $tpl->display('header.htm');
                    echo $tpl->display("msgbox.htm");
                    echo $tpl->display('footer.htm');
                    exit;
                }
            }
            $Name    = $_POST["Name"];
            $Email   = $_POST["Email"];
            $Message = $_POST["Msg"];
            $Subject = $_POST["Subject"];
            $FROM = "From: \t$Email\n";
            $MSGCall .= " ���� ����� ������ �� $Name ������ �� $Email ������� �� :\n";
            $MSGCall .= "$Message\n";
            $Mail = @mail($settings['adminmail'], $Subject, $MSGCall, $FROM);
            if($Mail){
                $MSG['Content'] = '�� ����� ������� ����� ����� ��������� ����� ��';
            }else{
                $MSG['Content'] = '����� ���� ����� �� ��� ����� �������';
            }
            $MSG['Title'] = '���� ���';
            echo $tpl->display('header.htm');
            echo $tpl->display("msgbox.htm");
            echo $tpl->display('footer.htm');
            exit;
        }
        echo $tpl->display('header.htm');
        echo $tpl->display("contact.htm");
        echo $tpl->display('footer.htm');
    break;
default :
    //default
}

?>