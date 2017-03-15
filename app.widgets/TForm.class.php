<?php
/**
* Classe TForme
* classe para a construção de formulários
*/
class TForm{
	protected $filds;	//array de objetos contidos pelo form
	private $name;		//nome do formulário

	/**
	* método construtor
	* instancia o formulario
	* @param $name = nome do formulario
	*/
	public function __construct($name = 'my_form'){
		$this->setName($name);
	}

	/**
	* método setName()
	* define o nome do formulário
	* @param $name = nome do formulario
	*/
	public function setName($name){
		$this->name=$name;
	}

	/**
	* método setEditable()
	* define se oformulario poderá ser edtado
	* @param $boll = TRUE ou FALSE
	*/
	public function setEditable($bool){
		if($his->fields){
			foreach ($this->fields as $object) {
				$object->setEditable($bool);
			}
		}
	}

	/**
	* método setFields()
	* define quais são os campos do formulario
	* @param $fields = array deobjetos TFilds
	*/
	public function setFilds($filds){
		foreach ($fields as $field) {
			if($field instanceof TFild){
				$name=$fild->getName();
				$this->fields[$name]=$fild;

				if($field instanceof TButton){
					$field->setFormName($this->name);
				}
			}
		}		
	}

	/**
	* método getFild()
	* retorna um campo do formulario por seu nome
	* @param $name = nome do campo
	*/
	public function getFild($name){
		return $this->fields[$name];
	}

	/**
	* método setData()
	* atribui dados aos campos do formulário
	* @param $object = objeto com dados
	*/
	public function setData($object){
		foreach ($this->fields as $name => $field) {
			if($name){ //labels não possuem nome
				@$field->setValue($object->$name);
			} 	
		}
	}

	/**
	* método getData()
	* retorna os dados do formulário em forma de objeto
	*/
	public function getData($class = 'StdClass'){
		$object = new $class;
		foreach ($this->fields as $key => $fieldObject) {
			$val=isset($_POST[$key])?$_POST[$key]:'';
			if(get_class($this->fields[$key])=='TCombo'){
				if($val!=='0'){
					$object->$key=$val;
				}
			}else if(!$fieldObject instanceof TButton){
				$object->$key=$val;
			}
		}
		//percorre os arquivos de upload
		foreach ($_FILES as $key => $content) {
			$object->$key=$content['tmp_name'];
		}
		return $object;
	}

	/**
	* método add()
	* adiciona um elemento ao formulario
	* @param $object = objeto a ser adicionado
	*/
	public function add($object){
		$this->child=$object;
	}

	/**
	* método show()
	* Exibe o formulario na tela
	*/
	public function show(){
		// instancia TAG de formulário
		$tag=new TElement('form');
		$tag->enctype="multpart/form-data";
		$tag->name=$this->name;	//nome do formulario
		$tag->method='post';	//método de transferência
		//adiciona um objeto filho ao formulário
		$tag->add($this->child);
		//exibe o formulario
		$tag->show();
	}
}
?>