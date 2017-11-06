<?php
function __autoload($classe){
	$pastas = array('app/widgets', 'app/ado');
	foreach ($pastas as $pasta) {
		if(file_exists("../{$pasta}/{$classe}.class.php")){
			include_once "../{$pasta}/{$classe}.class.php";
		}	
	}
}

class Pessoa extends TRecord{
	const TABLENAME='pessoa';
}

class PessoaList extends TPage{
	private $datagrid;
	private $loaded;

	public function __construct(){
		parent::__construct();

		$this->datagrid = new TDataGrid;

		$codigo			=new TDataGridColumn('id','Código','left',50);
		$nome			=new TDataGridColumn('nome','Nome','left',180);
		$endereco		=new TDataGridColumn('endereco','Endereço','left',140);
		$qualificacoes	=new TDataGridColumn('qualifica','Fone','left',200);

		$this->datagrid->addColumn($codigo);
		$this->datagrid->addColumn($nome);
		$this->datagrid->addColumn($endereco);
		$this->datagrid->addColumn($qualificacoes);

		$action1 = new TDataGridAction(array($this, 'onDelete'));
		$action1->setLabel('Deletar');
		$action1->setImage('ico_delete.png');
		$action1->setField('id');

		$action2=new TDataGridAction(array($this,'onView'));
		$action2->setLabel('Visualizar');
		$action2->setImage('ico_view.png');
		$action2->setField('id');

		$this->datagrid->addAction($action1);
		$this->datagrid->addAction($action2);


		$this->datagrid->createModel();

		parent::add($this->datagrid);
	}

	function onReload(){
		TTransaction::open('my_livro');
		$repository=new TRepository('Pessoa');
		$criteria=new TCriteria;
		$criteria->setProperty('order','id');
	
		$pessoas=$repository->load($criteria);
	
		$this->datagrid->clear();

		if($pessoas){
			foreach ($pessoas as $pessoa) {
			$this->datagrid->addItem($pessoa);
			}
		}
		TTransaction::close();
		$this->loaded=true;
	}

	function onDelete($param){
		$key=$param['key'];
		$action1=new TAction(array($this,'delete'));
		$action2=new TAction(array($this,'teste'));
		$action1->setParameter('key',$key);
		$action2->setParameter('key',$key);
		new TQuestion('Deseja realmenteexcluiroregistro?',$action1,$action2);
	}

	function delete($param){
		var_dump($param);
		$key=$param['key'];
		TTransaction::open('my_livro');
		$pessoa = new Pessoa($key);
		$pessoa->delete();
		TTransaction::close();
		new TMessage('info', "Registro excluido com sucesso");
		$this->onReload();
	}

	function onView($param){
		$key=$param['key'];
		TTransaction::open('my_livro');
		$pessoa = new Pessoa($key);
		TTransaction::close();
		$mensagem 	="O nome: $pessoa->nome<br>";
		$mensagem	.="Endereço: $pessoa->qualifica<br>";
		new TMessage('info', $mensagem);
		$this->onReload();
	}

	function show(){
		if(!$this->loaded){
			$this->onReload();
		}
		parent::show();
	}
}
	
$page = new PessoaList;
$page->show();

?>