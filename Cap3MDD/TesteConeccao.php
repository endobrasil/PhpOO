<?php
function __autoload($classe){
	if(file_exists("../app.ado/{$classe}.class.php"))
	{
		include_once "../app.ado/{$classe}.class.php";
		echo "include_once ../app.ado/{$classe}.class.php<br>\n";
	}
}
$sql = new TSqlSelect;
$sql->setEntity('famosos');
$sql->addColumn('codigo');
$sql->addColumn('nome');

$criteria = new TCriteria;
$criteria->add(new TFilter('codigo', '=', 10));
$sql->setCriteria($criteria);
echo $sql->getInstrution()."<hr>";
try
{
	$conn=TConnection::open('my_livro');
	$result=$conn->query($sql->getInstrution());
	
	if($result)
	{
		$row=$result->fetch(PDO::FETCH_ASSOC);
		echo $row['codigo'].' - '.$row['nome']."<br>\n";		
	}
	$conn=null;
}
catch(PDOException $e)
{
	print "Erro!:".$e->getMessage()."<br>\n";
	die();
}

try
{
	$conn=TConnection::open('my_livro');
	$result=$conn->query($sql->getInstrution());
	
	if($result)
	{
		$row=$result->fetch(PDO::FETCH_ASSOC);
		echo $row['codigo'].' - '.$row['nome']."<br>\n";		
	}
	$conn=null;
}
catch(PDOException $e)
{
	print "Erro!:".$e->getMessage()."<br>\n";
	die();
}
?>