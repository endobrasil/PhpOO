<?php
/**
* classe Cliente
* Active Recoord para tablea Cliente
*/
class Cliente extends TRecord{
	const TABLENAME='cliente';
	private $cidade;

	/**
	* método get_nome_cidade()
	* executado sempre que for acessadaa propriedade "nome_cidade"
	*/
	function get_nome_cidade(){
		//instanca cidade
		//carrega na memória a cidade de código $this->id_cidade
		if(empty($this->cidade)){
			$this->cidade = new Cidade($this->id_cidade);
		}
		//retorna o objeto instanciado
		return $this->cidade->nome;
	}
}
?>