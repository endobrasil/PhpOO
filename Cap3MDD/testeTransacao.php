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
	TTransaction::open('my_curso');
	$sql=new TSqlInsert;
	$sql->setEntity('famosos');
	$sql->setRowData('codigo',8);
	$sql->setRowData('nome','Galileu');
	$conn=TTransaction::get();
	$result=$conn->Query($sql->getInstruction());
}catch(Exception $e){
	echo $e->getMessage();
	TTransaction::rollback();

}
?>
</body>
</html>