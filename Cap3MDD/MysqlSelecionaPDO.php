<?php
function __autoload($classe){
	if(file_exists("../app.ado/{$classe}.class.php"))
	{
		include_once "../app.ado/{$classe}.class.php";
		echo "include_once ../app.ado/{$classe}.class.php<br>\n";
	}
}

	$conn = new PDO('mysql:host=localhost;port=3306;dbname=livros','root','Ab123456');

	
	$sql = new TSqlSelect;
	$sql->setEntity('famosos');
	$sql->addColumn('codigo');
	$sql->addColumn('nome');
	
	$criteria = new TCriteria;
	$criteria->add(new TFilter('codigo', '=', 5));
	$sql->setCriteria($criteria);
	echo $sql->getInstrution()."<hr>";
	
$result=$conn->query($sql->getInstrution());
if($result)
{
	$row=$result->fetch(PDO::FETCH_ASSOC);
	echo $row['codigo'].' - '.$row['nome']."<br>\n";
}else 
{
	echo "cunhou";
}

$conn=null;
	
?>