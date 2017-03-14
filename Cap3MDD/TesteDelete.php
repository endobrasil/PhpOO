<?php
function __autoload($classe){
	if(file_exists("../app.ado/{$classe}.class.php"))
	{
		include_once "../app.ado/{$classe}.class.php";
		echo "include_once ../app.ado/{$classe}.class.php<br>\n";
	}
}
$criteria = new TCriteria;
$criteria->add(new TFilter('id', '=', 3));

$sql = new TSqlDelete;
$sql->setEntity('aluno');
$sql->setCriteria($criteria);
echo $sql->getInstrution();
?>