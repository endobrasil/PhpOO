<?php
	class Produto{
		public $Codigo;
		public $Descricao;
		public $preco;
		public $Quantidade;
		
		function ImprimeEtiqueta(){
			print 'Código: '.$this->Codigo.'<br>';
			print 'Descrição: '.$this->Descricao.'<br>';
		}
	}
?>