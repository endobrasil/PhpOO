<?php
/**
* classe TField
* classe base para construção dos widgets para formulário
*/
abstract class TFild{
	protected $name;
	protected $fild;
	protected $value;
	protected $editable;
	protected $tag;

	/**
	* método construtor
	* instancia um campo do formulário
	* @param $name = nome do campo
	*/
	public function __construct($name){
		//define algumas características iniciais
		self::setEditable(true);
		self::setName($name);
		self::setSize(200);

		//instancia um estilo css chamado tfiel
		//que será utilizado pelos campos do formulário
		$style1=new TStyle('tfield');
		$style1->border='solid';
		$style1->border_color='#a0c9e6';
		$style1->border_width='1px';
		$style1->z_index='1';

		$style2=new TStyle('tfield_disabled');
		$style2->border='solid';
		$style2->border_color='#a0c9e6';
		$style2->border_width='1px';
		$style2->background_color='#e6c9a0';
		$style2->color='#c3c3c3';

		$style1->show();
		$style2->show();

		//cria uma tag HTML do tipo <input>
		$this->tag=new TElement('input');
		$this->tag->class='tfield';	//class css
	}

	/**
	* método setName()
	* define o nome do widget
	* @param $name = nome do widget
	*/
	public function setName($name){
		$this->name = $name;
	}

	/**
	* método getName()
	* retorna o nome do widget
	*/
	public function getName(){
		return $this->name;
	}

	/**
	* método setValue()
	* define o valor de um campo
	* @param $value = valor do campo
	*/
	public function setValue($value){
		$this->value=$value;
	}

	/**
	* método getValue()
	* retorna o valor de um campo
	*/
	public function getValue(){
		return $this->value;
	}

	/**
	* método setEditable()
	* define se o campo poderá ser editado
	* @param $editable = true or false
	*/
	public function setEditable($editable){
		$this->editable=$editable;
	}

	/**
	* método getEditable()
	* retorna o valor da propriedade $editable
	*/
	public function getEditable(){
		return $this->editable;
	}

	/**
	* método setProperty()
	* define uma propriedade para o campo
	* @param $name = nomeda propriedade
	* @param $value =valor da propriedade
	*/
	public function setProperty($name, $value){
		//define uma propriedade de $this->tag
		$this->tag->$name=$value;
	}

	/**
	* método setSize()
	* define alargura do widget
	* @param $width = largura em pixels
	* @param $height = altura em pxels(usada em TText)
	*/
	public function setSize($width, $height=NULL){
		$this->size=$width;
	}

}

?>