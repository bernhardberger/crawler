<?php
class tx_crawler_validator{
	private $patterns;
	
	public function __construct(){
		$this->patterns['string']				= '%^[[:alnum:]\ \-\.,&!\?_]+$%';
		$this->patterns['name']					= '%^[[:alpha:]�������\ \-\.,&]{0,50}+$%';
		$this->patterns['string_upper_case']	= '%^[[:upper:]]+$%';
		$this->patterns['string_lower_case']	= '%^[[:lower:]]+$%';
		$this->patterns['char']					= '%^[[:alpha:]]$%';
		$this->patterns['char_upper_case']		= '%^[[:upper:]]$%';
		$this->patterns['char_lower_case']		= '%^[[:lower:]]$%';
		$this->patterns['int']					= '%^[[:digit:]]+$%';
		$this->patterns['string_and_int']		= '%^[[:alnum:]]\ \-]+$%';
		$this->patterns['float']				= '%^[1-9]*[0-9]\.[0-9]+$%';
		$this->patterns['percent']				= '%(^100([\.,]{1}[0]+)?$)|(^[0-9]{1,2}([\.,]{1}[0-9]+)?$)%';
		$this->patterns['upper_case']			= '%^[0-9A-Z]+$%';    
		$this->patterns['zipcode']				= '%^[[:alnum:]\ \-]+$%';
		$this->patterns['phone_fax'] 			= '%^(\+[[:digit:]]+ )?[[:digit:]]+(\-)|(\/)[[:digit:]]+$%';
		$this->patterns['email']				= '%^[[:alnum:]���][[:alnum:]\.\-\_]*[[:alnum:]���]@[[:alnum:]���][[:alnum:]���\-\.]*[[:alnum:]���]\.[a-z]{2,5}+$%';
		$this->patterns['prevent_injection']	= '%(^[[:alnum:]\-_@ \/\.,]+$)|(^$)%';
		$this->patterns['not_empty']			= '%^.+$%';
		
		$this->patterns['sql'][] = '%INSERT.*INTO%';
		$this->patterns['sql'][] = '%UPDATE.*SET%';	
		$this->patterns['sql'][] = '%SELECT.*FROM%';
		$this->patterns['sql'][] = '%DROP.*TABLE%';
		$this->patterns['sql'][] = '%DROP.*DATABASE%';
		$this->patterns['sql'][] = '%TRUNCATE.*%';
		
	}
	
	/**
	 * Validates an integer value
	 *
	 * @param int $toTest
	 * @return boolean
	 */
	public function isInt($toTest){
		if(is_int($toTest)){
			$match = preg_match_all($this->patterns['int'],$toTest,$res);
			$match =  (bool)$match;
		}else{
			//no int datatype
			$match = false;
		}
		
		return $match;
	}
	
	/**
	 * Validates a given email address
	 *
	 * @param string $email
	 * @return boolean
	 */
	public function isEmail($email){
		if(is_string($email)){

			$match = preg_match_all($this->patterns['email'],$email,$res);
			$match =  (bool)$match;			
		}else{
			//no string datatype
			$match = false;		
		}
		
		return $match;
	}
	
	/**
	 * Validates a given string
	 *
	 * @param string $string
	 * @return boolean
	 */
	public function isString($string){
		if(is_string($string)){
			$match = preg_match_all($this->patterns['string'],$string,$res);
			$match =  (bool)$match;			
		}else{
			$match = false;
		}
		
		return $match;		
	}
	
	/**
	 * Validates a given string as name
	 *
	 * @param string $name
	 * @return boolean
	 */
	public function isName($name){
		if(is_string($name)){
			$match = preg_match_all($this->patterns['name'],$name,$res);
			$match =  (bool)$match;			
		}else{
			$match = false;
		}
		
		return $match;
	}
	
	/**
	 * Validates a given value as float
	 *
	 * @param float $float
	 * @return boolean
	 */
	public function isFloat($float){
		if(is_float){
			$match = preg_match_all($this->patterns['float'],$float,$res);
			$match =  (bool)$match;				
		}else{
			$match = false;
		}
		
		return $match;
	}
	
	/**
	 * This method validates a given value as percent value
	 *
	 * @param float $percent
	 * @return boolean
	 */
	public function isPercent($percent){
		$match = false;
		if(is_float($percent) || is_int($percent)){
			$match = preg_match_all($this->patterns['percent'],$percent,$res);
			$match = (bool)$match;
		}else{
			$match = false;
		}
		
		return $match;
	}
	
	/**
	 * This method is used to check that there sql no SQL INJECTION 
	 * in the given string
	 *
	 * @param string $line
	 * @return boolean
	 */
	public function isNoSqlInject($line){
		$bool = true;	
		foreach($this->patterns['sql'] as $pattern){
			//make to upper string 
			$line = strtoupper($line);
			if(preg_match_all($pattern,$line,$res)){
				$bool = false;
				break;	
			}
		}
		
		return $bool;
	}
}
?>