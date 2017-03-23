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

$form = new TForm('form_email');
$table = new TTable;

$form->add($table);

$nome = new TEntry('nome');
$email = new TEntry('email');
$titulo = new TEntry('titulo');
$mensagem = new TText('mensagem');
//$mensagem = new TEntry('mensagem');

$row = $table->addRow();
$row->addCell(new TLabel('Email: '));
$row->addCell(new TLabel($email));

$row = $table->addRow();
$row->addCell(new TLabel('Título: '));
$row->addCell(new TLabel($titulo));

$row = $table->addRow();
$row->addCell(new TLabel('Mensagem: '));
$row->addCell(new TLabel($mensagem));

$action1 = new TButton('action1');
$action2 = new TButton('action2');

$action1->setAction(new TAction('onSend'),'Enviar');
$action2->setAction(new TAction('onView'),'Visualizar');

$row = $table->addRow();
$row->addCell($action1);
$row->addCell($action2);

$form->setFields(array($nome,$email,$titulo,$mensagem,$action1,$action2));

function onView(){
	global $form;
	$data = $form->getData();
	$form->setData($data);
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
	global $form;
	$data=$form->getData();

	$form->setData($data);
	$form->setEditable(FALSE);
	new TMessage('info','Enviando dados...');
}

$page=new TPage;
$page->add($form);
$page->show();
?>