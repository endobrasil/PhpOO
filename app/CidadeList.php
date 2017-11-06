<?php
/**
* 
*/
class CidadeList extends TPage{
	private $form;
	private $datagrid;
	private $loaded;

	function __construct(){
		parent::__construct();

		$this->form=new TForm('form_cidades');

		$table=new TTable;

		$this->form->add($table);

		$codigo		=new TEntry('id');
		$descricao	=new TEntry('descricao');
		$estado		=new TCombo('estado');

		$itens=array();
		$itens['RS']='Rio Grande do Sul';
		$itens['SP']='São Paulo';
		$itens['MG']='Minhas Gerais';
		$itens['PR']='Paraná';

		$estado->addItens($itens);

		$codigo->setSize(40);
		$estado->setSize(200);

		$row=$table->addRow();
		$row->addCell(new TLabel('Código:'));
		$row->addCell($codigo);

		$row=$table->addRow();
		$row->addCell(new TLabel('Descrição:'));
		$row->addCell($descricao);

		$row=$table->addRow();
		$row->addCell(new TLabel('Estado:'));
		$row->addCell($estado);

		$btnSalvar=new TButton('save');
		$btnSalvar->setAction(new TAction(array($this,'onSave')),'Salvar');

		$row=$table->addRow();
		$row->addCell($btnSalvar);

		$this->form->setFilds(array($codigo,$descricao,$estado,$btnSalvar));

		$this->datagrid=new TDataGrid;
		$codigo		=new TDataGridColumn('id','Código','right',50);
		$descricao	=new TDataGridColumn('descricao','Descrição','left',200);
		$estado		=new TDataGridColumn('estado','Estado','left',40);

		$this->datagrid->addColumn($codigo);
		$this->datagrid->addColumn($descricao);
		$this->datagrid->addColumn($estado);

		$action1=new TDataGridAction(array($this,'onEdit'));
		$action1->setLabel('Editar');
		$action1->setImage('ico_edit.png');
		$action1->setField('id');

		$action2=new TDataGridAction(array($this,'onDelete'));
		$action2->setLabel('Deletar');
		$action2->setImage('ico_delete.png');
		$action2->setField('id');

		$this->datagrid->addAction($action1);
		$this->datagrid->addAction($action2);

		$this->datagrid->createModel();

		$table=new TTable;
		$row=$table->addRow();
		$row->addCell($this->form);
		$row=$table->addRow();
		$row->addCell($this->datagrid);
		parent::add($table);
	}

	function onReload(){
		TTransaction::open('my_livro');	
		$repository=new TRepository('Cidade');

		$criteria =new TCriteria;
		$criteria->setProperty('order','id');
		$cidades=$repository->load($criteria);
		$this->datagrid->clear();
		if($cidades){
			foreach ($cidades as $cidade) {
				$this->datagrid->addItem($cidade);
			}
		}

		TTransaction::close();
		$this->loaded=true;
	}

	function onSave(){
		TTransaction::open('my_livro');	
		
		$cidade=$this->form->getData('Cidade');
		$cidade->store();
		
		TTransaction::close();

		new TMessage('info','Dadosarmazenadoscom sucesso');
		$this->onReload();
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
		$key=$param['key'];
		
		TTransaction::open('my_livro');
		
		$cidade = new Cidade($key);
		$cidade->delete();
		
		TTransaction::close();

		$this->onReload();
		
		new TMessage('info', "Registro excluido com sucesso");		
	}

	function onEdit($param){
		$key=$param['key'];

		TTransaction::open('my_livro');

		$cidade = new Cidade($key);

		$this->form->setData($cidade);

		TTransaction::close();
		$this->onReload();
	}

	function show(){
		if(!$this->loaded){
			$this->onReload();
		}
		parent::show();
	}
}
?>