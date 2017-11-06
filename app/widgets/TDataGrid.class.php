<?php
/**
* classe DataGrid
* classepara construção de listagens
*/
class TDataGrid extends TTable{
	private $coluns;
	private $actions;
	private $rowcount;

	/**
	* método __construct()
	* instancia uma nova DataGrid
	*/
	public function __construct(){
		parent::__construct();
		$this->class='tDataGrid_table';

		//instancia um objeto TStyle
		//este estilo será utilizado para a tabela da datagrid
		$style1=new TStyle('tDataGrid_table');
		$style1->border_collapse=	'separate';
		$style1->font_family =		'arial,verdana,sans-serif';
		$style1->font_size=			'10pt';
		$style1->border_spacing=	'0pt';

		//instancia um objeto TStyle
		//este estilo será utilizado para o cabeçalho da datagrid
		$style2=new TStyle('tDataGrid_col');
		$style2->font_size=			'10pt';
		$style2->font_weight=		'bold';
		$style2->border_left=		'1px solid white';
		$style2->border_top=		'1px solid white';
		$style2->border_right=		'1px solid gray';
		$style2->border_buttom=		'1px solid gray';
		$style2->padding_top=		'1px';
		$style2->background_color=	'#CCCCCC';

		//instancia um objeto TStyle
		//este estilo é utilizado quando
		//o mouse estiver sobre o cabeçalho da datagrid
		$style3=new TStyle('tDataGrid_col_over');
		$style3->font_size=			'10pt';
		$style3->font_weight=		'bold';
		$style3->border_left=		'1px solid white';
		$style3->border_top=		'2px solid orange';
		$style3->border_right=		'1px solid gray';
		$style3->border_buttom=		'1px solid gray';
		$style3->padding_top=		'0px';
		$style3->cursor=			'pointer';
		$style3->background_color=	'#DCDCDC';

		//exibe os estylos na tela
		$style1->show();
		$style2->show();
		$style3->show();
	}

	/**
	* método addColumn()
	* adiciona uma coluna a listagem
	* @param $object = objeto do tipo TDataGridColumn
	*/
	public function addColumn(TDataGridColumn $object){
		$this->columns[]=$object;
	}

	/**
	* método addAction()
	* adiciona umaação a listagem
	* @param $object = objeto do tipo TDataGridAction
	*/
	public function addAction(TDataGridAction $object){
		$this->actions[]=$object;
	}

	/**
	* método clear()
	* elimina todas linhas dedados daDataGrid
	*/
	function clear(){
		//faz uma cópia do cabeçalho
		$copy=$this->children[0];
		//inicializa o vetor delinhas
		$this->children=array();
		//acrescenta novamente o cabeçalho
		$this->children[]=$copy;
		//zera a contagem de linhas
		$this->rowcount=0;
	}

	/**
	* método createModel()
	* cria a estrutura da Grid, com seu cabeçalho
	*/
	public function createModel(){
		//adiciona uma linha atabela
		$row=parent::addRow();

		//adiciona células para as ações
		if($this->actions){
			foreach ($this->actions as $actions) {
				$celula=$row->addCell('');
				$celula->class='tDataGrid_col';
			}
		}
		//adiciona colélulas para os dados
		if($this->columns){
			//percorre as colunas dalistagem
			foreach ($this->columns as $column) {
				//obtém as propriedades da coluna
				$name=$column->getName();
				$label=$column->getLabel();
				$aling=$column->getAling();
				$width=$column->getWidth();

				//adiciona a célula com a coluna
				$celula=$row->addCell($label);
				$celula->class='tDataGrid_col';
				$celula->aling=$aling;
				$celula->width=$width;
				//verifica se a coluna tem uma ação
				if($column->getAction()){
					$url=$column->getAction();
					$celula->onmouserover	="this.className='tDataGrid_col_over';";
					$celula->onmouserout	="this.className='tDataGrid_col';";
					$celula->onclick 		="document.location='$url'";
				}
			}
		}
	}

	/**
	* método addItem()
	* adiciona um objeto nagrid
	* @param $object = Objeto que contém os dados
	*/
	public function addItem($object){
		//cria um estilo comvariável
		$bgcolor=($this->rowcount%2)==0?'#FFFFFF':'#E0E0E0';
		//Adicionaumalinha na DatAgrid
		$row=parent::addRow();
		$row->bgcolor=$bgcolor;

		//verefica se a listagempossui ações
		if($this->actions){
			//percorre as ações
			foreach ($this->actions as $action) {
				//obtem as propriedades das ações
				$url	=$action->serialize();
				$label	=$action->getLabel();
				$image	=$action->getImage();
				$field	=$action->getField();
				//obtém o campo doobjeto queserá passado adiante
				$key	=$action->getField();

				//cria um link
				$link=new TElement('a');
				$link->href="{$url}&key={$key}";

				//verefica se o link está com a image ou com o texto
				if($image){
					//adiciona a imagem no link
					$image=new TImage("../app/img/$image");
					$link->add($image);
				}else{
					//adicona o rótulo de texto ao link
					$link->add($label);
				}
				//adiciona a célula à linha
				$row->addCell($link);
			}
		}
		if($this->columns){
			//percorre as olunas da DataGrid
			foreach ($this->columns as $column) {
				//obtem as propriedades da coluna
				$name 		=$column->getName();
				$aling 		=$column->getAling();
				$width 		=$column->getWidth();
				$function 	=$column->getTransformer();
				$data 		=$object->$name;
				//verifica se há função para transformar os dados
				if($function){
					//aplica a função sobre os dados
					$data=call_user_func($function,$data);
				}
				//adiciona a célula na linha
				$celula=$row->addCell($data);
				$celula->aling=$aling;
				$celula->width=$width;
			}
		}
		//incrementa o contador de linhas
		$this->rowcount++;
	}
}
?>