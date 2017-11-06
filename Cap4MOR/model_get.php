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
	<title>teste inserir</title>
</head>
<body>
<?php
//insere novos objetos no banco de dados.
try{
	TTransaction::open('my_curso');
	TTransaction::setLogger(new TLoggerHTML('../log/log_cap4-02.html'));

	TTransaction::log("** Obtendo alunos **");
	echo "<h1>** Obtendo alunos **</h1>\n";

	$daline = new Aluno(14);
	echo "Nome: {$daline->nome} <br>\n";
	echo "Endereço: {$daline->endereco} <br>\n";
	

	$daline = new Aluno(12);
	echo "Nome: {$daline->nome} <br>\n";
	echo "Endereço: {$daline->endereco} <br>\n";

	$curso = new Curso(1);
	echo "Curso: {$curso->descricao}<br>\n";

	TTransaction::close();
}catch(Exception $e){
	echo '<b>Erro</b>'.$e->getMessage();
	TTransaction::rollback();
}
?>

</body>
</html>
