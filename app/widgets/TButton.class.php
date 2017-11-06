<?php
/**
 * class TButton
 * classe responsável por exibir um botão 
 */
 class TButton extends TField{
 	private $action;
 	private $label;
 	private $formName;
 	
 	/**
 	 * método setAction
 	 * define a ação do botçao (funcção a ser executada)
 	 * @param $action = ação do botão
 	 * @param $label = rótulo do botão
 	 */
 	public function setAction($action,$label){
 		$this->action=$action;
 		$this->label=$label;
 	}
 	
 	/**
 	 * método setFormName
 	 * define o nome do formulário para a ação do botçao
 	 * @param $name = nome do formulário
 	 */
 	public function setFormName($name){
 		$this->formName=$name;
 	}
	
 	/**
 	 * método show()
 	 * exibe o widget na tela
 	 */
 	public function show(){
 		$url = $this->action->serialize();
 		
		//atribui as propriedades da TAG
 		$this->tag->name = $this->name;	//nome da tag
		$this->tag->type='button';	//tipo button
		$this->tag->value=$this->label;	//rótulo do botão
		
		//se o campo é ou não edivel
		if(!parent::getEditable()){
			$this->tag->disabled="1";
			$this->tag->class='tfield_disabled';//class CSS
		}
		
		//define a ação do botão
		$this->tag->onclick="document.{$this->formName}.action='{$url}';".
				"document.{$this->formName}.submit()";
		//exibe a tag
		$this->tag->show();
 	}
}
?> 
