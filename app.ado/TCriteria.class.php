<?php
class TCriteria extends TExpression{
	private $expressions;
	private $operators;
	private $properties;
	
	function __construct() {
		$this->expressions=array();
		$this->operators=array();
	}
	
	public function add(TExpression $expression, $operators=self::AND_OPERADOR){
		if(empty($this->expressions)){
			$operators=NULL;
		}
		$this->expressions[]=$expression;
		$this->operators[]=$operators;
	}
	
	public function dump() {
		if(is_array($this->expressions)){
			if(count($this->expressions>0)){
				$result='';
				foreach ($this->expressions as $i=>$expression){
					$operator=$this->operators[$i];
					$result.=$operator.$expression->dump().' ';
				}
				$result=trim($result);
				return $result;
			}
		}
	}
	
	public function setProperty($property,$value){
		if(isset($value)){
			$this->properties[$property]=$value;
		}else {
			$this->properties[$property]=null;
		}
	}
	
	public function getProperty($property){
		if(isset($this->properties[$property])){
			return $this->properties[$property];
		}
	}
}
?>