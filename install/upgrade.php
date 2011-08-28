<?php
/*#####################################################################*|
|                          SaphpLesson4.0                               |
| --------------------------------------------------------------------- |
|  This Script Is Free To Use But don't Delete copyright                |
|  Programmed By : Saleh AlMatrafe                                      |
|  Mobile : +966505545229 | Skype phone : saphps                        |
|  http://www.saphplesson.org  |  saphplesson@live.com(mail only)       |
|*#####################################################################*/

include("../includes/config.php");

$step = intval($_GET["step"]);

/******************************************************************************/
function template ($file) {
    global $step;
    $tpl = implode("",file($file));
    $tpl = str_replace('{step}',$step,$tpl);
    $tpl = str_replace('{next}',$step+1,$tpl);
    $tpl = str_replace('{steps}',5,$tpl);
    $tpl = str_replace('{file}','upgrade',$tpl);
    $tpl = str_replace('{action}','�����',$tpl);
	return $tpl;
}
/******************************************************************************/


switch ($step) {
case "1":
    echo template ('header.tpl');
    $CONTENT = '<p>������ �� �� ������� ���  ����� ������ ������ ������� 4.0</p>'.
               '<p>���� �� ���� ���� ���� �������� ������ �������� ��� ����� ��� ��� ������� ������� �� �� �������� ��� ������ ������� </p>'.
               '<span style="color: red;">������ : ��� ������� �� ������� 3.0 ��� .</span>';
    $body = template('box.tpl');
    $body = str_replace('{TITLE}','������� ���  ����� ������ ������ 4.0',$body);
    $body = str_replace('{CONTENT}',$CONTENT,$body);
    echo $body;
    echo template('next.tpl');
    echo template ('footer.tpl');
    break;
case "2":
    echo template ('header.tpl');
    $CONTENT =  '<p>���� ��� ������ ������� ���� ��� �������� �� ��� <span lang="en-us">'.
         'config.php :</span></p>'.
         '<form name="dbdata">'.
         '	<table style="width: 100%">'.
         '		<tr>'.
         '			<td style="width: 20%; text-align: left">�������� :</td>'.
         '			<td style="width: 80%">'.
         '				<input name="Text1" readonly="readonly" value="'.$SQL_HOST.'" type="text" style="width: 250px" />'.
         '			</td>'.
         '		</tr>'.
         '		<tr>'.
         '			<td style="width: 20%; text-align: left">��� �������� :</td>'.
         '			<td style="width: 80%">'.
         '				<input name="Text2" readonly="readonly" value="'.$SQL_USER.'" type="text" style="width: 250px" /></td>'.
         '		</tr>'.
         '		<tr>'.
         '			<td style="width: 20%; text-align: left">���� ������ :</td>'.
         '			<td style="width: 80%">'.
         '				<input name="Text3" readonly="readonly" value="'.$SQL_PWD.'" type="text" style="width: 250px" /></td>'.
         '		</tr>'.
         '		<tr>'.
         '			<td style="width: 20%; text-align: left">��� ������� :</td>'.
         '			<td style="width: 80%">'.
         '				<input name="Text4" readonly="readonly" value="'.$SQL_DB.'" type="text" style="width: 250px" /></td>'.
         '		</tr>'.
         '	</table>'.
         '</form>'.
         '<p>��� ��� ������� �� ��� �������� ��� ��������� ��� ������ ������� .</p>';
    $body = template('box.tpl');
    $body = str_replace('{TITLE}','������� ���  ����� ������ ������ 4.0',$body);
    $body = str_replace('{CONTENT}',$CONTENT,$body);
    echo $body;
    echo template('next.tpl');
    echo template ('footer.tpl');
    break;
case "3":
    require_once('../includes/mysql.php');
    echo template ('header.tpl');
    echo '<p>��� ���� ������ �� ������ ����� �������� ...</p>';
    $db  = new db($SQL_USER,$SQL_PWD,$SQL_DB,$SQL_HOST);
    if($db){
        echo '<p style="color: #008000;">�� ������� ������ �������� ����� ����� ���� �������� ��� '.
             '������ ������� .</p>';
    }else{
        echo '<p style="color: red;">�� ��� ������� ������ �������� ���� ������ �� ��������  �� ������ ������� .</p>';
        echo template ('footer.tpl');
        exit;
    }
    echo template('next.tpl');
    echo template ('footer.tpl');
    break;
case "4":
    require_once('../includes/mysql.php');
    echo template ('header.tpl');
    echo '<p>��� ���� ����� �������  ...</p>'.
         '<ul>';
    $db  = new db($SQL_USER,$SQL_PWD,$SQL_DB,$SQL_HOST);
    $tables['setting']   = "ALTER TABLE `setting` ADD `SaveWord` ENUM( '0', '1' ) NOT NULL DEFAULT '1',ADD `SavePDF` ENUM( '0', '1' ) NOT NULL DEFAULT '1',ADD `Attach` ENUM( '0', '1' ) NOT NULL DEFAULT '1',ADD `Sitemap` ENUM( '0', '1' ) NOT NULL DEFAULT '1',ADD `NoFollow` ENUM( '0', '1' ) NOT NULL DEFAULT '1',ADD `SEO1` ENUM( '0', '1' ) NOT NULL DEFAULT '1',ADD `SEO2` ENUM( '0', '1' ) NOT NULL DEFAULT '1',ADD `Meta1` VARCHAR( 225 ) NOT NULL ,ADD `Meta2` VARCHAR( 225 ) NOT NULL ;";
    $tables['setting.']  = "ALTER TABLE `setting` ADD `Captcha` VARCHAR( 100 ) NOT NULL DEFAULT '1,1,1,1,1';";
    $tables['modretor']  = "ALTER TABLE `modretor` CHANGE `Validities` `Validities` VARCHAR( 20 ) NOT NULL DEFAULT '1,1,1,1,1,1,1,1,1' ";
    $tables['modretor.'] = "ALTER TABLE `modretor` ADD `ModNote` LONGTEXT NOT NULL ;";
    $tables['less']      = "ALTER TABLE `less` CHANGE `View` `View` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0',CHANGE `Votes` `Votes` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0',CHANGE `Rate` `Rate` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' ";
    $tables['settings']  = "ALTER TABLE `setting` CHANGE `counter` `counter` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0' ";
    foreach ($tables as $key => $value) {
        if($db->query($value)){
            echo '<li>�� ����� ���� '.$key.'</li>'."\r\n";
        }else{
            echo '<li style="color: red;">�� ��� ����� ���� '.$key.'</li>'."\r\n";
        }
        flush();
    }
    $db->query("UPDATE setting SET SiteStyle='Default' WHERE setid=1");
    $db->query("UPDATE less SET Hidden='0' WHERE Hidden=''");
    echo '</ul><p>�� �������� �� ����� ������� ����� ���� �������� ��� ������ ������� .</p>'."\r\n";
    echo template('next.tpl');
    echo template ('footer.tpl');
    break;
case "5":
    echo template ('header.tpl');
    $CONTENT = '<strong>������� ��� �� �������� �� ����� ����� ������ ������ 4.0 </strong><br /><br /> '.
               '<span style="color: red"> ���� �� ���� ���� ���� install ����� �������� </span><br /><br /> '.
               '<a href="../admin/">���� ��� �������� ����� ������ .</a><br /> '.
               '<a href="../">���� ��� �������� ��� ������ �������� </a><br /> ';
    $do = @chmod("../cache", 0777);
    if(!$do){
		$CONTENT .= "<br /><span style='color: red;'>���� ����� ���� cache ������� 777</span><br /><br /> ";
    }
    $CONTENT .= '���� ���� �� ����� ������ ����� ������ ������ �������';
    $body = template('box.tpl');
    $body = str_replace('{TITLE}','����� ����� ������ ������ 4.0',$body);
    $body = str_replace('{CONTENT}',$CONTENT,$body);
    echo $body;
    echo template ('footer.tpl');
    break;
default :
    header("location: upgrade.php?step=1");
}
?>