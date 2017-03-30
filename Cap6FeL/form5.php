<?php
function __autoload($classe){
	$pastas = array('app.widgets', 'app.ado');
	foreach ($pastas as $pasta) {
		if(file_exists("../{$pasta}/{$classe}.class.php")){
			include_once "../{$pasta}/{$classe}.class.php";
			echo "include_once ../{$pasta}/{$classe}.class.php<br>\n";
		}	
	}
}

class Pessoa extends TRecord{
	const TABLENAME = 'pessoa';
}

class PessoasList extends TPage{
	private $loaded;
	private $datagrid;

	public function __construct(){
		parent::__construct();
		$this->datagrid = new TDataGrid;

		$codigo = new TDataGridColumn('id','codigo','left',50);
		$nome=new TDataGridColumn('nome','Nome','left',180);
		$endereco = new TDataGridColumn('endereco','Endereço','left',140);
		$qualifica=new TDataGridColumn('qualifica',"Qualificações",'left',200);
		
		$action1 = new TAction(array($this,'onReload'));
		$action1->setParameter('order','id');
		
		$action2 = new TAction(array($this,'onReload'));
		$action1->setParameter('order','nome');

		$codigo->setAction($action1);
		$nome->setAction($action2)

		$this->datagrid->addColumn($codigo);
		$this->datagrid->addColumn($nome);
		$this->datagrid->addColumn($endereco);
		$this->datagrid->addColumn($qualifica);

		$this->datagrid->createModel();

		parent::add($this->datagrid);
	}

	function onReload($param=NULL){
		$order=$param['order'];

		TTransaction::open('my_livro');

		$repository=new TRepository('Pessoa');
		$criteria = new TCriteria;
		$criteria->setProperty('order',$order);
		$pessoas =$repository->load($criteria);
		
		if($pessoas){
			$this->datagrid->clear();
			foreach ($pessoas as $pessoa) {
				$this->datagrid->addItem($pessoa);
			}
		}
		TTransaction::close();
		$this->loaded=true;
	}	
	
	function show(){
		if(!$this->loaded){
			$this->onReload()
		}
		parent::show();
	}
}
$page = new PessoasList;
$page->show();
?>