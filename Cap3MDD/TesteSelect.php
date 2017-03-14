<?php
function __autoload($classe){
	if(file_exists("../app.ado/{$classe}.class.php"))
	{
		include_once "../app.ado/{$classe}.class.php";
		echo "include_once ../app.ado/{$classe}.class.php<br>\n";
	}
}
$criteria = new TCriteria;
$criteria->add(new TFilter('nome', 'like', 'maria%'));
$criteria->add(new TFilter('cidade', 'like', 'porto%'));

$criteria->setProperty('offset', 0);
$criteria->setProperty('limit', 10);
$criteria->setProperty('order', 'nome');

$sql = new TSqlSelect;
$sql->setEntity('aluno');
$sql->addColumn('nome');
$sql->addColumn('fone');
$sql->setCriteria($criteria);
echo $sql->getInstrution();
echo "<br><br><br>\n";

$criteria1=new TCriteria;
$criteria1->add(new TFilter('sexo', '=', 'F'));
$criteria1->add(new TFilter('serie', '=', 3));

$criteria2=new TCriteria;
$criteria2->add(new TFilter('sexo', '=', 'M'));
$criteria2->add(new TFilter('serie', '=', 4));

$criteria = new TCriteria;
$criteria->add($criteria1,TExpression::OR_OPERADOR);
$criteria->add($criteria2,TExpression::OR_OPERADOR);
$criteria->setProperty('order','nome');

$sql=new TSqlSelect;
$sql = new TSqlSelect;
$sql->setEntity('aluno');
$sql->addColumn('*');
$sql->setCriteria($criteria);
echo $sql->getInstrution();
echo "<br><br><br>\n";



?>