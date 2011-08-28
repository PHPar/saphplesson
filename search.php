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
if($Captcha[2]){
		session_start();
}

$dosearch  = ($_REQUEST['Word']) ? 1 : (($_GET['action']=='lastlsn') ? 2 : 0);
$Current   = ($_GET['action']=='lastlsn') ? 'lastlsn' : 'search';
$PageTitle = ($_GET['action']=='lastlsn') ? 'ÌÏíÏ ÇáÏÑæÓ' : 'ÇáÈÍË';
$page = intval($_GET['Page']) ? intval($_GET['Page']) : 1;
$from    = ($page-1)*$settings["PageNO"];
if($dosearch){
    if($dosearch==2){
        $Word      = 'ÌÏíÏ ÇáÏÑæÓ';
        $sql       = "select * from less,forums where less.Hidden='0' and forums.id=less.forumno order by lessid DESC LIMIT 25";
        $nres      = $db->get_var("select * from less,forums where less.Hidden='0' and forums.id=less.forumno order by lessid DESC LIMIT 25");
    }else{
        $Security  = $_REQUEST['security'];
        if($_POST['Word']){
            if($Captcha[2]){
                if($Security!=$_SESSION['security_code']){
                    $MSG['Title'] = 'ÇáÈÍË';
                    $MSG['Content'] = 'ÑÞã ÇáÊÍÞÞ ÛíÑ ÕÍíÍ';
                    echo $tpl->display('header.htm');
                    echo $tpl->display('msgbox.htm');
                    echo $tpl->display('footer.htm');
                    exit;
                }
            }
        }
        require_once('./includes/arquery.class.php');
        $Word      = htmlspecialchars($_REQUEST['Word']);
        if(!trim($Word)){
            $MSG['Title'] = 'ÇáÈÍË';
            $MSG['Content'] = 'ÚÝæÇð  áã ÊÞã ÈÅÏÎÇá ßáãÉ ÇáÈÍË';
            echo $tpl->display('header.htm');
            echo $tpl->display('msgbox.htm');
            echo $tpl->display('footer.htm');
            exit;
        }
        $fields    = array('less','Writer','lesstitle');
        $Find      = in_array($_REQUEST['Find'], $fields) ? $_REQUEST['Find'] : 'less';
        $Cat       = intval($_REQUEST['Cat']);
        $orders    = array('Relevance','lessid','lesstitle','View');
        $Order     = in_array($_REQUEST['Order'], $orders) ? $_REQUEST['Order'] : 'Relevance';
        $Dir       = ($_REQUEST['Dir']=='ASC') ? 'ASC' : 'DESC';
        @ini_set('zend.ze1_compatibility_mode', '1');
        $srch      = new ArQuery();
        $srch->setStrFields($Find);
        $srch->setMode(0);
        $srch->order  = ($Order=='Relevance') ? 1 : 0;
        $strCondition = $srch->getWhereCondition($Word);
        if($Cat){
            $sql  = "select * from less,forums where less.Hidden='0' and less.forumno='".$Cat."' and forums.id=less.forumno and ".$strCondition.((!$srch->order) ? " order by $Order $Dir" : '')." LIMIT $from,".$settings["PageNO"];
            $nres = $db->get_var("select count(*) from less,forums where less.Hidden='0' and less.forumno='".$Cat."' and forums.id=less.forumno and ".$strCondition.((!$srch->order) ? " order by $Order $Dir" : ''));
        }else{
            $sql  = "select * from less,forums where less.Hidden='0' and forums.id=less.forumno and ".$strCondition.((!$srch->order) ? " order by $Order $Dir" : '')." LIMIT $from,".$settings["PageNO"];
            $nres = $db->get_var("select count(*) from less,forums where less.Hidden='0' and forums.id=less.forumno and ".$strCondition.((!$srch->order) ? " order by $Order $Dir" : ''));
        }
        $pnum    = (int) ((($nres-1)/$settings["PageNO"])+1);
        $pager = pager($pnum,$page,"search.php?Word=".str_replace('%','%%',rawurlencode($Word))."&security=$Security&Find=$Find&Cat=$Cat&Order=$Order&Dir=$Dir&Page=%d");
    }
    if($nres){
        if ($nres !=1 and $nres < 11 and $nres > 2){
            $single = 0;
        }else{
            $single = 1;
        }
        $results = $db->get_results($sql);
        $nresult = count($results);
        for ($i=0; $i<=$nresult-1; $i++){
            $results[$i]['Writer']    = htmlspecialchars($results[$i]['Writer']);
            $results[$i]['mail']      = htmlspecialchars($results[$i]['mail']);
            $results[$i]['lessdate']  = Hijri($results[$i]['lessdate'],$settings['DateFormat']);
        }
        $exgo = exgo();
        echo $tpl->display('header.htm');
        echo $tpl->display('result.htm');
        echo $tpl->display('footer.htm');
        exit;
    }else{
        $MSG['Title'] = 'ÇáÈÍË';
        $MSG['Content'] = 'áã íÊã ÇáÚËæÑ Úáì äÊÇÆÌ';
        echo $tpl->display('header.htm');
        echo $tpl->display('msgbox.htm');
        echo $tpl->display('footer.htm');
        exit;
    }
}
$cats = $db->get_results("select * from forums order by COrder");
$ncat = count($cats);
echo $tpl->display('header.htm');
echo $tpl->display('search.htm');
echo $tpl->display('footer.htm');
?>