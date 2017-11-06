<?php
/**
* 
*/
class FabricanteList extends TPage{
	private $form;
	private $datagrid;
	private $loaded;

	function __construct(){
		parent::__construct();

		$this->form=new TForm('form_fabricante');

		$table=new TTable;

		$this->form->add($table);

		$codigo		=new TEntry('id');
		$nome	=new TEntry('nome');
		$site		=new TCombo('site');

		$row=$table->addRow();
		$row->addCell(new TLabel('Código:'));
		$row->addCell($codigo);

		$row=$table->addRow();
		$row->addCell(new TLabel('Nome:'));
		$row->addCell($nome);

		$row=$table->addRow();
		$row->addCell(new TLabel('Site:'));
		$row->addCell($site);

		$btnSalvar=new TButton('save');
		$btnSalvar->setAction(new TAction(array($this,'onSave')),'Salvar');

		$row=$table->addRow();
		$row->addCell($btnSalvar);

		$this->form->setFilds(array($codigo,$nome,$site,$btnSalvar));

		$this->datagrid=new TDataGrid;
		$codigo		=new TDataGridColumn('id','Código','right',50);
		$nome		=new TDataGridColumn('nome','Nome','left',180);
		$site		=new TDataGridColumn('site','Site','left',180);

		$this->datagrid->addColumn($codigo);
		$this->datagrid->addColumn($nome);
		$this->datagrid->addColumn($site);

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
		$repository=new TRepository('Fabricante');

		$criteria =new TCriteria;
		$criteria->setProperty('order','id');
		$fabricantes=$repository->load($criteria);
		$this->datagrid->clear();
		if($fabricantes){
			foreach ($fabricantes as $fabricante) {
				$this->datagrid->addItem($fabricante);
			}
		}

		TTransaction::close();
		$this->loaded=true;
	}

	function onSave(){
		TTransaction::open('my_livro');	
		
		$fabricante=$this->form->getData('Fabricante');
		$fabricante->store();
		
		TTransaction::close();

		new TMessage('info','Dados armazenados com sucesso');
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
		
		$fabricante = new Fabricante($key);
		$fabricante->delete();
		
		TTransaction::close();

		$this->onReload();
		
		new TMessage('info', "Registro excluido com sucesso");		
	}

	function onEdit($param){
		$key=$param['key'];

		TTransaction::open('my_livro');

		$fabricante = new Fabricante($key);

		$this->form->setData($fabricante);

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