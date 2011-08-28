<?php
/*
  ****************************************************
  * RTF Generation PHP Class (For SaphpLesson Only). *
  * ------------------------------------------------ *
  * Written By : Saleh AlMatrafe <saleh@saleh.cc>    *
  * ------------------------------------------------ *
  * Copyright (C) 2008 by Saleh AlMatrafe.           *
  ****************************************************
*/

class RTF
{
    var $fonts = Array('Tahoma', 'Arabic Typesetting', 'Arial', 'Courier New', 'Microsoft Sans Serif', 'Times New Roman', 'Verdana');
    var $color = array('#000000' ,'#A0522D' ,'#556B2F' ,'#006400' ,'#483D8B' ,'#000080' ,'#4B0082' ,'#2F4F4F' ,'#8B0000' ,'#FF8C00' ,'#808000' ,'#008000' ,'#008080' ,'#0000FF' ,'#708090' ,'#696969' ,'#FF0000' ,'#F4A460' ,'#9ACD32' ,'#2E8B57' ,'#48D1CC' ,'#4169E1' ,'#800080' ,'#808080' ,'#FF00FF' ,'#FFA500' ,'#FFFF00' ,'#00FF00' ,'#00FFFF' ,'#00BFFF' ,'#9932CC' ,'#C0C0C0' ,'#FFC0CB' ,'#F5DEB3' ,'#FFFACD' ,'#98FB98' ,'#AFEEEE' ,'#ADD8E6' ,'#DDA0DD' ,'#FFFFFF' ,'#0000BB' ,'#007700' ,'#DD0000' ,'#FF8000');
    var $sizes = array('8' ,'16' ,'20' ,'24' ,'28' ,'36' ,'48' ,'72');

    function RTF(){
    }

    function load_colors(){
        $return  = '';
        $return .= "{\\colortbl;";
        for ($i=0; $i<count($this->color); $i++)  {
            $return .= $this->_toRGB($this->color[$i]);
        }
        $return .= "}\n";
        return $return;
    }

    function load_fonts(){
        $return  = '';
        $return .= "{\\fonttbl";
        for ($i=0; $i<count($this->fonts); $i++)  {
            $return .= "{\\f".$i."\\fswiss\\fprq2\\fcharset178 ".$this->fonts[$i].";}";
        }
        $return .= "}\n";
        return $return;
    }

    function _toRGB($hex){
        // strip off any leading #
        if (0 === strpos($hex, '#')) {
            $hex = substr($hex, 1);
        } else if (0 === strpos($hex, '&H')) {
            $hex = substr($hex, 2);
        }

        // break into hex 3-tuple
        $cutpoint = ceil(strlen($hex) / 2)-1;
        $rgb = explode(':', wordwrap($hex, $cutpoint, ':', $cutpoint), 3);

        // convert each tuple to decimal
        $rgb[0] = (isset($rgb[0]) ? hexdec($rgb[0]) : 0);
        $rgb[1] = (isset($rgb[1]) ? hexdec($rgb[1]) : 0);
        $rgb[2] = (isset($rgb[2]) ? hexdec($rgb[2]) : 0);

        //return ($asString ? "{$rgb[0]} {$rgb[1]} {$rgb[2]}" : $rgb);
        return "\\red".$rgb[0]."\\green".$rgb[1]."\\blue".$rgb[2].";\n";
    }

    function Replace($str){
        $search = array(
    	    	'~\[B](.*?)\[/B]~is',
    		    '~\[I](.*?)\[/I]~is',
    		    '~\[U](.*?)\[/U]~is',
                '~\[CENTER](.*?)\[/CENTER]~is',
                '~\[LEFT](.*?)\[/P]~is',
                '~\[RIGHT](.*?)\[/P]~is',
                '~\[JUSTIFY](.*?)\[/P]~is',
                '~\[php](.*?)\[/php]~is',
                '~\[code](.*?)\[/code]~is',
                '~\[vbasic](.*?)\[/vbasic]~is',
                '~\[flash=([^[]*)\[/flash]~i',
                '~\[ram]([^[]*)\[/ram]~i',
                '~\[sound]([^[]*)\[/sound]~i',
                '~\[MARQUEE-R]([^[]*)\[/MARQUEE]~i',
                '~\[MARQUEE-L]([^[]*)\[/MARQUEE]~i',
                '/\[url\](http:\/\/|)(.*?)\[\/url\]/i',
                '/\[url=(http:\/\/|)(.*?)\](.*?)\[\/url\]/i',
                '/\[url\](http:\/\/|)(.*?)\[\/url\]/i'
                        );
        $replace = array(
    	    	"\\b \\1\\b0 ",
    		    "\\i \\1\\i0 ",
    		    "\\ul \\1\\ulnone ",
                "\\pard\\rtlpar\\qc \\1 \\par\\pard\\rtlpar\\qr ",
                "\\pard\\ltrpar\\ql \\1 \\par\\pard\\rtlpar\\qr ",
                "\\pard\\rtlpar\\qr \\1 \\par\\pard\\rtlpar\\qr ",
                "\\pard\\rtlpar\\qr \\1 \\par\\pard\\rtlpar\\qr ",
                "\\trowd\\rtlrow\\trgaph108\\trleft-108\\trqr\\trbrdrl\\brdrs\\brdrw10\\brdrcf1 \\trbrdrt\\brdrs\\brdrw10\\brdrcf1 \\trbrdrr\\brdrs\\brdrw10\\brdrcf1 \\trbrdrb\\brdrs\\brdrw10\\brdrcf1 \\trpaddl108\\trpaddr108\\trpaddfl3\\trpaddfr3 \\clbrdrl\\brdrw10\\brdrs\\brdrcf1\\clbrdrt\\brdrw10\\brdrs\\brdrcf1\\clbrdrr\\brdrw10\\brdrs\\brdrcf1\\clbrdrb\\brdrw10\\brdrs\\brdrcf1 \\cellx8748\\pard\\intbl\\ltrpar\\nowidctlpar\\f2\\fs20 PHP Code\\cell\\row\\trowd\\rtlrow\\trgaph108\\trleft-108\\trqr\\trbrdrl\\brdrs\\brdrw10\\brdrcf1 \\trbrdrt\\brdrs\\brdrw10\\brdrcf1 \\trbrdrr\\brdrs\\brdrw10\\brdrcf1 \\trbrdrb\\brdrs\\brdrw10\\brdrcf1 \\trpaddl108\\trpaddr108\\trpaddfl3\\trpaddfr3 \\clbrdrl\\brdrw10\\brdrs\\brdrcf1\\clbrdrt\\brdrw10\\brdrs\\brdrcf1\\clbrdrr\\brdrw10\\brdrs\\brdrcf1\\clbrdrb\\brdrw10\\brdrs\\brdrcf1 \\cellx8748\\pard\\intbl\\ltrpar\\nowidctlpar\\f3 \\1 \\cell\\row\\pard\\rtlpar\\nowidctlpar\\qr\\f2\\par",
                "\\trowd\\rtlrow\\trgaph108\\trleft-108\\trqr\\trbrdrl\\brdrs\\brdrw10\\brdrcf1 \\trbrdrt\\brdrs\\brdrw10\\brdrcf1 \\trbrdrr\\brdrs\\brdrw10\\brdrcf1 \\trbrdrb\\brdrs\\brdrw10\\brdrcf1 \\trpaddl108\\trpaddr108\\trpaddfl3\\trpaddfr3 \\clbrdrl\\brdrw10\\brdrs\\brdrcf1\\clbrdrt\\brdrw10\\brdrs\\brdrcf1\\clbrdrr\\brdrw10\\brdrs\\brdrcf1\\clbrdrb\\brdrw10\\brdrs\\brdrcf1 \\cellx8748\\pard\\intbl\\ltrpar\\nowidctlpar\\f2\\fs20 Code\\cell\\row\\trowd\\rtlrow\\trgaph108\\trleft-108\\trqr\\trbrdrl\\brdrs\\brdrw10\\brdrcf1 \\trbrdrt\\brdrs\\brdrw10\\brdrcf1 \\trbrdrr\\brdrs\\brdrw10\\brdrcf1 \\trbrdrb\\brdrs\\brdrw10\\brdrcf1 \\trpaddl108\\trpaddr108\\trpaddfl3\\trpaddfr3 \\clbrdrl\\brdrw10\\brdrs\\brdrcf1\\clbrdrt\\brdrw10\\brdrs\\brdrcf1\\clbrdrr\\brdrw10\\brdrs\\brdrcf1\\clbrdrb\\brdrw10\\brdrs\\brdrcf1 \\cellx8748\\pard\\intbl\\ltrpar\\nowidctlpar\\f3 \\1 \\cell\\row\\pard\\rtlpar\\nowidctlpar\\qr\\f2\\par",
                "\\trowd\\rtlrow\\trgaph108\\trleft-108\\trqr\\trbrdrl\\brdrs\\brdrw10\\brdrcf1 \\trbrdrt\\brdrs\\brdrw10\\brdrcf1 \\trbrdrr\\brdrs\\brdrw10\\brdrcf1 \\trbrdrb\\brdrs\\brdrw10\\brdrcf1 \\trpaddl108\\trpaddr108\\trpaddfl3\\trpaddfr3 \\clbrdrl\\brdrw10\\brdrs\\brdrcf1\\clbrdrt\\brdrw10\\brdrs\\brdrcf1\\clbrdrr\\brdrw10\\brdrs\\brdrcf1\\clbrdrb\\brdrw10\\brdrs\\brdrcf1 \\cellx8748\\pard\\intbl\\ltrpar\\nowidctlpar\\f2\\fs20 Visual Basic Code\\cell\\row\\trowd\\rtlrow\\trgaph108\\trleft-108\\trqr\\trbrdrl\\brdrs\\brdrw10\\brdrcf1 \\trbrdrt\\brdrs\\brdrw10\\brdrcf1 \\trbrdrr\\brdrs\\brdrw10\\brdrcf1 \\trbrdrb\\brdrs\\brdrw10\\brdrcf1 \\trpaddl108\\trpaddr108\\trpaddfl3\\trpaddfr3 \\clbrdrl\\brdrw10\\brdrs\\brdrcf1\\clbrdrt\\brdrw10\\brdrs\\brdrcf1\\clbrdrr\\brdrw10\\brdrs\\brdrcf1\\clbrdrb\\brdrw10\\brdrs\\brdrcf1 \\cellx8748\\pard\\intbl\\ltrpar\\nowidctlpar\\f3 \\1 \\cell\\row\\pard\\rtlpar\\nowidctlpar\\qr\\f2\\par",
                "\\1",
                "\\1",
                "\\1",
                "\\1",
                "\\1",
                "\\2",
                "\\2",
                "\\2"
                        );
        $return = preg_replace($search, $replace, $str);
        $return = preg_replace_callback('~\[FONT=(.+?)](.*?)\[/FONT]~is', array($this,"_font"), $return);
        $return = preg_replace_callback('~\[color=([^[]*)](.*?)\[/color]~is', array($this,"_color"), $return);
        $return = preg_replace_callback('~\[SIZE=([0-9]+?)](.*?)\[/SIZE]~is', array($this,"_size"), $return);
        $return = preg_replace_callback('~\[img]([^[]*)\[/img]~i', array($this,"_img"), $return);
        $return = preg_replace_callback('~\[icon]([^[]*)\[/icon]~i', array($this,"_icon"), $return);
        $return = str_replace("\n", "\\par\n", $return);
        return $return;
    }

    function array_search_bit($search, $array_in)
    {
        foreach ($array_in as $key => $value)
        {
        if (strtolower($search)==strtolower($value))
            return $key;
        }

        return false;
    }
    function _font($s){
        $return = '';
        $key = $this->array_search_bit($s[1], $this->fonts);
        $key ? $key = $key : $key = '0';
        $return .= "\\f".$key." ".$s[2]."\\f0 ";
        return $return;
    }

    function _size($s){
        $return = '';
        $key = $this->sizes[$s[1]];
        $key ? $key = $key : $key = '20';
        $return .= "\\fs".$key." ".$s[2]."\\fs20 ";
        return $return;
    }

    function _color($s){
        $return = '';
        $key = $this->array_search_bit($s[1], $this->color);
        $key ? $key = $key+1 : $key = '0';
        $return .= "\\cf".$key." ".$s[2]."\\cf0 ";
        return $return;
    }

	function _img($s)
	{
		$file = @file_get_contents($s[1]);

		if (empty($file))
			return NULL;

		$return  = "{";
		$return .= "\\pict\\jpegblip\\picscalex100\\picscaley100\\bliptag132000428 ";
		$return .= trim(bin2hex($file));
		$return .= "}";
        return $return;
	}

	function _icon($s)
	{
		$file = @file_get_contents('images/icon/'.$s[1].'.gif');

		if (empty($file))
			return NULL;

		$return  = "{";
		$return .= "\\pict\\jpegblip\\picscalex100\\picscaley100\\bliptag132000428 ";
		$return .= trim(bin2hex($file));
		$return .= "}";
        return $return;
	}

    function document($str,$filename){
        $return  = "{\\rtf1\\fbidis\\ansi\\ansicpg1256\\deff0\\deflang1033\\deflangfe1033\n";
        $return .= $this->load_fonts();
        $return .= $this->load_colors();
        $return .= "{\\*\\generator SaphpLesson4.0;}\\viewkind1\\uc1\\pard\\rtlpar\\qr\\f0\\ltrch\\fs20";
        $return .= $this->Replace($str);
        $return .= "\n}\n";
		header('Content-type: application/msword');
		header('Content-Lenght: '. sizeof($return));
	   	header('Content-Disposition: inline; filename='.$filename.'.rtf');
        echo $return;
    }
}
?>