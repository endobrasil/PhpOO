<?php
/*
* classe TElement
* classe para abstração detags HTML
*/
class TElement{
	private $name;	//nome da TAG
	private $properties;	//propriedade da TAG
	protected $children;

	/*
	* método construtor
	* instancia uma tag HTML
	* @param $nome = nome da tag
	*/
	public function __construct($name){
		//define o nome do elemento
		$this->name=$name;
	}

	/*
	* método __set()
	* intercepta as atribuições á propriedade do objeto
	* @param $name = nome da propriedade
	* @param $value = valor
	*/
	public function __set($name, $value){
		//armazena osvalores atribuidos
		// ao array properties
		$this->properties[$name]=$value;
	}

	/*
	* método add()
	* adiciona um elemento filho
	* @param $child = objeto filho
	*/
	public function add($child){
		$this->children[]=$child;
	}

	/*
	* método open()
	* exibe a tag de abertura na tela
	*/

	private function open(){
		//exibe tag de abertura
		echo "<{$this->name}";
		if($this->properties){
			//percorre as propriedades
			foreach ($this->properties as $name => $value) {
				echo " {$name}=\"{$value}\"";
			}
		}
		echo ">";
	}

	/*
	* método show()
	* exibe uma tag na tela juntamente com o seu conteúdo
	*/

	public function show(){
		//abre a tag
		$this->open();
		echo "\n";

		//se possuir conteúdo
		if($this->children){
			//percorre todos os objetos filhos
			foreach ($this->children as $child) {
				//se for objeto
				if(is_object($child)){
					$child->show();
				}else if((is_string($child)) or (is_numeric($child))){
					//se for texto
					echo $child;
				}
			}
			//fecha a tag
			$this->close();
		}
	}

	/*
	* método close()
	* fechaumatag HTML
	*/
	public function close(){
		echo "</{$this->name}>\n";
	}
}
?>