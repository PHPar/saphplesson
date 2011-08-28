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
// Class Name: Arabic Queary Class
// Filename: oods.class.php
// Original  Author(s): Khaled Al-Sham'aa <khaled.alshamaa@gmail.com>
// Purpose:  Build WHERE condition for SQL statement using MySQL REGEXP and Arabic lexical  rules
// ----------------------------------------------------------------------

class ArQuery {
    var $fields = array();

    /**
     * @return TRUE if success, or FALSE if fail
     * @param Array $arrConfig Name of the fields that SQL statement will search them
     *                         (in array format where items are those fields names)
     * @desc setArrFields Setting value for $fields array
     * @author Khaled Al-Shamaa
     */
    function setArrFields($arrConfig) {
        $flag = true;

        // Get fields array
        $this->fields = $arrConfig;

        // Error check!
        if (count($this->fields) == 0) {
            $flag = false;
        }

        return $flag;
    }

    /**
     * @return TRUE if success, or FALSE if fail
     * @param String $strConfig Name of the fields that SQL statement will search them
     *                         (in string format using comma as delimated)
     * @desc setStrFields Setting value for $fields array
     * @author Khaled Al-Shamaa
     */
    function setStrFields($strConfig) {
        $flag = true;

        // Get fields array
        $this->fields = explode(",", $strConfig);

        // Error check!
        if (count($this->fields) == 0) {
            $flag = false;
        }

        return $flag;
    }

    /**
     * @return TRUE if success, or FALSE if fail
     * @param Integer $mode Setting value to be saved in the $mode propority
     * @desc setMode Setting $mode propority value that refer to search mode
     *               [0 for OR logic | 1 for AND logic]
     * @author Khaled Al-Shamaa
     */
    function setMode($mode) {
        $flag = true;

        // Set search mode [0 for OR logic | 1 for AND logic]
        $this->mode = $mode;

        // Error check!
        if (!isset($this->mode)) {
            $flag = false;
        }

        return $flag;
    }

    /**
     * @return Integer Value of $mode properity
     * @desc getMode Getting $mode propority value that refer to search mode
     *               [0 for OR logic | 1 for AND logic]
     * @author Khaled Al-Shamaa
     */
    function getMode() {
        // Get search mode value [0 for OR logic | 1 for AND logic]
        return $this->mode;
    }

    /**
     * @return Array Value of $fields array in Array format
     * @desc getArrFields Getting values of $fields Array in array format
     * @author Khaled Al-Shamaa
     */
    function getArrFields() {
        $fields = $this->fields;

        return $fields;
    }

    /**
     * @return String Values of $fields array in String format (comma delimated)
     * @desc getStrFields Getting values of $fields array in String format (comma delimated)
     * @author Khaled Al-Shamaa
     */
    function getStrFields() {
        $fields = implode(",", $this->fields);

        return $fields;
    }

    /**
     * @return String The WHERE section in SQL statement (MySQL database engine format)
     * @param String $arg  String that user search for in the database table
     * @desc getWhereCondition Build WHERE section of the SQL statement using defind lex's rules,
    search mode [AND | OR], and handle also phrases (inclosed by "")
    using normal LIKE condition to match it as it is.
     * @author Khaled Al-Shamaa
     */
    function getWhereCondition($arg) {
        // Check if there are phrases in $arg should handle as it is
        $phrase = explode("\"", $arg);
        if (count($phrase) > 2) {
            // Re-init $arg variable (It will contain the rest of $arg except phrases).
            $arg = "";
            for ($i = 0; $i < count($phrase); $i++) {
                if ($i % 2 == 0 && $phrase[$i] != "") {
                    // Re-build $arg variable after restricting phrases
                    $arg .= $phrase[$i];

                } elseif ($i % 2 == 1 && $phrase[$i] != "") {
                    // Handle phrases using reqular LIKE matching in MySQL
                    $this->wordCondition[] = $this->getWordLike($phrase[$i]);
                }
            }
        }

        // Handle normal $arg using lex's and regular expresion
        $words = explode(" ", $arg);

        foreach($words as $word) {
            if ($word != "") {
                $this->wordCondition[] = $this->getWordRegExp($word);
            }
        }

        if ($this->mode == 0) {
            $sql = "((".implode(") OR (", $this->wordCondition)."))";
        } elseif ($this->mode == 1) {
            $sql = "((".implode(") AND (", $this->wordCondition)."))";
        }
        if($this->order){
            $sql .= ' ORDER BY ' . $this->getOrderByRelevance($arg);
        }

        return $sql;
    }

    /**
     * @return String sub SQL condition (for private use)
     * @param String $arg  String (one word) that you want to build a condition for
     * @desc getWordRegExp Search condition in SQL format for one word in all defind fields
    using REGEXP clause and lex's rules
     * @author Khaled Al-Shamaa
     */
    function getWordRegExp($arg) {
        $arg = $this->lex($arg);
        $sql = "`".implode("` REGEXP '$arg' OR `", $this->fields).
            "` REGEXP '$arg'";

        return $sql;
    }

    /**
     * @return String sub SQL condition (for private use)
     * @param String $arg String (one word) that you want to build a condition for
     * @desc getWordRegExp Search condition in SQL format for one word in all defind fields using normal LIKE clause
     * @author Khaled Al-Shamaa
     */
    function getWordLike($arg) {
        $sql = "`".implode("` LIKE '% $arg %' OR `", $this->fields).
            "` LIKE '% $arg %'";

        return $sql;
    }

      /**
       * @return String sub SQL ORDER BY section (for private use)
       * @param String $arg String that user search for in the database table
       * @desc Get more relevant order by section related to the user search keywords
       * @author Saleh AlMatrafe <saleh@saleh.cc>
       */
      function getOrderByRelevance($arg)
      {
          // Check if there are phrases in $arg should handle as it is
          $phrase = explode("\"", $arg);
          if (count($phrase) > 2) {
              // Re-init $arg variable (It will contain the rest of $arg except phrases).
              $arg = '';
              for ($i = 0; $i < count($phrase); $i++) {
                  if ($i % 2 == 0 && $phrase[$i] != '') {
                      // Re-build $arg variable after restricting phrases
                      $arg .= $phrase[$i];
                  } elseif ($i % 2 == 1 && $phrase[$i] != '') {
                      // Handle phrases using reqular LIKE matching in MySQL
                      $wordOrder[] = $this->getWordLike($phrase[$i]);
                  }
              }
          }
          
          // Handle normal $arg using lex's and regular expresion
          $words = explode(' ', $arg);
          foreach ($words as $word) {
              if ($word != '') {
                  $wordOrder[] = 'CASE WHEN ' . $this->getWordRegExp($word) . ' THEN 1 ELSE 0 END';
              }
          }
          
          $order = '((' . implode(') + (', $wordOrder) . ')) DESC';

          return $order;
      }

    /**
     * @return String Regular Expression format to be used in MySQL query statement
     * @param String $arg  String of one word user want to search for
     * @desc Lex method will implement various regular expressin rules based on pre-defined Arabic lexical rules
     * @author Khaled Al-Shamaa
     */
    function lex($arg) {
        $patterns = array();
        $replacements = array();

        // Prefix's
        array_push($patterns, '/^Çá/');
        array_push($replacements, '(Çá)?');

        // Singular
        array_push($patterns, '/(\S{3,})Êíä$/');
        array_push($replacements, '\\1(Êíä|É)?');
        array_push($patterns, '/(\S{3,})íä$/');
        array_push($replacements, '\\1(íä)?');
        array_push($patterns, '/(\S{3,})æä$/');
        array_push($replacements, '\\1(æä)?');
        array_push($patterns, '/(\S{3,})Çä$/');
        array_push($replacements, '\\1(Çä)?');
        array_push($patterns, '/(\S{3,})ÊÇ$/');
        array_push($replacements, '\\1(ÊÇ)?');
        array_push($patterns, '/(\S{3,})Ç$/');
        array_push($replacements, '\\1(Ç)?');
        array_push($patterns, '/(\S{3,})(É|ÇÊ)$/');
        array_push($replacements, '\\1(É|ÇÊ)?');

        // Postfix's
        array_push($patterns, '/(\S{3,})åãÇ$/');
        array_push($replacements, '\\1(åãÇ)?');
        array_push($patterns, '/(\S{3,})ßãÇ$/');
        array_push($replacements, '\\1(ßãÇ)?');
        array_push($patterns, '/(\S{3,})äí$/');
        array_push($replacements, '\\1(äí)?');
        array_push($patterns, '/(\S{3,})ßã$/');
        array_push($replacements, '\\1(ßã)?');
        array_push($patterns, '/(\S{3,})Êã$/');
        array_push($replacements, '\\1(Êã)?');
        array_push($patterns, '/(\S{3,})ßä$/');
        array_push($replacements, '\\1(ßä)?');
        array_push($patterns, '/(\S{3,})Êä$/');
        array_push($replacements, '\\1(Êä)?');
        array_push($patterns, '/(\S{3,})äÇ$/');
        array_push($replacements, '\\1(äÇ)?');
        array_push($patterns, '/(\S{3,})åÇ$/');
        array_push($replacements, '\\1(åÇ)?');
        array_push($patterns, '/(\S{3,})åã$/');
        array_push($replacements, '\\1(åã)?');
        array_push($patterns, '/(\S{3,})åä$/');
        array_push($replacements, '\\1(åä)?');
        array_push($patterns, '/(\S{3,})æÇ$/');
        array_push($replacements, '\\1(æÇ)?');
        array_push($patterns, '/(\S{3,})íÉ$/');
        array_push($replacements, '\\1(í|íÉ)?');
        array_push($patterns, '/(\S{3,})ä$/');
        array_push($replacements, '\\1(ä)?');

        // Writing errors
        array_push($patterns, '/(É|å)$/');
        array_push($replacements, '(É|å)');
        array_push($patterns, '/(É|Ê)$/');
        array_push($replacements, '(É|Ê)');
        array_push($patterns, '/(í|ì)$/');
        array_push($replacements, '(í|ì)');
        array_push($patterns, '/(Ç|ì)$/');
        array_push($replacements, '(Ç|ì)');
        array_push($patterns, '/(Æ|ìÁ|Ä|æÁ|Á)/');
        array_push($replacements, '(Æ|ìÁ|Ä|æÁ|Á)');

        // Normalization
        array_push($patterns, '/ø|ó|ð|õ|ñ|ö|ò|ú/');
        array_push($replacements, '(ø|ó|ð|õ|ñ|ö|ò|ú)?');
        array_push($patterns, '/Ç|Ã|Å|Â/');
        array_push($replacements, '(Ç|Ã|Å|Â)');

        $arg = preg_replace($patterns, $replacements, $arg);

        return $arg;
    }
}

?>
