<?php
/**
* classe TTableRow
* classe para exibição de uma linha de tabelas
*/
class TTableRow extends TElement{
	/**
	* método construtor
	* instancia uma nova linha
	*/
	public function __construct(){
		parent::__construct('tr');
	}

	/**
	* método addCell()
	* agrega um novo objeto célula (TTableCell) na linha
	* @param $value = conteúdo da célula
	*/
	public function addCell($value){
		$cell = new TTableCell($value);
		parent::add($cell);
		return $cell;
	}
}
?>