<?php
/**
* classe TImage
* classe para a exibição de imagens
*/
class TImage2{
	private $source;	//localização da imagem
	private $tag; 		//objeto TElement

	/**
	* método construtor
	* instancia objeto TImage
	* @param $source =localização da imagem
	*/
	public function __construct($source){
		//atribui a localização daimagem
		$this->source=$source;
		//instancia objeto TElement
		$this->tag = new TElement('img');
	}

	/**
	* método show()
	* exibe a imagem natela
	*/
	public function show(){
		//define algumas propriedades da tag
		$this->tag->src=$this->source;
		$this->tag->border=0;

		//exibe tag na tela
		$this->tag->show();
	}
}
?>