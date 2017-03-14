<?php
class TFilter extends TExpression{
	private $variavel;
	private $operador;
	private $valor;
	
	public function __construct($variavel, $operador,$valor) {
		$this->operador=$operador;
		$this->valor=$this->transformar($valor);
		$this->variavel=$variavel;
	}
	
	private function transformar($valor) {
		//caso de array
		if(is_array($valor)){
			foreach ($valor as $x){
				if(is_integer($x)){
					$foo[]=$x;
				}else if(is_string($x)){
					$foo[]="'$x'";
				}
			}
			$resultado='('.implode(',', $foo).')';
		}else if(is_string($valor)){
			$resultado="'$valor'";
		}else if(is_null($valor)){
			$resultado='null';
		}else if(is_bool($valor)){
			$resultado=$valor?'TRUE':'FALSE';
		}else{
			$resultado=$valor;
		}
		
		return $resultado;
	}
	
	public function dump() {
		return "{$this->variavel} {$this->operador} {$this->valor}";
	}
}
?>