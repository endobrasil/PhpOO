<?php
function __autoload($classe){
	if(file_exists("../app/ado/{$classe}.class.php"))
	{
		include_once "../app/ado/{$classe}.class.php";
		echo "include_once ../app/ado/{$classe}.class.php<br>\n";
	}
}

$criteria = new TCriteria;
$criteria->add(new TFilter('id', '=', 3));
$sql = new TSqlUpdate;
$sql->setEntity('aluno');
$sql->setRowData('nome', 'Pedro fezes');
$sql->setRowData('rua', 'Dois');
$sql->setRowData('fone', '(86) 9 9912.1366');
$sql->setCriteria($criteria);

echo $sql->getInstrution();

?>