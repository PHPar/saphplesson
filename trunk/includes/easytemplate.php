<?php
/***************************************************************************
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.

@ Project: EasyTemplate 1.6.1
 @ Link: http://daif.net/easy/
 @ Author: Daifallh alotaibi <daif55@gmail.com>
 @ Developer: AzzozHSN <www.azzozhsn.net>
 @ Developer: Saleh AlMatrafe <www.saleh.cc>
 @ Date: 2008-03-27
 **************************************************************************/
	class EasyTemplate{
		var $vars; //Reference to $GLOBALS
		var $HTML; //html page content
		var $Temp; // your template path OR '.'
		var $Cache; // must be writeable check permission OR use $_ENV["TEMP"];
		var $color	= array();
		var $loop	= array();
		var $reg	= array('var'=>'/([{]{1,2})+([A-Z0-9_\.]+)[}]{1,2}/i',
							   'color'=>'/="((([A-Z0-9])|([#_\-\/\.]))+(\|)+(.+))"/iU'
		);
		//Startup Function
		function EasyTemplate($Temp='.',$Cache='easycache'){
			if(phpversion()<'4.3.0') $this->_error("Update Your PHP version To 4.3.0 Or later, Your's ".phpversion());
			$this->Temp	=$Temp;
			$this->Cache	=$Cache;
			$this->vars		= &$GLOBALS;
		}
		//Function to load a template file.
		function _load_file($FileName){
			if(!file_exists($this->Temp)) $this->_error('Template Folder <i>'.$this->Temp.'</i> Not Exists');
			if(!file_exists($FileName)) $this->_error('Template File <i>'.$FileName.'</i> Not Exists');
			$this->HTML = file_get_contents($FileName);//it is the preferred way to read the contents of a file into a string.
		}
		//Function to parse the Template Tags
		function _parse(){
			$this->HTML = preg_replace_callback('/\(([{A-Z0-9_\.}\s!=<>]+)\?(.*):(.*)\)/iU',array('EasyTemplate','_iif_callback'),$this->HTML);
			$this->HTML = preg_replace_callback('/<(IF|ELSEIF) (.+)>/iU',array($this,'_if_callback'),$this->HTML);
			$this->HTML = preg_replace_callback('/<LOOP (.+)>/iU',array($this,'_loop_callback'),$this->HTML);
			$this->HTML = preg_replace_callback($this->reg['var'],array($this,'_vars_callback'),$this->HTML);
			$this->HTML = preg_replace_callback($this->reg['color'],array($this,'_color_callback'),$this->HTML);
			$this->HTML = preg_replace('/<SWITCH\s+NAME\s*=\s*"([A-Z0-9_]{1,})"\s*CASE\s*=\s*"(.+)"\s*VALUE\s*=\s*"(.+)"\s*>/i','<?= $this->_switch($this->vars["\\1"],"\\2","\\3")?>',$this->HTML);
			$this->HTML = preg_replace('/<INCLUDE\s+NAME\s*=\s*"(.+)"\s*>/iU','<?= EasyTemplate::_include("\\1"); ?>',$this->HTML);
			$this->HTML = preg_replace('/<\/LOOP>/i','<? } $akeys = array_keys($this->loop); $this->vars[end($akeys)]= array_pop($this->loop); ?>',$this->HTML);
			$this->HTML = preg_replace('/<\/IF>/i','<? } ?>',$this->HTML);
			$this->HTML = preg_replace('/(<ELSE>|<ELSE \/>)/i','<? }else{ ?>',$this->HTML);
		}
		//if tag
		function _if_callback($matches){
			$char  = array(' eq ',' lt ',' gt ', ' neq ');
			$reps  = array('==','<','>', '!=');
			$atts = $this->_get_attributes($matches[0]);
			$con = ($atts[NAME])?$atts[NAME]:$atts[LOOP];
			if(preg_match('/(.*)('.implode('|',$char).')(.*)/i', $con,$arr)){
				$var1 = ($arr[1]{0}=='$')?$arr[1]:'"'.$arr[1].'"';
				$opr = str_replace($char,$reps,$arr[2]);
				$var2 = ($arr[3]{0}=='$')?$arr[3]:'"'.$arr[3].'"';
				$con = "$var1$opr$var2";
			}elseif($atts[NAME]{0}!=='$'){
				$con = ($atts[NAME])?'{'.$con.'}':'{{'.$con.'}}';
				$con = $this->_var_callback($con);
			}
			if(strtoupper($matches[1])=='IF'){
				return '<? if('.$con.'){ ?>';
			}else{
				return '<? }elseif('.$con.'){ ?>';
			}
		}
		//iif tag
		function _iif_callback($matches){
			$if = '<IF NAME="'.$matches[1].'">';
			$if .= $matches[2];
			$if .= '<ELSE>';
			$if .= $matches[3];
			$if .= '</IF>';
			return ($if);
		}
		//loop tag
		function _loop_callback($matches){
			$atts = $this->_get_attributes($matches[0]);
			$var = ($atts[NAME])?$atts[NAME]:$atts[LOOP];
			preg_match('/NAME="({{|{|)([A-Z0-9_\.]+)(}|}}|)"/iU',$matches[1],$name);
			//$loop = ($name[1]=='{{')?true:false;
			$name = $name[2];
			$out .= '$this->loop[\''.$name.'\'] = $this->vars[\''.$name.'\'];';
			if($atts[SQL]){
				if($atts[LIMIT]){
					$out .= ' $'.$name.'_q=$this->_queryLimit("'.$name.'","'.$atts[SQL].'","'.$atts[LIMIT].'","'.$atts[LINK].'");';
				}else{
					$out .= ' $'.$name.'_q=$this->_query("'.$atts[SQL].'","'.$atts[LINK].'");';
				}
				$out .= ' while($var = $this->vars[\''.$name.'\'] = $this->_fetch($'.$name.'_q)) {';
			}elseif($loop){
				$out .= ' $this->vars[\''.$name.'\'] = $var;foreach($this->vars[\''.$name.'\'] as $key=>$var){';
				$out .= ' $this->vars["_key"] = $key;$this->vars["_var"] = $this->vars[\''.$name.'\'] = $var;';
			}else{
				if($atts[LIMIT]) $out .= ' $this->_limit("'.$name.'",'.$atts[LIMIT].');';
				$out .= ' $'.$name.'_arr = '.$var.';foreach($'.$name.'_arr as $key=>$var){';
				$out .= ' $this->vars["_key"] = $key;$this->vars["_var"] = $this->vars[\''.$name.'\'] = $var;';
			}
			return "<? $out ?>";
		}
		//make variable printable
		function _vars_callback($matches){
			$var = $this->_var_callback($matches);
			return('<?= '.$var.'?>');
		}
		//variable replace
		function _var_callback($matches){
			if(!is_array($matches)){
				preg_match($this->reg['var'],$matches,$matches);
			}
			$s = $matches[1];
			$var = str_replace('.','\'][\'',$matches[2]);
			if($s=='{{'){
				$var = '$var[\''.$var.'\']';
			}else{
				$var = '$this->vars[\''.$var.'\']';
			}
			return($var);
		}
		//att variable replace
		function _var_callback_att($matches){
			return('{'.$this->_var_callback($matches).'}');
		}
		//color callback
		function _color_callback($matches){
			return '=<?= $this->_sw('.rand().',"'.$matches[1].'") ?>';
		}
		//swich colors
		function _sw($index,$vars){
			$vars = explode('|',$vars);
			if($this->color[$index]>=count($vars) OR !$this->color[$index]){
				$this->color[$index]=0;
			}
			return('"'.$vars[$this->color[$index]++].'"');
		}
		//Error logger
		function _error($error){
			exit("<b>ERROR:</b> $error");
		}
		//get tag  attributes
		function _get_attributes($tag){
			preg_match_all('/([a-z]+)="(.+)"/iU',$tag,$attribute);
			for($i=0;$i<count($attribute[1]);$i++){
				$att = strtoupper($attribute[1][$i]);
				if(preg_match('/NAME|LOOP/',$att)){
					$attributes[$att] = preg_replace_callback($this->reg['var'],array('EasyTemplate','_var_callback'),$attribute[2][$i]);
				}else{
					$attributes[$att] = preg_replace_callback($this->reg['var'],array('EasyTemplate','_var_callback_att'),$attribute[2][$i]);
				}
			}
			return($attributes);
		}
		//query
		function _query($sql,$resource=null){
			return (is_resource($this->vars["$resource"]))?mysql_query($sql,$this->vars["$resource"]):mysql_query($sql);
		}
		//fetch query
		function _fetch($q){
			return mysql_fetch_assoc($q);
		}
		//switch Tag
		function _switch($var,$case,$value){
			$case  = explode(',',$case);
			$value = explode(',',$value);
			foreach($case as $k=>$val)
			if($var==$val) return $value[$k];
		}
		//include Tag
		function _include($fn){
			list(,, $ex,) = array_values(pathinfo($fn));
			if(strtoupper($ex) =='PHP'){
				include($fn);
			}else{
				return($this->display($fn));
			}
		}
		//Assign Veriables
		function assign($var,&$to){
			$GLOBALS[$var] = $to;
		}
		//Function to make limited Array
		function _limit($arr_name,$limit=10){
			$count  = count($this->vars[$arr_name]);
			$page   = (int) $this->vars[_GET][$arr_name.'_PS'];
			$pagestart = ($page*$limit >= $count)?$count-$limit:$page*$limit;
			$pageend   = ($page*$limit+$limit > $count)?$count:$page*$limit+$limit;
			for($i=$pagestart;$i<$pageend;$i++) $page_array[] = $this->vars[$arr_name][$i];
			$query = preg_replace("/(\&|)$arr_name+_PS=\\d+/i",'',$_SERVER['QUERY_STRING']);
			$prefix = ($query)?"?$query&":'?';
			if(count($this->vars[$arr_name])/$limit>1)
			for($i=0;$i<count($this->vars[$arr_name])/$limit;$i++)
			$this->vars[$arr_name.'_paging'] .= ($page==$i)?' <b>'.($i+1).'</b> ':' <a href="'.$prefix.$arr_name.'_PS='.$i.'" class="paging">'.($i+1).'</a> ';
			$this->vars[$arr_name] = $page_array;
		}
		//Function to count and limt SQL
		function _queryLimit($arr_name,$sql,$limit=10,$link=null){
			$s   = (int) $this->vars[_GET][$arr_name.'_PS']*$limit;
			$sql = preg_replace('/\sLIMIT\s*(\d+\s*|(\d+)\s*,\s*(\d+)\s*)$/i','',$sql)." LIMIT $s,$limit";
			$sql = preg_replace('/^SELECT\s/i','SELECT SQL_CALC_FOUND_ROWS ',ltrim($sql));
			$q   = $this->_query($sql,$link);
			list($count) = mysql_fetch_array(mysql_query("SELECT FOUND_ROWS() as `count`"));
			$query = preg_replace("/(\&|)$arr_name+_PS=\\d+/i",'',$_SERVER['QUERY_STRING']);
			$prefix = ($query)?"?$query&":'?';
			if($count/$limit>1)
			for($i=0;$i<$count/$limit;$i++)
			$this->vars[$arr_name.'_paging'] .= ($s==$i*$limit)?' <b>'.($i+1).'</b> ':' <a href="'.$prefix.$arr_name.'_PS='.$i.'" class="paging">'.($i+1).'</a> ';
			return($q);
		}
		//load parser and return page content
		function display($FileName) {
			if(!file_exists($this->Cache)) mkdir($this->Cache);
			$this->Cache = (!is_writeable($this->Cache))?$_ENV["TEMP"]:$this->Cache;
			$file 		= realpath($this->Temp)."/".$FileName;
			$cache	= realpath($this->Cache)."/".str_replace(array('\\','/',':'), array('/','-',''), $file).".php";
			if(@filemtime($file)>=@filemtime($cache)){
				$this->_load_file($file);
				$this->_parse();
				$fp = fopen($cache,'w');
				fwrite($fp,$this->HTML);
				fclose($fp);
			}
			ob_start();
			include($cache);
			$this->page = ob_get_contents();
			ob_end_clean();
            //do not remove this
            if($FileName=="footer.htm"){
                if(!preg_match("^SaphpLesson 4.0^", $this->page)){
                    $this->page = $this->page . "<center>POWERED BY: <a href='http://www.saphplesson.org'>SaphpLesson</a> 4.0</center>";
                }
            }
			return($this->page);
		}
	}
?>