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
// Class Name: Arabic Auto Summarize Class
// Filename:   arAutoSummarize.class.php
// Original    Author(s): Khaled Al-Sham'aa <khaled.alshamaa@gmail.com>
// Purpose:    Automatic keyphrase extraction to provide a quick mini-summary for a long Arabic document.
// ----------------------------------------------------------------------

class ArAutoSummarize {

    /**
    * @return String Output summary requested
    * @param String  Input Arabic document as a string using windows-1256 charset
    *        Integer Number of sentences required in output summary
    * @desc  doSummarize Summarize input Arabic string (document content) into specific number of sentences in the output
    * @author Khaled Al-Shamaa
    */
    function doSummarize($str, $int, $keywords){
        $summary = '';

        $str           = strip_tags($str);
        $normalizedStr = $this->doNormalize($str);
        $cleanedStr    = $this->cleanCommon($normalizedStr);
        $stemStr       = $this->draftStem($cleanedStr);
        $wordRanks     = $this->rankWords($stemStr);

        if($keywords){
            $keywords = $this->doNormalize($keywords);
            $keywords = $this->draftStem($keywords);
            $words    = split(' ', $keywords);

            foreach($words as $word){
                 $wordRanks[$word] = 1000;
            }
        }

        $sentencesRanks= $this->rankSentences($str, $wordRanks);

        list($sentences, $ranks)= $sentencesRanks;
        $minRank = $this->minAcceptedRank($ranks, $int);
        $totalSentences = count($ranks);

        for($i=0; $i<$totalSentences; $i++){
            if($sentencesRanks[1][$i] >= $minRank) { $summary .= $sentencesRanks[0][$i]; }
        }

        return $summary;
    }

    /**
    * @return String Output summary requested
    * @param String  Input Arabic document as a string using windows-1256 charset
    *        Integer Rate of output summary sentence number as percentage of the input Arabic string (document content)
    * @desc  doRateSummarize Summarize percentage of the input Arabic string (document content) into output
    * @author Khaled Al-Shamaa
    */
    function doRateSummarize($str, $rate, $keywords){
        preg_match_all("/[^|\.|\n|\¡|\º](.+?)[\.|\n|\¡|\º]/", $str, $sentences);

        $totalSentences = count($sentences[0]);
        $int = round($rate * $totalSentences / 100);

        $str = $this->doSummarize($str, $int, $keywords);

        return $str;
    }

    /**
    * @return String Output highlighted key sentences summary (using CSS)
    * @param String  Input Arabic document as a string using windows-1256 charset
    *        Integer Number of key sentences required to be highlighted in the input string (document content)
    * @desc  highlightSummary Highlight key sentences (summary) of the input string (document content) using CSS and send the result back as an output
    * @author Khaled Al-Shamaa
    */
    function highlightSummary($str, $int, $keywords){
        $highlighted = '';

        $str           = strip_tags($str);
        $normalizedStr = $this->doNormalize($str);
        $cleanedStr    = $this->cleanCommon($normalizedStr);
        $stemStr       = $this->draftStem($cleanedStr);
        $wordRanks     = $this->rankWords($stemStr);

        if($keywords){
            $keywords = $this->doNormalize($keywords);
            $keywords = $this->draftStem($keywords);
            $words    = split(' ', $keywords);

            foreach($words as $word){
                 $wordRanks[$word] = 1000;
            }
        }

        $sentencesRanks= $this->rankSentences($str, $wordRanks);

        list($sentences, $ranks)= $sentencesRanks;
        $minRank = $this->minAcceptedRank($ranks, $int);
        $totalSentences = count($ranks);

        for($i=0; $i<$totalSentences; $i++){
            if($sentencesRanks[1][$i] >= $minRank) {
                $highlighted .= '<span style="BACKGROUND-COLOR: #EEEE80">'.$sentencesRanks[0][$i].'</span>';
            }else{
                $highlighted .= $sentencesRanks[0][$i];
            }
        }

        $highlighted = str_replace("\n", '<br />', $highlighted);

        return $highlighted;
    }

    /**
    * @return String Output highlighted key sentences summary (using CSS)
    * @param String  Input Arabic document as a string using windows-1256 charset
    *        Integer Rate of highlighted key sentences summary number as percentage of the input Arabic string (document content)
    * @desc  highlightRateSummary Highlight key sentences (summary) as percentage of the input string (document content) using CSS and send the result back as an output
    * @author Khaled Al-Shamaa
    */
    function highlightRateSummary($str, $rate, $keywords){
        preg_match_all("/[^|\.|\n|\¡|\º](.+?)[\.|\n|\¡|\º]/", $str, $sentences);

        $totalSentences = count($sentences[0]);
        $int = round($rate * $totalSentences / 100);

        $str = $this->highlightSummary($str, $int, $keywords);

        return $str;
    }

    /**
    * @return String List of the keywords extracting from input Arabic string (document content)
    * @param String  Input Arabic document as a string using windows-1256 charset
    *        Integer Number of keywords required to be extracting from input string (document content)
    * @desc  getMetaKeywords Extract keywords from a given Arabic string (document content)
    * @author Khaled Al-Shamaa
    */
    function getMetaKeywords($str, $int){
        $patterns     = array();
        $replacements = array();
        $metaKeywords = '';

        array_push($patterns, '/\.|\n|\¡|\º|\(|\[|\{|\)|\]|\}/');
        array_push($replacements, ' ');
        $str = preg_replace($patterns, $replacements, $str);

        $normalizedStr = $this->doNormalize($str);
        $cleanedStr    = $this->cleanCommon($normalizedStr);

        $str = preg_replace('/(\W)Çá(\w{3,})/', '\\1\\2', $cleanedStr);
        $str = preg_replace('/(\W)æÇá(\w{3,})/', '\\1\\2', $str);
        $str = preg_replace('/(\w{3,})åãÇ(\W)/', '\\1\\2', $str);
        $str = preg_replace('/(\w{3,})ßãÇ(\W)/', '\\1\\2', $str);
        $str = preg_replace('/(\w{3,})Êíä(\W)/', '\\1\\2', $str);
        $str = preg_replace('/(\w{3,})åã(\W)/', '\\1\\2', $str);
        $str = preg_replace('/(\w{3,})åä(\W)/', '\\1\\2', $str);
        $str = preg_replace('/(\w{3,})åÇ(\W)/', '\\1\\2', $str);
        $str = preg_replace('/(\w{3,})äÇ(\W)/', '\\1\\2', $str);
        $str = preg_replace('/(\w{3,})äí(\W)/', '\\1\\2', $str);
        $str = preg_replace('/(\w{3,})ßã(\W)/', '\\1\\2', $str);
        $str = preg_replace('/(\w{3,})Êã(\W)/', '\\1\\2', $str);
        $str = preg_replace('/(\w{3,})ßä(\W)/', '\\1\\2', $str);
        $str = preg_replace('/(\w{3,})ÇÊ(\W)/', '\\1\\2', $str);
        $str = preg_replace('/(\w{3,})íä(\W)/', '\\1\\2', $str);
        $str = preg_replace('/(\w{3,})Êä(\W)/', '\\1\\2', $str);
        $str = preg_replace('/(\w{3,})æä(\W)/', '\\1\\2', $str);
        $str = preg_replace('/(\w{3,})Çä(\W)/', '\\1\\2', $str);
        $str = preg_replace('/(\w{3,})ÊÇ(\W)/', '\\1\\2', $str);
        $str = preg_replace('/(\w{3,})æÇ(\W)/', '\\1\\2', $str);
        $str = preg_replace('/(\w{3,})É(\W)/', '\\1\\2', $str);
        $stemStr = preg_replace('/(\W)\w{1,3}(\W)/', '\\2', $str);

        $wordRanks     = $this->rankWords($stemStr);

        arsort($wordRanks, SORT_NUMERIC);

        $i = 1;
        foreach ($wordRanks as $key => $value) {
            if($this->acceptedWord($key)){
                $metaKeywords .= $key.', ';
                $i++;
            }
            if($i > $int){ break; }
        }

        return $metaKeywords;
    }

    /**
    * @return String Normalized Arabic document 
    * @param String  Input Arabic document as a string using windows-1256 charset
    * @desc doNormalize Normalized Arabic document
    * @author Khaled Al-Shamaa
    */
    function doNormalize($str){
        $patterns     = array();
        $replacements = array();

        array_push($patterns, '/ø|ó|ð|õ|ñ|ö|ò|ú/');
        array_push($patterns, '/Ç|Ã|Å|Â/');

        array_push($replacements, '');
        array_push($replacements, 'Ç');

        $str = preg_replace($patterns, $replacements, $str);

        return $str;
    }

    /**
    * @return String Arabic document as a string free of common words (roughly)
    * @param  String Input normalized Arabic document as a string using windows-1256 charset
    * @desc   cleanCommon Extracting common Arabic words (roughly) from input Arabic string (document content)
    * @author Khaled Al-Shamaa
    */
    function cleanCommon($str){
        $patterns = array('/\s+\w{1,2}(\s+)/');

        $words    = file('./includes/common.inc.txt');

        $max      = count($words);
        for($i=0; $i<$max; $i++){
            $words[$i] = trim($words[$i]);
        }

        $str    = preg_replace('/\s+æ?(' . implode('|', $words) . ')(\s+)/', '\\2', $str, -1);

        return $str;
    }

    /**
    * @return String Output string after removing less significant Arabic letter (not human readable output)
    * @param  String Input Arabic document as a string using windows-1256 charset
    * @desc   draftStem Remove less significant Arabic letter from given string (document content). Please note that output will not be human readable.
    * @author Khaled Al-Shamaa
    */
    function draftStem($str){
        $str = preg_replace('/Ó|Ç|á|Ê|ã|æ|ä|í|å|É/', '', $str);
        return $str;
    }

    /**
    * @return Hash  Associated array where document words referred by index and those words ranks referred by values of those array items
    * @param  String Input Arabic document as a string using windows-1256 charset
    * @desc   rankWords Ranks words in a given Arabic string (document content). That rank refers to the frequency of that word appears in that given document.
    * @author Khaled Al-Shamaa
    */
    function rankWords($str){
        $wordsRanks   = array();
        $patterns     = array();
        $replacements = array();

        array_push($patterns, '/\.|\n|\¡|\º|\(|\[|\{|\)|\]|\}/');
        array_push($replacements, ' ');
        $str = preg_replace($patterns, $replacements, $str);

        $words = preg_split("/[\s,]+/", $str);

        foreach($words as $word){
            if($wordsRanks[$word]){
                $wordsRanks[$word] = $wordsRanks[$word] + 1;
            }else{
                $wordsRanks[$word] = 1;
            }
        }

        foreach($wordsRanks as $wordRank => $total){
            if (substr($wordRank, 0, 1) == 'æ'){
                $subWordRank = substr($wordRank, 1, strlen($wordRank)-1);
                if (isset($wordsRanks[$subWordRank])){
                    unset($wordsRanks[$wordRank]);
                    $wordsRanks[$subWordRank] += $total;
                }
            }
        }

        return $wordsRanks;
    }

    /**
    * @return Array  Two dimension array, first item is an array of document sentences, second item is an array of ranks of document sentences
    * @param  String Input Arabic document as a string using windows-1256 charset
    *         Array  Words ranks array (word as an index and value refer to the word frequency)
    * @desc   rankSentences Ranks sentences in a given Arabic string (document content).
    * @author Khaled Al-Shamaa
    */
    function rankSentences($str, $arr){
        $sentenceArr = array();
        $rankArr     = array();

        preg_match_all("/[^|\.|\n|\¡|\º](.+?)[\.|\n|\¡|\º]/", $str, $sentences);

        foreach($sentences[0] as $sentence){
            $w     = 0;
            $first = $sentence{0};
            $last  = $sentence{strlen($sentence)-1};

            if ($first == "\n") { $w += 3; }
            elseif (in_array($first, array('.','¡','º'))) { $w += 2; }
            else { $w += 1; }

            if ($last == "\n") { $w += 3; }
            elseif (in_array($last, array('.','¡','º'))) { $w += 2; }
            else { $w += 1; }

            $words = file('./includes/important.inc.txt');
            for($i = 0; $i<count($words); $i++){ $words[$i] = trim($words[$i]); }
            $pattern = '/('.implode('|',$words).')/';
            preg_match_all($pattern, $sentence, $important);
            $w += count($important[0]);

            $sentence = substr(substr($sentence, 0, -1), 1);
            if(!in_array($first, array('.','¡','º',"\n"))) { $sentence = $first.$sentence; }

            $normalizedStr = $this->doNormalize($sentence);
            $cleanedStr    = $this->cleanCommon($normalizedStr);
            $stemStr       = $this->draftStem($cleanedStr);

            $words = preg_split("/[\s,]+/", $stemStr);

            $totalWords = count($words);
            if($totalWords > 0){
                $totalWordsRank = 0;

                foreach($words as $word){
                    $totalWordsRank += $arr[$word];
                }

                $wordsRank = $totalWordsRank/$totalWords;
                $sentenceRanks = $w * $wordsRank;

                array_push($sentenceArr, $sentence.$last);
                array_push($rankArr, $sentenceRanks);
            }
        }

        $sentencesRanks = array($sentenceArr, $rankArr);

        return $sentencesRanks;
    }

    /**
    * @return Integer Minimum accepted sentence rank (sentences with rank more than this will be listed in the document summary)
    * @param  Array   Sentences ranks
    *         Integer Number of sentences you need to include in your summary
    * @desc   minAcceptedRank Calculate minimum rank for sentences which will be including in the summary
    * @author Khaled Al-Shamaa
    */
    function minAcceptedRank($arr, $int){
        rsort($arr, SORT_NUMERIC);

        $minRank = $arr[$int];

        return $minRank;
    }

    /**
    * @return True if passed string is accepted as a valid word else it will return False
    * @param  String  String to be checked if it is a valid word or not
    * @desc   acceptedWord Check some conditions to know if a given string is a formal valid word or not
    * @author Khaled Al-Shamaa
    */
    function acceptedWord($word){
        $accept = true;
        
        if(strlen($word) < 3) $accept = false;

        return $accept;
    }
}
?>