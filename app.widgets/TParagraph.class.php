<?php
/**
* classe TParagraph
* classe para exibição de parágrafos
*/
class TParagraph extends TElement{
	/**
	* método construtor
	* instancia objeto TParagraph
	* @param $texto = texto a serexibido
	*/
	public function __construct($text){
		parent::__construct('p');
		//atribui o conteúdo dotexto
		parent::add($text);
	}

	/**
	* método set_aling()
	* define o alinhamento do texto
	* @param $aling = alinhamento do texto
	*/
	function set_aling($aling){
		$this->aling=$aling;
	}
}
?>