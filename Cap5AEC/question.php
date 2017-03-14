<?php
function __autoload($classe){
	if(file_exists("../app.widgets/{$classe}.class.php"))
	{
		include_once "../app.widgets/{$classe}.class.php";
		echo "include_once ../app.widgets/{$classe}.class.php<br>\n";
	}
}

class Pagina extends TPage{
	private $panel;
	function __construct(){
		parent::__construct();

		$this->panel=new TPainel(400,200);
		$this->panel->put(new TParagraph('Responda a questão'),10,10);

		$actionYes = new TAction(array($this, 'onYes'));
		$actionNo = new TAction(array($this, 'onNo'));

		new TQuestion('Deseja realmente excluir o registro?', $actionYes, $actionNo);

		parent::add($this->panel);
	}

	function onYes(){
		$this->panel->put(new TParagraph("vc escolheu sim"), 10,40);
	}

	function onNo(){
		$this->panel->put(new TParagraph("vc escolheu não"), 10,40);
	}
}

$pagina = new Pagina;
$pagina->show();
?>