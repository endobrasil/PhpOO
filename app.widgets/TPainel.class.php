<?php
/**
* classe TPanel
* painel de posições fixas
*/
class TPainel extends TElement{
	/**
	* método construtor
	* instancia um novo painel
	* @param $width = largura do painel
	* @param $height = altura do painel
	*/
	public function __construct($width, $height){
		//instancia um objeto TStyle 
		//para definir as características do painel
		$style = new TStyle('panel');
		$style->position ='relative';
		$style->width =$width;
		$style->height =$height;
		$style->border ='2px solid';
		$style->border_color ='grey';
		$style->background_color='#a0b0c0';
		$style->show();
		parent::__construct('div');
		$this->class='panel';
	}

	/**
	* método put()
	* posiciona um objeto no painel
	* @param $widget = objeto a ser inserido no painel
	* @param $col = coluna em pixels.
	* @param $row = linha em pixels
	*/
	public function put($widget,$col,$row){
		//cria uma camada para owidget
		$camada = new TElement('div');
		//define a posição dacamada
		$camada->style="position:absolute; left:{$col}px; top:{$row}px;";
		//adiciona o objeto widget a camada recem criada
		$camada->add($widget);
		//adiciona widget no array de elementos
		parent::add($camada);
	}
}
?>