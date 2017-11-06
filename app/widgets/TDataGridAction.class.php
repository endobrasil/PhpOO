<?php
/**
* class TDatagridAction
* representa uma ação de uma listagem
*/
class TDataGridAction extends TAction{
	private $image;
	private $label;
	private $field;

	/**
	* método setImage()
	* atribui uma imagem à ação
	* @param $image = local do arquivo de imagem
	*/
	public function setImage($image){
		$this->image=$image;
	}

	/**
	* método getImage()
	* retorna a imagem da ação
	*/
	public function getImage(){
		return $this->image;
	}

	/**
	* método setLabel()
	* define o rótulo de texto da ação
	* @param $label = rótulo de texto da ação
	*/
	public function setLabel($label){
		$this->label=$label;
	}

	/**
	* método getLabel()
	* retorna o rótulo de texto da ação
	*/
	public function getLabel(){
		return $this->label;
	}

	/**
	* método setField()
	* defineonome docampodobanco dedados
	* que será passado juntamente com a ação
	* @param $field =nomedocampo do banco de dados
	*/
	public function setField($field){
		$this->field=$field;
	}

	/**
	* function getField()
	* retorna o nome do campo de dados definido 
	* pelo método setField()
	*/
	public function getField(){
		return $this->field;
	}
}
?>