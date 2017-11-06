<?php
function __autoload($classe){
	if(file_exists("../app/ado/{$classe}.class.php"))
	{
		include_once "../app/ado/{$classe}.class.php";
		echo "include_once ../app/ado/{$classe}.class.php<br>\n";
	}
}

class Aluno extends TRecord{
	const TABLENAME = 'Aluno';
}

class Curso extends TRecord{
	const TABLENAME = 'Curso';
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>teste Delete</title>
</head>
<body>
<?php
try{
	TTransaction::open('my_curso');
	TTransaction::setLogger(new TLoggerHTML('../log/log_cap4-05.html'));

	TTransaction::log("** deletando da primeira forma **");
	echo "<h1>** Obtendo aluno 1 **</h1>\n";

	$daline = new Aluno(1);
	if($daline){
		echo "Deletando o aluno {$daline->nome}<br>\n";
		$daline->delete();
	}

	TTransaction::log("** Deletando da segunda forma **");
	echo "Deletando o aluno de id 2<br>\n";
	$record = new Aluno;
	$record->delete(2);

	TTransaction::close();
}catch(Exception $e){
	echo '<b>Erro</b>'.$e->getMessage();
	TTransaction::rollback();
}
?>

</body>
</html>
