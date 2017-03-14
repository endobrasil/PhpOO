<?php
/**
* class TAction
* encapsula uma ação
*/
class TAction {
	private $action;
	private $param;

	/**
	* método __construct()
	* instancia uma nova ação
	* @param action = método a ser executado
	*/
	public function __construct($action){
		$this->action=$action;
	}

	/**
	* método setParameter()
	* acrescenta um parâmetro ao método a ser executado
	* @param $param=nome do parãmetro
	* @param $value = valor do parâmetro
	*/
	public function setParameter($param,$value){
		$this->param[$param]=$value;
	}

	/**
	* método serialize()
	* transforma a ação em umastring do tipo URL
	*/
	public function serialize(){
		//verifica se a ação é um método
		if(is_array($this->action)){
			//obtem o nome da classe
			$url['class']=get_class($this->action[0]);
			//obtem o nome do método
			$url['method']=$this->action[1];
		}else if(is_string($this->action)){//é uma string
			//obtem o nome dafunção
			$url['method']=$this->action;
		}

		//verifica sehá parâmetros
		if($this->param){
			$url=array_merge($url,$this->param);
		}

		//monta a url
		return '?'.http_build_query($url);
	}
}

?>