<?php
/**
*	classe TEntry
*	caixa para a construção de caixas de texto
*/
class TEntry extends TFild{
	/**
	*	método show()
	*	exibe o widget na tela
	*/
	public function show(){
		//atribui as propriedades da TAG
		$this->tag->name = $this->name;	//nome da tag
		$this->tag->value=$this->value;	//valor da tag
		$this->tag->type='text';		//tipo input
		$this->tag->style="width:{$this->size}"; //tamanho em pixels

		//se o campo é ou não edivel
		if(!parent::getEditable()){
			$this->tag->readonly="1";
			$this->tag->class='tfield_disabled';//class CSS
		}

		//exibe a tag
		$this->tag->show();
	}
}
?>

