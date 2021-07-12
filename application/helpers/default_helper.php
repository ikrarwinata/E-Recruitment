<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Unlink a file, but its safe with empty values
 *
 * Using unlink(), and check file existance before execute
 *
 * @access	public
 * @param	string	$path 	the file path
 * @return	return TRUE if success, false otherwise.
 */
 
if (! function_exists('unlink_safe'))
{
	function unlink_safe($path)
	{
		if ($path!=NULL) {
            if (file_exists($path)) {
            	if (is_dir($path)) {
            		unlink($path);
            		return TRUE;
            	}
            }else{
	        	return FALSE;
	        };
        }else{
        	return FALSE;
        };
	};
}

/**
 * input_select($value, $selectvalue)
 *
 * Used to select one of the select box option
 *
 * @access	public
 * @param	string	$value 	the value send by server
 * @param	string	$selectvalue 	the select option value
 * @param	string	$returnstring 	(Optional) the return value for selected option
 * @return	return string selected="true" for equal value ($value==$selectvalue).
 */
 
if (! function_exists('input_select'))
{
	function input_select($value, $selectvalue, $returnstring = 'selected="true"')
	{
		if ($value==NULL || $selectvalue == NULL) {
			return NULL;
		};
		if($value == $selectvalue){
			return $returnstring;
		};
	}
}

/**
 * columnLetter($index)
 *
 * Convert int to char,
 * used for working with excel column.
 * eg : 1 = A, 2 = B
 *
 * @access	public
 * @param	string	index 	input value, integer only. (0 = NULL)
 * @param	bool	(Optional) resultToUpperCase 	convert to upercase
 * @return	return single char. ( A ~ Z )
 */
 
if (! function_exists('columnLetter'))
{
	function columnLetter($index, $resultToUpperCase = FALSE)
	{
		$c = intval($index);
	    if ($c <= 0) return NULL;

	    $letter = '';
	             
	    while($c != 0){
	       $p = ($c - 1) % 26;
	       $c = intval(($c - $p) / 26);
	       $letter = chr(65 + $p) . $letter;
	    }
	    if ($resultToUpperCase) $letter = strtoupper($letter);
	    
	    return $letter;
	}
}

/**
 * timeLog($inputDate, $format = "%d days, %m months, %y years, %H Hour %i minutes %s seconds")
 *
 * Get time log, used for LastSeen in chat app
 *
 * @access	public
 * @param	string	inputDate 	input date comparison
 * @param	string	format 	(Optional) string output format
 * @return	type	
 */
 
if (! function_exists('timeLog'))
{
	function timeLog($inputDate, $format = "%d days, %m months, %Y years, %H Hour %i minutes %s seconds")
	{
		if(trim($inputDate)==NULL) return NULL;
		$date = NULL;

		if (strpos($inputDate, "-") !== FALSE || strpos($inputDate, "/") !== FALSE) {
			$date = format_date($inputDate);
		}else{
			// timestapms
			$date = date("Y-m-d H:i:s", $inputDate);
		};

		
	}
}

function format_number($number){
	$result = $number;
	if(strpos($number, ",")!==FALSE){
		$listNumber = explode(",", $number);

		$result = number_format($listNumber[0]);
		$result = str_replace(",", ".", $result);
		foreach ($listNumber as $value) {
			$result .= ",". $value;
		}
	}else{
		$result = number_format($number);
		$result = str_replace(",", ".", $result);
	};

	return $result;
}

function set_timezone($zone = 'Asia/Jakarta'){
	date_default_timezone_set($zone);
}

function format_date($date){

	if(trim($date)==NULL){return NULL;};
	$c = array();
	$d=NULL;
	$m=NULL;
	$Y=NULL;
	$time = NULL;

	if(strpos($date, "-")!==FALSE){
		$c = explode("-", $date);
	}else{
		$c = explode("/", $date);
	};

	if(strlen($c[0]) >= 4){
		$d = $c[2];
		$m = $c[1];
		$Y = $c[0];
	}else if($c[1] >= 13){
		$d = $c[1];
		$m = $c[0];
		$Y = $c[2];
	}else{
		return $date;
	}

	if (strpos($date, " ")!==FALSE) $time = " ".explode(" ", $date)[1];

	return $d."-".$m."-".$Y.$time;
}

function format_date_from_string($date, $oldformat){

	if(trim($date)==NULL){return NULL;};
	$c = array();
	$f = array();

	$sp = strpos($oldformat, "-")!==FALSE?"-":"/";
	$sp2 = strpos($date, "-")!==FALSE?"-":"/";
	$c = explode($sp2, $date);
	$f = explode($sp, $oldformat);

	$d=NULL;
	$m=NULL;
	$Y=NULL;
	$result = NULL;

	for ($i=0; $i < 3; $i++) { 
		if (isset($f[$i])) {
			switch (strtolower($f[$i])) {
				case 'd':
					$d = $c[$i];
					break;
				case 'm':
					$m = $c[$i];
					break;
				case 'y':
					$Y = $c[$i];
					break;
				default:
					$d = $c[$i];
					break;
			}
		}else{
			$result = $date;
			break;
		}
	}
	$result = $d."-".$m."-".$Y;

	return $result;
}

function get_year($date){
	if($date==NULL){return NULL;};
	$sp = strpos($date, '-')!==FALSE?'-':'/';
	$res = explode($sp, $date)[2];
	return $res;
}

function get_month($date){
	if($date==NULL){return NULL;};
	$sp = strpos($date, '-')!==FALSE?'-':'/';
	$res = explode($sp, $date)[1];
	return $res;
}

function get_str_month($index){
	$sbulan = array('', 'January', "February", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	if($index<=count($sbulan)){
		$index = $index*1;
		return $sbulan[$index];
	}else{
		return NULL;
	}
}

function get_day($date){
	if($date==NULL){return NULL;};
	$sp = strpos($date, '-')!==FALSE?'-':'/';
	$res = explode($sp, $date)[0];
	return $res;
}

function get_str_day($date){
	if($date==NULL){return NULL;};
	$result = NULL;
	switch (date("w", mktime(0, 0, 0, get_month($date), get_day($date), get_year($date)))) {
		case '0':
			$result="Minggu";
			break;
		case '1':
			$result="Senin";
			break;
		case '2':
			$result="Selasa";
			break;
		case '3':
			$result="Rabu";
			break;
		case '4':
			$result="Kamis";
			break;
		case '5':
			$result="Jumat";
			break;
		case '6':
			$result="Sabtu";
			break;
		default:
			$result=NULL;
			break;
	};
	return $result;
};

function date_passed($date, $onequal = 1){
	if($date == NULL){return FALSE;};
	$date = format_date($date);

	$dY = date("Y");
	$dM = date("m");
	$dd = date("d");
	$nY = get_year($date);
	$nM = get_month($date);
	$nd = get_day($date);

	if($dY > $nY){return "1";};
	if($dM > $nM && $dY == $nY){return "1";};
	if($dd > $nd && $dM == $nM && $dY == $nY){return "1";};
	if($onequal == TRUE && $dd == $nd && $dM == $nM && $dY == $nY){return "1";};
	return "0";
}

function str_sentence($str){
	$c = explode(" ", $str);
	$res = NULL;
	foreach ($c as $value) {
		$res .= strtoupper(substr($value, 0,1)).strtolower(substr($value, 1))." ";
	};
	$res = trim($res);
	return $res;
};

function str_shortened($str, $lenght, $ext = "..."){
	$res = NULL;
	if(strlen($str)>$lenght){
		$res = substr($str, 0, $lenght).$ext;
	}else{
		$res = $str;
	}
	return $res;
}

function increase_date($date, $increament){
	$d = strtotime("+$increament day", strtotime(get_year($date)."-".get_month($date)."-".get_day($date)));
	return date("d-m-Y", $d);
}

function increase_date_defaultformat($date, $increament){
	$d = strtotime("+$increament day", strtotime(get_year($date)."-".get_month($date)."-".get_day($date)));
	return date("Y-m-d", $d);
}

function is_odd($number){
	if($number % 2 == 0){ 
        return false;
    } 
    else{ 
        return true;
    }
}

function is_even($number){
	if($number % 2 == 0){ 
        return true;
    } 
    else{ 
        return false;
    }
}