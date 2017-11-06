<?php
/**
*	classe TLabel
*	classe para construção de rótulos de textos
*/
class TLabel extends TField{
	private $fontSize;	// tamanho da fonte
	private $fonteFace;	// nome da fonte
	private $fonteColor;// cor da fonte

	/**
	*	método contrutor
	*	instancia um label, cria um objeto <font>
	*	@param $value = texto = texto do label
	*/
	public function __construct($value){
		//atribui um conteúdo do label
		$this->setValue($value);

		//instancia um elemento font
		$this->tag=new TElement('font');

		//define os valores iniciais às propriedades
		$this->fontSize='14';
		$this->fonteFace='Arial';
		$this->fonteColor='black';
	}

	/**
	*	método setSize
	*	define o tamanho da fonte
	*	@param $size = tamanho da fonte
	*/
	public function setFontSize($size){
		$this->fontSize=$size;
	}

	/**
	*	método setFontFace
	*	define a família da fonte
	*	@param $font = nome da fonte
	*/
	public function setFontFace($face){
		$this->fonteFace=$face;
	}

	/**
	*	método fontSetColor
	*	define a cor da fonte
	*	@param color = cor da fonte
	*/
	public function setFontcolor($color){
		$this->fonteColor=$color;
	}

	/**
	*	método show()
	*	exibe o widget na tela
	*/
	public function show(){
		//define o estilo da tag
		$this->tag->style=	"font-family:{$this->fonteFace}; ".
						"color:{$this->fonteColor}; ".
						"font-size:{$this->fontSize}";
		// adiciona o conteúdo à tag
		$this->tag->add($this->value);
		//exibe a tag
		$this->tag->show();
	}
}
?>