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

class Turma extends TRecord{
	const TABLENAME = 'Turma';
}

class Inscricao extends TRecord{
	const TABLENAME = 'Inscricao';
}

?>
<!DOCTYPE html>
<html>
<head meta charset="UTF-8">
	<title>Collection Count</title>
</head>
<body>
<?php
try{
	TTransaction::open('my_curso');
	TTransaction::setLogger(new TLoggerHTML('../log/log_cap4-08.html'));

	TTransaction::log("** Total dos Alunos de Largeiro **");
	
	$criteria = new TCriteria;
	$criteria->add(new TFilter('cidade','=','Largeiro'));

	$repository = new TRepository('aluno');
	$count = $repository->count($criteria);
	
	echo "<h3>** ** Total dos Alunos de Largeiro $count ** **</h3>\n";


	TTransaction::log("** Conta os alunos da sala b19 a tarde e b17 tarde **");

	$criteria1 = new TCriteria;
	$criteria1->add(new TFilter('sala','=','b19'));
	$criteria1->add(new TFilter('turno','=','t'));

	$criteria2 = new TCriteria;
	$criteria2->add(new TFilter('sala','=','b17'));
	$criteria2->add(new TFilter('turno','=','t'));

	$criteria = new TCriteria;
	$criteria->add($criteria1,TExpression::OR_OPERADOR);
	$criteria->add($criteria2,TExpression::OR_OPERADOR);

	$repository = new TRepository('Turma');
	$count = $repository->count($criteria);

	echo "<h3>** Conta os alunos da sala b19 a tarde e b17 tarde $count **</h3>\n";

	TTransaction::close();
}catch(Exception $e){
	echo '<b>Erro</b>'.$e->getMessage();
	TTransaction::rollback();
}
?>

</body>
</html>