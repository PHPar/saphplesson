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
if(!$Premission[2]){
    $MSG["TITLE"]   = "���� ������";
    $MSG["Error"]   = "�� ���� ���� ������� ����� ��� ������";
    $MSG["Referer"] = "login.php";
    echo $tpl->display("msgbox.tpl");
    exit;
}
$action = $_GET["action"];

switch ($action) {
case "add":
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        if($_POST["MName"] AND $_POST["MPass"]){
            $Prem = "";
            for ($i=1 ;$i<=9 ; $i++)
            {
                $_POST["prem"][$i] = intval($_POST["prem"][$i]);
                if ($i==9){
                    $Prem .= $_POST["prem"][$i];
                }else{
                    $Prem .= $_POST["prem"][$i].",";
                }
            }
            $MName = $_POST["MName"];
            $MPass = md5($_POST["MPass"]);
            if($db->get_var("select count(*) from modretor where ModName='".$MName."'")){
                $MSG["TITLE"] = "����� ����";
                $MSG["Error"] = "���� ���� ���� ��� �����";
            }else{
                $Query = $db->query("INSERT INTO modretor SET ModName='".$MName."',ModPassword='".$MPass."',Validities='".$Prem."'");
                if($Query){
                    $MSG["TITLE"] = "����� ����";
                    $MSG["OK"]    = "�� ����� ������ �����";
                    $MSG["Referer"] = "moderator.php";
                }else{
                    $MSG["TITLE"] = "����� ����";
                    $MSG["Error"] = "���� ����� �� ����� �������� �� ��� ����� ������";
                }
            }
        }else{
            $MSG["TITLE"] = "����� ����";
            $MSG["Error"] = "����� ���� �� ���� �� ������";
        }
        echo $tpl->display("msgbox.tpl");
        exit;
    }
    echo $tpl->display("mod_add.tpl");
    break;
case "edit":
    $id = intval($_GET["id"]);
    if($id){
        if ($_SERVER["REQUEST_METHOD"]=="POST"){
            if($_POST["MName"]){
                $Prem = "";
                for ($i=1 ;$i<=9 ; $i++)
                {
                    $_POST["prem"][$i] = intval($_POST["prem"][$i]);
                    if ($i==9){
                        $Prem .= $_POST["prem"][$i];
                    }else{
                        $Prem .= $_POST["prem"][$i].",";
                    }
                }
                $MName = $_POST["MName"];
                if($db->get_var("select count(*) from modretor where ModName='".$MName."' and ModID!=".$id)){
                    $MSG["TITLE"] = "����� ����";
                    $MSG["Error"] = "���� ���� ���� ��� �����";
                }else{
                    if($_POST["MPass"]){
                        $MPass = md5($_POST["MPass"]);
                        $Query = $db->query("UPDATE modretor SET ModName='".$MName."',ModPassword='".$MPass."',Validities='".$Prem."' WHERE ModID=".$id);
                    }else{
                        $Query = $db->query("UPDATE modretor SET ModName='".$MName."',Validities='".$Prem."' WHERE ModID=".$id);
                    }
                    if($Query){
                        $MSG["TITLE"]   = "����� ����";
                        $MSG["OK"]      = "�� ����� ������ �����";
                        $MSG["Referer"] = "moderator.php";
                    }else{
                        $MSG["TITLE"] = "����� ����";
                        $MSG["Error"] = "���� ����� �� ����� �������� �� ��� ����� ������";
                    }
                }
            }else{
                $MSG["TITLE"] = "����� ����";
                $MSG["Error"] = "����� ���� �� ���� �� ������";
            }
            echo $tpl->display("msgbox.tpl");
            exit;
        }
        $mod  = $db->get_row('select * from modretor where ModID='.$id);
        $prem = explode(",",$mod["Validities"]);
        echo $tpl->display("mod_edit.tpl");
    }
    break;
case "delete":
    $id = intval($_GET["id"]);
    if($id){
        if($id=="1"){
            $MSG["TITLE"] = "��������";
            $MSG["Error"] = "�� ���� ��� ������ �����";
            $MSG["Referer"] = "moderator.php";
        }else{
            $Query = $db->query('delete from modretor where ModID='.$id);

            if($Query){
                $MSG["TITLE"] = "��������";
                $MSG["OK"]    = "�� ��� ������ �����";
            }else{
                $MSG["TITLE"] = "��������";
                $MSG["Error"] = "���� ����� �� ����� �������� �� ��� ��� ������";
            }
        }
        echo $tpl->display("msgbox.tpl");
    }
    break;
default :
    $modretor = $db->get_results("select * from modretor order by ModID");
    $modnum   = $db->get_var("select count(*) from modretor order by ModID");
    echo $tpl->display("moderator.tpl");
}

?>