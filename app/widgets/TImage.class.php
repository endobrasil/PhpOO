<?php
/**
* classe TImage
* classe para a exibição de imagens
*/
class TImage extends TElement{
	private $source;	//localização da imagem

	/**
	* método construtor
	* instancia objeto TImage
	* @param $source =localização da imagem
	*/
	public function __construct($source){
		parent::__construct('img');
		
		$this->src=$source;
		$this->border=0;
	}
}
?>