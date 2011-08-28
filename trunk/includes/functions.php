<?php
/*#####################################################################*|
|                          SaphpLesson4.0                               |
| --------------------------------------------------------------------- |
|  This Script Is Free To Use But don't Delete copyright                |
|  Programmed By : Saleh AlMatrafe                                      |
|  Mobile : +966505545229 | Skype phone : saphps                        |
|  http://www.saphplesson.org  |  saphplesson@live.com(mail only)       |
|*#####################################################################*/


//add slashes to array
function add_slashes(&$Str)
{
    if ( get_magic_quotes_gpc() )
    {
        if ( is_array($Str) )
        {
            foreach ($Str as $k => $v)
            {
                $Str[$k] = trim($v);
            }
        }
        else
        {
            $Str = trim($Str);
        }
    }
    else
    {
        if ( is_array($Str) )
        {
            foreach ($Str as $k => $v)
            {
                $Str[$k] = addslashes(trim($v));
            }
        }
        else
        {
            $Str = addslashes(trim($Str));
        }
    }
   return $Str;
}

// Hijri Date By Khaled Mamduh
function Hijri($GetDateFormat,$DateFormatD)
{
    if ($DateFormatD=="0"){
        $TDays=round(strtotime($GetDateFormat)/(60*60*24));
        $HYear=round($TDays/354.37419);
        $Remain=$TDays-($HYear*354.37419);
        $HMonths=round($Remain/29.531182);
        $HDays=$Remain-($HMonths*29.531182);
        $HYear=$HYear+1389;
        $HMonths=$HMonths+10;
        $HDays=$HDays+23;
        if ($HDays>29.531188 and round($HDays)!=30)
        {
              $HMonths=$HMonths+1;
              $HDays=Round($HDays-29.531182);
        }else{
              $HDays=Round($HDays);
        }
        if ($HMonths>12){$HMonths=$HMonths-12;$HYear=$HYear+1;}
        $ResultDate="$HDays-$HMonths-$HYear";
        $ResultDate="$ResultDate"."Â‹";
        return $ResultDate;
    }else{
        $time = strtotime ($GetDateFormat);
        return date("d/m/Y", $time);
    }
}

//Calc Rate For Lessons By Saleh AlMatrafe
function CalcRate($Votes,$Rate)
{
    if ($Votes <> 0){
        $Rating = round($Rate / $Votes,2);
        if($Rating > 5) {$Rating = 5;}
        if($Rating < 0) {$Rating = 0;}
    }else{
        $Rating = 0;
    }
    return floor($Rating);
}

//get browser for User By Saleh AlMatrafe
function CheckBrowser()
{
    $browser_string = strtolower($_SERVER["HTTP_USER_AGENT"]);
    $ie_version = preg_replace('/.*msie/sm', '', $browser_string);
    $ie_version = substr ($ie_version, 0,4);
    $moz_version = preg_replace('/.*rv:/sm', '', $browser_string);
    $moz_version = substr ($moz_version, 0,3);
    if ($ie_version>=5){
        return "IE";
    }elseif($moz_version>="1.5"){
        return "FireFox";
    }else{
        return "Unknown";
    }
}

//Thanx For Pal Coder
function CleanVar($var)
{
    (get_magic_quotes_gpc() == 0) ? $var : addslashes($var);

    return htmlspecialchars(trim($var));
}

//Get User IP
function real_ip()
{
    $alt_ip = $_SERVER['REMOTE_ADDR'];
    if (isset($_SERVER['HTTP_CLIENT_IP']))
    {
        $alt_ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches))
    {
        foreach ($matches[0] AS $ip)
        {
            if (!preg_match("#^(10|172\.16|192\.168)\.#", $ip))
            {
                $alt_ip = $ip;
                break;
            }
        }
    }
    else if (isset($_SERVER['HTTP_FROM']))
    {
        $alt_ip = $_SERVER['HTTP_FROM'];
    }
    return $alt_ip;
}

//get styles from style folder
function get_styles($style_root){
        $styles_dir = @ opendir($style_root);
        if(!$styles_dir){
            exit;
        }
        $i = 1;
        while ( ($style_dir = readdir($styles_dir)) !== false ) {
            if (is_dir($style_root . '/' . $style_dir)){
                if ( $style_dir{0} == '.' || $style_dir == '..' || $style_dir == 'CVS')
			    continue;
                    $style["style"] = $style_dir;
                    $styles[] = $style;
            }
        }
        @closedir($styles_dir);
        return $styles;
}

//format pages $PageNav = pager($Limet,$Page,"pages.php?page=%d");
function pager($numofpages,$page_num = 1,$link){
    if ($numofpages > '1' ) {
            $range =10;
            $range_min = ($range % 2 == 0) ? ($range / 2) - 1 : ($range - 1) / 2;
            $range_max = ($range % 2 == 0) ? $range_min + 1 : $range_min;
            $page_min = $page_num- $range_min;
            $page_max = $page_num+ $range_max;

            $page_min = ($page_min < 1) ? 1 : $page_min;
            $page_max = ($page_max < ($page_min + $range - 1)) ? $page_min + $range - 1 : $page_max;
            if ($page_max > $numofpages) {
                $page_min = ($page_min > 1) ? $numofpages - $range + 1 : 1;
                $page_max = $numofpages;
            }

            $page_min = ($page_min < 1) ? 1 : $page_min;

            if ( ($page_num > ($range - $range_min)) && ($numofpages > $range) ) {
                $page_pagination .= '<a class="pager"  title="«·’›Õ… «·√Ê·Ï" href="'.sprintf($link, 1).'">&laquo;</a> ';
            }

            if ($page_num != 1) {
                $page_pagination .= '<a class="pager" href="'.sprintf($link, ($page_num-1)).'">«·”«»ﬁ</a> ';
            }

            for ($i = $page_min;$i <= $page_max;$i++) {
                if ($i == $page_num)
                $page_pagination .= '<span class="pager"><strong>' . $i . '</strong></span> ';
                else
                $page_pagination.= '<a class="pager" href="'.sprintf($link, $i).'">'.$i.'</a> ';
            }

            if ($page_num < $numofpages) {
                $page_pagination.= ' <a class="pager" href="'.sprintf($link, ($page_num + 1)).'">«· «·Ì</a>';
            }


            if (($page_num< ($numofpages - $range_max)) && ($numofpages > $range)) {
                $page_pagination .= ' <a class="pager" title="«·’›Õ… «·√ŒÌ—…" href="'.sprintf($link, $numofpages).'">&raquo;</a> ';
            }
            $page_pagination ='<div id="pagination">&nbsp;&nbsp;«·’›Õ«  :&nbsp;'.$page_pagination.'</div>';
            return $page_pagination;
    }else{
        return false;
    }
}

//XSS Remove
function XSS_Remove($x_content){
    $x_content = preg_replace('#(<[^>]+[\s\r\n\"\'])(on|xmlns)[^>]*>#iU',"$1>",$x_content);
    $x_content = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([\`\'\"]*)[\\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iU','$1=$2nojavascript...',$x_content);
    $x_content = preg_replace('#([a-z]*)[\x00-\x20]*=([\'\"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iU','$1=$2novbscript...',$x_content);
    $x_content = preg_replace('#</*\w+:\w[^>]*>#i','',$x_content);
    do {
        $oldstring = $x_content;
        $x_content = preg_replace('#</*(\?xml|applet|meta|xml|blink|link|style|script|object|iframe|frame|frameset|ilayer|layer|bgsound|title|base)[^>]*>#i',"",$x_content);
    } while ($oldstring != $x_content);
    return $x_content;
}

//filter bad word
function FilterWords(){
    global $db;
    $return            = array();
    $return['find']    = array();
    $return['replace'] = array();
    $words   = $db->get_results("select * from words");
    $nword    = count($words);
    if($nword){
        for ($i=0; $i<=$nword-1; $i++){
            $return['find'][]    = $words[$i]['WFind'];
            $return['replace'][] = $words[$i]['WReplace'];
        }
    }
    return $return;
}

//express go list
function exgo(){
    global $db;
    $cats   = $db->get_results("select * from forums order by CatID,COrder");
    $ncat    = count($cats);
    $return = array();
    if($ncat){
        for($i=0;$i<$ncat;$i++) {
            if($cats[$i]['CatID']){
                $return[$cats[$i]['CatID']]['sub'][$cats[$i]['id']] = $cats[$i];
            }else{
                $return[$cats[$i]['id']] = $cats[$i];
            }
        }
    }
    return $return;
}


//function to validate ip address format in php by Roshan Bhattarai(http://roshanbh.com.np)
function validateIpAddress($ip_addr)
{
  //first of all the format of the ip address is matched
  if(preg_match("/^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/",$ip_addr))
  {
    //now all the intger values are separated
    $parts=explode(".",$ip_addr);
    //now we need to check each part can range from 0-255
    foreach($parts as $ip_parts)
    {
      if(intval($ip_parts)>255 || intval($ip_parts)<0)
      return false; //if number is not within range of 0-255
    }
    return true;
  }
  else
    return false; //if format of ip address doesn't matches
}
?>