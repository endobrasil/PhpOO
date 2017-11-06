<?php
function __autoload($classe){
	if(file_exists("../app/ado/{$classe}.class.php"))
	{
		include_once "../app/ado/{$classe}.class.php";
		echo "include_once ../app/ado/{$classe}.class.php<br>\n";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>teste TTransaction</title>
</head>
<body>
<?php

try{
TTransaction::open('my_livro');
$sql = new TSqlSelect;
$sql->setEntity('famoso');
$sql->addColumn('codigo');
$sql->addColumn('nome');
$criteria = new TCriteria;
$criteria->add(new TFilter('codigo', '=', 19));
$sql->setCriteria($criteria);


$conn=TTransaction::get();

$result=$conn->Query($sql->getInstruction());
	if($result){
		$row=$result->fetch(PDO::FETCH_ASSOC);
		echo $row['codigo'].' - '.$row['nome']."<br>\n";		
	}

}catch(Exception $e){
	echo $e->getMessage();
	TTransaction::rollback();
}
?>
</body>
</html>