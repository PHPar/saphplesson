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
        $this->windows1256[0] = '�';
        $this->windows1256[1] = '�';
        $this->windows1256[2] = '�';
        $this->windows1256[3] = '�';
        $this->windows1256[4] = '�';
        $this->windows1256[5] = '�';
        $this->windows1256[6] = '�';
        $this->windows1256[7] = '�';
        $this->windows1256[8] = '�';
        $this->windows1256[9] = '�';
        $this->windows1256[10] = '�';
        $this->windows1256[11] = '�';
        $this->windows1256[12] = '�';
        $this->windows1256[13] = '�';
        $this->windows1256[14] = '�';
        $this->windows1256[15] = '�';
        $this->windows1256[16] = '�';
        $this->windows1256[17] = '�';
        $this->windows1256[18] = '�';
        $this->windows1256[19] = '�';
        $this->windows1256[20] = '�';
        $this->windows1256[21] = '�';
        $this->windows1256[22] = '�';
        $this->windows1256[23] = '�';
        $this->windows1256[24] = '�';
        $this->windows1256[25] = '�';
        $this->windows1256[26] = '�';
        $this->windows1256[27] = '�';
        $this->windows1256[28] = '�';
        $this->windows1256[29] = '�';
        $this->windows1256[30] = '�';
        $this->windows1256[31] = '�';
        $this->windows1256[32] = '�';
        $this->windows1256[33] = '�';
        $this->windows1256[34] = '�';
        $this->windows1256[35] = '�';
        $this->windows1256[36] = '�';
        $this->windows1256[37] = '�';
        $this->windows1256[38] = '�';
        $this->windows1256[39] = '�';
        $this->windows1256[40] = '�';
        $this->windows1256[41] = '�';
        $this->windows1256[42] = '�';
        $this->windows1256[43] = '�';
        $this->windows1256[44] = '�';
        $this->windows1256[45] = ',';
        $this->windows1256[46] = '.';
        $this->windows1256[47] = '�';
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

        $this->iso88596[0] = '�';
        $this->iso88596[1] = '�';
        $this->iso88596[2] = '�';
        $this->iso88596[3] = '�';
        $this->iso88596[4] = '�';
        $this->iso88596[5] = '�';
        $this->iso88596[6] = '�';
        $this->iso88596[7] = '�';
        $this->iso88596[8] = '�';
        $this->iso88596[9] = '�';
        $this->iso88596[10] = '�';
        $this->iso88596[11] = '�';
        $this->iso88596[12] = '�';
        $this->iso88596[13] = '�';
        $this->iso88596[14] = '�';
        $this->iso88596[15] = '�';
        $this->iso88596[16] = '�';
        $this->iso88596[17] = '�';
        $this->iso88596[18] = '�';
        $this->iso88596[19] = '�';
        $this->iso88596[20] = '�';
        $this->iso88596[21] = '�';
        $this->iso88596[22] = '�';
        $this->iso88596[23] = '�';
        $this->iso88596[24] = '�';
        $this->iso88596[25] = '�';
        $this->iso88596[26] = '�';
        $this->iso88596[27] = '�';
        $this->iso88596[28] = '�';
        $this->iso88596[29] = '�';
        $this->iso88596[30] = '�';
        $this->iso88596[31] = '�';
        $this->iso88596[32] = '�';
        $this->iso88596[33] = '�';
        $this->iso88596[34] = '�';
        $this->iso88596[35] = '�';
        $this->iso88596[36] = '�';
        $this->iso88596[37] = '�';
        $this->iso88596[38] = '�';
        $this->iso88596[39] = '�';
        $this->iso88596[40] = '�';
        $this->iso88596[41] = '�';
        $this->iso88596[42] = '�';
        $this->iso88596[43] = '�';
        $this->iso88596[44] = '�';
        $this->iso88596[45] = ',';
        $this->iso88596[46] = '.';
        $this->iso88596[47] = '�';
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

        $this->utf8[0] = 'ذ';
        $this->utf8[1] = 'د';
        $this->utf8[2] = 'ج';
        $this->utf8[3] = 'ح';
        $this->utf8[4] = 'خ';
        $this->utf8[5] = 'ه';
        $this->utf8[6] = 'ع';
        $this->utf8[7] = 'غ';
        $this->utf8[8] = 'ف';
        $this->utf8[9] = 'ق';
        $this->utf8[10] = 'ث';
        $this->utf8[11] = 'ص';
        $this->utf8[12] = 'ض';
        $this->utf8[13] = 'ط';
        $this->utf8[14] = 'ك';
        $this->utf8[15] = 'م';
        $this->utf8[16] = 'ن';
        $this->utf8[17] = 'ت';
        $this->utf8[18] = 'ا';
        $this->utf8[19] = 'ل';
        $this->utf8[20] = 'ب';
        $this->utf8[21] = 'ي';
        $this->utf8[22] = 'س';
        $this->utf8[23] = 'ش';
        $this->utf8[24] = 'ظ';
        $this->utf8[25] = 'ز';
        $this->utf8[26] = 'و';
        $this->utf8[27] = 'ة';
        $this->utf8[28] = 'ى';
        $this->utf8[29] = 'ر';
        $this->utf8[30] = 'ؤ';
        $this->utf8[31] = 'ء';
        $this->utf8[32] = 'ئ';
        $this->utf8[33] = 'ّ';
        $this->utf8[34] = 'َ';
        $this->utf8[35] = 'ً';
        $this->utf8[36] = 'ٌ';
        $this->utf8[37] = 'إ';
        $this->utf8[38] = 'ِ';
        $this->utf8[39] = 'ٍ';
        $this->utf8[40] = 'أ';
        $this->utf8[41] = 'ـ';
        $this->utf8[42] = '،';
        $this->utf8[43] = 'ْ';
        $this->utf8[44] = 'آ';
        $this->utf8[45] = ',';
        $this->utf8[46] = '.';
        $this->utf8[47] = '؟';
        /*$this->utf8[48] = '٠';
        $this->utf8[49] = '١';
        $this->utf8[50] = '٢';
        $this->utf8[51] = '٣';
        $this->utf8[52] = '٤';
        $this->utf8[53] = '٥';
        $this->utf8[54] = '٦';
        $this->utf8[55] = '٧';
        $this->utf8[56] = '٨';
        $this->utf8[57] = '٩';*/

        $this->bug[0] = 'Ð';
        $this->bug[1] = 'Ï';
        $this->bug[2] = 'Ì';
        $this->bug[3] = 'Í';
        $this->bug[4] = 'Î';
        $this->bug[5] = 'å';
        $this->bug[6] = 'Ñ';
        $this->bug[7] = 'Û';
        $this->bug[8] = 'Ý';
        $this->bug[9] = 'Þ';
        $this->bug[10] = 'Ë';
        $this->bug[11] = 'Õ';
        $this->bug[12] = 'Ö';
        $this->bug[13] = 'Ø';
        $this->bug[14] = 'ß';
        $this->bug[15] = 'ã';
        $this->bug[16] = 'ä';
        $this->bug[17] = 'Ê';
        $this->bug[18] = 'Ç';
        $this->bug[19] = 'á';
        $this->bug[20] = 'È';
        $this->bug[21] = 'í';
        $this->bug[22] = 'Ó';
        $this->bug[23] = 'Ô';
        $this->bug[24] = 'Ù';
        $this->bug[25] = 'Ò';
        $this->bug[26] = 'æ';
        $this->bug[27] = 'É';
        $this->bug[28] = 'ì';
        $this->bug[29] = 'Ñ';
        $this->bug[30] = 'Ä';
        $this->bug[31] = 'Á';
        $this->bug[32] = 'Æ';
        $this->bug[33] = 'ø';
        $this->bug[34] = 'ó';
        $this->bug[35] = 'ð';
        $this->bug[36] = 'ñ';
        $this->bug[37] = 'Å';
        $this->bug[38] = 'ö';
        $this->bug[39] = 'ò';
        $this->bug[40] = 'Ã';
        $this->bug[41] = 'Ü';
        $this->bug[42] = '¡';
        $this->bug[43] = 'ú';
        $this->bug[44] = 'Â';
        $this->bug[45] = ',';
        $this->bug[46] = '.';
        $this->bug[47] = '¿';
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
