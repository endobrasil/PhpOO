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

$form = new TForm('form_pessoas');

$table = new TTable;
$table->border=1;
$table->gbcolor='#f2f2f2';

$form->add($table);

$titulo = new TLabel('exemplo de formulário');
$titulo->setFontFace('Arial');
$titulo->setFontColor('red');
$titulo->setFontSize(18);


$row=$table->addRow();
$titulo=$row->addCell($titulo);
$titulo->colspan=2;

$table1 = new TTable;
$table2 = new TTable;

$codigo = new TEntry('codigo');
$nome = new TEntry('nome');
$endereco = new TEntry('endereco');
$telefone = new TEntry('telefone');
$cidade = new TCombo('cidade');
$itens = array();
$itens['1']='Porto Alegre';
$itens['2']='Lajeado';
$itens['3']='Fortaleza';
$cidade->addItens($itens);

$codigo->setSize(70);
$nome->setSize(140);
$endereco->setSize(140);
$telefone->setSize(140);
$cidade->setSize(140);

$lblCodigo=new TLabel('Código');
$lblNome=new TLabel('Nome');
$lblCidade=new TLabel('Cidade');
$lblEndereco=new TLabel('Endereço');
$lblTelefone=new TLabel('Telefone');

$row=$table1->addRow();
$row->addCell($lblCodigo);
$row->addCell($codigo);

$row=$table1->addRow();
$row->addCell($lblNome);
$row->addCell($nome);

$row=$table1->addRow();
$row->addCell($lblCidade);
$row->addCell($cidade);

$row=$table2->addRow();
$row->addCell($lblEndereco);
$row->addCell($endereco);

$row=$table2->addRow();
$row->addCell($lblTelefone);
$row->addCell($telefone);

$row=$table->addRow();
$row->addCell($table1);
$row->addCell($table2);

$form->show();
?>