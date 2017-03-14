<?php
include_once 'Conta.class.php';

class ContaCorrente extends Conta{
	public $limite;
	
	function __construct($Agencia,$Codigo,$dataDeCriacao,$Titular,$Senha,$Saldo,$Cancelado,$limite){
		parent::__construct($Agencia, $Codigo, $dataDeCriacao, $Titular, $Senha, $Saldo, $Cancelado);
		$this->limite=$limite;
	}
	
	function retirar($quantia){
		$cpmf=0.05;
		if($this->Saldo+$this->limite>=$quantia){
			parent::retirar($quantia);
			parent::retirar($quantia*$cpmf);
			return true;
		}else {
			return false;
		}
	}
}
?>