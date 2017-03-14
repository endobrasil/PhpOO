<?php
	class Conta{
		public $Agencia;
		public $Codigo;
		public $dataDeCriacao;
		public $Titular;
		public $Senha;
		public $Saldo;
		public $Cancelado;
		
		function retirar($quantia){
			if($quantia>0){
				$this->Saldo-=$quantia;
			}			
		}
		
		function depositar($quantia){
			if($quantia>0){
				$this->Saldo+=quantia;
			}			
		}
		
		function obterSaldo() {
			return $this->Saldo;
		}
		
		function __construct($Agencia,$Codigo,$dataDeCriacao,$Titular,$Senha,$Saldo,$Cancelado){
			$this->Agencia=$Agencia;
			$this->Codigo=$Codigo;
			$this->dataDeCriacao=$dataDeCriacao;
			$this->Titular=$Titular;
			$this->Senha=$Senha;
			$this->Saldo=$Saldo;
			$this->Cancelado=$Cancelado;
		}
		
		function __destruct(){
			echo "Objeto Conta{$this->Codigo} de {$this->Titular->Nome} finalizada...<br>";
		}
	}
?>