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
$page = intval($_GET['Page']) ? intval($_GET['Page']) : 1;
if(intval($_GET['forumid'])){
    parse_str($_SERVER['QUERY_STRING'], $params);
    $newurl = '';
    foreach ($params as $key => $value) {
        if($key=='forumid') $key = 'id';
        $newurl .= $key.'='.$value.'&';
    }
    if($settings["SrchLink"]){
        $newurl = "cat-".$_GET['forumid']."-$page.html";
    }else{
        $newurl = 'showcat.php?'.substr($newurl, 0, -1);
    }
    header ("HTTP/1.1 301 Moved Permanently");
    header ("Location: " . $newurl);
    exit;
}
if($settings["SrchLink"]){
    if(!$_GET['h']){
        $newurl = "cat-".$_GET['id']."-$page.html";
        header ("HTTP/1.1 301 Moved Permanently");
        header ("Location: " . $newurl);
        exit;
    }
}else{
    if($_GET['h']){
        if($page==1){
            $newurl = "showcat.php?id=".$_GET['id'];
        }else{
            $newurl = "showcat.php?id=".$_GET['id']."&Page=$page";
        }
        header ("HTTP/1.1 301 Moved Permanently");
        header ("Location: " . $newurl);
        exit;
    }
}
$id = intval($_GET["id"]);
if(!$id){
    $MSG['Title'] = $settings['sitetitle'];
    $MSG['Content'] = 'ÇáÞÓã ÇáãÍÏÏ ÛíÑ ãæÌæÏ Ýí ÍÇá ßäÊ ÅÊÈÚÊ ÑÇÈØ ÎÇØÆ ÇáÑÌÇÁ ÅÚáÇã ÇáãÔÑÝ ';
    echo $tpl->display('header.htm');
    echo $tpl->display('msgbox.htm');
    echo $tpl->display('footer.htm');
    exit;
}

$cinfo = $db->get_row("select Title,CatID from forums where id='$id'");
if(!$cinfo['Title']){
    $MSG['Title'] = $settings['sitetitle'];
    $MSG['Content'] = 'ÇáÞÓã ÇáãÍÏÏ ÛíÑ ãæÌæÏ Ýí ÍÇá ßäÊ ÅÊÈÚÊ ÑÇÈØ ÎÇØÆ ÇáÑÌÇÁ ÅÚáÇã ÇáãÔÑÝ ';
    echo $tpl->display('header.htm');
    echo $tpl->display('msgbox.htm');
    echo $tpl->display('footer.htm');
    exit;
}
/*******************************Get Sub Categories*****************************/
if($cinfo['CatID']){
    $parent = $db->get_row("select * from forums where id='".$cinfo['CatID']."'");
}else{
    $subcats = $db->get_results('select * from forums where CatID='.$id.' order by COrder');
    $nsubcat = count($subcats);
    if($nsubcat){
        for ($i=0; $i<=$nsubcat-1; $i++){
            $subcats[$i]['NLess']  = intval($db->get_var("select count(*) from less where Hidden='0' and forumno=".$subcats[$i]['id']));
            $subcats[$i]['Description'] = nl2br($subcats[$i]['Description']);
        }
    }
}
/******************************Get lessons category****************************/
$from    = ($page-1)*$settings["PageNO"];
$lsncat  = intval($db->get_var("select count(*) from less where Hidden='0' and forumno=$id"));
if($lsncat){
    $lessons = $db->get_results("select * from less where Hidden='0' and forumno=$id order by lessid DESC LIMIT $from,".$settings["PageNO"]);
    $lsnnum  = count($lessons);
    if($lsnnum){
        for ($i=0; $i<=$lsnnum-1; $i++){
            $lessons[$i]['CTotal'] = intval($db->get_var('select count(*) from comment where CLsn='.$lessons[$i]['lessid']));
            $lessons[$i]['Attach'] = $db->get_var('select count(*) from attachments where ALesson='.$lessons[$i]['lessid']);
            $lessons[$i]['Rating'] = CalcRate($lessons[$i]['Votes'],$lessons[$i]['Rate']);
            $lessons[$i]['Writer']    = htmlspecialchars($lessons[$i]['Writer']);
            $lessons[$i]['mail']      = htmlspecialchars($lessons[$i]['mail']);
            $lessons[$i]['lessdate']  = Hijri($lessons[$i]['lessdate'],$settings['DateFormat']);
        }
    }
}
$pnum    = (int) ((($lsncat-1)/$settings["PageNO"])+1);

/*****************************Generate Page Numbers****************************/
if($settings["SrchLink"]){
    $pager = pager($pnum,$page,"cat-$id-%d.html");
}else{
    $pager = pager($pnum,$page,"showcat.php?id=$id&Page=%d");
}
/***********************************Echo Page**********************************/
$exgo      = exgo();
$PageTitle = $cinfo['Title'];
echo $tpl->display('header.htm');
echo $tpl->display('showcat.htm');
echo $tpl->display('footer.htm');
?>