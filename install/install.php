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
    $tpl = str_replace('{steps}',8,$tpl);
    $tpl = str_replace('{file}','install',$tpl);
    $tpl = str_replace('{action}','�����',$tpl);
	return $tpl;
}
/******************************************************************************/


switch ($step) {
case "1":
    echo template ('header.tpl');
    $CONTENT = '<p>������ �� �� ����� ����� ������ ������ ������� 4.0</p>'.
               '<p>��� ��� ���� ����� ������� ���� ��� ����� ����� ��������� ��� ������ �������'.
               '.</p>'.
               '<p>��� ��� ��� ���� ������� �� ����� ���� ��� ������ <a href="upgrade.php">���'.
               '������</a></p>';
    $body = template('box.tpl');
    $body = str_replace('{TITLE}','����� ����� ������ ������ 4.0',$body);
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
    $body = str_replace('{TITLE}','����� ����� ������ ������ 4.0',$body);
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
    echo '<p>��� ���� ����� ������� ...</p>'.
         '<ul>';
    $db  = new db($SQL_USER,$SQL_PWD,$SQL_DB,$SQL_HOST);
    $tables['attachments'] = "CREATE TABLE IF NOT EXISTS `attachments` (`AID` int(10) unsigned NOT NULL auto_increment,`AName` varchar(250) NOT NULL,`AData` longblob NOT NULL,`ACounter` int(10) unsigned NOT NULL default '0',`ALesson` int(10) unsigned NOT NULL default '0',`AEXT` varchar(10) NOT NULL,`ACat` smallint(5) unsigned NOT NULL default '0',PRIMARY KEY  (`AID`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
    $tables['attachtype']  = "CREATE TABLE IF NOT EXISTS `attachtype` (`FType` varchar(255) NOT NULL,`FEXT` varchar(10) NOT NULL,`FImage` varchar(255) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
    $tables['comment']     = "CREATE TABLE IF NOT EXISTS `comment` (`CID` int(10) unsigned NOT NULL auto_increment,`CName` varchar(250) NOT NULL,`CMail` varchar(250) NOT NULL,`Cmnt` mediumtext NOT NULL,`CLsn` int(10) unsigned NOT NULL default '0',`CDate` date NOT NULL default '0000-00-00',`CCat` smallint(5) unsigned NOT NULL default '0',PRIMARY KEY  (`CID`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
    $tables['forums']      = "CREATE TABLE IF NOT EXISTS `forums` (`id` smallint(5) unsigned NOT NULL auto_increment,`Title` varchar(100) default NULL,`CatImg` varchar(100) NOT NULL,`Description` mediumtext NOT NULL,`CatID` int(10) NOT NULL default '0',`COrder` smallint(5) NOT NULL default '0',PRIMARY KEY  (`id`),KEY `Title` (`Title`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
    $tables['less']        = "CREATE TABLE IF NOT EXISTS `less` (`lessid` int(10) unsigned NOT NULL auto_increment,`Hidden` enum('1','0') NOT NULL default '1',`forumno` smallint(5) unsigned NOT NULL default '1',`Writer` varchar(225) NOT NULL,`mail` varchar(255) NOT NULL,`site` varchar(255) NOT NULL,`IP` varchar(255) NOT NULL default '0',`icon` tinyint(1) NOT NULL default '0',`lesstitle` varchar(255) NOT NULL,`less` longtext NOT NULL,`lessdate` date NOT NULL default '0000-00-00',`View` int(10) unsigned NOT NULL default '0',`Votes` int(10) unsigned NOT NULL default '0',`Rate` int(10) unsigned NOT NULL default '0',PRIMARY KEY  (`lessid`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
    $tables['modretor']    = "CREATE TABLE IF NOT EXISTS `modretor` (`ModID` int(9) NOT NULL auto_increment,`ModName` varchar(100) NOT NULL,`ModPassword` varchar(100) NOT NULL,`Validities` varchar(20) NOT NULL default '1,1,1,1,1,1,1,1,1',`ModNote` longtext NOT NULL,PRIMARY KEY  (`ModID`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
    $tables['online']      = "CREATE TABLE IF NOT EXISTS `online` (`OnlineID` int(9) NOT NULL auto_increment,`IP` varchar(100) NOT NULL,`Time` int(10) NOT NULL,PRIMARY KEY  (`OnlineID`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
    $tables['setting']     = "CREATE TABLE IF NOT EXISTS `setting` (`setid` int(10) NOT NULL default '1',`adminmail` varchar(50) NOT NULL,`sitetitle` varchar(100) NOT NULL,`SiteLink` varchar(250) NOT NULL,`counter` int(10) unsigned NOT NULL default '0',`HiDaN` enum('0','1') NOT NULL default '0',`PageNO` smallint(10) NOT NULL default '10',`SiteStatus` enum('0','1') NOT NULL default '0',`StatusText` varchar(225) NOT NULL default 'SaphpLesson4.0',`SiteStyle` varchar(255) NOT NULL,`CmntNO` smallint(10) NOT NULL default '0',`ASize` smallint(10) NOT NULL default '0',`Comment` enum('1','0') NOT NULL default '1',`Show_RSS` enum('1','0') NOT NULL default '0',`VisitedAdd` enum('1','0') NOT NULL default '1',`SrchLink` enum('1','0') NOT NULL default '1',`RssCount` smallint(5) NOT NULL default '0',`TextBox` enum('1','0') NOT NULL default '1',`DateFormat` enum('0','1') NOT NULL default '0',`SaveWord` enum('0','1') NOT NULL default '1',`SavePDF` enum('0','1') NOT NULL default '1',`Attach` enum('0','1') NOT NULL default '1',`Sitemap` enum('0','1') NOT NULL default '1',`NoFollow` enum('0','1') NOT NULL default '1',`SEO1` enum('0','1') NOT NULL default '1',`SEO2` enum('0','1') NOT NULL default '1',`Meta1` varchar(225) NOT NULL,`Meta2` varchar(225) NOT NULL,`Captcha` varchar(100) NOT NULL default '1,1,1,1,1',PRIMARY KEY  (`setid`),KEY `adminpassword` (`adminmail`,`sitetitle`)) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
    $tables['words']       = "CREATE TABLE IF NOT EXISTS `words` (`WID` int(1) NOT NULL auto_increment,`WFind` varchar(255) NOT NULL,`WReplace` varchar(255) NOT NULL,PRIMARY KEY  (`WID`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
    foreach ($tables as $key => $value) {
        if($db->query($value)){
            echo '<li>�� ����� ���� '.$key.'</li>'."\r\n";
        }else{
            echo '<li style="color: red;">�� �� ����� ���� '.$key.'</li>'."\r\n";
        }
        flush();
    }
    echo '</ul><p>�� �������� �� ����� ������� ����� ���� �������� ��� ������ ������� .</p>'."\r\n";
    echo template('next.tpl');
    echo template ('footer.tpl');
    break;
case "5":
    require_once('../includes/mysql.php');
    echo template ('header.tpl');
    echo '<p>��� ���� ����� �������� ���������� ������� ...</p>'.
         '<ul>';
    $db  = new db($SQL_USER,$SQL_PWD,$SQL_DB,$SQL_HOST);
    $defaults['attachtype'] = "INSERT INTO `attachtype` (`FType`, `FEXT`, `FImage`) VALUES ('���� GIF', '.gif', 'images/type/gif.gif'),('��� ���', '.txt', 'images/type/txt.gif'),('���� JPG', '.jpg', 'images/type/jpg.gif'),('��� �����', '.zip', 'images/type/zip.gif'),('����� ������', '.rar', 'images/type/rar.gif');";
    $defaults['forums']     = "INSERT INTO `forums` (`id`, `Title`, `CatImg`, `Description`, `CatID`, `COrder`) VALUES (1, '����� ��������', 'images/test.gif', '����� �������� ������ ������ ������', 0, 1);";
    $defaults['less']       = "INSERT INTO `less` (`lessid`, `Hidden`, `forumno`, `Writer`, `mail`, `site`, `IP`, `icon`, `lesstitle`, `less`, `lessdate`, `View`, `Votes`, `Rate`) VALUES (1, '0', 1, '���� �������', 'saphplesson@live.com', 'www.saphplesson.org', '000.000.000.000', 2, '�� ����� ������� ����� ..', '[CENTER]��� ���� ������ ������[/CENTER]\n \n[CENTER][FONT=Arial][SIZE=3][B]������� �� �� ����� ����� ������ ������ 4.0 �����[/B][/SIZE][/FONT][/CENTER]\n \n[FONT=Arial][SIZE=3][B][color=#ff8c00]��[/color] [color=#ff8c00]��[/color] [color=#ff8c00]����[/color] [color=#ff8c00]��[/color] [color=#ff8c00]���[/color] [color=#ff8c00]������� :[/color][/B][/SIZE][/FONT]\n \n* ����� ����� ������� ��� ���� ����� �������� ����� �� ��������� ������� ���� ���� .\n* ��� OpenSearch .\n* ������� ��� ����� ���� PDF .\n* ��� ������� ������ �� ���SEO ������ ������ ����� .\n* ����� ����� ������ ������ ����� ����� Google ������ ������� .\n* ����� ��� ������ �� ������ ������� �� ������ .\n* ����� ������ �� ������ �� ����� ����� ����� ������� .\n* ����� ����� ����� ���� ��� ������� �� ������ ����� ����� .\n* ������� ����� ����� ������� �� ����� ����� .\n* ����� ����� �������� ������� ������ �� ���� ������ .\n* ����� ����� ������ ������ �� ���� ������ .\n* ������� ������� ������ ������� �� ���� ������ .\n* ����� ��� ������� ������� �� ����� ������� .\n* ����� ���� ������ ���������� �� ���� ������ .\n* ����� ���� ��� ����� ���� Word .\n* ����� ����� RSS ��� ������ .\n* ����� ���� ������� ��� ������� ������ .\n* ����� ����� ������� .\n* ����� ��� ���� ������ ����� ��� ��� ���� .\n* ����� ����� ����� ������� �� ��� ��������� .\n* ����� ����� ���������� ���� .\n* ����� ����� ����� ������ �������� ������ ������ .\n* �� ��� ������� �� ������� ������� ��� ��� ��� ���� ������� �� ������� .\n \n[color=#008000]��� ��� ��� �� ���� �� ��� ������� �������� ��� ������ ������� ������� .[/color]\n \n������ ������ ������� : [url]http://www.saphplesson.org[/url]\n \n��� ����� ������ �����\n \n����� / ���� ������� [icon]1[/icon]', '2008-07-05', 1, 0, 0);";
    foreach ($defaults as $key => $value) {
        if($db->query($value)){
            echo '<li>�� ����� �������� ���������� �����  '.$key.'</li>'."\r\n";
        }else{
            echo '<li style="color: red;">�� ��� ����� �������� ���������� ������  '.$key.'</li>'."\r\n";
        }
        flush();
    }
    echo '</ul><p>�� �������� �� ����� �������� ���������� ����� ���� �������� ��� ������'.
         '������� .</p>';
    echo template('next.tpl');
    echo template ('footer.tpl');
    break;
case "6":
    echo template ('header.tpl');
    if ($HTTP_ENV_VARS['REQUEST_URI'] OR $HTTP_SERVER_VARS['REQUEST_URI'])
    {
            $scriptpath = $HTTP_SERVER_VARS['REQUEST_URI'] ? $HTTP_SERVER_VARS['REQUEST_URI'] : $HTTP_ENV_VARS['REQUEST_URI'];
    }
    else
    {
            if ($HTTP_ENV_VARS['PATH_INFO'] OR $HTTP_SERVER_VARS['PATH_INFO'])
            {
                    $scriptpath = $HTTP_SERVER_VARS['PATH_INFO'] ? $HTTP_SERVER_VARS['PATH_INFO']: $HTTP_ENV_VARS['PATH_INFO'];
            }
            else if ($HTTP_ENV_VARS['REDIRECT_URL'] OR $HTTP_SERVER_VARS['REDIRECT_URL'])
            {
                    $scriptpath = $HTTP_SERVER_VARS['REDIRECT_URL'] ? $HTTP_SERVER_VARS['REDIRECT_URL']: $HTTP_ENV_VARS['REDIRECT_URL'];
            }
            else
            {
                    $scriptpath = $HTTP_SERVER_VARS['PHP_SELF'] ? $HTTP_SERVER_VARS['PHP_SELF'] : $HTTP_ENV_VARS['PHP_SELF'];
            }

            if ($HTTP_ENV_VARS['QUERY_STRING'] OR $HTTP_SERVER_VARS['QUERY_STRING'])
            {
                    $scriptpath .= '?' . ($HTTP_SERVER_VARS['QUERY_STRING'] ? $HTTP_SERVER_VARS['QUERY_STRING'] : $HTTP_ENV_VARS['QUERY_STRING']);
            }
    }
    $data = template ('data.tpl');
    $data = str_replace('{scriptpath}','http://' . $_SERVER['SERVER_NAME'] . substr($scriptpath,0, strpos($scriptpath, '/install/')),$data);
    $data = str_replace('{adminmail}','webmaster@'.$_SERVER["SERVER_NAME"],$data);
    echo $data;
    echo template ('footer.tpl');
    break;
case "7":
    require_once('../includes/mysql.php');
    echo template ('header.tpl');
    $db  = new db($SQL_USER,$SQL_PWD,$SQL_DB,$SQL_HOST);
    $db->query("INSERT INTO `setting` (`setid`, `adminmail`, `sitetitle`, `SiteLink`, `counter`, `HiDaN`, `PageNO`, `SiteStatus`, `StatusText`, `SiteStyle`, `CmntNO`, `ASize`, `Comment`, `Show_RSS`, `VisitedAdd`, `SrchLink`, `RssCount`, `TextBox`, `DateFormat`, `SaveWord`, `SavePDF`, `Attach`, `Sitemap`, `NoFollow`, `SEO1`, `SEO2`, `Meta1`, `Meta2`, `Captcha`) VALUES (1, '".$_POST['sitemail']."', '".$_POST['sitetitle']."', '".$_POST['SiteLink']."', 0, '0', 10, '0', 'SaphpLesson4.0', 'Default', 5, 1024, '1', '1', '1', '1', 10, '1', '0', '1', '1', '1', '1', '1', '1', '1', '', '', '1,1,1,1,1');");
    $db->query("INSERT INTO `modretor` (`ModID`, `ModName`, `ModPassword`, `Validities`, `ModNote`) VALUES (1, '".$_POST['MName']."', '".md5($_POST['MPass'])."', '1,1,1,1,1,1,1,1,1', '');");
    $CONTENT = '�� ����� �������� ����� ����� ���� �������� ������� �������';
    $body = template('box.tpl');
    $body = str_replace('{TITLE}','����� ����� ������ ������ 4.0',$body);
    $body = str_replace('{CONTENT}',$CONTENT,$body);
    echo $body;
    echo template('next.tpl');
    echo template ('footer.tpl');
    break;
case "8":
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
    header("location: install.php?step=1");
}
?>