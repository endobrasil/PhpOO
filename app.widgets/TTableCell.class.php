<?php
/**
* classe TTableCell
* classe para exibição de uma célula de tabelas
*/
class TTableCell extends TElement{
	/**
	* método construtor
	* instancia uma nova célula de uma tabela
	* @param $value = conteúdo da célula 
	*/
	public function __construct($value){
		parent::__construct('td');
		parent::add($value);
	}
}
?>