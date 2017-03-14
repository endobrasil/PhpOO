<?php
include_once 'Conta.class.php';

class ContaPoupanca extends Conta{
	public $limite;
	
	public function retirar($quantia){
		if($this->Saldo>=$quantia){
			parent::retirar($quantia);
			return true;
		}else{
			return false;
		}
	}
}
?>