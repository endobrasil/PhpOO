<?php
function __autoload($classe){
	if(file_exists("../app.ado/{$classe}.class.php"))
	{
		include_once "../app.ado/{$classe}.class.php";
		echo "include_once ../app.ado/{$classe}.class.php<br>\n";
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
$sql->setEntity('famosos');
$sql->addColumn('codigo');
$sql->addColumn('nome');
$criteria = new TCriteria;
$criteria->add(new TFilter('codigo', '=', 10));
$sql->setCriteria($criteria);

	$conn=TTransaction::get();

	$result=$conn->Query($sql->getInstruction());
	if($result){
		$row=$result->fetch(PDO::FETCH_ASSOC);
		echo $row['codigo'].' - '.$row['nome']."<br>\n";		
	}

/*	$sql=new TSqlInsert;
	$sql->setEntity('famosos');
	$sql->setRowData('codigo',8);
	$sql->setRowData('nome','Galileu');
	*/


}catch(Exception $e){
	echo $e->getMessage();
	TTransaction::rollback();
}
?>
</body>
</html>