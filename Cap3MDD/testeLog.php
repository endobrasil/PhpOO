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
	setlocale(LC_NUMERIC, 'POSIX');
	TTransaction::open('my_livro');
	TTransaction::setLogger(new TLoggerHTML('../log/log_03.html'));
	TTransaction::log("Inserindo registro do André Wendel");

	$sql = new TSqlInsert;
	$sql->setEntity('famoso');
	$sql->setRowData('codigo',10);
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