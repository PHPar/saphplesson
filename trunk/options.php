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

$action = $_GET["action"];

switch ($action) {
case "word":
    if($settings['SaveWord']){
        $id = intval($_GET['L']);
        if(!$id){
            $MSG['Title'] = $settings['sitetitle'];
            $MSG['Content'] = '«·œ—” «·„Õœœ €Ì— „ÊÃÊœ ›Ì Õ«· ﬂ‰  ≈ »⁄  —«»ÿ Œ«ÿ∆ «·—Ã«¡ ≈⁄·«„ «·„‘—› ';
            echo $tpl->display('header.htm');
            echo $tpl->display('msgbox.htm');
            echo $tpl->display('footer.htm');
            exit;
        }
        require_once('./includes/rtf.class.php');
        $RTF = new RTF();
        $lsn = $db->get_row("select * from less where lessid='$id' and Hidden='0'");
        if(!$lsn['lesstitle']){
            $MSG['Title'] = $settings['sitetitle'];
            $MSG['Content'] = '«·œ—” «·„Õœœ €Ì— „ÊÃÊœ ›Ì Õ«· ﬂ‰  ≈ »⁄  —«»ÿ Œ«ÿ∆ «·—Ã«¡ ≈⁄·«„ «·„‘—› ';
            echo $tpl->display('header.htm');
            echo $tpl->display('msgbox.htm');
            echo $tpl->display('footer.htm');
            exit;
        }
        $badword = FilterWords();
        $lsn['less']     = str_replace($badword['find'], $badword['replace'], $lsn['less']);
        $RTF->document($lsn['less'],$lsn['lesstitle']);
        }
    break;
case "pdf":
    if($settings['SavePDF']){
        $id = intval($_GET['L']);
        if(!$id){
            $MSG['Title'] = $settings['sitetitle'];
            $MSG['Content'] = '«·œ—” «·„Õœœ €Ì— „ÊÃÊœ ›Ì Õ«· ﬂ‰  ≈ »⁄  —«»ÿ Œ«ÿ∆ «·—Ã«¡ ≈⁄·«„ «·„‘—› ';
            echo $tpl->display('header.htm');
            echo $tpl->display('msgbox.htm');
            echo $tpl->display('footer.htm');
            exit;
        }
        $lsn = $db->get_row("select * from less where lessid='$id' and Hidden='0'");
        if(!$lsn['lesstitle']){
            $MSG['Title'] = $settings['sitetitle'];
            $MSG['Content'] = '«·œ—” «·„Õœœ €Ì— „ÊÃÊœ ›Ì Õ«· ﬂ‰  ≈ »⁄  —«»ÿ Œ«ÿ∆ «·—Ã«¡ ≈⁄·«„ «·„‘—› ';
            echo $tpl->display('header.htm');
            echo $tpl->display('msgbox.htm');
            echo $tpl->display('footer.htm');
            exit;
        }

        require_once('./includes/tcpdf.php');
        @ini_set('zend.ze1_compatibility_mode', '1');

        include('./includes/archarsetc.class.php');
        $utf = new ArCharsetC();
        $pdf = new TCPDF('P', 'mm', 'A4', true);
        $filename              = $lsn['lesstitle'];
        $lsn['lesstitle']      = $utf->win2utf($lsn['lesstitle']);
        $lsn['Writer']         = $utf->win2utf($lsn['Writer']);
        $settings['sitetitle'] = $utf->win2utf($settings['sitetitle']);
        $settings['Meta2']     = $utf->win2utf($settings['Meta2']);
        $pdf->SetCreator('SaphpLesson4.0 www.saphplesson.org');
        $pdf->SetAuthor($lsn['Writer']);
        $pdf->SetTitle($lsn['lesstitle']);
        $pdf->SetSubject($settings['sitetitle']);
        $pdf->SetKeywords($settings['Meta2']);
        $pdf->SetHeaderData("", "", $settings['sitetitle'], $lsn['lesstitle'] .$utf->win2utf(" ··ﬂ« » : ").$lsn['Writer']);
        $pdf->setHeaderFont(Array('almohanad', '', 10));
        $pdf->setFooterFont(Array('almohanad', '', 12));
        $pdf->SetMargins(15, 17, 15);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);
        $pdf->SetAutoPageBreak(TRUE, 25);
        $pdf->setImageScale(4);
        $lg = Array();
        $lg['a_meta_charset'] = "UTF-8";
        $lg['a_meta_dir'] = "rtl";
        $lg['a_meta_language'] = "ar";
        $lg['w_page'] = "page";
        $pdf->setLanguageArray($lg);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $badword = FilterWords();
        $lsn['less']     = str_replace($badword['find'], $badword['replace'], $lsn['less']);
        require_once('./includes/replace.php');
        $lsn['less'] = $utf->win2utf(PDFReplace($lsn['less']));
        $pdf->setRTL(true);
        $pdf->SetFont("almohanad", "", 10);
        $pdf->WriteHTML($lsn['less'], true, 0, true, 0);
        $pdf->Ln(5);
        $pdf->SetFont("almohanad", "", 16);
        if($settings["SrchLink"]){
        		$pdf->Cell(0,12,$utf->win2utf("“Ì«—… «·‰”Œ… «·√’·Ì… „‰ «·œ—”"),0,1,'C',0,$settings["SiteLink"].'/lesson-'.$id.'-1.html');
        }else{
        		$pdf->Cell(0,12,$utf->win2utf("“Ì«—… «·‰”Œ… «·√’·Ì… „‰ «·œ—”"),0,1,'C',0,$settings["SiteLink"].'/show.php?L='.$id);
        }
        $pdf->Output($filename.".pdf", "I");
    }
    break;
case "rating":
    if ($_SERVER['REQUEST_METHOD']=='POST'){
    		$star1 = intval($_POST['star1']);
            $id    = intval($_POST['id']);
            if($id){
            		$Query = $db->query("UPDATE less SET Votes=Votes+1, Rate=Rate+$star1 WHERE lessid=$id");
            }
    }
    break;
case "print":
    $id = intval($_GET['L']);
    if(!$id){
        $MSG['Title'] = $settings['sitetitle'];
        $MSG['Content'] = '«·œ—” «·„Õœœ €Ì— „ÊÃÊœ ›Ì Õ«· ﬂ‰  ≈ »⁄  —«»ÿ Œ«ÿ∆ «·—Ã«¡ ≈⁄·«„ «·„‘—› ';
        echo $tpl->display('header.htm');
        echo $tpl->display('msgbox.htm');
        echo $tpl->display('footer.htm');
        exit;
    }
    require_once('./includes/replace.php');
    $lsn = $db->get_row("select * from less where lessid='$id' and Hidden='0'");
    if(!$lsn['lesstitle']){
        $MSG['Title'] = $settings['sitetitle'];
        $MSG['Content'] = '«·œ—” «·„Õœœ €Ì— „ÊÃÊœ ›Ì Õ«· ﬂ‰  ≈ »⁄  —«»ÿ Œ«ÿ∆ «·—Ã«¡ ≈⁄·«„ «·„‘—› ';
        echo $tpl->display('header.htm');
        echo $tpl->display('msgbox.htm');
        echo $tpl->display('footer.htm');
        exit;
    }
    $badword = FilterWords();
    $lsn['less']     = str_replace($badword['find'], $badword['replace'], $lsn['less']);
    $lsn['Rating']   = CalcRate($lsn['Votes'],$lsn['Rate']);
    $lsn['lessdate'] = Hijri($lsn['lessdate'],$settings['DateFormat']);
    $lsn['less']     = Replace($lsn['less']);
    echo $tpl->display('print.htm');
    break;
case "addcomment":
    $Captcha   = explode(',',$settings['Captcha']);
    if($Captcha[1]){
    		session_start();
    }
    $L        = intval($_GET['L']);
    $LCat     = intval($_GET['LCat']);
    $LsnTitle = htmlspecialchars($_GET['LsnTitle']);
    if($L AND $LCat){
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            if($Captcha[1]){
                $security = $_POST['security'];
                if($security!=$_SESSION['security_code']){
                    $MSG['Content'] = "—ﬁ„ «· Õﬁﬁ €Ì— ’ÕÌÕ";
                    $MSG['Title'] = "≈÷«›…  ⁄·Ìﬁ";
                    $noheader = 1;
                    echo $tpl->display("msgbox.htm");
                    exit;
                }
            }
            $CName  = htmlspecialchars($_POST['CName']);
            $CMail  = htmlspecialchars($_POST['CMail']);
            $Commnt = htmlspecialchars($_POST['Commnt']);
            $Query  = $db->query("INSERT INTO comment SET  CName='$CName', CMail ='$CMail', Cmnt = '$Commnt', CLsn ='$L', CDate =CURDATE(),CCat='$LCat'");
            if($Query){
                $MSG['Content'] = " „ «÷«›… «· ⁄·Ìﬁ »‰Ã«Õ";
            }else{
                $MSG['Content'] = "Õ’·  „‘ﬂ·… ·« Ì„ﬂ‰ ≈÷«›… «· ⁄·Ìﬁ";
            }
            $MSG['Title'] = "≈÷«›…  ⁄·Ìﬁ";
            $noheader = 1;
            echo $tpl->display("msgbox.htm");
            if($Query){
                ?><script language="javascript" type="text/javascript">opener.location.reload();window.close();</script><?php
            }
            exit;
        }
        echo $tpl->display('addcomment.htm');
        echo $_SESSION['security_code'];
    }
    break;
case "attach":
        $id = intval($_GET['id']);
        if(!$id){
            $MSG['Title'] = $settings['sitetitle'];
            $MSG['Content'] = '«·„·› «·„Õœœ €Ì— „ÊÃÊœ ›Ì Õ«· ﬂ‰  ≈ »⁄  —«»ÿ Œ«ÿ∆ «·—Ã«¡ ≈⁄·«„ «·„‘—› ';
            echo $tpl->display('header.htm');
            echo $tpl->display('msgbox.htm');
            echo $tpl->display('footer.htm');
            exit;
        }
        $attach = $db->get_row("select * from attachments where AID='$id'");
        if(!$attach['AName']){
            $MSG['Title'] = $settings['sitetitle'];
            $MSG['Content'] = '«·„·› «·„Õœœ €Ì— „ÊÃÊœ ›Ì Õ«· ﬂ‰  ≈ »⁄  —«»ÿ Œ«ÿ∆ «·—Ã«¡ ≈⁄·«„ «·„‘—› ';
            echo $tpl->display('header.htm');
            echo $tpl->display('msgbox.htm');
            echo $tpl->display('footer.htm');
            exit;
        }
        $update = $db->query("UPDATE attachments SET ACounter=ACounter+1 WHERE AID=$id");
        $filesize = strlen($attach['AData']);
        header('Content-Type: application/octetstream');
    	header('Content-disposition: attachment; filename='.$attach['AName']);
    	header("Content-Length: $filesize");
    	header('Pragma: no-cache');
    	header('Expires: 0');
        echo $attach['AData'];
    break;
case "sendlsn":
        $id = intval($_GET['L']);
        if(!$id){
            $MSG['Title'] = $settings['sitetitle'];
            $MSG['Content'] = '«·œ—” «·„Õœœ €Ì— „ÊÃÊœ ›Ì Õ«· ﬂ‰  ≈ »⁄  —«»ÿ Œ«ÿ∆ «·—Ã«¡ ≈⁄·«„ «·„‘—› ';
            echo $tpl->display('header.htm');
            echo $tpl->display('msgbox.htm');
            echo $tpl->display('footer.htm');
            exit;
        }
        if ($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $ReceiverEmail = $_POST['ReceiverEmail'];
            $SenderEmail   = $_POST['SenderEmail'];
            $Message       = $_POST['Message'];
            $Subject       = $_POST['Subject'];
            $SendCopy      = $_POST['SendCopy'];
            $PageUrl       = $settings['SiteLink'] ."/show.php?L=". $id;
            $MsgSignature="______________________________________\n";
            $X = @mail ($ReceiverEmail,$Subject,"$Message \n\n\n $PageUrl \n\n $MsgSignature", "From: $EmailFrom <$SenderEmail>");
            if($X){
                $MSG['Content'] = "‘ﬂ—« ·ﬂ °  „ «—”«·… «·—”«·… ·’œÌﬁﬂ";
            }else{
                $MSG['Content'] = "⁄›Ê« ° Õ’·  „‘ﬂ·… ·„ Ì „ «—”«· «·—”«·…";
            }
            $MSG['Title'] = "«—”«· «·œ—” ·’œÌﬁ";
            $noheader = 1;
            echo $tpl->display("msgbox.htm");
            if ($SendCopy);{
                $X = @mail ($SenderEmail,$Subject,"$Message \n\n\n $PageUrl \n\n $MsgSignature", "From: ‰”Œ… „‰ «·—”«·… <saphp@msn.com>");
            }
            exit;
        }
        echo $tpl->display('sendlsn.htm');
    break;
default :
    //default
}

?>