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

$painel = new TPanel(400,200);

$form->add($painel);

$titulo = new TLabel('exemplo de formulário');
$titulo->setFontFace('Arial');
$titulo->setFontColor('red');
$titulo->setFontSize(18);

$painel->put($titulo, 120, 4);

$imagem = new TImage9('../app.img/lora.png');
$painel->put($imagem,320,120);


$codigo = new TEntry('codigo');
$nome = new TEntry('nome');
$endereco = new TEntry('endereco');
$telefone = new TEntry('telefone');
//$cidade = new TCombo('cidade');
$itens = array();
$itens['1']='Porto Alegre';
$itens['2']='Lajeado';
$itens['3']='Fortaleza';
//$cidade->addItems($itens);

$codigo->setSize(70);
$nome->setSize(140);
$endereco->setSize(140);
$telefone->setSize(140);
//$cidade->setSize(140);

$lblCodigo=new TLabel('Código');
$lblNome=new TLabel('Nome');
//$lblCidade=new TLabel('Cidade');
$lblEndereco=new TLabel('Endereço');
$lblTelefone=new TLabel('Telefone');

$painel->put($lblCodigo,10,40);
$painel->put($codigo,10,60);
$painel->put($lblNome,10,90);
$painel->put($nome,10,120);
//$painel->put($lblCidade,10,140);
//$painel->put($cidade,10,160);
$painel->put($lblEndereco,200,40);
$painel->put($endereco,200,60);
$painel->put($lblTelefone,200,90);
$painel->put($telefone,200,120);


$form->show();
?>