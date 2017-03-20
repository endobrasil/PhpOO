<?php
/**
 * class TCombo
 * classe para a construção de campos de digitação de senhas 
 */
 class TCombo extends TFild{
 	private $itens; 	
 	
 	/**
 	 * método construtor
 	 * instancia um combo box
 	 * @param $name = nome do campo
 	 */
 	public function __construct($name){
 		//executa o mṕetodo construtor da classe pai
 		parent::__construct($name);
 		
 		//cria uma tag html do tipo <select>
 		$this->tag=new TElement('select');
 		$this->tag->class='tfield';	//class css 		
 	}
 	
 	/**
 	 * método addItens()
 	 * adiciona intens a combo box
 	 * @param $itens = array de itens  	 
 	 */
 	public function addItens($itens){
 		$this->itens=$itens
 	}
 	
 	/**
 	 * método show()
 	 * exibe o widget na tela
 	 */
 	public function show(){
 		//atribui as propriedades da TAG
 		$this->tag->name = $this->name;	//nome da tag
		$this->tag->style="width:{$this->size}"; //tamanho em pixels
		
		//cria uma tag <option> com um valor padrão
		$option = new TElement('option');
		$option->add('');
		$option->value='0'; 	//valor da tag
		//adiciona a opção à combo
		$this->tag->add($option);
		
		if($this->itens){
			//percorre os itens adicionados
			foreach ($this->itens as $chave=>$item){
				//cria a tag <option> para o item
				$option = new TElement('option');
				$option->value=$chave; 	//define o índice da opção
				$option->add($item);	//adiciona o texto da opção
				
				//caso a opção selecionada
				if($chave == $this->value){
					//seleciona o item da combo
					$option->selected=1;
				}
				
				//adiciona a opção à combo
				$this->tag->add($option);		
			}
		}		
		
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
