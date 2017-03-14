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
	setlocale(LC_NUMERIC, 'POSIX');
	TTransaction::open('my_curso');
	TTransaction::setLogger(new TLoggerHTML('../log/log_03.html'));
	TTransaction::log("Inserindo registro do André Wendel");

	$sql = new TSqlInsert;
	$sql->setEntity('famosos');
	$sql->setRowData('codigo',9);
	$sql->setRowData('nome','André Wendel');
	$conn=TTransaction::get();
	$result=$conn->Query($sql->getInstruction());
	TTransaction::log($sql->getInstruction());

	var_dump($result);

	TTransaction::close();
}catch(Exception $e){
	echo $e->getMessage();
	TTransaction::rollback();

}
?>
</body>
</html>