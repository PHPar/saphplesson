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
    $tpl = str_replace('{action}',' —ﬁÌ…',$tpl);
	return $tpl;
}
/******************************************************************************/


switch ($step) {
case "1":
    echo template ('header.tpl');
    $CONTENT = '<p>„—Õ»« »ﬂ ›Ì «· —ﬁÌ… ≈·Ï  ”ﬂ—»  «·œ—Ê” «·⁄—»Ì «·≈’œ«— 4.0</p>'.
               '<p> –ﬂ— «‰  ﬁÊ„ »√Œ– ‰”Œ… «Õ Ì«ÿÌ… ·ﬁ«⁄œ… «·»Ì«‰«  ﬁ»· «·»œ¡ ≈–« ﬂ‰  „” ⁄œ« ·· —ﬁÌ… ﬁ„ »« »«·≈‰ﬁ«· ≈·Ï «·ŒÿÊ… «· «·Ì… </p>'.
               '<span style="color: red;">„·«ÕŸ… : Â–« «· —ﬁÌ… „‰ «·≈’œ«— 3.0 ›ﬁÿ .</span>';
    $body = template('box.tpl');
    $body = str_replace('{TITLE}','«· —ﬁÌ… ≈·Ï  ”ﬂ—»  «·œ—Ê” «·⁄—»Ì 4.0',$body);
    $body = str_replace('{CONTENT}',$CONTENT,$body);
    echo $body;
    echo template('next.tpl');
    echo template ('footer.tpl');
    break;
case "2":
    echo template ('header.tpl');
    $CONTENT =  '<p>›Ì„« Ì·Ì »Ì«‰«  «·ﬁ«⁄œ… «· Ì ﬁ„  »ﬂ «» Â« ›Ì „·› <span lang="en-us">'.
         'config.php :</span></p>'.
         '<form name="dbdata">'.
         '	<table style="width: 100%">'.
         '		<tr>'.
         '			<td style="width: 20%; text-align: left">«·„” ÷Ì› :</td>'.
         '			<td style="width: 80%">'.
         '				<input name="Text1" readonly="readonly" value="'.$SQL_HOST.'" type="text" style="width: 250px" />'.
         '			</td>'.
         '		</tr>'.
         '		<tr>'.
         '			<td style="width: 20%; text-align: left">«”„ «·„” Œœ„ :</td>'.
         '			<td style="width: 80%">'.
         '				<input name="Text2" readonly="readonly" value="'.$SQL_USER.'" type="text" style="width: 250px" /></td>'.
         '		</tr>'.
         '		<tr>'.
         '			<td style="width: 20%; text-align: left">ﬂ·„… «·„—Ê— :</td>'.
         '			<td style="width: 80%">'.
         '				<input name="Text3" readonly="readonly" value="'.$SQL_PWD.'" type="text" style="width: 250px" /></td>'.
         '		</tr>'.
         '		<tr>'.
         '			<td style="width: 20%; text-align: left">«”„ «·ﬁ«⁄œ… :</td>'.
         '			<td style="width: 80%">'.
         '				<input name="Text4" readonly="readonly" value="'.$SQL_DB.'" type="text" style="width: 250px" /></td>'.
         '		</tr>'.
         '	</table>'.
         '</form>'.
         '<p>≈–« ﬂ‰  „ √ﬂœ« „‰ Â–Â «·»Ì«‰«  ›ﬁ„ »«·«‰ ﬁ«· ≈·Ï «·ŒÿÊ… «· «·Ì… .</p>';
    $body = template('box.tpl');
    $body = str_replace('{TITLE}','«· —ﬁÌ… ≈·Ï  ”ﬂ—»  «·œ—Ê” «·⁄—»Ì 4.0',$body);
    $body = str_replace('{CONTENT}',$CONTENT,$body);
    echo $body;
    echo template('next.tpl');
    echo template ('footer.tpl');
    break;
case "3":
    require_once('../includes/mysql.php');
    echo template ('header.tpl');
    echo '<p>Ì „ «·¬‰ «· Õﬁﬁ „‰ »Ì«‰«  ﬁ«⁄œ… «·»Ì«‰«  ...</p>';
    $db  = new db($SQL_USER,$SQL_PWD,$SQL_DB,$SQL_HOST);
    if($db){
        echo '<p style="color: #008000;"> „ «·« ’«· »ﬁ«⁄œ… «·»Ì«‰«  »‰Ã«Õ Ì„ﬂ‰ﬂ «·¬‰ «·«‰ ﬁ«· ≈·Ï '.
             '«·ŒÿÊ… «· «·Ì… .</p>';
    }else{
        echo '<p style="color: red;">·„ Ì „ «·≈ ’«· »ﬁ«⁄œ… «·»Ì«‰«  Ì—ÃÏ «· Õﬁﬁ „‰ «·»Ì«‰«   À„ „⁄«Êœ… «· ‰’Ì» .</p>';
        echo template ('footer.tpl');
        exit;
    }
    echo template('next.tpl');
    echo template ('footer.tpl');
    break;
case "4":
    require_once('../includes/mysql.php');
    echo template ('header.tpl');
    echo '<p>Ì „ «·¬‰  —ﬁÌ… «·Ãœ«Ê·  ...</p>'.
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
            echo '<li> „  —ﬁÌ… ÃœÊ· '.$key.'</li>'."\r\n";
        }else{
            echo '<li style="color: red;">·„   „  —ﬁÌ… ÃœÊ· '.$key.'</li>'."\r\n";
        }
        flush();
    }
    $db->query("UPDATE setting SET SiteStyle='Default' WHERE setid=1");
    $db->query("UPDATE less SET Hidden='0' WHERE Hidden=''");
    echo '</ul><p> „ «·≈‰ Â«¡ „‰  —ﬁÌ… «·Ãœ«Ê· Ì„ﬂ‰ﬂ «·¬‰ «·≈‰ ﬁ«· ≈·Ï «·ŒÿÊ… «· «·Ì… .</p>'."\r\n";
    echo template('next.tpl');
    echo template ('footer.tpl');
    break;
case "5":
    echo template ('header.tpl');
    $CONTENT = '<strong> Â«‰Ì‰« °°°  „ «·≈‰ Â«¡ „‰  —ﬁÌ… ”ﬂ—»  «·œ—Ê” «·⁄—»Ì 4.0 </strong><br /><br /> '.
               '<span style="color: red">  –ﬂ— «‰  ﬁÊ„ »Õ–› „Ã·œ install ÊÃ„Ì⁄ „Õ ÊÌ« Â </span><br /><br /> '.
               '<a href="../admin/">«÷€ÿ Â‰« ··≈‰ ﬁ«· ··ÊÕ… «· Õﬂ„ .</a><br /> '.
               '<a href="../">«÷€ÿ Â‰« ··≈‰ ﬁ«· ≈·Ï «·’›Õ… «·—∆Ì”Ì… </a><br /> ';
    $do = @chmod("../cache", 0777);
    if(!$do){
		$CONTENT .= "<br /><span style='color: red;'>Ì—ÃÏ «⁄ÿ«¡ „Ã·œ cache «· ’—ÌÕ 777</span><br /><br /> ";
    }
    $CONTENT .= 'Ê⁄‰œ ÕœÊÀ √Ì „‘ﬂ·… Ì„ﬂ‰ﬂ„ “Ì«—… «·„Êﬁ⁄ «·—”„Ì ··”ﬂ—» ';
    $body = template('box.tpl');
    $body = str_replace('{TITLE}',' —ﬁÌ… ”ﬂ—»  «·œ—Ê” «·⁄—»Ì 4.0',$body);
    $body = str_replace('{CONTENT}',$CONTENT,$body);
    echo $body;
    echo template ('footer.tpl');
    break;
default :
    header("location: upgrade.php?step=1");
}
?>