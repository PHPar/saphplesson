<?php
/*#####################################################################*|
|                          SaphpLesson4.0                               |
| --------------------------------------------------------------------- |
|  This Script Is Free To Use But don't Delete copyright                |
|  Programmed By : Saleh AlMatrafe                                      |
|  Mobile : +966505545229 | Skype phone : saphps                        |
|  http://www.saphplesson.org  |  saphplesson@live.com(mail only)       |
|*#####################################################################*/

//format visual basic code
function VBasic($code) {
    $reserved = Array("Public", "Private", "Sub", "Dim", "As", "Integer", "End", "Me", "String", "Long", "Function", "Declare", "Lib", "ByVal", "With", "If", "Then", "Else", "Option", "Explicit", "Type", "Const", "Open", "Close", "Print", "Write", "As", "For", "Next", "To","Exit","On","Error","GoTo");
    $numr = count($reserved);
    $code = str_replace('(', ' ( ', $code);
    $code = str_replace(')', ' ) ', $code);
    $code = str_replace('.', ' . ', $code);
    $code = str_replace("'", " ' ", $code);
    $code = str_replace('"', ' " ', $code);
    $code = str_replace(",", " , ", $code);
    $lines = explode("<br />", $code);
    $numl = count($lines);
    $_numbers = "";
    for ($i = 0; $i < $numl; $i++) {
        $lines[$i] = str_replace("\r", '', $lines[$i]);
        $words = explode(' ', $lines[$i]);
        $numw = count($words);
        $line = '';
        for ($j = 0; $j < $numw; $j++) {
            $b = 0;
            if($words[$j] == "'") {
                $line = substr($line, 0, strlen($line) -1) . '<font color="#008800">' . "'";
                for ($m = $j + 1; $m < $numw; $m++) {
                    $line = $line . $words[$m] . ' ';
                }
                $line = $line . "</font>";
                break;
            }
            if ($words[$j] == '"') {
                $line = substr($line, 0, strlen($line) -1) . $words[$j];
                if ($skip == 1) {
                    $skip = 0;
                } else {
                    $skip = 1;
                }
            } else {
                if ($skip == 0) {
                    for ($k = 0; $k < $numr; $k++) {
                        if (strtolower(trim($words[$j])) == strtolower($reserved[$k])) {
                            $b = 1;
                            $line = $line . '<font color="#000088">' . $words[$j] . '</font> ';
                            break;
                        }
                    }
                    if ($b != 1) {
                        $line = $line . $words[$j];
                        if(trim($words[$j]) != '"') {
                            if(trim($words[$j]) != "'") {
                                $line = $line . ' ';
                            }
                        }
                    }
                } else {
                    if (trim($words[$j]) == '"') {
                        $line = trim($line) . '"';
                    } else {
                        $line = $line . $words[$j] . ' ';
                    }
                }
            }
        }
        $fcode = $fcode . $line . "<br />\r\n";
        if($line){
            $_numbers .= str_pad($i, 4, "0", STR_PAD_LEFT);
		    $_numbers .= "<br />\r\n";
        }
    }
    $fcode = str_replace(" ( ", "(", $fcode);
    $fcode = str_replace(" ) ", ")", $fcode);
    $fcode = str_replace(" . ", ".", $fcode);
    $fcode = str_replace(" ' ", "'", $fcode);
    $fcode = str_replace(" , ", ",", $fcode);
	$html = '<div align="center"><table border="1" width="80%" dir="ltr" cellspacing="0" bordercolor="#000000" cellpadding="2" style="border-collapse: collapse">
			<tr>
				<td colspan="2" style="color: #000000; font-family: Courier New; font-size: 12pt; font-weight: bold; background-color: #C0C0C0;text-align: left">Visual Basic CODE:</td>
			</tr>
			<tr>
				<td width="20" style="font-weight: none;color: #FFFFFF; background-color: #333333;font-size: small;" valign="top">
				<code>'.$_numbers.'</code></td>
				<td align="left" style="background: #ffffff" valign="top">
				<code>'.$fcode.'</code></td>
			</tr>
			</table></div>';
	return $html;
}

//format php code
	function phpcode($code)
	{
        $code = preg_replace('#^(( |\t)*((<br>|<br />)[\r\n]*)|\r\n|\n|\r){0,1}#si', '', $code);
        $code = strrev(preg_replace('#^(((>rb<|>/ rb<)[\n\r]*)|\n\r|\n|\r){0,1}#si', '', strrev(rtrim($code))));
        $code = str_replace( '\"', '"', $code );
		$code = preg_replace( "/<br>|<br \/>/", "\n", $code );

		$codefind = array('&gt;','&lt;','&quot;','&amp;','&#91;','&#93;');
		$codereplace = array('>','<','"','&','[',']');

		$code = str_replace($codefind, $codereplace, $code);

		if (!preg_match('#<\?#si', $code))
		{
			$code = "<?php $code \r\n ?>";
			$addedtags = true;
		}
		else
		{
			$addedtags = false;
		}

		$oldlevel = error_reporting(0);
		$code = highlight_string($code, true);
		error_reporting($oldlevel);

		if ($addedtags)
		{
			$search = array(
				'#&lt;\?php( |&nbsp;)( |&nbsp;)#siU',
				'#(<(span|font)[^>]*>)&lt;\?(</\\2>(<\\2[^>]*>))php( |&nbsp;)( |&nbsp;)#siU',
				'#( |&nbsp;)\?(>|&gt;)#siU'
			);
			$replace = array(
				'',
				'\\4',
				''
			);

			$code = preg_replace($search, $replace, $code);
		}

		$code = preg_replace('/&amp;#([0-9]+);/', '&#$1;', $code);
		$code = str_replace(array('[', ']'), array('&#91;', '&#93;'), $code);
		$lines = explode("<br />", $code);
		$_numbers = "";
		for ($i = 1; $i <= count($lines); $i++) {
		    $_numbers .= str_pad($i, 4, "0", STR_PAD_LEFT);
		    $_numbers .= "<br />\r\n";
		}

		$html = '<div align="center"><table border="1" width="80%" dir="ltr" cellspacing="0" bordercolor="#000000" cellpadding="2" style="border-collapse: collapse">
			<tr>
				<td colspan="2" style="color: #000000; font-family: Courier New; font-size: 12pt; font-weight: bold; background-color: #C0C0C0;text-align: left">PHP CODE:</td>
			</tr>
			<tr>
				<td width="20" style="font-weight: none;color: #FFFFFF; background-color: #333333;font-size: small;" valign="top">
				<code>'.$_numbers.'</code></td>
				<td align="left" style="background: #ffffff" valign="top">
				'.$code.'</td>
			</tr>
			</table></div>';
		return $html;
	}

//format simple code
function NCode($code) {
    $lines = explode("<br />", $code);
    $_numbers = "";
    for ($i = 1; $i <= count($lines); $i++) {
        $_numbers .= str_pad($i, 4, "0", STR_PAD_LEFT);
        $_numbers .= "<br />\r\n";
    }
		$html = '<div align="center"><table border="1" width="80%" dir="ltr" cellspacing="0" bordercolor="#000000" cellpadding="2" style="border-collapse: collapse">
			<tr>
				<td colspan="2" style="color: #000000; font-family: Courier New; font-size: 12pt; font-weight: bold; background-color: #C0C0C0;text-align: left">CODE:</td>
			</tr>
			<tr>
				<td width="20" style="font-weight: none;color: #FFFFFF; background-color: #333333;font-size: small;" valign="top">
				<code>'.$_numbers.'</code></td>
				<td align="left" style="background: #ffffff" valign="top">
				<code>'.$code.'</code></td>
			</tr>
			</table></div>';
		return $html;
}

//format PDF simple code
function PDFNCode($code) {
    $code = preg_replace( "/<br>|<br \/>/", "<BR>", $code );
    $arr = explode("<BR>",$code);
    $lines = count($arr);
    $height = $lines * 15;
    if($height!=15){
        //$code = implode("<br dir='ltr' align='left'>",$arr);
        //print_r($code);
        $code = "";
        for ($i=0; $i<=$lines-1; $i++)  {
            $code .= "<tr><th width='750' dir='ltr' height='10' align='left'>".$arr[$i]."</th></tr>";
        }
        return "<table border='1' cellspacing='0' cellpadding='0'><tr><th width='750' bgcolor='#666666' height='10' color='#ffffff' dir='ltr' align='left'>Code :</th></tr><tr><th width='750' height='$height'><table border='0' cellspacing='0' cellpadding='0'>$code</table></th></tr></table>";
        //return $code;
    }else{
        return "<table border='1' cellspacing='1' cellpadding='1'><tr><th width='750' bgcolor='#666666' height='10' color='#ffffff' dir='ltr' align='left'>Code :</th></tr><tr><th width='750' height='10' dir='ltr' align='left'>$code</th></tr></table>";
    }
}

//general replce function
function Replace($Text){
    global $settings;
    $search = array(
                    '~>~',
                    '~<~',
                    '~&quot;~',
                    '~\[B](.*?)\[/B]~is',
                    '~\[I](.*?)\[/I]~is',
                    '~\[U](.*?)\[/U]~is',
                    '~\[CENTER](.*?)\[/CENTER]~is',
                    '~\[LEFT](.*?)\[/P]~is',
                    '~\[RIGHT](.*?)\[/P]~is',
                    '~\[JUSTIFY](.*?)\[/P]~is',
                    '~\[SIZE=([0-9]+?)](.*?)\[/SIZE]~is',
                    '~\[FONT=(.+?)](.*?)\[/FONT]~is',
                    '~\[color=([^[]*)](.*?)\[/color]~is',
                    '~\[img]([^[]*)\[/img]~i',
                    '~\[flash=(.*?)\[/flash]~i',
                    '~\[flash\s+(width=([0-9]+?))\s+(height=([0-9]+?))](.*?)\[/flash]~is',
                    '~\[flash](.*?)\[/flash]~is',
                    '~\[icon]([^[]*)\[/icon]~i',
                    '~\r\n~',
                    '~\n~',
                    '/(\[)(php)(])(\r\n)*(.*)(\[\/php\])/esiU',
                    '~\[ram]([^[]*)\[/ram]~i',
                    '~\[sound]([^[]*)\[/sound]~i',
                    '~\[MARQUEE-R]([^[]*)\[/MARQUEE]~i',
                    '~\[MARQUEE-L]([^[]*)\[/MARQUEE]~i',
                    '/\[url\](http:\/\/|)(.*?)\[\/url\]/i',
                    '/\[url=(http:\/\/|)(.*?)\](.*?)\[\/url\]/i',
                    '/\[url\](http:\/\/|)(.*?)\[\/url\]/i',
                    '/(\[)(code)(])(\r\n)*(.*)(\[\/code\])/esiU',
                    "/(\[)(VBasic)(])(\r\n)*(.*)(\[\/VBasic\])/esiU"
          );
    $replace = array(
                    '&gt;',
                    '&lt;',
                    "'",
                    '<b>\\1</b>',
                    '<i>\\1</i>',
                    '<u>\\1</u>',
                    '<center>\\1</center>',
                    '<p align="left">\\1</p>',
                    '<p align="right">\\1</p>',
                    '<p align="justify">\\1</p>',
                    '<font size="\\1">\\2</font>',
                    '<font face="\\1">\\2</font>',
                    '<font color="\\1">\\2</font>',
                    '<img src="\\1" border="0" alt="\\1">',
                    '<embed src=\\1 type="application/x-shockwave-flash">',
                    '<object width="\\2" height="\\4"><param name="movie" value="\\5"></param><embed src="\\5" type="application/x-shockwave-flash" width="\\2" height="\\4"></embed></object>',
                    '<object width="400" height="300"><param name="movie" value="\\1"></param><embed src="\\1" type="application/x-shockwave-flash" width="400" height="300"></embed></object>',
                    '<img src="images/icon/\\1.gif" SID="\\1" border="0" alt="ÇÈÊÓÇãÉ">',
                    '<br />',
                    '<br />',
                    "phpcode('\\5')",
                    '<embed border="0" width="295" height="40" type="audio/x-pn-realaudio-plugin" controls="ControlPanel" autostart="true" src="\\1">',
                    '<embed autostart="true" Src="\\1">',
                    '<marquee direction=right loop=100 scrollAmount=3 scrollDelay=25 width=100% border=0>\\1</marquee>',
                    '<marquee direction=left loop=100 scrollAmount=3 scrollDelay=25 width=100% border=0>\\1</marquee>',
                    "<a href='http://\\2' ".($settings['NoFollow'] ? 'rel="nofollow"' : '')." target=\'_blank\'>\\1\\2</a>",
                    "<a href='http://\\2' ".($settings['NoFollow'] ? 'rel="nofollow"' : '')." target=\'_blank\'>\\3</a>",
                    "<a href='http://\\2' ".($settings['NoFollow'] ? 'rel="nofollow"' : '')." target=\'_blank\'>\\1\\2</a>",
                    "NCode('\\5')",
                    "VBasic('\\5')"
          );
    $Text = preg_replace($search, $replace, $Text);
    $Text = preg_replace("~<br />~", "<br />\r\n", $Text);
    Return $Text;
}

//WYSIWYG replce function
function WYSIWYGReplace($Text){
    $search = array(
            '~>~',
            '~<~',
            '~&quot;~',
                    '~\[B](.*?)\[/B]~is',
                    '~\[I](.*?)\[/I]~is',
                    '~\[U](.*?)\[/U]~is',
                    '~\[CENTER](.*?)\[/CENTER]~is',
                    '~\[LEFT](.*?)\[/P]~is',
                    '~\[RIGHT](.*?)\[/P]~is',
                    '~\[JUSTIFY](.*?)\[/P]~is',
                    '~\[SIZE=([0-9]+?)](.*?)\[/SIZE]~is',
                    '~\[FONT=(.+?)](.*?)\[/FONT]~is',
                    '~\[color=([^[]*)](.*?)\[/color]~is',
                    '~\[img]([^[]*)\[/img]~i',
                    '~\[icon]([^[]*)\[/icon]~i',
                    '~\r\n~',
                    '~\n~',
                    '/\[url\](http:\/\/|)(.*?)\[\/url\]/i',
                    '/\[url=(http:\/\/|)(.*?)\](.*?)\[\/url\]/i',
                    '/\[url\](http:\/\/|)(.*?)\[\/url\]/i',
          );
    $replace = array(
                       '&gt;',
                       '&lt;',
                       "'",
                    '<b>\\1</b>',
                    '<i>\\1</i>',
                    '<u>\\1</u>',
                    '<center>\\1</center>',
                    '<p align="left">\\1</p>',
                    '<p align="right">\\1</p>',
                    '<p align="justify">\\1</p>',
                    '<font size="\\1">\\2</font>',
                    '<font face="\\1">\\2</font>',
                    '<font color="\\1">\\2</font>',
                    '<img src="\\1" border="0" alt="\\1">',
                    '<img src="../images/icon/\\1.gif" SID="\\1" border="0" alt="ÇÈÊÓÇãÉ">',
                    '<BR>',
                    '<BR>',
                    "<a href='http://\\2' target=\'_blank\'>\\1\\2</a>",
                    "<a href='http://\\2' target=\'_blank\'>\\3</a>",
                    "<a href='http://\\2' target=\'_blank\'>\\1\\2</a>",
          );
    $Text = preg_replace($search, $replace, $Text);
    $Text = preg_replace("~<BR>~", "<br>\r\n", $Text);
    Return $Text;
}

//general replce function
function PDFReplace($Text){
    $search = array(
            '~>~',
            '~<~',
            '~&quot;~',
                    '~\[B](.*?)\[/B]~is',
                    '~\[I](.*?)\[/I]~is',
                    '~\[U](.*?)\[/U]~is',
                    '~\[CENTER](.*?)\[/CENTER]~is',
                    '~\[LEFT](.*?)\[/P]~is',
                    '~\[RIGHT](.*?)\[/P]~is',
                    '~\[JUSTIFY](.*?)\[/P]~is',
                    '~\[SIZE=([0-9]+?)](.*?)\[/SIZE]~is',
                    '~\[FONT=(.+?)](.*?)\[/FONT]~is',
                    '~\[color=([^[]*)](.*?)\[/color]~is',
                    '~\[img]([^[]*)\[/img]~i',
                    '~\[flash=([^[]*)\[/flash]~i',
                    '~\[icon]([^[]*)\[/icon]~i',
                    '~\r\n~',
                    '~\n~',
                    '/(\[)(php)(])(\r\n)*(.*)(\[\/php\])/esiU',
                    '~\[ram]([^[]*)\[/ram]~i',
                    '~\[sound]([^[]*)\[/sound]~i',
                    '~\[MARQUEE-R]([^[]*)\[/MARQUEE]~i',
                    '~\[MARQUEE-L]([^[]*)\[/MARQUEE]~i',
                    '/\[url\](http:\/\/|)(.*?)\[\/url\]/i',
                    '/\[url=(http:\/\/|)(.*?)\](.*?)\[\/url\]/i',
                    '/\[url\](http:\/\/|)(.*?)\[\/url\]/i',
                    '/(\[)(code)(])(\r\n)*(.*)(\[\/code\])/esiU',
                    "/(\[)(VBasic)(])(\r\n)*(.*)(\[\/VBasic\])/esiU"
          );
    $replace = array(
                       '&gt;',
                       '&lt;',
                       "'",
                    '<b>\\1</b>',
                    '<i>\\1</i>',
                    '<u>\\1</u>',
                    '<table border="0" cellspacing="1" cellpadding="1"><tr><th width="750" align="center">\\1</th></tr></table>',
                    '<table border="0" cellspacing="1" cellpadding="1"><tr><th width="750" align="left">\\1</th></tr></table>',
                    '<table border="0" cellspacing="1" cellpadding="1"><tr><th width="750" align="right">\\1</th></tr></table>',
                    '<table border="0" cellspacing="1" cellpadding="1"><tr><th width="750" align="right">\\1</th></tr></table>',
                    '<font size="\\1">\\2</font>',
                    '<font face="\\1">\\2</font>',
                    '<font color="\\1">\\2</font>',
                    '<img src="\\1" border="0" alt="\\1">',
                    "<a href='\\1' target=\'_blank\'>\\1</a>",
                    '<img src="images/icon/p\\1.gif" border="0">',
                    '<BR>',
                    '<BR>',
                    "PDFNCode('\\5')",
                    "<a href='\\1' target=\'_blank\'>\\1</a>",
                    "<a href='\\1' target=\'_blank\'>\\1</a>",
                    '<marquee direction=right loop=100 scrollAmount=3 scrollDelay=25 width=100% border=0>\\1</marquee>',
                    '<marquee direction=left loop=100 scrollAmount=3 scrollDelay=25 width=100% border=0>\\1</marquee>',
                    "<a href='http://\\2' target=\'_blank\'>\\1\\2</a>",
                    "<a href='http://\\2' target=\'_blank\'>\\3</a>",
                    "<a href='http://\\2' target=\'_blank\'>\\1\\2</a>",
                    "PDFNCode('\\5')",
                    "PDFNCode('\\5')",
          );
    $Text = preg_replace($search, $replace, $Text);
    $Text = preg_replace("~<BR>~", "<br>\r\n", $Text);
    Return $Text;
}

//clear empty tags
function EmptyReplace($Text){
$search = array(
                '~\[B][/B]~is',
                '~\[I][/I]~is',
                '~\[U][/U]~is',
                '~\[CENTER][/CENTER]~is',
                '~\[LEFT][/P]~is',
                '~\[RIGHT][/P]~is',
                '~\[JUSTIFY][/P]~is',
                '~\[SIZE=([0-9]+?)][/SIZE]~is',
                '~\[FONT=(.+?)][/FONT]~is',
                '~\[color=([^[]*)][/color]~is',
                '~\[img][/img]~i',
                '~\[flash=[/flash]~i',
                '~\[icon][/icon]~i',
                '/(\[)(php)(])(\r\n)(\[\/php\])/esiU',
                '~\[ram][/ram]~i',
                '~\[sound][/sound]~i',
                '~\[MARQUEE-R][/MARQUEE]~i',
                '~\[MARQUEE-L][/MARQUEE]~i',
                '~\[php][/php]~is',
                '~\[code][/code]~is',
                '~\[VBasic][/VBasic]~is',
                '/(\[)(code)(])(\r\n)(\[\/code\])/esiU',
                "/(\[)(VBasic)(])(\r\n)(\[\/VBasic\])/esiU"
      );
$Text = preg_replace($search, "", $Text);
Return $Text;
}
//***************END Function****************\\

?>