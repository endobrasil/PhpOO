<?php
/**
 * class TCheckButton
 * classe para a construção de botões para verificação 
 */
 class TCheckButton extends TField{
 		
 	/**
 	 * método show()
 	 * exibe o widget na tela
 	 */
 	public function show(){
 		//atribui as propriedades da TAG
 		$this->tag->name = $this->name;	//nome da tag
 		$this->tag->value = $this->value;//valor
		$this->tag->type='checkbox';	//tipo do input
		
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
