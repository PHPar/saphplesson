<?php
/*#####################################################################*|
|                          SaphpLesson4.0                               |
| --------------------------------------------------------------------- |
|  This Script Is Free To Use But don't Delete copyright                |
|  Programmed By : Saleh AlMatrafe                                      |
|  Mobile : +966505545229 | Skype phone : saphps                        |
|  http://www.saphplesson.org  |  saphplesson@live.com(mail only)       |
|*#####################################################################*/

function sanitize_url($type, $url, $delimiter = '\\"')
{
	static $find, $replace;
	if (!is_array($find))
	{
		$find =    array('<',    '>',    '\\"');
		$replace = array('&lt;', '&gt;', '"');
	}

	$delimiter = str_replace('\\"', '"', $delimiter);

	return str_replace('\\"', '"', $type) . '=' . $delimiter . str_replace($find, $replace, $url) . $delimiter;
}

function convert_wysiwyg_html_to_bbcode($text, $allowhtml = false, $p_two_linebreak = false)
{

	$text = preg_replace(array(
			'#<a href="([^"]*)\[([^"]+)"(.*)>(.*)\[\\2</a>#siU',
			'#(<[^<>]+ (src|href))=(\'|"|)??(.*)(\\3)#esiU'
		), array(
			'<a href="\1"\3>\4</a>[\2',
			"sanitize_url('\\1', '\\4', '\\3')"
		), $text
	);

	if (!$allowhtml)
	{
		$text = str_replace('<br/>', '<br />', $text);
		$text = preg_replace('#<script[^>]*>(.*)</script>#siU', '', $text);
		$text = strip_tags($text, '<b><strong><i><em><u><a><div><span><p><blockquote><ol><ul><li><font><img><br><h1><h2><h3><h4><h5><h6>');
	}

	$text = str_replace('&nbsp;', ' ', $text);

	if (CheckBrowser()=="FireFox")
	{
		$text = preg_replace('#(?<!<br>|<br />|\r)(\r\n|\n|\r)#', ' ', $text);
	}

	$text = preg_replace('#(\r\n|\n|\r)#', '', $text);

	$pregfind = array
	(
		'#<(h[0-9]+)[^>]*>(.*)</\\1>#siU',
		'#<img[^>]+SID=(\'|")(.*)(\\1).*>#siU',
		'#<img[^>]+src=(\'|")(.*)(\\1).*>#esiU',
		'#<br.*>#siU',
		'#<a name=[^>]*>(.*)</a>#siU',
		'#\[(code|php|vbasic)\]((?>[^\[]+?|(?R)|.))*\[/\\1\]#siUe',
		'#\[url=(\'|"|&quot;|)<A href="(.*)/??">\\2/??</A>#siU'
	);
	$pregreplace = array
	(
		"[B]\\2[/B]\n\n",
		"[icon]\\2[/icon]",
		"handle_wysiwyg_img('\\2')",
		"\n",
		'\1',
		"strip_tags_callback('\\0')",
		'[url=$1$2'
	);
	$text = preg_replace($pregfind, $pregreplace, $text);

	$text = parse_wysiwyg_recurse('b', $text, 'parse_wysiwyg_code_replacement', 'b');
	$text = parse_wysiwyg_recurse('strong', $text, 'parse_wysiwyg_code_replacement', 'b');
	$text = parse_wysiwyg_recurse('i', $text, 'parse_wysiwyg_code_replacement', 'i');
	$text = parse_wysiwyg_recurse('em', $text, 'parse_wysiwyg_code_replacement', 'i');
	$text = parse_wysiwyg_recurse('u', $text, 'parse_wysiwyg_code_replacement', 'u');
	$text = parse_wysiwyg_recurse('a', $text, 'parse_wysiwyg_anchor');
	$text = parse_wysiwyg_recurse('font', $text, 'parse_wysiwyg_font');
	$text = parse_wysiwyg_recurse('blockquote', $text, 'parse_wysiwyg_code_replacement', 'indent');
	$text = parse_wysiwyg_recurse('div', $text, 'parse_wysiwyg_div');
	$text = parse_wysiwyg_recurse('span', $text, 'parse_wysiwyg_span');

	$GLOBALS['p_two_linebreak'] = $p_two_linebreak;
	$text = parse_wysiwyg_recurse('p', $text, 'parse_wysiwyg_paragraph');

	$pregfind = array(
		'#<li>(.*)((?=<li>)|</li>)#iU',
		'#<p></p>#i',
		'#<p.*>#iU'
	);
	$pregreplace = array(
		"\\1\n",
		'',
		"\n"
	);
	$text = preg_replace($pregfind, $pregreplace, $text);

	$text = preg_replace('#</?(A|LI|FONT|IMG)>#siU', '', $text);

	$strfind = array
	(
		'&lt;',
		'&gt;',
		'&amp;'
	);
	$strreplace = array
	(
		'<',
		'>',
		'&'
	);

	$text = str_replace($strfind, $strreplace, $text);

	$text = preg_replace('#\[url=("|\'|)(.*)\\1\]\\2\[/url\]#siU', '[url]$2[/url]', $text);

	return trim($text);
}

function handle_wysiwyg_img($img_url)
{
	$img_url = str_replace('\\"', '"', $img_url);

	if (!preg_match('#^https?://#i', $img_url))
	{
		$img_url = create_full_url($img_url);
	}

	return '[img]' . $img_url . '[/img]';
}

function parse_style_attribute($tagoptions, &$prependtags, &$appendtags)
{
	$searchlist = array(
		array('tag' => 'left', 'option' => false, 'regex' => '#text-align:\s*(left);?#i'),
		array('tag' => 'center', 'option' => false, 'regex' => '#text-align:\s*(center);?#i'),
		array('tag' => 'right', 'option' => false, 'regex' => '#text-align:\s*(right);?#i'),
        array('tag' => 'justify', 'option' => false, 'regex' => '#text-align:\s*(justify);?#i'),
		array('tag' => 'color', 'option' => true, 'regex' => '#(?<![a-z0-9-])color:\s*([^;]+);?#i', 'match' => 1),
		array('tag' => 'font', 'option' => true, 'regex' => '#font-family:\s*(\'|)([^;,\']+)\\1[^;]*;?#i', 'match' => 2),
		array('tag' => 'b', 'option' => false, 'regex' => '#font-weight:\s*(bold);?#i'),
		array('tag' => 'i', 'option' => false, 'regex' => '#font-style:\s*(italic);?#i'),
		array('tag' => 'u', 'option' => false, 'regex' => '#text-decoration:\s*(underline);?#i')
	);

	$style = parse_wysiwyg_tag_attribute('style=', $tagoptions);
	$style = preg_replace(
		'#(?<![a-z0-9-])color:\s*rgb\((\d+),\s*(\d+),\s*(\d+)\)(;?)#ie',
		'sprintf("color: #%02X%02X%02X$4", $1, $2, $3)',
		$style
	);
	foreach ($searchlist AS $searchtag)
	{
		if (preg_match($searchtag['regex'], $style, $matches))
		{
			$prependtags .= '[' . strtoupper($searchtag['tag']) . ($searchtag['option'] == true ? '=' . $matches["$searchtag[match]"] : '') . ']';
            if(($searchtag['tag']=='right') or ($searchtag['tag']=='justify') or ($searchtag['tag']=='left')){
                $appendtags = "[/P]$appendtags";
            }else{
			    $appendtags = '[/' . strtoupper($searchtag['tag']) . "]$appendtags";
            }
		}
	}
}

function parse_wysiwyg_anchor($aoptions, $text)
{
	$href = parse_wysiwyg_tag_attribute('href=', $aoptions);
	return "[url=$href]" . parse_wysiwyg_recurse('a', $text, 'parse_wysiwyg_anchor') . "[/url]";
}

function parse_wysiwyg_paragraph($poptions, $text)
{
	$style = parse_wysiwyg_tag_attribute('style=', $poptions);
	$align = parse_wysiwyg_tag_attribute('align=', $poptions);

	switch ($align)
	{
		case 'left':
		case 'center':
		case 'right':
        case 'justify':
			break;
		default:
			$align = '';
	}

	$align = strtoupper($align);

	$prepend = '';
	$append = '';

	parse_style_attribute($poptions, $prepend, $append);
	if ($align)
	{
        if($align=="CENTER"){
    		$prepend .= "[$align]";
    		$append .= "[/$align]";
        }else{
    		$prepend .= "[$align]";
    		$append .= "[/P]";
        }
	}

	global $p_two_linebreak;
	if ($p_two_linebreak)
	{
		$append .= "\n\n";
	}
	else
	{
		$append .= "\n";
	}

	return $prepend . parse_wysiwyg_recurse('p', $text, 'parse_wysiwyg_paragraph') . $append;
}

function parse_wysiwyg_span($spanoptions, $text)
{

	$prependtags = '';
	$appendtags = '';
	parse_style_attribute($spanoptions, $prependtags, $appendtags);

	return $prependtags . parse_wysiwyg_recurse('span', $text, 'parse_wysiwyg_span') . $appendtags;
}

function parse_wysiwyg_div($divoptions, $text)
{
	$prepend = '';
	$append = '';

	parse_style_attribute($divoptions, $prepend, $append);
	$align = parse_wysiwyg_tag_attribute('align=', $divoptions);

	switch ($align)
	{
		case 'left':
		case 'center':
		case 'right':
        case 'justify':
			break;
		default:
			$align = '';
	}

	$align = strtoupper($align);

	if ($align)
	{
        if($align=="CENTER"){
    		$prepend .= "[$align]";
    		$append .= "[/$align]";
        }else{
    		$prepend .= "[$align]";
    		$append .= "[/P]";
        }
	}
	$append .= "\n";

	return $prepend . parse_wysiwyg_recurse('div', $text, 'parse_wysiwyg_div') . $append;
}


function parse_wysiwyg_font($fontoptions, $text)
{
	$tags = array(
		'FONT' => 'face=',
		'SIZE' => 'size=',
		'color' => 'color='
	);
	$prependtags = '';
	$appendtags = '';

	$fontoptionlen = strlen($fontoptions);

	foreach ($tags AS $code => $locate)
	{
		$optionvalue = parse_wysiwyg_tag_attribute($locate, $fontoptions);
		if ($optionvalue)
		{
			$prependtags .= "[$code=$optionvalue]";
			$appendtags = "[/$code]$appendtags";
		}
	}

	parse_style_attribute($fontoptions, $prependtags, $appendtags);
    if ($text!=""){
	    return $prependtags . parse_wysiwyg_recurse('font', $text, 'parse_wysiwyg_font') . $appendtags;
	}
}

function parse_wysiwyg_code_replacement($options, $text, $tagname, $parseto)
{
	if (trim($text) == '')
	{
		return '';
	}

		$text = parse_wysiwyg_recurse($tagname, $text, 'parse_wysiwyg_code_replacement', $parseto);
		return '['.strtoupper($parseto).']'.$text.'[/'.strtoupper($parseto).']';
}

function parse_wysiwyg_recurse($tagname, $text, $functionhandle, $extraargs = '')
{
	$tagname = strtolower($tagname);
	$open_tag = "<$tagname";
	$open_tag_len = strlen($open_tag);
	$close_tag = "</$tagname>";
	$close_tag_len = strlen($close_tag);

	$beginsearchpos = 0;
	do {
		$textlower = strtolower($text);
		$tagbegin = @strpos($textlower, $open_tag, $beginsearchpos);
		if ($tagbegin === false)
		{
			break;
		}

		$strlen = strlen($text);

		$inquote = '';
		$found = false;
		$tagnameend = false;
		for ($optionend = $tagbegin; $optionend <= $strlen; $optionend++)
		{
			$char = $text{$optionend};
			if (($char == '"' OR $char == "'") AND $inquote == '')
			{
				$inquote = $char;
			}
			else if (($char == '"' OR $char == "'") AND $inquote == $char)
			{
				$inquote = '';
			}
			else if ($char == '>' AND !$inquote)
			{
				$found = true;
				break;
			}
			else if (($char == '=' OR $char == ' ') AND !$tagnameend)
			{
				$tagnameend = $optionend;
			}
		}
		if (!$found)
		{
			break;
		}
		if (!$tagnameend)
		{
			$tagnameend = $optionend;
		}
		$offset = $optionend - ($tagbegin + $open_tag_len);
		$tagoptions = substr($text, $tagbegin + $open_tag_len, $offset);
		$acttagname = substr($textlower, $tagbegin + 1, $tagnameend - $tagbegin - 1);
		if ($acttagname != $tagname)
		{
			$beginsearchpos = $optionend;
			continue;
		}

		$tagend = strpos($textlower, $close_tag, $optionend);
		if ($tagend === false)
		{
			break;
		}

		$nestedopenpos = strpos($textlower, $open_tag, $optionend);
		while ($nestedopenpos !== false AND $tagend !== false)
		{
			if ($nestedopenpos > $tagend)
			{
				break;
			}
			$tagend = strpos($textlower, $close_tag, $tagend + $close_tag_len);
			$nestedopenpos = strpos($textlower, $open_tag, $nestedopenpos + $open_tag_len);
		}
		if ($tagend === false)
		{
			$beginsearchpos = $optionend;
			continue;
		}

		$localbegin = $optionend + 1;
		$localtext = $functionhandle($tagoptions, substr($text, $localbegin, $tagend - $localbegin), $tagname, $extraargs);
		$text = substr_replace($text, $localtext, $tagbegin, $tagend + $close_tag_len - $tagbegin);

		$beginsearchpos = $tagbegin + strlen($localtext);
	} while ($tagbegin !== false);

	return $text;
}

function parse_wysiwyg_tag_attribute($option, $text)
{
	if (($position = strpos($text, $option)) !== false)
	{
		$delimiter = $position + strlen($option);
		if ($text{$delimiter} == '"')
		{
			$delimchar = '"';
		}
		else if ($text{$delimiter} == '\'')
		{
			$delimchar = '\'';
		}
		else
		{
			$delimchar = ' ';
		}
		$delimloc = strpos($text, $delimchar, $delimiter + 1);
		if ($delimloc === false)
		{
			$delimloc = strlen($text);
		}
		else if ($delimchar == '"' OR $delimchar == '\'')
		{
			$delimiter++;
		}
		return trim(substr($text, $delimiter, $delimloc - $delimiter));
	}
	else
	{
		return '';
	}
}

function strip_tags_callback($text)
{
	$text = str_replace('\\"', '"', $text);
	return strip_tags($text, '<p>');
}
?>