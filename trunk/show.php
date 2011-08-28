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
@ini_set('zend.ze1_compatibility_mode', '1');
$page = intval($_GET['Page']) ? intval($_GET['Page']) : 1;
if(intval($_GET['lessid'])){
    parse_str($_SERVER['QUERY_STRING'], $params);
    $newurl = '';
    if($settings["SrchLink"]){
        $newurl = "lesson-".$_GET['lessid']."-$page.html";
    }else{
        foreach ($params as $key => $value) {
            if($key=='lessid') $key = 'L';
            $newurl .= $key.'='.$value.'&';
        }
        $newurl = 'show.php?'.substr($newurl, 0, -1);
    }
    header ("HTTP/1.1 301 Moved Permanently");
    header ("Location: " . $newurl);
    exit;
}

$id = intval($_GET['L']);
if($settings["SrchLink"]){
    if(!$_GET['h']){
        $newurl = "lesson-".$_GET['L']."-$page.html";
        header ("HTTP/1.1 301 Moved Permanently");
        header ("Location: " . $newurl);
        exit;
    }
}else{
    if($_GET['h']){
        if($page==1){
            $newurl = "show.php?L=".$_GET['L'];
        }else{
            $newurl = "show.php?L=".$_GET['L']."&Page=$page";
        }
        header ("HTTP/1.1 301 Moved Permanently");
        header ("Location: " . $newurl);
        exit;
    }
}
if(!$id){
    $MSG['Title'] = $settings['sitetitle'];
    $MSG['Content'] = 'ÇáÏÑÓ ÇáãÍÏÏ ÛíÑ ãæÌæÏ Ýí ÍÇá ßäÊ ÅÊÈÚÊ ÑÇÈØ ÎÇØÆ ÇáÑÌÇÁ ÅÚáÇã ÇáãÔÑÝ ';
    echo $tpl->display('header.htm');
    echo $tpl->display('msgbox.htm');
    echo $tpl->display('footer.htm');
    exit;
}

$lsn = $db->get_row("select * from less where lessid='$id' and Hidden='0'");
if(!$lsn['lesstitle']){
    $MSG['Title'] = $settings['sitetitle'];
    $MSG['Content'] = 'ÇáÏÑÓ ÇáãÍÏÏ ÛíÑ ãæÌæÏ Ýí ÍÇá ßäÊ ÅÊÈÚÊ ÑÇÈØ ÎÇØÆ ÇáÑÌÇÁ ÅÚáÇã ÇáãÔÑÝ ';
    echo $tpl->display('header.htm');
    echo $tpl->display('msgbox.htm');
    echo $tpl->display('footer.htm');
    exit;
}
$badword = FilterWords();
$cinfo = $db->get_row("select Title,CatID from forums where id='".$lsn['forumno']."'");
if($cinfo['CatID']){
    $parent = $db->get_row("select * from forums where id='".$cinfo['CatID']."'");
}
/*********************************Format Lesson********************************/
$update = $db->query("UPDATE less SET View=View+1 WHERE lessid=$id");
require_once('./includes/replace.php');
$lsn['Rating']   = CalcRate($lsn['Votes'],$lsn['Rate']);
$lsn['lessdate'] = Hijri($lsn['lessdate'],$settings['DateFormat']);
$lsn['less']     = str_replace($badword['find'], $badword['replace'], $lsn['less']);
$lsn['less']     = Replace($lsn['less']);
$lsn['Attach']   = $db->get_row("select * from attachments,attachtype where attachments.ALesson=$id AND attachtype.FEXT =attachments.AEXT");
/**********************************Get Comments********************************/
if($settings['Comment']){
    $allcmnts    = intval($db->get_var("select count(*) from comment where CLsn=$id order by CID"));
    if($allcmnts){
        $from     =($page-1)*$settings['CmntNO'];
        $cmnts    = $db->get_results("select * from comment where CLsn=$id order by CID DESC limit $from,".$settings['CmntNO']);
        $ncmnt    = count($cmnts);
        if($ncmnt){
            for ($i=0; $i<=$ncmnt-1; $i++){
                $cmnts[$i]['Cmnt']  = nl2br($cmnts[$i]['Cmnt']);
                $cmnts[$i]['Cmnt']  = str_replace($badword['find'], $badword['replace'], $cmnts[$i]['Cmnt']);
                $cmnts[$i]['CDate'] = Hijri($cmnts[$i]['CDate'],$settings['DateFormat']);
            }
        }
    }
    if($settings['CmntNO']){
        $pnum  =(int) ((($allcmnts-1)/$settings['CmntNO'])+1);
    }else{
        $pnum  = 1;
    }
    $pager = pager($pnum,$page,($settings['SrchLink'] ? "lesson-$id-%d.html" :"show.php?L=$id&Page=%d"));
}
/***********************************Echo Page**********************************/
$PageTitle = $lsn['lesstitle'];
$showlsn   = 1;
if($settings["SrchLink"]){
    $lsn['lsnLink'] = $settings["SiteLink"].'/lesson-'.$id.'-1.html';
}else{
    $lsn['lsnLink'] = $settings["SiteLink"].'/show.php?L='.$id;
}
$lsn['lsnlinkurl'] = urlencode($lsn['lsnLink']);
$lsn['lsntitlelnk'] = urlencode($lsn['lesstitle']);
if($settings['SEO2']){
    include_once('./includes/arautosummarize.class.php');
    $autos = new ArAutoSummarize();
    $lsn['Meta2'] = $autos->getMetaKeywords($lsn['lesstitle']." ".strip_tags($lsn['less']), 20);
}
$exgo      = exgo();
echo $tpl->display('header.htm');
echo $tpl->display('show.htm');
echo $tpl->display('footer.htm');
?>