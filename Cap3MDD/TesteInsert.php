<?php
function __autoload($classe){
	if(file_exists("../app/ado/{$classe}.class.php"))
	{
		include_once "../app/ado/{$classe}.class.php";
		echo "include_once ../app/ado/{$classe}.class.php<br>\n";
	}
}
setlocale(LC_NUMERIC, 'POSIX');

$sql = new TSqlInsert;
$sql->setEntity('aluno');
$sql->setRowData('id', 3);
$sql->setRowData('nome', 'pedro bosta');
$sql->setRowData('fone', '(85) - 9 8867.5574');
$sql->setRowData('nascimento', '1985-04-12');
$sql->setRowData('sexo', 'M');
$sql->setRowData('serie', '4');
$sql->setRowData('mensalidade', 284.40);
echo $sql->getInstruction();
?>