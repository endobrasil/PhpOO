<?php
function __autoload($classe){
	$pastas = array('app/widgets', 'app/ado');
	foreach ($pastas as $pasta) {
		if(file_exists("../{$pasta}/{$classe}.class.php")){
			include_once "../{$pasta}/{$classe}.class.php";
			echo "include_once ../{$pasta}/{$classe}.class.php<br>\n";
		}	
	}
}

$datagrid 	= new TDataGrid;
$codigo		=new TDataGridColumn('codigo','Código','left',50);
$nome		=new TDataGridColumn('nome','Nome','left',180);
$endereco		=new TDataGridColumn('endereco','Endereço','left',140);
$telefone		=new TDataGridColumn('fone','Fone','center',100);

$datagrid->addColumn($codigo);
$datagrid->addColumn($nome);
$datagrid->addColumn($endereco);
$datagrid->addColumn($telefone);

$action1 = new TDataGridAction('onDelete');
$action1->setLabel('Deletar');
$action1->setImage('ico_delete.png');
$action1->setField('codigo');

$action2=new TDataGridAction('onView');
$action2->setLabel('Visualizar');
$action2->setImage('ico_view.png');
$action2->setField('nome');

$datagrid->addAction($action1);
$datagrid->addAction($action2);

$datagrid->createModel();

#adicionadoosdados dogrd....

$item=new StdClass;
$item->codigo	='1';
$item->nome 	='Meu nominho lindinho';
$item->endereco	='Rua das Tabepa';
$item->fone	 	='1111-1111';
$datagrid->addItem($item);

$item=new StdClass;
$item->codigo	='2';
$item->nome 	='Meu nominho feiozinho';
$item->endereco	='Rua Dois';
$item->fone	 	='1111-2222';
$datagrid->addItem($item);

$item=new StdClass;
$item->codigo	='3';
$item->nome 	='Meu Nada';
$item->endereco	='Rua tr~ea';
$item->fone	 	='1111-3333';
$datagrid->addItem($item);

$item=new StdClass;
$item->codigo	='4';
$item->nome 	='Meu Sohho dourado';
$item->endereco	='Rua S/N';
$item->fone	 	='1111-4444';
$datagrid->addItem($item);

$page = new TPage;
$page->add($datagrid);
$page->show();

function onDelete($param){
	$key=$param['key'];
	new TMessage('error', "Deu não pra apagar $key ;^)");
}

function onView($param){
	$key=$param['key'];
	new TMessage('info', "O nome oh: $key ;^*");
}
?>