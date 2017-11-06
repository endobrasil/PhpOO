<?php
function __autoload($classe){
	$pastas = array('app/widgets', 'app/ado');
	foreach ($pastas as $pasta) {
		if(file_exists("../{$pasta}/{$classe}.class.php")){
			include_once "../{$pasta}/{$classe}.class.php";
		}	
	}
}

function covDataToBr($data){
	$ano = substr($data, 0,4);
	$mes = substr($data, 5,2);
	$dia = substr($data, 8,4);
	return "{$dia}/{$mes}/{$ano}";
}

function getSexo($sexo){
	switch ($sexo) {
		case 'M':
			return 'Masculino';
			break;
		case 'F':
			return 'Feminino';
			break;
		default:
			return $sexo.'não é um falor válido';
	}
}

class Pessoa extends TRecord{
	const TABLENAME='pessoa';
}

$datagrid=new TDataGrid;
$codigo		=new TDataGridColumn('id','Código','right',50);
$nome		=new TDataGridColumn('nome','Nome','left',160);
$endereco	=new TDataGridColumn('endereco','Endereço','left',140);
$datanasc	=new TDataGridColumn('datanasc','Data nasc','left',100);
$sexo 		=new TDataGridColumn('sexo','Sexo','center',100);

$nome->setTransformer('strtoupper');
$datanasc->setTransformer('covDataToBr');
$sexo->setTransformer('getSexo');

$datagrid->addColumn($codigo);
$datagrid->addColumn($nome);
$datagrid->addColumn($endereco);
$datagrid->addColumn($datanasc);
$datagrid->addColumn($sexo);

$datagrid->createModel();

try{
	TTransaction::open('my_livro');

	$repository=new TRepository('Pessoa');
	$criteria=new TCriteria;
	$criteria->setProperty('order','id');
	$pessoas=$repository->load($criteria);
	foreach ($pessoas as $pessoa) {
		$datagrid->addItem($pessoa);
	}
	TTransaction::close();
}catch(Exception $e){
	new TMessage('error ', $e->getMessage());
	TTransaction::rollback();
}

$page=new TPage;
$page->add($datagrid);
$page->show();

?>