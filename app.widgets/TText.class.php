<?php
/**
 * class TText
 * classe para a construção de campos de digitação de senhas 
 */
 class TText extends TField{
 	private $width;
 	private $height;
 	
 	/**
 	 * método construtor
 	 * instancia um novo objeto
 	 * @param $name = nome do campo
 	 */
 	public function __construct($name){
 		//executa o mṕetodo construtor da classe pai
 		parent::__construct($name);
 		
 		//cria uma tag html do tipo <textarea>
 		$this->tag=new TElement('textarea');
 		$this->tag->class='tfield';	//class css
 		
 		//define a altura padrão da caixa de texto
 		$this->height=100;
 	}
 	
 	/**
 	 * método setSize()
 	 * define o tamanho de um campo de texto
 	 * @param $width = largura
 	 * @param $height = altura  	 
 	 */
 	public function setSize($width, $height=NULL){
 		$this->size=$width;
 		if(isset($height)){
 			$this->height=$height;
 		}
 	}
 	
 	/**
 	 * método show()
 	 * exibe o widget na tela
 	 */
 	public function show(){
 		//atribui as propriedades da TAG
 		$this->tag->name = $this->name;	//nome da tag
		$this->tag->style="width:{$this->size}; height:{$this->height}"; //tamanho em pixels
		
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
