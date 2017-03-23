<?php
function __autoload($classe){
	if(file_exists("../app.widgets/{$classe}.class.php"))
	{
		include_once "../app.widgets/{$classe}.class.php";
		echo "include_once ../app.widgets/{$classe}.class.php<br>\n";
	}else{
		echo "### NÃO include_once ../app.widgets/{$classe}.class.php<br>\n";
	}
}

class EmailForm extends TPage{
	private $form;
	
	function __construct(){
		parent::__construct();

		$this->form=new TForm('form_email');
		$table=new TTable;

		$this->form->add($table);

		$nome = new TEntry('nome');
		$email = new TEntry('email');
		$titulo = new TEntry('titulo');
		$mensagem = new TText('mensagem');

		$row=$table->addRow();
		$row->addCell(new TLabel('Nome:'));
		$row->addCell($nome);

		$row=$table->addRow();
		$row->addCell(new TLabel('Email:'));
		$row->addCell($email);

		$row=$table->addRow();
		$row->addCell(new TLabel('Título:'));
		$row->addCell($titulo);

		$row=$table->addRow();
		$row->addCell(new TLabel('Mensagem'));
		$row->addCell($mensagem);

		$action1 = new TButton('action1');
		$action2 = new TButton('action2');

		$action1->setAction(new TAction(array($this,'onSend')),'Enviar');
		$action2->setAction(new TAction(array($this,'onView')),'Visualizar');

		$row=$table->addRow();
		$row->addCell($action1);
		$row->addCell($action2);

		$this->form->setFields(array($nome,$email,$titulo,$mensagem,$action1,$action2));

		parent::add($this->form);
	}

	function onView(){
		$data=$this->form->getData();
		$this->form->setData($data);

		$window=new TWindow('Dados do form');
		$window->setPosition(300,70);
		$window->setSize(300,150);

		$output="Nome: {$data->nome}\n";
		$output.="Email: {$data->email}\n";
		$output.="Título: {$data->titulo}\n";
		$output.="Mensagem: {$data->mensagem}";

		$text=new TText('texto',300);
		$text->setSize(290,120);
		$text->setValue($output);

		$window->add($text);
		$window->show();

	}

	function onSend(){
		$data=$this->form->getData();
		$this->form->getData();

		$this->form->setData($data);
		$this->form->setEditable(FALSE);
		new TMessage('info','Enviando dados...');
	}
}

$page=new EmailForm;
$page->show();

?>
