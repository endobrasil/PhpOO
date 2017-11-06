<?php
/**
* classe TWindow
* TWindow é um container que exibeseu conteúdo em uma camada simulando uma janela
*/
class TWindow extends TElement{
	private $x;		//coluna
	private $y;		//linha
	private $width;	//largura
	private $height; //Altura
	private $title;	//Título da janela
	private $content; //Conteúdo da janela
	static private $counter; //contador

	/**
	* método construtor
	* incrementa o contador de janelas
	*/
	public function __construct($title){
		//incrementa o contador de janelas
		//para exibir cada uma comum ID diferente
		self::$counter++;
		$this->title=$title;
	}

	/**
	* método setPosition()
	* define a coluna elinha (x,y) que a janela será exibida na tela
	* @param $x = coluna (em pixels)
	* @param $y = linha (em pixels)
	*/
	public function setPosition($x, $y){
		//atribui os pontos cardinais do canto superior esquerdo da janela
		$this->x=$x;
		$this->y=$y;
	}

	/**
	* método setSize()
	* define a altura e largura da janela em tela
	* @param $width = largura em pixels
	* @param $height = altura em pixels
	*/
	public function setSize($width,$height){
		//atribui as dimensões
		$this->width=$width;
		$this->height=$height;
	}

	/**
	* método add()
	* adiciona um conteúdo a janela
	* @param $content = conteúdo a ser adicionado
	*/
	public function add($content){
		$this->content=$content;
	}

	/**
	* método show()
	* exibe a janela na tela
	*/
	public function show(){
		$window_id = 'TWindow'.self::$counter;
		//instancia objeto TStyle para definir as características
		//de posicionamento edimensão da camada criada
		$style = new TStyle($window_id);
		$style->position='absolute';
		$style->left=$this->x;
		$style->top=$this->y;
		$style->width=$this->width;
		$style->height=$this->height;
		$style->background='#7856a1';
		$style->border='1px solid #000000';
		$style->z_index='10000';

		//exibe o estilo natela
		$style->show();

		//Cria a camada div para a camada que representará a janela
		$painel = new TElement('div');
		$painel->id=$window_id;
		$painel->class=$window_id;

		//instancia objeto get_html_translation_table
		$table = new TTable;
		$table->width='100%';
		$table->height='100%';
		$table->style='border-collapse:collapse';

		//adiciona uma linha para o título
		$row1=$table->addRow();
		$row1->bgcolor='#606060';
		$row1->height='20px';

		//adiciona uma célula para o título
		$titulo = $row1->addCell("<font face=Arial size=2 color=white><b>{$this->title}</b></font>");
		$titulo->width='100%';

		//cria um link com ação para esconder o div
		$link=new TElement('a');
		$img= new TImage('../app.img/burra.png');
		$link->add($img);
		$link->width="60px";
		$link->height="90px";
		$link->onclick="document.getElementById('$window_id').style.display='none'";

		//adiciona uma célula comolink de fechar
		$cell=$row1->addCell($link);

		//cria uma linha para conteúdo
		$row2=$table->addRow();
		$row2->valign='top';

		//adiciona conteúdo ocupando duas colunas(colspan)
		$cell=$row2->addCell($this->content);
		$cell->colspan=2;

		//adiciona a tabela ao painel
		$painel->add($table);

		//exibe paine
		$painel->show();
	}
}
?>