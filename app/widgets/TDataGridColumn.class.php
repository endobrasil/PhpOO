<?php
/**
* classnTDataGridColumn
* representauma coluna de listagem
*/
class TDatagridColumn{
	private $name;
	private $label;
	private $aling;
	private $width;
	private $action;
	private $transformer;

	/**
	* método __construct()
	* instancia uma coluna nova
	* @param $name = nome da coluna no banco de dados
	* @param $label = rótulo de texto que será exibido
	* @param $aling = alinhamento da coluna (left, center, right)
	* @param $width = largura da coluna (em pixels)
	*/
	public function __construct($name, $label, $aling, $width){
		//atribui osparâmetros às propriedades do objeto
		$this->name=$name;
		$this->label=$label;
		$this->aling=$aling;
		$this->width=$width;
	}

	/**
	* método getName()
	* retorna o nome da coluna no banco de dados
	*/
	public function getName(){
		return $this->name;
	}

	/**
	* método getLabel()
	* retorna o rótulo do texto da coluna
	*/
	public function getLabel(){
		return $this->label;
	}

	/**
	* método getAling()
	* retorna o alinhamento da coluna (left, center, right)
	*/
	public function getAling(){
		return $this->aling;
	}

	/**
	* método getWidth()
	* retornao a largura da coluna (em pixels)
	*/
	public function getWidth(){
		return $this->width;
	}

	/**
	* método setAction()
	* define uma ação a ser executada quando o usuário
	* clicar sobre o título da coluna
	* @param $action = objeto TAction contendo a ação
	*/
	public function setAction(TAction $action){
		$this->action=$action;
	}

	/**
	* método getAction()
	* retorna a ação vinculada à coluna
	*/
	public function getAction(){
		//verifica se a coluna possui ação
		if($this->action){
			return $this->action->serialize();
		}
	}

	/**
	* método setTransformer()
	* define uma função (callback) a ser aplicada
	* sobre todo dado contido nesta coluna
	* @param $callback = função do PHP ou do usuário
	*/
	public function setTransformer($callback){
		$this->transformer=$callback;
	}

	/**
	* método getTransformer()
	* retorna a função (callback) aplicada à coluna
	*/
	public function getTransformer(){
		return $this->transformer;
	}
}
?>