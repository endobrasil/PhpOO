<?php
function __autoload($classe){
	if(file_exists("../app.ado/{$classe}.class.php"))
	{
		include_once "../app.ado/{$classe}.class.php";
		echo "include_once ../app.ado/{$classe}.class.php<br>\n";
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
	TTransaction::setLogger(new TLoggerHTML('../log/log_cap4-09.html'));

	TTransaction::log("** exclui turmas da noite **");
	
	$criteria = new TCriteria;
	$criteria->add(new TFilter('turno','=','n'));

	$repository = new TRepository('turma');
	$turmas=$repository->load($criteria);
	
	if($turmas){
		foreach ($turmas as $turma) {
			$turma->delete();
		}
	}

	TTransaction::log("** exclui as inscrições do aluno 6 **");
	$criteria = new TCriteria;
	$criteria->add(new TFilter('id_Aluno','=',6));

	$repository = new TRepository('Inscricao');
	$repository->delete($criteria);



	TTransaction::close();
}catch(Exception $e){
	echo '<b>Erro</b>'.$e->getMessage();
	TTransaction::rollback();
}
?>

</body>
</html>