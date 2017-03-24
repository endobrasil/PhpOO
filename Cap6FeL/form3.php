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

$form = new TForm('form_pessoas');

$table = new TTable;
$table->bgcolor='#FAFAFA';
$table->style='border:2px solid grey';
$table->width=400;

$form->add($table);

$codigo = new TEntry('id');
$nome = new TEntry('nome');
$endereco = new TEntry('endereco');
$datanasc = new TEntry('datanasc');

$sexo = new TRadioGroup('sexo');
$linguas = new TCheckGroup('linguas');
$qualifica = new TText('qualifica');

$codigo->setSize(100);
$codigo->setEditable(FALSE);

$itens=array();
$itens['M']='Masculino';
$itens['F']='Feminino';

$datanasc->setSize(100);

$sexo->addItens($itens);
$sexo->setValue('M');
$sexo->setLayout('horizontal');

$itens=array();
$itens['E']='Inglês';
$itens['S']='Espanhol';
$itens['I']='Italiano';
$itens['F']='Francês';
$linguas->addItens($itens);
$linguas->setValue(array('E','I'));

$qualifica->setValue('<digite suas qualificações aqui>');
$qualifica->setSize(240,120);

$row=$table->addRow();
$row->addCell(new TLabel('Código: '));
$row->addCell($codigo);

$row=$table->addRow();
$row->addCell(new TLabel('Nome: '));
$row->addCell($nome);

$row=$table->addRow();
$row->addCell(new TLabel('Endereço: '));
$row->addCell($endereco);

$row=$table->addRow();
$row->addCell(new TLabel('Data de Nascimento: '));
$row->addCell($datanasc);

$row=$table->addRow();
$row->addCell(new TLabel('Sexo: '));
$row->addCell($sexo);

$row=$table->addRow();
$row->addCell(new TLabel('Línguas: '));
$row->addCell($linguas);

$row=$table->addRow();
$row->addCell(new TLabel('Qualificações: '));
$row->addCell($qualifica);

$submit = new TButton('action1');
$submit->setAction(new TAction('onSave'),'Salvar');

$row=$table->addRow();
$row->addCell($submit);

$form->setFields(array($codigo,$nome,$endereco,$datanasc,$sexo,$linguas,$qualifica,$submit));

$page = new TPage;
$page->add($form);

$page->show();

function onSave(){
	global $form;
	$pessoa = $form->getData('Pessoa');
	try{
		TTransaction::open('my_livro');

		$pessoa->linguas=implode(' ', $pessoa->linguas);
		$pessoa->datanasc= conv_data_to_us($pessoa->datanasc);
		$pessoa->store();
		TTransaction::close();
		new TMessage('info', 'Dados armazenados com sucesso');
	}catch(Exception $e){
		new TMessage('erro','<b>Erro</b>'.$e->getMessage());
		TTransaction::rollback();
	}
}

function onEdit($param){
	global $form;
	try{
		TTransaction::open('my_livro');
		$pessoa = new Pessoa($param['id']);
		$pessoa->linguas=explode('', $pessoa->linguas);
		$pessoa->datanasc= conv_data_to_br($pessoa->datanasc);
		$form->setData($pessoa);
		TTransaction::close();
	}catch(Exception $e){
		new TMessage('erro','<b>Erro</b>'.$e->getMessage());
		TTransaction::rollback();
	}
}

function conv_data_to_us($data){
	$dia=substr($data,0,2);
	$mes=substr($data,3,2);
	$ano=substr($data,6,4);

	return "{$ano}-{$mes}-{$dia}";
}

function conv_data_to_br($data){
	$dia=substr($data,8,4);
	$mes=substr($data,5,2);
	$ano=substr($data,0,4);

	return "{$dia}/{$mes}/{$ano}";
}

?>