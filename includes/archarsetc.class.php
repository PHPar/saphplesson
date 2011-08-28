<?php
// ----------------------------------------------------------------------
// Copyright (C) 2006 by Khaled Al-Shamaa.
// http://www.al-shamaa.com/
// ----------------------------------------------------------------------
// LICENSE

// This program is open source product; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.

// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.

// To read the license please visit http://www.gnu.org/copyleft/gpl.html
// ----------------------------------------------------------------------
// Class Name: Arabic Character Set Converter
// Filename:   ArCharsetC.class.php
// Original    Author(s): Khaled Al-Sham'aa <khaled.alshamaa@gmail.com>
// Purpose:    Convert a given Arabic string from one Arabic character set to another,
//             those available character sets includes the most popular three:
//             Windows-1256, ISO 8859-6, and UTF-8
// ----------------------------------------------------------------------

class ArCharsetC {

    var $windows1256 = array();
    var $iso88596 = array();
    var $utf8 = array();
    var $bug = array();
    var $html = array();

    function ArCharsetC() {
        $this->windows1256[0] = 'Ð';
        $this->windows1256[1] = 'Ï';
        $this->windows1256[2] = 'Ì';
        $this->windows1256[3] = 'Í';
        $this->windows1256[4] = 'Î';
        $this->windows1256[5] = 'å';
        $this->windows1256[6] = 'Ú';
        $this->windows1256[7] = 'Û';
        $this->windows1256[8] = 'Ý';
        $this->windows1256[9] = 'Þ';
        $this->windows1256[10] = 'Ë';
        $this->windows1256[11] = 'Õ';
        $this->windows1256[12] = 'Ö';
        $this->windows1256[13] = 'Ø';
        $this->windows1256[14] = 'ß';
        $this->windows1256[15] = 'ã';
        $this->windows1256[16] = 'ä';
        $this->windows1256[17] = 'Ê';
        $this->windows1256[18] = 'Ç';
        $this->windows1256[19] = 'á';
        $this->windows1256[20] = 'È';
        $this->windows1256[21] = 'í';
        $this->windows1256[22] = 'Ó';
        $this->windows1256[23] = 'Ô';
        $this->windows1256[24] = 'Ù';
        $this->windows1256[25] = 'Ò';
        $this->windows1256[26] = 'æ';
        $this->windows1256[27] = 'É';
        $this->windows1256[28] = 'ì';
        $this->windows1256[29] = 'Ñ';
        $this->windows1256[30] = 'Ä';
        $this->windows1256[31] = 'Á';
        $this->windows1256[32] = 'Æ';
        $this->windows1256[33] = 'ø';
        $this->windows1256[34] = 'ó';
        $this->windows1256[35] = 'ð';
        $this->windows1256[36] = 'ñ';
        $this->windows1256[37] = 'Å';
        $this->windows1256[38] = 'ö';
        $this->windows1256[39] = 'ò';
        $this->windows1256[40] = 'Ã';
        $this->windows1256[41] = 'Ü';
        $this->windows1256[42] = '¡';
        $this->windows1256[43] = 'ú';
        $this->windows1256[44] = 'Â';
        $this->windows1256[45] = ',';
        $this->windows1256[46] = '.';
        $this->windows1256[47] = '¿';
        /*$this->windows1256[48] = '0';
        $this->windows1256[49] = '1';
        $this->windows1256[50] = '2';
        $this->windows1256[51] = '3';
        $this->windows1256[52] = '4';
        $this->windows1256[53] = '5';
        $this->windows1256[54] = '6';
        $this->windows1256[55] = '7';
        $this->windows1256[56] = '8';
        $this->windows1256[57] = '9';*/

        $this->iso88596[0] = 'Ð';
        $this->iso88596[1] = 'Ï';
        $this->iso88596[2] = 'Ì';
        $this->iso88596[3] = 'Í';
        $this->iso88596[4] = 'Î';
        $this->iso88596[5] = 'ç';
        $this->iso88596[6] = 'Ù';
        $this->iso88596[7] = 'Ú';
        $this->iso88596[8] = 'á';
        $this->iso88596[9] = 'â';
        $this->iso88596[10] = 'Ë';
        $this->iso88596[11] = 'Õ';
        $this->iso88596[12] = 'Ö';
        $this->iso88596[13] = '×';
        $this->iso88596[14] = 'ã';
        $this->iso88596[15] = 'å';
        $this->iso88596[16] = 'æ';
        $this->iso88596[17] = 'Ê';
        $this->iso88596[18] = 'Ç';
        $this->iso88596[19] = 'ä';
        $this->iso88596[20] = 'È';
        $this->iso88596[21] = 'ê';
        $this->iso88596[22] = 'Ó';
        $this->iso88596[23] = 'Ô';
        $this->iso88596[24] = 'Ø';
        $this->iso88596[25] = 'Ò';
        $this->iso88596[26] = 'è';
        $this->iso88596[27] = 'É';
        $this->iso88596[28] = 'é';
        $this->iso88596[29] = 'Ñ';
        $this->iso88596[30] = 'Ä';
        $this->iso88596[31] = 'Á';
        $this->iso88596[32] = 'Æ';
        $this->iso88596[33] = 'ñ';
        $this->iso88596[34] = 'î';
        $this->iso88596[35] = 'ë';
        $this->iso88596[36] = 'ì';
        $this->iso88596[37] = 'Å';
        $this->iso88596[38] = 'ð';
        $this->iso88596[39] = 'í';
        $this->iso88596[40] = 'Ã';
        $this->iso88596[41] = 'à';
        $this->iso88596[42] = '¬';
        $this->iso88596[43] = 'ò';
        $this->iso88596[44] = 'Â';
        $this->iso88596[45] = ',';
        $this->iso88596[46] = '.';
        $this->iso88596[47] = '¿';
        /*$this->iso88596[48] = '0';
        $this->iso88596[49] = '1';
        $this->iso88596[50] = '2';
        $this->iso88596[51] = '3';
        $this->iso88596[52] = '4';
        $this->iso88596[53] = '5';
        $this->iso88596[54] = '6';
        $this->iso88596[55] = '7';
        $this->iso88596[56] = '8';
        $this->iso88596[57] = '9';*/

        $this->utf8[0] = 'Ø°';
        $this->utf8[1] = 'Ø¯';
        $this->utf8[2] = 'Ø¬';
        $this->utf8[3] = 'Ø­';
        $this->utf8[4] = 'Ø®';
        $this->utf8[5] = 'Ù‡';
        $this->utf8[6] = 'Ø¹';
        $this->utf8[7] = 'Øº';
        $this->utf8[8] = 'Ù';
        $this->utf8[9] = 'Ù‚';
        $this->utf8[10] = 'Ø«';
        $this->utf8[11] = 'Øµ';
        $this->utf8[12] = 'Ø¶';
        $this->utf8[13] = 'Ø·';
        $this->utf8[14] = 'Ùƒ';
        $this->utf8[15] = 'Ù…';
        $this->utf8[16] = 'Ù†';
        $this->utf8[17] = 'Øª';
        $this->utf8[18] = 'Ø§';
        $this->utf8[19] = 'Ù„';
        $this->utf8[20] = 'Ø¨';
        $this->utf8[21] = 'ÙŠ';
        $this->utf8[22] = 'Ø³';
        $this->utf8[23] = 'Ø´';
        $this->utf8[24] = 'Ø¸';
        $this->utf8[25] = 'Ø²';
        $this->utf8[26] = 'Ùˆ';
        $this->utf8[27] = 'Ø©';
        $this->utf8[28] = 'Ù‰';
        $this->utf8[29] = 'Ø±';
        $this->utf8[30] = 'Ø¤';
        $this->utf8[31] = 'Ø¡';
        $this->utf8[32] = 'Ø¦';
        $this->utf8[33] = 'Ù‘';
        $this->utf8[34] = 'ÙŽ';
        $this->utf8[35] = 'Ù‹';
        $this->utf8[36] = 'ÙŒ';
        $this->utf8[37] = 'Ø¥';
        $this->utf8[38] = 'Ù';
        $this->utf8[39] = 'Ù';
        $this->utf8[40] = 'Ø£';
        $this->utf8[41] = 'Ù€';
        $this->utf8[42] = 'ØŒ';
        $this->utf8[43] = 'Ù’';
        $this->utf8[44] = 'Ø¢';
        $this->utf8[45] = ',';
        $this->utf8[46] = '.';
        $this->utf8[47] = 'ØŸ';
        /*$this->utf8[48] = 'Ù ';
        $this->utf8[49] = 'Ù¡';
        $this->utf8[50] = 'Ù¢';
        $this->utf8[51] = 'Ù£';
        $this->utf8[52] = 'Ù¤';
        $this->utf8[53] = 'Ù¥';
        $this->utf8[54] = 'Ù¦';
        $this->utf8[55] = 'Ù§';
        $this->utf8[56] = 'Ù¨';
        $this->utf8[57] = 'Ù©';*/

        $this->bug[0] = 'Ã';
        $this->bug[1] = 'Ã';
        $this->bug[2] = 'ÃŒ';
        $this->bug[3] = 'Ã';
        $this->bug[4] = 'ÃŽ';
        $this->bug[5] = 'Ã¥';
        $this->bug[6] = 'Ã‘';
        $this->bug[7] = 'Ã›';
        $this->bug[8] = 'Ã';
        $this->bug[9] = 'Ãž';
        $this->bug[10] = 'Ã‹';
        $this->bug[11] = 'Ã•';
        $this->bug[12] = 'Ã–';
        $this->bug[13] = 'Ã˜';
        $this->bug[14] = 'ÃŸ';
        $this->bug[15] = 'Ã£';
        $this->bug[16] = 'Ã¤';
        $this->bug[17] = 'ÃŠ';
        $this->bug[18] = 'Ã‡';
        $this->bug[19] = 'Ã¡';
        $this->bug[20] = 'Ãˆ';
        $this->bug[21] = 'Ã­';
        $this->bug[22] = 'Ã“';
        $this->bug[23] = 'Ã”';
        $this->bug[24] = 'Ã™';
        $this->bug[25] = 'Ã’';
        $this->bug[26] = 'Ã¦';
        $this->bug[27] = 'Ã‰';
        $this->bug[28] = 'Ã¬';
        $this->bug[29] = 'Ã‘';
        $this->bug[30] = 'Ã„';
        $this->bug[31] = 'Ã';
        $this->bug[32] = 'Ã†';
        $this->bug[33] = 'Ã¸';
        $this->bug[34] = 'Ã³';
        $this->bug[35] = 'Ã°';
        $this->bug[36] = 'Ã±';
        $this->bug[37] = 'Ã…';
        $this->bug[38] = 'Ã¶';
        $this->bug[39] = 'Ã²';
        $this->bug[40] = 'Ãƒ';
        $this->bug[41] = 'Ãœ';
        $this->bug[42] = 'Â¡';
        $this->bug[43] = 'Ãº';
        $this->bug[44] = 'Ã‚';
        $this->bug[45] = ',';
        $this->bug[46] = '.';
        $this->bug[47] = 'Â¿';
        /*$this->bug[48] = '0';
        $this->bug[49] = '1';
        $this->bug[50] = '2';
        $this->bug[51] = '3';
        $this->bug[52] = '4';
        $this->bug[53] = '5';
        $this->bug[54] = '6';
        $this->bug[55] = '7';
        $this->bug[56] = '8';
        $this->bug[57] = '9';*/

        $this->html[0] = '/\&\#1584\;/';
        $this->html[1] = '/\&\#1583\;/';
        $this->html[2] = '/\&\#1580\;/';
        $this->html[3] = '/\&\#1581\;/';
        $this->html[4] = '/\&\#1582\;/';
        $this->html[5] = '/\&\#1607\;/';
        $this->html[6] = '/\&\#1593\;/';
        $this->html[7] = '/\&\#1594\;/';
        $this->html[8] = '/\&\#1601\;/';
        $this->html[9] = '/\&\#1602\;/';
        $this->html[10] = '/\&\#1579\;/';
        $this->html[11] = '/\&\#1589\;/';
        $this->html[12] = '/\&\#1590\;/';
        $this->html[13] = '/\&\#1591\;/';
        $this->html[14] = '/\&\#1603\;/';
        $this->html[15] = '/\&\#1605\;/';
        $this->html[16] = '/\&\#1606\;/';
        $this->html[17] = '/\&\#1578\;/';
        $this->html[18] = '/\&\#1575\;/';
        $this->html[19] = '/\&\#1604\;/';
        $this->html[20] = '/\&\#1576\;/';
        $this->html[21] = '/\&\#1610\;/';
        $this->html[22] = '/\&\#1587\;/';
        $this->html[23] = '/\&\#1588\;/';
        $this->html[24] = '/\&\#1592\;/';
        $this->html[25] = '/\&\#1586\;/';
        $this->html[26] = '/\&\#1608\;/';
        $this->html[27] = '/\&\#1577\;/';
        $this->html[28] = '/\&\#1609\;/';
        $this->html[29] = '/\&\#1585\;/';
        $this->html[30] = '/\&\#1572\;/';
        $this->html[31] = '/\&\#1569\;/';
        $this->html[32] = '/\&\#1574\;/';
        $this->html[33] = '/\&\#1617\;/';
        $this->html[34] = '/\&\#1614\;/';
        $this->html[35] = '/\&\#1611\;/';
        $this->html[36] = '/\&\#1612\;/';
        $this->html[37] = '/\&\#1573\;/';
        $this->html[38] = '/\&\#1616\;/';
        $this->html[39] = '/\&\#1613\;/';
        $this->html[40] = '/\&\#1571\;/';
        $this->html[41] = '/\&\#1600\;/';
        $this->html[42] = '/\&\#1548\;/';
        $this->html[43] = '/\&\#1618\;/';
        $this->html[44] = '/\&\#1570\;/';
        $this->html[45] = '/\,/';
        $this->html[46] = '/\./';
        $this->html[47] = '/\&\#1567\;/';
        /*$this->html[48] = '/[^\D\#]0[^\D\;]/';
        $this->html[49] = '/[^\D\#]1[^\D\;]/';
        $this->html[50] = '/[^\D\#]2[^\D\;]/';
        $this->html[51] = '/[^\D\#]3[^\D\;]/';
        $this->html[52] = '/[^\D\#]4[^\D\;]/';
        $this->html[53] = '/[^\D\#]5[^\D\;]/';
        $this->html[54] = '/[^\D\#]6[^\D\;]/';
        $this->html[55] = '/[^\D\#]7[^\D\;]/';
        $this->html[56] = '/[^\D\#]8[^\D\;]/';
        $this->html[57] = '/[^\D\#]9[^\D\;]/';*/
    }

    function win2iso($string) {
        $chars = preg_split('//', $string);

        foreach($chars as $char) {
            $key = array_search($char, $this->windows1256);
            if (is_int($key)) {
                $converted .= $this->iso88596[$key];
            } else {
                $converted .= $char;
            }
        }
        return $converted;
    }

    function win2utf($string) {
        $chars = preg_split('//', $string);

        foreach($chars as $char) {
            $key = array_search($char, $this->windows1256);
            if (is_int($key)) {
                $converted .= $this->utf8[$key];
            } else {
                $converted .= $char;
            }
        }
        return $converted;
    }

    function iso2win($string) {
        $chars = preg_split('//', $string);

        foreach($chars as $char) {
            $key = array_search($char, $this->iso88596);
            if (is_int($key)) {
                $converted .= $this->windows1256[$key];
            } else {
                $converted .= $char;
            }
        }
        return $converted;
    }

    function iso2utf($string) {
        $chars = preg_split('//', $string);

        foreach($chars as $char) {
            $key = array_search($char, $this->iso88596);
            if (is_int($key)) {
                $converted .= $this->utf8[$key];
            } else {
                $converted .= $char;
            }
        }
        return $converted;
    }

    function utf2win($string) {
        $chars = preg_split('//', $string);

        $cmp = false;
        foreach($chars as $char) {
            $ascii = ord($char);
            if (($ascii == 216 || $ascii == 217) && !$cmp) {
                $code = $char;
                $cmp = true;
                continue;
            }
            if ($cmp) {
                $code .= $char;
                $cmp = false;
                $key = array_search($code, $this->utf8);
                if (is_int($key)) {
                    $converted .= $this->windows1256[$key];
                }
            } else {
                $converted .= $char;
            }
        }
        return $converted;
    }

    function utf2iso($string) {
        $chars = preg_split('//', $string);

        $cmp = false;
        foreach($chars as $char) {
            $ascii = ord($char);
            if (($ascii == 216 || $ascii == 217) && !$cmp) {
                $code = $char;
                $cmp = true;
                continue;
            }
            if ($cmp) {
                $code .= $char;
                $cmp = false;
                $key = array_search($code, $this->utf8);
                if (is_int($key)) {
                    $converted .= $this->iso88596[$key];
                }
            } else {
                $converted .= $char;
            }
        }
        return $converted;
    }

    function bug2win($string) {
        $chars = preg_split('//', $string);

        $cmp = false;
        foreach($chars as $char) {
            $ascii = ord($char);
            if (($ascii == 195 || $ascii == 194) && !$cmp) {
                $code = $char;
                $cmp = true;
                continue;
            }
            if ($cmp) {
                $code .= $char;
                $cmp = false;
                $key = array_search($code, $this->bug);
                if (is_int($key)) {
                    $converted .= $this->windows1256[$key];
                }
            } else {
                $converted .= $char;
            }
        }
        return $converted;
    }

    function bug2utf($string) {
        $chars = preg_split('//', $string);

        $cmp = false;
        foreach($chars as $char) {
            $ascii = ord($char);
            if (($ascii == 195 || $ascii == 194) && !$cmp) {
                $code = $char;
                $cmp = true;
                continue;
            }
            if ($cmp) {
                $code .= $char;
                $cmp = false;
                $key = array_search($code, $this->bug);
                if (is_int($key)) {
                    $converted .= $this->utf8[$key];
                }
            } else {
                $converted .= $char;
            }
        }
        return $converted;
    }

    function html2utf($string) {
        $converted = preg_replace($this->html, $this->utf8, $string);
        return $converted;
    }

    function html2win($string) {
        $converted = preg_replace($this->html, $this->windows1256, $string);
        return $converted;
    }
}

?>
